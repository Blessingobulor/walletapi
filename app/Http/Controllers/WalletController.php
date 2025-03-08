<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Wallet;
use App\Models\User;


class WalletController extends Controller
{
    public function index()
    {
        return response()->json(Wallet::with(['user', 'walletType'])->get());
    }

    public function show($id)
    {
        $wallet = Wallet::with(['user', 'walletType'])->find($id);
        
        if (!$wallet) {
            return response()->json(['message' => 'wallet not found'], 404);
        }

        return response()->json($wallet);
    }
   
    public function transfer(Request $request)
{
    $request->validate([
        'from_wallet_id' => 'required|exists:wallets,id',
        'to_wallet_id' => 'required|exists:wallets,id|different:from_wallet_id',
        'amount' => 'required|numeric|min:0.01',
    ]);

    // Debug: Print wallet IDs
    return response()->json([
        'from_wallet_id' => $request->from_wallet_id,
        'to_wallet_id' => $request->to_wallet_id,
        'wallets_in_db' => Wallet::pluck('id')
    ]);

    $fromWallet = Wallet::find($request->from_wallet_id);
    $toWallet = Wallet::find($request->to_wallet_id);

    if (!$fromWallet || !$toWallet) {
        return response()->json(['message' => 'wallet not found'], 404);
    }

    if ($fromWallet->balance < $request->amount) {
        return response()->json(['message' => 'Insufficient funds'], 400);
    }

    // Perform transfer
    $fromWallet->decrement('balance', $request->amount);
    $toWallet->increment('balance', $request->amount);

    return response()->json(['message' => 'Transfer successful']);
}

}