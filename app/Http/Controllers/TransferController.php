<?php

namespace App\Http\Controllers;

use App\Models\Account;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class TransferController extends Controller
{
    # Función para realizar la transferencia entre cuentas (la que se ejecuta cuando le pegan a /transfer)
    public function transfer(Request $request)
    {
        # Validaciones que las cuentas existen y que el monto es mayor a 0
        $validated = $request->validate([
            'from_account_id' => 'required|exists:accounts,id',
            'to_account_id' => 'required|exists:accounts,id|different:from_account_id',
            'amount' => 'required|numeric|min:0.01',
        ]);

        try {
            # Iniciamos una transacción de base de datos con DB::transaction de Laravel
            DB::transaction(function () use ($validated) {
                # Es como hacer: SELECT * FROM accounts WHERE id = ? , y devuelve una instancia de App\Models\Account
                $from = Account::find($validated['from_account_id']); 
                $to = Account::find($validated['to_account_id']);
                $amount = $validated['amount'];

                # Validación de que la cuenta de origen tiene suficientes fondos (amount mayor al balance)
                if ($from->balance < $amount) {
                    abort(400, 'Fondos insuficientes');
                }

                # Ejecutamos la lógica de transferencia
                $from->balance -= $amount;
                $to->balance += $amount;

                # Guardamos los cambios en las cuentas. Ejecuta UPDATE en la base de datos
                $from->save();
                $to->save();

                logger('➡️ Inicia transferencia');
                logger('➡️ From ID: ' . $validated['from_account_id']);
                logger('➡️ Simulando latencia externa');
                # Simulación del sistema externo
                usleep(random_int(100, 500) * 1000); # Latencia entre 100 y 500ms

                if (random_int(1, 100) <= 20) { # Probabilidad de fallo del 20%
                    logger('❌ Fallo simulado activado');
                    throw new \Exception('Fallo simulado en el sistema externo', 400);
                }

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
