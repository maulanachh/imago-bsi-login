<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\feature;
use Illuminate\Support\Facades\DB;

class costumerController extends Controller
{
    public function searchCustomer(Request $request)
    {
        try {
            $search = $request->get('search');

            $customers = DB::table('ms_customers')
                ->select('cus_id', 'cus_name')
                ->when($search, function ($query) use ($search) {
                    $query->where('cus_name', 'like', "%{$search}%")
                        ->orWhere('cus_identity_number', 'like', "%{$search}%")
                        ->orWhere('cus_phone', 'like', "%{$search}%");
                })
                ->limit(10)
                ->get()
                ->map(function ($item) {
                    return [
                        'id' => $item->cus_id,
                        'text' => $item->cus_name
                    ];
                });
            return response()->json([
                'data' => $customers
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'error' => 'Error fetching locations'
            ], 500);
        }
    }
}
