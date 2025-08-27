<?php

namespace App\Exports;

use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class UtilizationExport implements FromCollection, WithHeadings
{
    protected $startDate;
    protected $endDate;

    public function __construct($startDate, $endDate)
    {
        $this->startDate = Carbon::createFromFormat('d M, Y', $startDate)->format('Y-m-d');
        $this->endDate = Carbon::createFromFormat('d M, Y', $endDate)->format('Y-m-d');
    }

    public function collection()
    {
        $rooms = DB::table('ms_kamar')
            ->whereNull('deleted_at')
            ->select('kamar_id', 'kamar_name')
            ->get();
        $totalRooms = $rooms->count();

        $reservations = DB::table('tr_reservasi_kmr')
            ->select('kamar_id', 'tanggal_checkin', 'tanggal_checkout')
            ->whereBetween('tanggal_checkin', [$this->startDate, $this->endDate])
            ->orWhereBetween('tanggal_checkout', [$this->startDate, $this->endDate])
            ->get();

        $utilization = [];
        $grandTotalOccupied = 0;
        $totalPerRoom = array_fill_keys($rooms->pluck('kamar_id')->toArray(), 0);

        $currentDate = $this->startDate;
        while ($currentDate <= $this->endDate) {
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
                    $totalPerRoom[$room->kamar_id]++;
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
        ];

        // Tambahkan total per kamar ke grand total
        foreach ($rooms as $room) {
            $grandTotalRow[$room->kamar_name] = $totalPerRoom[$room->kamar_id];
        }

        // Tambahkan total kamar terisi dan total kamar
        $grandTotalRow['total_occupied'] = $grandTotalOccupied;
        $grandTotalRow['total_rooms'] = $totalRooms * count($utilization);
        $grandTotalRow['percentage_occupied'] = $totalRooms > 0 ? round(($grandTotalOccupied / ($totalRooms * count($utilization))) * 100, 2) : 0;

        // Tambahkan grand total row ke data
        $utilization[] = $grandTotalRow;

        return collect($utilization);
    }

    public function headings(): array
    {
        $headings = ['Tanggal'];

        $rooms = DB::table('ms_kamar')->whereNull('deleted_at')->pluck('kamar_name')->toArray();
        $headings = array_merge($headings, $rooms);

        $headings = array_merge($headings, ['Total Kamar Terisi', 'Total Kamar', 'Persentase Kamar Terisi (%)']);

        return $headings;
    }
}
