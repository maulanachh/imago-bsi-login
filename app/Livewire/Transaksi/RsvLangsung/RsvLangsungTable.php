<?php

namespace App\Livewire\Transaksi\RsvLangsung;

use App\Models\transaksi\rsvLangsung;
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
use Illuminate\Support\Facades\DB;

final class RsvLangsungTable extends PowerGridComponent
{
    use WithExport;
    public string $primaryKey = 'tr_reservasi_kmr.rsv_id';

    public string $sortField = 'tr_reservasi_kmr.rsv_id';
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
        return rsvLangsung::query()
            ->join('ms_customers', 'tr_reservasi_kmr.cus_id', '=', 'ms_customers.cus_id')
            ->join('ms_kamar', 'tr_reservasi_kmr.kamar_id', '=', 'ms_kamar.kamar_id')
            ->join('ms_tipe_inap', 'tr_reservasi_kmr.tipeinap_id', '=', 'ms_tipe_inap.tipeinap_id')
            ->where('tr_reservasi_kmr.sttsrsv_id', 3)
            ->select([
                'tr_reservasi_kmr.rsv_id',
                'ms_customers.cus_name',
                'ms_kamar.kamar_name',
                'ms_tipe_inap.tipeinap_name',
                'tr_reservasi_kmr.jumlah_tamu',
                'tr_reservasi_kmr.tanggal_checkin',
                'tr_reservasi_kmr.tanggal_checkout'
            ]);
    }

    public function relationSearch(): array
    {
        return [];
    }

    public function fields(): PowerGridFields
    {
        return PowerGrid::fields()
            ->add('rsv_id')
            ->add('cus_name')
            ->add('kamar_name')
            ->add('tipeinap_name')
            ->add('jumlah_tamu')
            ->add('tanggal_checkin')
            ->add('tanggal_checkout')
            ->add('tanggal_checkin_formatted', fn(rsvLangsung $model) => Carbon::parse($model->tanggal_checkin)->format('d M, y'))
            ->add('tanggal_checkout_formatted', fn(rsvLangsung $model) => Carbon::parse($model->tanggal_checkout)->format('d M, y'));
    }

    public function columns(): array
    {
        return [
            Column::make('id', 'rsv_id')
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

            Column::make('tanggal Check-In', 'tanggal_checkin_formatted', 'tanggal_checkin')
                ->sortable()
                ->searchable(),

            Column::make('tanggal Check-Out', 'tanggal_checkout_formatted', 'tanggal_checkout')
                ->sortable()
                ->searchable(),

            Column::action('Action')
        ];
    }

    public function filters(): array
    {
        return [
            Filter::inputText('cus_name', 'ms_customers.cus_name')
                ->operators(['contains']),
            Filter::inputText('kamar_name', 'ms_kamar.kamar_name')
                ->operators(['contains']),
            Filter::inputText('tipeinap_name', 'ms_tipe_inap.tipeinap_name')
                ->operators(['contains']),
        ];
    }

    #[\Livewire\Attributes\On('edit')]
    public function edit($rowId): void
    {
        //$this->js('alert(' . $rowId . ')');
        $data_RSV = rsvLangsung::query()->find($rowId);
        session()->put([
            'rsv_id' => $rowId,
            'cus_id' => $data_RSV->cus_id,
            'function' => 'edit'
        ]);
        redirect('/transaksi/reservasi/direct/create');
    }

    public function actions(rsvLangsung $row): array
    {
        return [
            Button::add('edit')
                ->slot('<i class="bx bx-edit-alt"></i> Edit')
                ->id()
                ->class('btn btn-ghost-primary waves-effect waves-light')
                ->dispatch('edit', ['rowId' => $row->rsv_id]),
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
