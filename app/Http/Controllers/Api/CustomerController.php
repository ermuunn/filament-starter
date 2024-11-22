<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Customer;
use Illuminate\Http\Request;

class CustomerController extends Controller
{
    public function getCustomers(Request $request)
    {
        try {
            $customers = Customer::query()->orderBy('first_name')->get();
            return response()->json([
                'success' => true,
                'customers' => $customers,
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => $e->getMessage(),
            ], 500);
        }
    }
}
