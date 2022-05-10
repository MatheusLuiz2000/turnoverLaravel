<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use Tymon\JWTAuth\Facades\JWTAuth;
use Tymon\JWTAuth\Facades\JWTFactory;
use App\Services\TransactionService;
use Validator;

class TransactionsController extends Controller
{

    private $transactionsService;

    public function __construct()
    {
        $this->transactionsService = new TransactionService();
    }

    public function searchTransactions()
    {
        try {
            $transactions = $this->transactionsService->searchTransaction();

            return response()->json($transactions);
        } catch (\Exception $ex) {
            return response()->json(['error' => true, 'message' => $ex->getMessage()], 400);
        }
    }

    public function getTransactionsCount()
    {
        try {
            $transactions = $this->transactionsService->getCountTransactions();

            return response()->json($transactions);
        } catch (\Exception $ex) {
            return response()->json(['error' => true, 'message' => $ex->getMessage()], 400);
        }
    }
}
