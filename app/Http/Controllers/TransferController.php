<?php

namespace App\Http\Controllers;

use App\Models\Account;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class TransferController extends Controller
{
    public function transfer(Request $request)
    {
        $validated = $request->validate([
            'from_account_id' => 'required|exists:accounts,id',
            'to_account_id' => 'required|exists:accounts,id|different:from_account_id',
            'amount' => 'required|numeric|min:0.01',
        ]);

        try {
            DB::transaction(function () use ($validated) {
                $from = Account::find($validated['from_account_id']);
                $to = Account::find($validated['to_account_id']);
                $amount = $validated['amount'];

                if ($from->balance < $amount) {
                    abort(400, 'Fondos insuficientes.');
                }

                $from->balance -= $amount;
                $to->balance += $amount;

                $from->save();
                $to->save();
            });

            return response()->json(['message' => 'Transferencia exitosa.'], 200);
        } catch (\Exception $e) {
            return response()->json([
                'error' => 'Transferencia fallida.',
                'details' => $e->getMessage(),
            ], 500);
        }
    }
}
