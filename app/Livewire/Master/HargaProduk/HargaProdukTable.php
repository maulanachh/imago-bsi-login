<?php

namespace App\Livewire\Master\HargaProduk;

use App\Models\master\hargaProduk;
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
use Illuminate\Support\Facades\DB;

final class HargaProdukTable extends PowerGridComponent
{
    public string $primaryKey = 'produk_id';
    public string $sortField = 'produk_id';

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
        return hargaProduk::query()
            ->join('ms_produk', 'ms_harga_produk.produk_id', '=', 'ms_produk.produk_id')
            ->groupBy('ms_harga_produk.produk_id')
            ->select(
                'ms_harga_produk.produk_id',
                'ms_produk.produk_name',
                DB::raw('COUNT(ms_harga_produk.pekerjaan_id) as pekerjaan_count')
            );
    }

    public function relationSearch(): array
    {
        return [];
    }

    public function fields(): PowerGridFields
    {
        return PowerGrid::fields()
            ->add('hrgproduk_id')
            ->add('produk_id')
            ->add('role_id')
            ->add('hpp')
            ->add('harga_jual')
            ->add('created_by')
            ->add('updated_by')
            ->add('deleted_by')
            ->add('created_at');
    }

    public function columns(): array
    {
        return [
            Column::make('Produk id', 'produk_id')
                ->sortable()
                ->searchable(),

            Column::make('nama produk', 'produk_name')
                ->sortable()
                ->searchable(),

            Column::make('jumlah cluster pekerjaan', 'pekerjaan_count')
                ->sortable()
                ->searchable(),
        ];
    }

    public function filters(): array
    {
        return [];
    }

    #[\Livewire\Attributes\On('edit')]
    public function edit($rowId): void
    {
        $this->js('alert(' . $rowId . ')');
    }

    // public function actions(hargaProduk $row): array
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
