<?php

namespace App\Http\Controllers\transaksi;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Carbon;
use Barryvdh\Snappy\Facades\SnappyPdf as PDF;

class invoiceController extends Controller
{
    public function printInvoice($id)
    {
        $data_invoice = DB::table('tr_bill_total')
            ->where('billtotal_id', $id)
            ->where('deleted_at', null)
            ->first();
        $data_reservasi = DB::table('tr_reservasi_kmr')
            ->join('ms_customers', 'tr_reservasi_kmr.cus_id', '=', 'ms_customers.cus_id')
            ->join('ms_kamar', 'tr_reservasi_kmr.kamar_id', '=', 'ms_kamar.kamar_id')
            ->join('ms_tipe_inap', 'tr_reservasi_kmr.tipeinap_id', '=', 'ms_tipe_inap.tipeinap_id')
            ->join('ms_kelas_kmr', 'ms_kamar.klskmr_id', '=', 'ms_kelas_kmr.klskmr_id')
            ->join('users', 'users.user_id', '=', 'tr_reservasi_kmr.updated_by')
            ->join('ms_karyawan', 'users.karyawan_id', '=', 'ms_karyawan.karyawan_id')
            ->join('ms_rekanan', 'ms_rekanan.rekanan_id', '=', 'tr_reservasi_kmr.rekanan_id')
            ->where('rsv_id', $data_invoice->rsv_id)
            ->select(
                'ms_customers.cus_name',
                'ms_customers.cus_address',
                'ms_customers.cus_phone',
                'tr_reservasi_kmr.tanggal_checkin',
                'tr_reservasi_kmr.tanggal_checkout',
                'tr_reservasi_kmr.jumlah_tamu',
                'ms_tipe_inap.tipeinap_name',
                'ms_kamar.kamar_name',
                'ms_kelas_kmr.klskmr_name',
                'ms_karyawan.karyawan_name',
                'ms_rekanan.rekanan_name',
            )
            ->first();
        Carbon::setLocale('id');
        $tgl_cetak = Carbon::now();
        $tgl_cetak_format = $tgl_cetak->translatedFormat('d F Y');
        //$nominal_pajak = ($data_invoice->total_bill_kmr + $data_invoice->total_bill_fasilitas * $data_invoice->pajak) / 100;
        $data_cetak_invoice = [
            'cus_name' => $data_reservasi->cus_name,
            'karyawan_name' => $data_reservasi->karyawan_name,
            'cus_address' => $data_reservasi->cus_address,
            'cus_phone' => $data_reservasi->cus_phone,
            'tanggal_checkin' => $data_reservasi->tanggal_checkin,
            'tanggal_checkout' => $data_reservasi->tanggal_checkout,
            'jumlah_tamu' => $data_reservasi->jumlah_tamu,
            'tipeinap_name' => $data_reservasi->tipeinap_name,
            'kamar_name' => $data_reservasi->kamar_name,
            'klskmr_name' => $data_reservasi->klskmr_name,
            'no_invoice' => $data_invoice->no_invoice,
            'tgl_invoice' => $tgl_cetak_format,
            'total_bill_kmr' => $data_invoice->total_bill_kmr,
            'total_bill_fasilitas' => $data_invoice->total_bill_fasilitas,
            'total_bill_fnb' => $data_invoice->total_bill_fnb,
            'total_bill_extracharge' => $data_invoice->total_bill_extracharge,
            'total_bill_extracharge_manual' => $data_invoice->total_bill_extracharge_manual,
            'subtotal' => $data_invoice->subtotal,
            'nominal_diskon' => $data_invoice->nominal_diskon,
            'nominal_diskon_rekanan' => $data_invoice->nominal_diskon_rekanan,
            'pajak' => $data_invoice->pajak,
            'nominal_pajak' => $data_invoice->nominal_pajak,
            'grand_total' => $data_invoice->grand_total,
            'rekanan_name' => $data_reservasi->rekanan_name,
            'bayar_id' => $data_invoice->bayar_id
        ];
        return view(
            'livewire.transaksi.rsv-langsung.invoice',
            [
                'data_invoice' => $data_cetak_invoice
            ]
        );
    }
    public function printInvoiceDasar($id)
    {
        $data_invoice = DB::table('tr_bill_total')
            ->where('billtotal_id', $id)
            ->where('deleted_at', null)
            ->first();
        $data_reservasi = DB::table('tr_reservasi_kmr')
            ->join('ms_customers', 'tr_reservasi_kmr.cus_id', '=', 'ms_customers.cus_id')
            ->join('ms_kamar', 'tr_reservasi_kmr.kamar_id', '=', 'ms_kamar.kamar_id')
            ->join('ms_tipe_inap', 'tr_reservasi_kmr.tipeinap_id', '=', 'ms_tipe_inap.tipeinap_id')
            ->join('ms_kelas_kmr', 'ms_kamar.klskmr_id', '=', 'ms_kelas_kmr.klskmr_id')
            ->join('users', 'users.user_id', '=', 'tr_reservasi_kmr.updated_by')
            ->join('ms_karyawan', 'users.karyawan_id', '=', 'ms_karyawan.karyawan_id')
            ->join('ms_rekanan', 'ms_rekanan.rekanan_id', '=', 'tr_reservasi_kmr.rekanan_id')
            ->where('rsv_id', $data_invoice->rsv_id)
            ->select(
                'ms_customers.cus_name',
                'ms_customers.cus_address',
                'ms_customers.cus_phone',
                'tr_reservasi_kmr.tanggal_checkin',
                'tr_reservasi_kmr.tanggal_checkout',
                'tr_reservasi_kmr.jumlah_tamu',
                'ms_tipe_inap.tipeinap_name',
                'ms_kamar.kamar_name',
                'ms_kelas_kmr.klskmr_name',
                'ms_karyawan.karyawan_name',
                'ms_rekanan.rekanan_name',
            )
            ->first();
        Carbon::setLocale('id');
        $tgl_cetak = Carbon::now();
        $tgl_cetak_format = $tgl_cetak->translatedFormat('d F Y');
        //$nominal_pajak = ($data_invoice->total_bill_kmr + $data_invoice->total_bill_fasilitas * $data_invoice->pajak) / 100;
        $data_cetak_invoice = [
            'cus_name' => $data_reservasi->cus_name,
            'karyawan_name' => $data_reservasi->karyawan_name,
            'cus_address' => $data_reservasi->cus_address,
            'cus_phone' => $data_reservasi->cus_phone,
            'tanggal_checkin' => $data_reservasi->tanggal_checkin,
            'tanggal_checkout' => $data_reservasi->tanggal_checkout,
            'jumlah_tamu' => $data_reservasi->jumlah_tamu,
            'tipeinap_name' => $data_reservasi->tipeinap_name,
            'kamar_name' => $data_reservasi->kamar_name,
            'klskmr_name' => $data_reservasi->klskmr_name,
            'no_invoice' => $data_invoice->no_invoice,
            'tgl_invoice' => $tgl_cetak_format,
            'total_bill_kmr' => $data_invoice->total_bill_kmr,
            'total_bill_fasilitas' => $data_invoice->total_bill_fasilitas,
            'total_bill_kamar_fasilitas' => $data_invoice->total_bill_kmr + $data_invoice->total_bill_fasilitas,
            'total_bill_extracharge' => $data_invoice->total_bill_extracharge,
            'total_bill_extracharge_manual' => $data_invoice->total_bill_extracharge_manual,
            'subtotal' => $data_invoice->subtotal,
            'nominal_diskon' => $data_invoice->nominal_diskon,
            'nominal_diskon_rekanan' => $data_invoice->nominal_diskon_rekanan,
            'pajak' => $data_invoice->pajak,
            'nominal_pajak' => $data_invoice->nominal_pajak,
            'grand_total_kamar_fasilitas' => $data_invoice->total_bill_kmr + $data_invoice->total_bill_fasilitas + $data_invoice->nominal_pajak - $data_invoice->nominal_diskon - $data_invoice->nominal_diskon_rekanan,
            'grand_total' => $data_invoice->grand_total,
            'rekanan_name' => $data_reservasi->rekanan_name,
            'bayar_id' => $data_invoice->bayar_id
        ];
        return view(
            'livewire.transaksi.rsv-langsung.invoice-dasar',
            [
                'data_invoice' => $data_cetak_invoice
            ]
        );
    }
    public function printInvoiceExtra($id)
    {
        $data_invoice = DB::table('tr_bill_total')
            ->where('billtotal_id', $id)
            ->where('deleted_at', null)
            ->first();
        $data_reservasi = DB::table('tr_reservasi_kmr')
            ->join('ms_customers', 'tr_reservasi_kmr.cus_id', '=', 'ms_customers.cus_id')
            ->join('ms_kamar', 'tr_reservasi_kmr.kamar_id', '=', 'ms_kamar.kamar_id')
            ->join('ms_tipe_inap', 'tr_reservasi_kmr.tipeinap_id', '=', 'ms_tipe_inap.tipeinap_id')
            ->join('ms_kelas_kmr', 'ms_kamar.klskmr_id', '=', 'ms_kelas_kmr.klskmr_id')
            ->join('users', 'users.user_id', '=', 'tr_reservasi_kmr.updated_by')
            ->join('ms_karyawan', 'users.karyawan_id', '=', 'ms_karyawan.karyawan_id')
            ->join('ms_rekanan', 'ms_rekanan.rekanan_id', '=', 'tr_reservasi_kmr.rekanan_id')
            ->where('rsv_id', $data_invoice->rsv_id)
            ->select(
                'ms_customers.cus_name',
                'ms_customers.cus_address',
                'ms_customers.cus_phone',
                'tr_reservasi_kmr.tanggal_checkin',
                'tr_reservasi_kmr.tanggal_checkout',
                'tr_reservasi_kmr.jumlah_tamu',
                'ms_tipe_inap.tipeinap_name',
                'ms_kamar.kamar_name',
                'ms_kelas_kmr.klskmr_name',
                'ms_karyawan.karyawan_name',
                'ms_rekanan.rekanan_name',
            )
            ->first();
        Carbon::setLocale('id');
        $tgl_cetak = Carbon::now();
        $tgl_cetak_format = $tgl_cetak->translatedFormat('d F Y');
        //$nominal_pajak = ($data_invoice->total_bill_kmr + $data_invoice->total_bill_fasilitas * $data_invoice->pajak) / 100;
        $data_cetak_invoice = [
            'cus_name' => $data_reservasi->cus_name,
            'karyawan_name' => $data_reservasi->karyawan_name,
            'cus_address' => $data_reservasi->cus_address,
            'cus_phone' => $data_reservasi->cus_phone,
            'tanggal_checkin' => $data_reservasi->tanggal_checkin,
            'tanggal_checkout' => $data_reservasi->tanggal_checkout,
            'jumlah_tamu' => $data_reservasi->jumlah_tamu,
            'tipeinap_name' => $data_reservasi->tipeinap_name,
            'kamar_name' => $data_reservasi->kamar_name,
            'klskmr_name' => $data_reservasi->klskmr_name,
            'no_invoice' => $data_invoice->no_invoice,
            'tgl_invoice' => $tgl_cetak_format,
            'total_bill_kmr' => $data_invoice->total_bill_kmr,
            'total_bill_fasilitas' => $data_invoice->total_bill_fasilitas,
            'total_bill_extracharge' => $data_invoice->total_bill_extracharge,
            'total_bill_extracharge_manual' => $data_invoice->total_bill_extracharge_manual,
            'total_bill_fnb' => $data_invoice->total_bill_fnb,
            'subtotal' => $data_invoice->subtotal,
            'subtotal_extra' => $data_invoice->total_bill_extracharge + $data_invoice->total_bill_extracharge_manual + +$data_invoice->total_bill_fnb,
            'nominal_diskon' => $data_invoice->nominal_diskon,
            'pajak' => $data_invoice->pajak,
            'nominal_pajak' => $data_invoice->nominal_pajak,
            'grand_total' => $data_invoice->grand_total,
            'rekanan_name' => $data_reservasi->rekanan_name,
            'grand_total_extra' => $data_invoice->total_bill_extracharge + $data_invoice->total_bill_extracharge_manual + $data_invoice->total_bill_fnb
        ];
        return view(
            'livewire.transaksi.rsv-langsung.invoice-extra',
            [
                'data_invoice' => $data_cetak_invoice
            ]
        );
    }
    public function printInvoiceDP($id)
    {
        $data_invoice = DB::table('tr_bill_dp')
            ->where('billtotal_id', $id)
            ->where('deleted_at', null)
            ->first();
        $data_reservasi = DB::table('tr_booking_kmr')
            ->join('ms_customers', 'tr_booking_kmr.cus_id', '=', 'ms_customers.cus_id')
            ->join('ms_kamar', 'tr_booking_kmr.kamar_id', '=', 'ms_kamar.kamar_id')
            ->join('ms_tipe_inap', 'tr_booking_kmr.tipeinap_id', '=', 'ms_tipe_inap.tipeinap_id')
            ->join('ms_kelas_kmr', 'ms_kamar.klskmr_id', '=', 'ms_kelas_kmr.klskmr_id')
            ->join('users', 'users.user_id', '=', 'tr_booking_kmr.updated_by')
            ->join('ms_karyawan', 'users.karyawan_id', '=', 'ms_karyawan.karyawan_id')
            ->join('ms_rekanan', 'ms_rekanan.rekanan_id', '=', 'tr_booking_kmr.rekanan_id')
            ->where('booking_id', $data_invoice->booking_id)
            ->select(
                'ms_customers.cus_name',
                'ms_customers.cus_address',
                'ms_customers.cus_phone',
                'tr_booking_kmr.tanggal_checkin',
                'tr_booking_kmr.tanggal_checkout',
                'tr_booking_kmr.jumlah_tamu',
                'ms_tipe_inap.tipeinap_name',
                'ms_kamar.kamar_name',
                'ms_kelas_kmr.klskmr_name',
                'ms_karyawan.karyawan_name',
                'ms_rekanan.rekanan_name',
            )
            ->first();
        Carbon::setLocale('id');
        $tgl_cetak = Carbon::now();
        $tgl_cetak_format = $tgl_cetak->translatedFormat('d F Y');
        //$nominal_pajak = ($data_invoice->total_bill_kmr + $data_invoice->total_bill_fasilitas * $data_invoice->pajak) / 100;
        $data_cetak_invoice = [
            'cus_name' => $data_reservasi->cus_name,
            'karyawan_name' => $data_reservasi->karyawan_name,
            'cus_address' => $data_reservasi->cus_address,
            'cus_phone' => $data_reservasi->cus_phone,
            'tanggal_checkin' => Carbon::parse($data_reservasi->tanggal_checkin)->format('d M, Y'),
            'tanggal_checkout' => Carbon::parse($data_reservasi->tanggal_checkout)->format('d M, Y'),
            'jumlah_tamu' => $data_reservasi->jumlah_tamu,
            'tipeinap_name' => $data_reservasi->tipeinap_name,
            'kamar_name' => $data_reservasi->kamar_name,
            'klskmr_name' => $data_reservasi->klskmr_name,
            'no_invoice' => $data_invoice->no_invoice,
            'tgl_invoice' => $tgl_cetak_format,
            'total_bill_kmr' => $data_invoice->total_bill_kmr,
            'total_bill_fasilitas' => $data_invoice->total_bill_fasilitas,
            'total_bill_fnb' => $data_invoice->total_bill_fnb,
            'subtotal' => $data_invoice->subtotal,
            'nominal_diskon' => $data_invoice->nominal_diskon,
            'pajak' => $data_invoice->pajak,
            'nominal_pajak' => $data_invoice->nominal_pajak,
            'nominal_bayar' => $data_invoice->nominal_bayar,
            'nominal_diskon_rekanan' => $data_invoice->nominal_diskon_rekanan,
            'grand_total' => $data_invoice->grand_total,
            'rekanan_name' => $data_reservasi->rekanan_name,
            'bayar_id' => $data_invoice->bayar_id
        ];
        return view(
            'livewire.transaksi.booking.invoice',
            [
                'data_invoice' => $data_cetak_invoice
            ]
        );
    }
}
