<?php

namespace App\Livewire\Report\Hunian;

use Livewire\Component;
use Livewire\Attributes\Layout;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;
use Illuminate\Validation\Rule;
use Illuminate\Support\Carbon;
use Maatwebsite\Excel\Facades\Excel;
use App\Exports\UtilizationExport;

class TingkatHunianIndex extends Component
{
    #[Layout('components.layouts.app')]
    public $username;
    public $tanggal_awal;
    public $tanggal_akhir;
    public $data_okupasi = [];

    public function ambilData()
    {
        $startDate = Carbon::createFromFormat('d M, Y', $this->tanggal_awal)->format('Y-m-d'); // Ganti dengan tanggal mulai yang diinginkan
        $endDate = Carbon::createFromFormat('d M, Y', $this->tanggal_akhir)->format('Y-m-d'); // Ganti dengan tanggal akhir yang diinginkan

        // Ambil data kamar
        $rooms = DB::table('ms_kamar')
            ->whereNull('deleted_at')
            ->select('kamar_id', 'kamar_name')
            ->get();
        $totalRooms = $rooms->count(); // Total kamar

        $reservations = DB::table('tr_reservasi_kmr')
            ->select('kamar_id', 'tanggal_checkin', 'tanggal_checkout')
            ->whereBetween('tanggal_checkin', [$startDate, $endDate])
            ->orWhereBetween('tanggal_checkout', [$startDate, $endDate])
            ->get();

        $utilization = [];
        $grandTotalOccupied = 0;
        $totalPerRoom = array_fill_keys($rooms->pluck('kamar_id')->toArray(), 0); // Inisialisasi total per kamar

        $currentDate = $startDate;
        while ($currentDate <= $endDate) {
            $dailyStatus = ['date' => $currentDate];
            $occupiedCount = 0;

            foreach ($rooms as $room) {
                $isOccupied = false;

                foreach ($reservations as $reservation) {
                    if (
                        $reservation->kamar_id == $room->kamar_id &&
                        $reservation->tanggal_checkin <= $currentDate &&
                        $reservation->tanggal_checkout > $currentDate
                    ) {
                        $isOccupied = true;
                        break;
                    }
                }

                $dailyStatus[$room->kamar_name] = $isOccupied ? '1' : '0';
                if ($isOccupied) {
                    $occupiedCount++;
                    $totalPerRoom[$room->kamar_id]++; // Tambah total per kamar
                }
            }

            $dailyStatus['total_occupied'] = $occupiedCount;
            $dailyStatus['total_rooms'] = $totalRooms;
            $dailyStatus['percentage_occupied'] = $totalRooms > 0 ? round(($occupiedCount / $totalRooms) * 100, 2) : 0;

            $grandTotalOccupied += $occupiedCount;
            $utilization[] = $dailyStatus;
            $currentDate = date('Y-m-d', strtotime($currentDate . ' +1 day'));
        }

        // Add grand total row
        $grandTotalRow = [
            'date' => 'Grand Total',
            'total_occupied' => $grandTotalOccupied,
            'total_rooms' => $totalRooms * count($utilization), // Total kamar selama periode
            'percentage_occupied' => $totalRooms > 0 ? round(($grandTotalOccupied / ($totalRooms * count($utilization))) * 100, 2) : 0, // Persentase terisi
        ];

        // Tambahkan total per kamar ke grand total
        foreach ($rooms as $room) {
            $grandTotalRow[$room->kamar_name] = $totalPerRoom[$room->kamar_id];
        }

        $utilization[] = $grandTotalRow;

        $this->data_okupasi = $utilization;
    }
    public function exportToExcel()
    {
        return Excel::download(new UtilizationExport($this->tanggal_awal, $this->tanggal_akhir), 'utilization_report.xlsx');
    }
    public function mount()
    {
        if (Auth::check()) {
            $this->username = Auth::user()->user_name;
        } else {
            return redirect()->route('login');
        }
    }
    public function render()
    {
        return view('livewire.report.hunian.tingkat-hunian-index');
    }
}
