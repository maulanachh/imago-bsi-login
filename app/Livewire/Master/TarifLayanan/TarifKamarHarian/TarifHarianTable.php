<?php

namespace App\Livewire\Master\TarifLayanan\TarifKamarHarian;

use App\Models\master\tarifHarian;
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

final class TarifHarianTable extends PowerGridComponent
{
    use WithExport;
    public string $primaryKey = 'ms_dailyrate_kmr.dailyrate_id';

    public string $sortField = 'ms_dailyrate_kmr.dailyrate_id';
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
        return tarifHarian::query()
            ->join('ms_days', 'ms_dailyrate_kmr.day_id', '=', 'ms_days.day_id')
            ->join('ms_kelas_kmr', 'ms_dailyrate_kmr.klskmr_id', '=', 'ms_kelas_kmr.klskmr_id')
            ->select(
                'ms_dailyrate_kmr.dailyrate_id',
                'ms_days.day_name',
                'ms_kelas_kmr.klskmr_name',
                'ms_dailyrate_kmr.tarif_harian_fullday',
                'ms_dailyrate_kmr.tarif_harian_halfday',
            );
    }

    public function relationSearch(): array
    {
        return [];
    }

    public function fields(): PowerGridFields
    {
        return PowerGrid::fields()
            ->add('dailyrate_id')
            ->add('klskmr_id')
            ->add('day_id')
            ->add('tarif_harian_fullday')
            ->add('tarif_harian_halfday')
            ->add('created_by')
            ->add('updated_by')
            ->add('deleted_by')
            ->add('created_at');
    }

    public function columns(): array
    {
        return [
            Column::make('id', 'dailyrate_id')
                ->sortable()
                ->searchable(),

            Column::make('nama kelas kamar', 'klskmr_name')
                ->sortable()
                ->searchable(),

            Column::make('hari', 'day_name')
                ->sortable()
                ->searchable(),

            Column::make('Tarif harian fullday', 'tarif_harian_fullday')
                ->sortable()
                ->searchable(),

            Column::make('Tarif harian halfday', 'tarif_harian_halfday')
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
        $tarif_kamar = tarifHarian::query()->find($rowId);
        session()->put([
            'dailyrate_id' => $rowId,
            'function' => 'edit'
        ]);
        redirect('/master/tariflayanan/tarifharian/create');
    }
    #[\Livewire\Attributes\On('confirmDeleteTarifHarian')]
    public function deleteRow($id)
    {
        $user = Auth::user();
        $data_kamar = tarifHarian::find($id);
        if ($data_kamar) {
            $delete_data = $data_kamar->delete(); // Soft delete
            if ($delete_data) {
                $data_kamar->update([
                    'deleted_by' => $user->user_id
                ]);
                $this->js("alert('Tarif Kamar berhasil dihapus.')");
            } else {
                $this->js("alert('Gagal menghapus Tarif Kamar .')");
            }
        } else {
            $this->js("alert('Fitur tidak ditemukan.')");
        }
    }
    public function actions(tarifHarian $row): array
    {
        return [
            Button::add('edit')
                ->slot('<i class="bx bx-edit-alt"></i> Edit')
                ->id()
                ->class('btn btn-ghost-primary waves-effect waves-light')
                ->dispatch('edit', ['rowId' => $row->dailyrate_id]),
            Button::add('delete')
                ->slot('<i class="bx bx-trash-alt"></i> delete')
                ->id()
                ->class('btn btn-ghost-danger waves-effect waves-light')
                ->dispatch('openDeleteModal', [
                    'rowId' => $row->dailyrate_id,
                    'kamarName' => $row->klskmr_name,
                ])
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
