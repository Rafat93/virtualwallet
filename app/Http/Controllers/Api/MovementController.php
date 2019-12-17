<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Controllers\Api\WalletController;
use App\Http\Resources\Movement as MovementResource;
use App\Movement;
use App\User;
use App\Wallet;
use Illuminate\Http\Request;
use App\Http\Resources\Wallet as WalletResource;

class MovementController extends Controller
{
    public function index(Request $request)
    {
        return MovementResource::collection(Movement::paginate(10));
    }

    public function getMyMovements($id){
        $user = User::findOrFail($id);
        $wallet =  WalletResource::collection(Wallet::where('email',$user->email)->get());
        return MovementResource::collection(Movement::where('wallet_id',$wallet[0]->id)->get());
    }
}
