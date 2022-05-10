<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use App\Services\DepositService;
use Tymon\JWTAuth\Facades\JWTAuth;
use Tymon\JWTAuth\Facades\JWTFactory;
use App\Services\PurchaseService;
use Validator;

class DepositController extends Controller
{

    private $depositservice;

    public function __construct()
    {
        $this->depositservice = new DepositService();
    }

    public function getDeposits(Request $request)
    {
        try {
            $deposits = $this->depositservice->getDeposits($request);

            return response()->json($deposits);
        } catch (\Exception $ex) {
            return response()->json(['error' => true, 'message' => $ex->getMessage()], 400);
        }
    }

    public function getDepositPending(Request $request)
    {
        try {
            $deposits = $this->depositservice->getDepositPending($request);

            return response()->json($deposits);
        } catch (\Exception $ex) {
            return response()->json(['error' => true, 'message' => $ex->getMessage()], 400);
        }
    }

    public function addNewDeposit(Request $request)
    {
        try {
            $deposits = $this->depositservice->addNewDeposit($request);

            return response()->json($deposits);
        } catch (\Exception $ex) {
            return response()->json(['error' => true, 'message' => $ex->getMessage()], 400);
        }
    }

    public function updateDeposit(Request $request)
    {
        try {
            $deposits = $this->depositservice->updateDeposit($request);

            return response()->json($deposits);
        } catch (\Exception $ex) {
            return response()->json(['error' => true, 'message' => $ex->getMessage()], 400);
        }
    }
}
