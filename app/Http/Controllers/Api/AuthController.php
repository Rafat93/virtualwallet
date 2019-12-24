<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\User;
use App\Wallet;
use GuzzleHttp\Client;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class AuthController extends Controller
{

    public function register (Request $request) {

        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:255|regex:/^[A-Za-záàâãéèêíóôõúçÁÀÂÃÉÈÍÓÔÕÚÇ ]+$/',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:6|confirmed',
            'nif' => 'required|min:1|max:9',
            'file_foto' => 'nullable|image|mimes:jpeg,jpg|max:2048',
        ]);

        if ($validator->fails())
        {
            return response(['errors'=>$validator->errors()->all()], 422);
        }

        $request['password']=Hash::make($request['password']);
        $input = $request->all();
        $user = User::create($input);
        $wallet = new Wallet;
        $wallet->id = $user->id;
        $wallet->email = $user->email;
        $wallet->balance = 0;

        $wallet->save();

        return $this->createToken($request);

    }

    public function login(Request $request)
    {
        return $this->createToken($request);
    }

    public function logout()
    {
        \Auth::guard('api')->user()->token()->revoke();
        \Auth::guard('api')->user()->token()->delete();
        return response()->json(['msg' => 'Token revoked'], 200);
    }

    private function createToken($request){
        $http = new Client();
        $response = $http->post(env('PASSPORT_URL') . '/oauth/token', [
            'form_params' => [
                'grant_type' => 'password',
                'client_id' => env('PASSPORT_ID', 2),
                'client_secret' => env('PASSPORT_SECRET'),
                'username' => $request->email,
                'password' => $request->password,
                'scope' => ''
            ],
            'exceptions' => false,
        ]);
        $errorCode = $response->getStatusCode();
        if ($errorCode == '200') {
            return json_decode((string) $response->getBody(), true);
        } else {
            return response()->json(['msg' => 'user credentials are invalid'], $errorCode);
        }
    }
}
