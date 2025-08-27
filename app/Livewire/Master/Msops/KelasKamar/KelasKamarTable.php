<?php

namespace App\Livewire\master\msops\kelaskamar;

use App\Models\master\kelasKamar;
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
use Illuminate\Support\Number;

final class KelasKamarTable extends PowerGridComponent
{
    use WithExport;
    public string $primaryKey = 'ms_kelas_kmr.klskmr_id';

    public string $sortField = 'ms_kelas_kmr.klskmr_id';
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
        return kelasKamar::query()
            ->join('ms_fasilitas_kelas_kmr', 'ms_fasilitas_kelas_kmr.klskmr_id', '=', 'ms_kelas_kmr.klskmr_id')
            ->join('ms_fasilitas_kmr', 'ms_fasilitas_kelas_kmr.faskmr_id', '=', 'ms_fasilitas_kmr.faskmr_id')
            ->select(
                'ms_kelas_kmr.klskmr_id',
                'ms_kelas_kmr.klskmr_name',
                'ms_kelas_kmr.tarif_dasar_fullday',
                'ms_kelas_kmr.tarif_dasar_halfday',
                DB::raw('COUNT(ms_fasilitas_kelas_kmr.faskmr_id) as total_fasilitas')
            )
            ->groupBy('ms_fasilitas_kelas_kmr.klskmr_id');
    }

    public function relationSearch(): array
    {
        return [];
    }

    public function fields(): PowerGridFields
    {
        return PowerGrid::fields()
            ->add('klskmr_id')
            ->add('klskmr_code')
            ->add('klskmr_name')
            ->add('klskmr_desc')
            // ->add('tarif_dasar_fullday')
            ->add('tarif_dasar_fullday', function ($row) {
                return Number::currency($row->tarif_dasar_fullday, in: 'IDR', locale: 'id_ID');
            })
            //->add('tarif_dasar_halfday')
            ->add('tarif_dasar_halfday', function ($row) {
                return Number::currency($row->tarif_dasar_halfday, in: 'IDR', locale: 'id_ID');
            })
            ->add('total_fasilitas');
    }

    public function columns(): array
    {
        return [
            Column::make('id', 'klskmr_id')
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
            Column::make('total fasilitas kamar', 'total_fasilitas'),

            Column::action('Action')
        ];
    }

    public function filters(): array
    {
        return [];
    }
    #[\Livewire\Attributes\On('confirmDeleteKelas')]
    public function deleteRow($id)
    {
        $user = Auth::user();
        $data_kelas = kelasKamar::find($id);
        if ($data_kelas) {
            $delete_data = $data_kelas->delete(); // Soft delete
            if ($delete_data) {
                $data_kelas->update([
                    'deleted_by' => $user->user_id
                ]);
                $this->js("alert('Kelas \"{$data_kelas->klskmr_name}\" berhasil dihapus.')");
            } else {
                $this->js("alert('Gagal menghapus Kelas \"{$data_kelas->klskmr_name}\".')");
            }
        } else {
            $this->js("alert('Fitur tidak ditemukan.')");
        }
    }
    #[\Livewire\Attributes\On('edit')]
    public function edit($rowId): void
    {
        //$this->js('alert(' . $rowId . ')');
        $kelas_kamar = kelasKamar::query()->find($rowId);
        session()->put([
            'klskmr_id' => $rowId,
            'function' => 'edit'
        ]);
        redirect('/master/ops/kelaskamar/create');
    }

    public function actions(kelasKamar $row): array
    {
        return [
            Button::add('edit')
                ->slot('<i class="bx bx-edit-alt"></i> Edit')
                ->id()
                ->class('btn btn-ghost-primary waves-effect waves-light')
                ->dispatch('edit', ['rowId' => $row->klskmr_id]),
            Button::add('delete')
                ->slot('<i class="bx bx-trash-alt"></i> delete')
                ->id()
                ->class('btn btn-ghost-danger waves-effect waves-light')
                ->dispatch('openDeleteModal', [
                    'rowId' => $row->klskmr_id,
                    'kelasName' => $row->klskmr_name,
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
