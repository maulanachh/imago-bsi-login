<?php

namespace App\Livewire\Report\Hunian;

use App\Models\transaksi\rsvLangsung;
use Illuminate\Support\Carbon;
use Illuminate\Database\Query\Builder;
use PowerComponents\LivewirePowerGrid\Button;
use PowerComponents\LivewirePowerGrid\Column;
use PowerComponents\LivewirePowerGrid\Exportable;
use PowerComponents\LivewirePowerGrid\Facades\Filter;
use PowerComponents\LivewirePowerGrid\Footer;
use PowerComponents\LivewirePowerGrid\Header;
use PowerComponents\LivewirePowerGrid\PowerGrid;
use PowerComponents\LivewirePowerGrid\PowerGridFields;
use PowerComponents\LivewirePowerGrid\PowerGridComponent;
use PowerComponents\LivewirePowerGrid\Traits\WithExport;
use Illuminate\Support\Facades\DB;

final class TingkatHunianTable extends PowerGridComponent
{
    use WithExport;
    // public string $primaryKey = 'tr_reservasi_kmr.rsv_id';

    // public string $sortField = 'tr_reservasi_kmr.rsv_id';
    public function setUp(): array
    {

        return [
            Exportable::make('export')
                ->striped()
                ->type(Exportable::TYPE_XLS, Exportable::TYPE_CSV),
            Header::make()->showSearchInput(),
            Footer::make()
                ->showPerPage()
                ->showRecordCount(),
        ];
    }
    public function datasource(): ?Builder
    {
        $startDate = '2025-01-01'; // Ganti dengan tanggal mulai yang diinginkan
        $endDate = '2025-01-31'; // Ganti dengan tanggal akhir yang diinginkan

        // Ambil data kamar
        $rooms = DB::table('ms_kamar')->select('kamar_id', 'nama_kamar')->get();

        // Ambil data reservasi
        $reservations = DB::table('tr_reservasi_kmr')
            ->select('kamar_id', 'tanggal_checkin', 'tanggal_checkout')
            ->whereBetween('tanggal_checkin', [$startDate, $endDate])
            ->orWhereBetween('tanggal_checkout', [$startDate, $endDate])
            ->get();

        $utilization = [];
        $currentDate = $startDate;

        while ($currentDate <= $endDate) {
            $dailyStatus = ['date' => $currentDate];

            foreach ($rooms as $room) {
                $isOccupied = false;

                foreach ($reservations as $reservation) {
                    if (
                        $reservation->kamar_id == $room->kamar_id &&
                        $reservation->tanggal_checkin <= $currentDate &&
                        $reservation->tanggal_checkout >= $currentDate
                    ) {
                        $isOccupied = true;
                        break;
                    }
                }

                $dailyStatus[$room->nama_kamar] = $isOccupied ? 'Occupied' : 'Available';
            }

            $utilization[] = $dailyStatus;
            $currentDate = date('Y-m-d', strtotime($currentDate . ' +1 day'));
        }

        // Konversi array ke koleksi yang diterima oleh PowerGrid
        $utilizationCollection = collect($utilization);

        // Buat builder dari collection
        return $utilizationCollection;
    }

    public function relationSearch(): array
    {
        return [];
    }

    public function fields(): PowerGridFields
    {
        return PowerGrid::fields()
            ->add('id')
            ->add('date')
            ->add('used_rooms')
            ->add('empty_rooms');
    }

    public function columns(): array
    {
        return [
            Column::make('Date', 'date')->sortable()->searchable(),
            Column::make('Used Rooms', 'used_rooms')->sortable()->searchable(),
            Column::make('Empty Rooms', 'empty_rooms')->sortable()->searchable(),
            Column::action('Action')
        ];
    }

    public function filters(): array
    {
        return [
            Filter::datepicker('tanggal_checkin'),
            Filter::datepicker('tanggal_checkout'),
        ];
    }

    // #[\Livewire\Attributes\On('edit')]
    // public function edit($rowId): void
    // {
    //     $this->js('alert(' . $rowId . ')');
    // }

    // public function actions(rsvLangsung $row): array
    // {
    //     return [
    //         Button::add('edit')
    //             ->slot('Edit: ' . $row->id)
    //             ->id()
    //             ->class('pg-btn-white dark:ring-pg-primary-600 dark:border-pg-primary-600 dark:hover:bg-pg-primary-700 dark:ring-offset-pg-primary-800 dark:text-pg-primary-300 dark:bg-pg-primary-700')
    //             ->dispatch('edit', ['rowId' => $row->id])
    //     ];
    // }

    /*
    public function actionRules($row): array
    {
       return [
            // Hide button edit for ID 1
            Rule::button('edit')
                ->when(fn($row) => $row->id === 1)
                ->hide(),
        ];
    }
    */
}
