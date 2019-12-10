<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\User;
use App\Wallet;
use App\Http\Resources\Wallet as WalletResource;
use Illuminate\Http\Request;

class WalletController extends Controller
{

    public function index(Request $request)
    {
        return WalletResource::collection(Wallet::all());

    }

    public function getNumberOfWallets(){
        $wallets = Wallet::all();
        return $wallets->count();
    }

    public function getMyWallet($id){
        $user = User::findOrFail($id);
        return WalletResource::collection(Wallet::query()->where('email',$user->email));
    }

    public function getMyBalance($id){
        $user = User::findOrFail($id);
        $wallet= WalletResource::collection(Wallet::query()->where('email',$user->email));
        return $wallet->balance;
    }
}
