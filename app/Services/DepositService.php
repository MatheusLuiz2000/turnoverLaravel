<?php

namespace App\Services;

use Illuminate\Validation\ValidationException;
use App\Models\Deposit;
use App\Models\Purchase;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use App\Services\TransactionService;

class DepositService
{

    public function getDeposits()
    {
        $search = Deposit::where(['user_id' => auth()->user()->id]);

        return $search->get();
    }

    public function getDepositPending()
    {
        return Deposit::whereNull('status')->with('user')->get();
    }

    public function addNewDeposit($request)
    {
        $result = $request->file('check_img');

        $imageName = uniqid() . '.' . $result->getClientOriginalExtension();

        $checkImage = $result->storeAs('checks', $imageName, 'check');

        $data = array(
            "amount" => $request->input("amount"),
            "description" => $request->input("description"),
            'check_img' =>  $checkImage,
            'user_id' => auth()->user()->id
        );

        $deposit = new Deposit($data);

        $deposit->save();

        return $deposit;
    }

    public function updateDeposit($request)
    {
        $deposit = Deposit::find($request->input("id"));

        if (!$deposit) {
            return ['error' => true, 'message' => 'Erro to find the deposit'];
        }

        $deposit = Deposit::where("id", $request->input("id"))->update(['status' => $request->input("decision")]);

        return $deposit;
    }
}
