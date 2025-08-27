<?php

namespace App\Livewire\Master\TarifLayanan\TarifKhusus;

use App\Models\master\tarifKhusus;
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

final class TarifKhususTable extends PowerGridComponent
{
    use WithExport;
    public string $primaryKey = 'ms_tarif_khusus_kmr.trkhusus_id';

    public string $sortField = 'ms_tarif_khusus_kmr.trkhusus_id';
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
        return tarifKhusus::query()
            ->join('ms_kelas_kmr', 'ms_tarif_khusus_kmr.klskmr_id', '=', 'ms_kelas_kmr.klskmr_id')
            ->select(
                'ms_kelas_kmr.klskmr_name',
                'ms_tarif_khusus_kmr.trkhusus_id',
                'ms_tarif_khusus_kmr.trkhusus_fullday',
                'ms_tarif_khusus_kmr.trkhusus_halfday',
                'ms_tarif_khusus_kmr.tanggal_awal',
                'ms_tarif_khusus_kmr.tanggal_akhir'

            );
    }

    public function relationSearch(): array
    {
        return [];
    }

    public function fields(): PowerGridFields
    {
        return PowerGrid::fields()
            ->add('trkhusus_id')
            ->add('klskmr_id')
            ->add('klskmr_name')
            ->add('trkhusus_fullday')
            ->add('trkhusus_halfday')
            ->add('tanggal_awal_formatted', fn(tarifKhusus $model) => Carbon::parse($model->tanggal_awal)->format('d/m/Y H:i:s'))
            ->add('tanggal_akhir_formatted', fn(tarifKhusus $model) => Carbon::parse($model->tanggal_akhir)->format('d/m/Y H:i:s'))
            ->add('keterangan')
            ->add('created_by')
            ->add('updated_by')
            ->add('deleted_by')
            ->add('created_at');
    }

    public function columns(): array
    {
        return [
            Column::make('id', 'trkhusus_id')
                ->sortable()
                ->searchable(),

            Column::make('nama kelas kamar', 'klskmr_name')
                ->sortable()
                ->searchable(),

            Column::make('Tanggal awal event', 'tanggal_awal_formatted', 'tanggal_awal')
                ->sortable(),

            Column::make('Tanggal akhir event', 'tanggal_akhir_formatted', 'tanggal_akhir')
                ->sortable(),

            Column::make('tarif fullday', 'trkhusus_fullday')
                ->sortable()
                ->searchable(),

            Column::make('tarif halfday', 'trkhusus_halfday')
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
        $tarif_kamar = tarifKhusus::query()->find($rowId);
        session()->put([
            'trkhusus_id' => $rowId,
            'function' => 'edit'
        ]);
        redirect('/master/tariflayanan/tarifkhusus/create');
    }
    #[\Livewire\Attributes\On('confirmDeleteTarifKhusus')]
    public function deleteRow($id)
    {
        $user = Auth::user();
        $data_kamar = tarifKhusus::find($id);
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
    public function actions(tarifKhusus $row): array
    {
        return [
            Button::add('edit')
                ->slot('<i class="bx bx-edit-alt"></i> Edit')
                ->id()
                ->class('btn btn-ghost-primary waves-effect waves-light')
                ->dispatch('edit', ['rowId' => $row->trkhusus_id]),
            Button::add('delete')
                ->slot('<i class="bx bx-trash-alt"></i> delete')
                ->id()
                ->class('btn btn-ghost-danger waves-effect waves-light')
                ->dispatch('openDeleteModal', [
                    'rowId' => $row->trkhusus_id,
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
