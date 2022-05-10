<?php

namespace App\Services;

use Illuminate\Validation\ValidationException;
use App\Models\Deposit;
use App\Models\Purchase;
use App\Services\TransactionService;

class PurchaseService
{
    public function addNewPurchase($request)
    {
        $data = $request->all();

        $purchaseservice = new TransactionService();

        $purchaseValues = $purchaseservice->getCountTransactions();

        $balance = $purchaseValues['deposit'] - $purchaseValues['purchase'];

        if ($balance >= $data['amount']) {

            $data = array(
                'amount' => $request->input('amount'),
                "description" => $request->input('description'),
                "created_at" =>  $request->input('date'),
                "user_id" => auth()->user()->id
            );

            $purchase = new Purchase($data);

            $purchase->save();

            return $purchase;
        } else {
            return ['error' => true, 'message' => 'Insufficient funds'];
        }
    }
}
