<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Controllers\Api\WalletController;
use App\Http\Requests\StoreMovementRequest;
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
        return MovementResource::collection(Movement::where('wallet_id',$user->id)->orderBy('date','ASC')->get());
    }

    public function store(StoreMovementRequest $request)
    {
        $movement = new Movement();
        $movement->fill($request->all());
        $movement->save();
        return response()->json(new MovementResource($movement), 201);
    }
}
