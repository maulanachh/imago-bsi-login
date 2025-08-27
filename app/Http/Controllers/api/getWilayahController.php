<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\feature;
use Illuminate\Support\Facades\DB;

class getWilayahController extends Controller
{
    public function searchProv(Request $request)
    {
        try {
            $search = $request->get('search');

            $provinsi = DB::table('ms_prov')
                ->select('id_prov', 'nama_prov')
                ->when($search, function ($query) use ($search) {
                    $query->where('nama_prov', 'like', "%{$search}%");
                })
                ->get()
                ->map(function ($item) {
                    return [
                        'id' => $item->id_prov,
                        'text' => $item->nama_prov
                    ];
                });
            return response()->json([
                'data' => $provinsi
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'error' => 'Error fetching locations'
            ], 500);
        }
    }
    public function searchKab(Request $request)
    {
        try {
            $search = $request->get('search');

            $kabupaten = DB::table('ms_kab')
                ->select('id_kab', 'nama_kab')
                ->where('id_prov', $request->get('id_prov'))
                ->when($search, function ($query) use ($search) {
                    $query->where('nama_kab', 'like', "%{$search}%");
                })
                ->get()
                ->map(function ($item) {
                    return [
                        'id' => $item->id_kab,
                        'text' => $item->nama_kab
                    ];
                });
            return response()->json([
                'data' => $kabupaten
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'error' => 'Error fetching locations'
            ], 500);
        }
    }
    public function searchKec(Request $request)
    {
        try {
            $search = $request->get('search');

            $kecamatan = DB::table('ms_kec')
                ->select('id_kec', 'nama_kec')
                ->where('id_kab', $request->get('id_kab'))
                ->when($search, function ($query) use ($search) {
                    $query->where('nama_kec', 'like', "%{$search}%");
                })
                ->get()
                ->map(function ($item) {
                    return [
                        'id' => $item->id_kec,
                        'text' => $item->nama_kec
                    ];
                });
            return response()->json([
                'data' => $kecamatan
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'error' => 'Error fetching locations'
            ], 500);
        }
    }
    public function searchKel(Request $request)
    {
        try {
            $search = $request->get('search');

            $kelurahan = DB::table('ms_kel')
                ->select('id_kel', 'nama_kel')
                ->where('id_kec', $request->get('id_kec'))
                ->when($search, function ($query) use ($search) {
                    $query->where('nama_kel', 'like', "%{$search}%");
                })
                ->get()
                ->map(function ($item) {
                    return [
                        'id' => $item->id_kel,
                        'text' => $item->nama_kel
                    ];
                });
            return response()->json([
                'data' => $kelurahan
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'error' => 'Error fetching locations'
            ], 500);
        }
    }
}
