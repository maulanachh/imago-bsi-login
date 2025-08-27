<?php

namespace App\Livewire\Transaksi\Booking;

use App\Models\transaksi\booking;
use Illuminate\Support\Carbon;
use Illuminate\Database\Eloquent\Builder;
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
use Illuminate\Support\Facades\Auth;

final class BookingTable extends PowerGridComponent
{
    use WithExport;
    public string $primaryKey = 'booking_id';

    public string $sortField = 'booking_id';

    public function setUp(): array
    {
        return [
            Header::make()->showSearchInput(),
            Footer::make()
                ->showPerPage()
                ->showRecordCount(),
        ];
    }

    public function datasource(): Builder
    {
        return booking::query()
            ->join('ms_customers', 'tr_booking_kmr.cus_id', '=', 'ms_customers.cus_id')
            ->join('ms_kamar', 'tr_booking_kmr.kamar_id', '=', 'ms_kamar.kamar_id')
            ->join('ms_tipe_inap', 'tr_booking_kmr.tipeinap_id', '=', 'ms_tipe_inap.tipeinap_id')
            ->whereIn('sttsrsv_id', [5, 1])
            ->select([
                'tr_booking_kmr.booking_id',
                'ms_customers.cus_name',
                'ms_kamar.kamar_name',
                'ms_tipe_inap.tipeinap_name',
                'tr_booking_kmr.jumlah_tamu',
                'tr_booking_kmr.tanggal_checkin',
                'tr_booking_kmr.tanggal_checkout'
            ]);;
    }

    public function relationSearch(): array
    {
        return [];
    }

    public function fields(): PowerGridFields
    {
        return PowerGrid::fields()
            ->add('booking_id')
            ->add('rsv_id')
            ->add('cus_id')
            ->add('kamar_id')
            ->add('tanggal_checkin')
            ->add('tanggal_checkin')
            ->add('jumlah_tamu')
            ->add('sttsrsv_id')
            ->add('tipeinap_id')
            ->add('asaltrf_id')
            ->add('created_by')
            ->add('updated_by')
            ->add('deleted_by')
            ->add('created_at');
    }

    public function columns(): array
    {
        return [
            Column::make('Booking id', 'booking_id')
                ->sortable()
                ->searchable(),

            Column::make('nama customer', 'cus_name')
                ->sortable()
                ->searchable(),

            Column::make('nama kamar', 'kamar_name')
                ->sortable()
                ->searchable(),

            Column::make('jenis menginap', 'tipeinap_name')
                ->sortable(),

            Column::make('jumlah tamu', 'jumlah_tamu')
                ->sortable(),

            Column::make('tanggal Check-In', 'tanggal_checkin')
                ->sortable()
                ->searchable(),

            Column::make('tanggal Check-Out', 'tanggal_checkout')
                ->sortable()
                ->searchable(),


            Column::action('Action')
        ];
    }

    public function filters(): array
    {
        return [];
    }

    #[\Livewire\Attributes\On('edit')]
    public function edit($rowId): void
    {
        //$this->js('alert(' . $rowId . ')');
        $data_RSV = booking::query()->find($rowId);
        session()->put([
            'booking_id' => $rowId,
            'cus_id' => $data_RSV->cus_id,
            'function' => 'edit'
        ]);
        redirect('/transaksi/reservasi/booking/create');
    }

    public function actions(booking $row): array
    {
        return [
            Button::add('edit')
                ->slot('<i class="bx bx-edit-alt"></i> Edit')
                ->id()
                ->class('btn btn-ghost-primary waves-effect waves-light')
                ->dispatch('edit', ['rowId' => $row->booking_id]),
        ];
    }

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
