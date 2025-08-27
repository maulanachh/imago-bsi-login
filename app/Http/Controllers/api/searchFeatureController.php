<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\feature;
use Illuminate\Support\Facades\DB;

class searchFeatureController extends Controller
{
    public function searchLocation(Request $request)
    {
        try {
            $search = $request->get('search');

            $locations = DB::table('feature_location')
                ->select('feature_location_id', 'feature_location_name')
                ->when($search, function ($query) use ($search) {
                    $query->where('feature_location_name', 'like', "%{$search}%");
                })
                ->limit(10)
                ->get()
                ->map(function ($item) {
                    return [
                        'id' => $item->feature_location_id,
                        'text' => $item->feature_location_name
                    ];
                });
            return response()->json([
                'data' => $locations
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'error' => 'Error fetching locations'
            ], 500);
        }
    }
    public function searchFeatureParentSidebar(Request $request)
    {
        try {
            $search = $request->get('search');

            $feature_parent = DB::table('features')
                ->select('feature_id', 'feature_name')
                ->where('is_parent', 1)
                ->whereNull('feature_parent_id')
                ->when($search, function ($query) use ($search) {
                    $query->where('feature_name', 'like', "%{$search}%");
                })
                ->limit(10)
                ->get()
                ->map(function ($item) {
                    return [
                        'id' => $item->feature_id,
                        'text' => $item->feature_name
                    ];
                });
            return response()->json([
                'data' => $feature_parent
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'error' => 'Error fetching locations'
            ], 500);
        }
    }
    public function searchFeatureLevel(Request $request)
    {
        try {
            $search = $request->get('search');

            $feature_level = DB::table('feature_level')
                ->select('feature_level_id', 'feature_level_name')
                ->when($search, function ($query) use ($search) {
                    $query->where('feature_level_name', 'like', "%{$search}%");
                })
                ->limit(10)
                ->get()
                ->map(function ($item) {
                    return [
                        'id' => $item->feature_level_id,
                        'text' => $item->feature_level_name
                    ];
                });
            return response()->json([
                'data' => $feature_level
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'error' => 'Error fetching locations'
            ], 500);
        }
    }
    public function searchFeatureParent(Request $request)
    {
        try {
            $search = $request->get('search');
            $feature_location_id = $request->location_id;
            $parent_sidebar = $request->parent_sidebar;
            $feature_parent = DB::table('features')
                ->select('feature_id', 'feature_name')
                ->where('is_parent', 1)
                ->where('feature_feature_location_id', $feature_location_id)
                ->where('feature_side_bar_id', $parent_sidebar)
                ->when($search, function ($query) use ($search) {
                    $query->where('feature_name', 'like', "%{$search}%");
                })
                ->limit(10)
                ->get()
                ->map(function ($item) {
                    return [
                        'id' => $item->feature_id,
                        'text' => $item->feature_name
                    ];
                });
            return response()->json([
                'data' => $feature_parent
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'error' => 'Error fetching locations'
            ], 500);
        }
    }
}
