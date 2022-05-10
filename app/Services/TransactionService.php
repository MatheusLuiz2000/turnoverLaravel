<?php

namespace App\Services;

use Illuminate\Validation\ValidationException;

use App\Models\Deposit;
use App\Models\Purchase;


class TransactionService
{
    public function searchTransaction()
    {
        $user_id = auth()->user()->id;

        $deposit = Deposit::where([['user_id', $user_id], ['status', '1', $user_id]]);
        $purchase = Purchase::where('user_id', $user_id);

        return ['deposit' => $deposit->get(), 'purchase' => $purchase->get()];
    }

    public function getCountTransactions()
    {
        $user_id = auth()->user()->id;

        $deposit = Deposit::where([['user_id', $user_id], ['status', '1', $user_id]])->sum("amount");
        $purchase = Purchase::where('user_id', $user_id)->sum("amount");

        return ['deposit' => $deposit, 'purchase' => $purchase];
    }
}
