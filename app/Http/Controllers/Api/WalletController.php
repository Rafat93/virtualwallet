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
        return WalletResource::collection(Wallet::where('id',$id)->get());
    }

    public function getMyBalance($id){
        $wallet= Wallet::where('id',$id)->get();
        return $wallet[0]->balance;
    }
}
