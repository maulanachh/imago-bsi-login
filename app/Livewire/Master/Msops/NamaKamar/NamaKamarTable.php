<?php

namespace App\Livewire\Master\Msops\NamaKamar;

use App\Models\master\namaKamar;
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

final class NamaKamarTable extends PowerGridComponent
{
    use WithExport;
    public string $primaryKey = 'ms_kamar.kamar_id';

    public string $sortField = 'ms_kamar.kamar_id';
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
        return namaKamar::query()
            ->join('ms_jenis_kmr', 'ms_kamar.jnskmr_id', '=', 'ms_jenis_kmr.jnskmr_id')
            ->join('ms_kelas_kmr', 'ms_kamar.klskmr_id', '=', 'ms_kelas_kmr.klskmr_id')
            ->select(
                'ms_kamar.kamar_id',
                'ms_kamar.kamar_name',
                'ms_jenis_kmr.jnskmr_name',
                'ms_kelas_kmr.klskmr_name',
                'ms_kelas_kmr.tarif_dasar_fullday',
                'ms_kelas_kmr.tarif_dasar_halfday',
            );
    }

    public function relationSearch(): array
    {
        return [];
    }

    public function fields(): PowerGridFields
    {
        return PowerGrid::fields()
            ->add('kamar_id')
            ->add('kamar_code')
            ->add('kamar_name')
            ->add('jnskmr_name')
            ->add('klskmr_name')
            ->add('tarif_dasar_fullday')
            ->add('tarif_dasar_halfday');
    }

    public function columns(): array
    {
        return [
            Column::make('id', 'kamar_id')
                ->sortable()
                ->searchable(),

            Column::make('nama kamar', 'kamar_name')
                ->sortable()
                ->searchable(),

            Column::make('jenis kamar', 'jnskmr_name')
                ->sortable()
                ->searchable(),

            Column::make('kelas kamar', 'klskmr_name')
                ->sortable()
                ->searchable(),

            Column::make('tarif dasar fullday', 'tarif_dasar_fullday')
                ->sortable()
                ->searchable(),

            Column::make('tarif dasar halfday', 'tarif_dasar_halfday')
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
        $nama_kamar = namaKamar::query()->find($rowId);
        session()->put([
            'kamar_id' => $rowId,
            'function' => 'edit'
        ]);
        redirect('/master/ops/namakamar/create');
    }
    #[\Livewire\Attributes\On('confirmDeleteKamar')]
    public function deleteRow($id)
    {
        $user = Auth::user();
        $data_kamar = namaKamar::find($id);
        if ($data_kamar) {
            $delete_data = $data_kamar->delete(); // Soft delete
            if ($delete_data) {
                $data_kamar->update([
                    'deleted_by' => $user->user_id
                ]);
                $this->js("alert('Kamar \"{$data_kamar->kamar_name}\" berhasil dihapus.')");
            } else {
                $this->js("alert('Gagal menghapus Kamar \"{$data_kamar->kamar_name}\".')");
            }
        } else {
            $this->js("alert('Fitur tidak ditemukan.')");
        }
    }
    public function actions(namaKamar $row): array
    {
        return [
            Button::add('edit')
                ->slot('<i class="bx bx-edit-alt"></i> Edit')
                ->id()
                ->class('btn btn-ghost-primary waves-effect waves-light')
                ->dispatch('edit', ['rowId' => $row->kamar_id]),
            Button::add('delete')
                ->slot('<i class="bx bx-trash-alt"></i> delete')
                ->id()
                ->class('btn btn-ghost-danger waves-effect waves-light')
                ->dispatch('openDeleteModal', [
                    'rowId' => $row->kamar_id,
                    'kamarName' => $row->kamar_name,
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
