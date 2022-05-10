<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use Tymon\JWTAuth\Facades\JWTAuth;
use Tymon\JWTAuth\Facades\JWTFactory;
use App\Services\PurchaseService;
use Validator;

class PurchaseController extends Controller
{

    private $purchaseservice;

    public function __construct()
    {
        $this->purchaseservice = new PurchaseService();
    }

    public function addNewPurchase(Request $request)
    {
        try {
            $purchases = $this->purchaseservice->addNewPurchase($request);

            return response()->json($purchases, 200);
        } catch (\Exception $ex) {
            return response()->json(['error' => true, 'message' => $ex->getMessage()], 400);
        }
    }
}
