<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Controllers\Api\WalletController;
use App\Http\Requests\StoreMovementRequest;
use App\Http\Requests\UpdateMovementRequest;
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
        return MovementResource::collection(Movement::where('wallet_id',$user->id)->orderBy('date','desc')->get());
    }

    public function getMyLastMovements($id){
        $user = User::findOrFail($id);
        return MovementResource::collection(Movement::where('wallet_id',$user->id)->orderBy('date','desc')->take(5)->get());
    }

    public function storeExpense(StoreMovementRequest $request)
    {
        $movement = new Movement();
        $movement->fill($request->all());
        //is a transfer, have to create an income in the other wallet
        $wallet = Wallet::collection(Wallet::where('id',$movement->wallet_id)->get());
        if($movement->transfer == 1){

        }
        $movement->start_balance = $lastMovement->end_balance;
        $movement->end_balance = $movement->start_balance-$movement->value;
        $movement->save();
        return response()->json(new MovementResource($movement), 201);
    }

    public function storeIncome(StoreMovementRequest $request)
    {
        $movement = new Movement();
        $movement->fill($request->all());

        $movement->save();
        return response()->json(new MovementResource($movement), 201);
    }

    public function update (UpdateMovementRequest $request,$id){
        $movement = Movement::findOrFail($id);
        $movement->fill($request->validated());
        $movement->save();
        return new MovementResource($movement);
    }

    public function destroy($id)
    {
        $movement = Movement::findOrFail($id);
        $movement->delete();
        return response()->json(null, 204);
    }
}
