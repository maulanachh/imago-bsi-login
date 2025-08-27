<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class prosesWilayahController extends Controller
{
    public function pecahWilayah()
    {
        $data = DB::table('wilayah')->get();

        foreach ($data as $item) {
            $segments = explode('.', $item->kode);
            $nama = $item->nama;

            switch (count($segments)) {
                case 1:
                    // Provinsi
                    DB::table('ms_prov')->updateOrInsert(
                        ['kode_prov' => $item->kode],
                        ['nama_prov' => $nama]
                    );
                    break;

                case 2:
                    // Kabupaten
                    $kode_prov = $segments[0];

                    $prov = DB::table('ms_prov')->where('kode_prov', $kode_prov)->first();
                    if (!$prov) continue 2;

                    DB::table('ms_kab')->updateOrInsert(
                        ['kode_kab' => $item->kode],
                        [
                            'nama_kab' => $nama,
                            'id_prov' => $prov->id_prov
                        ]
                    );
                    break;

                case 3:
                    // Kecamatan
                    $kode_kab = $segments[0] . '.' . $segments[1];

                    $kab = DB::table('ms_kab')->where('kode_kab', $kode_kab)->first();
                    if (!$kab) continue 2;

                    DB::table('ms_kec')->updateOrInsert(
                        ['kode_kec' => $item->kode],
                        [
                            'nama_kec' => $nama,
                            'id_kab' => $kab->id_kab
                        ]
                    );
                    break;

                case 4:
                    // Kelurahan
                    $kode_kec = $segments[0] . '.' . $segments[1] . '.' . $segments[2];

                    $kec = DB::table('ms_kec')->where('kode_kec', $kode_kec)->first();
                    if (!$kec) continue 2;

                    DB::table('ms_kel')->updateOrInsert(
                        ['kode_kel' => $item->kode],
                        [
                            'nama_kel' => $nama,
                            'id_kec' => $kec->id_kec
                        ]
                    );
                    break;

                default:
                    continue 2;
            }
        }

        return response()->json(['message' => 'Data berhasil diproses']);
    }
}
