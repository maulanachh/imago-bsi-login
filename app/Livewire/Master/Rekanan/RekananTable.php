<?php

namespace App\Livewire\Master\Rekanan;

use App\Models\master\rekanan;
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

final class RekananTable extends PowerGridComponent
{
    use WithExport;
    public string $primaryKey = 'rekanan_id';

    public string $sortField = 'rekanan_id';
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
        return rekanan::query()
            ->join('ms_tipe_diskon', 'ms_rekanan.tipediskon_id', '=', 'ms_tipe_diskon.tipediskon_id')
            ->where('ms_rekanan.deleted_at', null)
            ->select('ms_rekanan.*', 'ms_tipe_diskon.tipediskon_name');
    }

    public function relationSearch(): array
    {
        return [];
    }

    public function fields(): PowerGridFields
    {
        return PowerGrid::fields()
            ->add('rekanan_id')
            ->add('tipediskon_name')
            ->add('tipediskon_name')
            ->add('rekanan_name')
            ->add('rekanan_desc')
            ->add('persen_diskon')
            ->add('nominal_diskon')
            ->add('created_by')
            ->add('updated_by')
            ->add('deleted_by')
            ->add('created_at');
    }

    public function columns(): array
    {
        return [
            Column::make('ID', 'rekanan_id')
                ->sortable()
                ->searchable(),
            Column::make('Nama Rekanan', 'rekanan_name')
                ->sortable()
                ->searchable(),

            Column::make('Nama Rekanan', 'rekanan_name')
                ->sortable()
                ->searchable(),

            Column::make('Jenis Diskon', 'tipediskon_name')
                ->sortable()
                ->searchable(),

            Column::make('Nominal Diskon', 'nominal_diskon')
                ->sortable()
                ->searchable(),

            Column::make('Deskripsi', 'rekanan_desc')
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
        $data = rekanan::query()->find($rowId);
        session()->put([
            'rekanan_id' => $rowId,
            'function' => 'edit'
        ]);
        redirect('/master/tariflayanan/masterrekanan/create');
    }
    #[\Livewire\Attributes\On('confirmDelete')]
    public function deleteRow($id)
    {
        $user = Auth::user();
        $data = rekanan::find($id);
        if ($data) {
            $delete_data = $data->delete(); // Soft delete
            if ($delete_data) {
                $this->js("alert('User \"{$data->rekanan_name}\" berhasil dihapus.')");
            } else {
                $this->js("alert('Gagal menghapus User \"{$data->rekanan_name}\".')");
            }
        } else {
            $this->js("alert('Fitur tidak ditemukan.')");
        }
    }
    public function actions(rekanan $row): array
    {
        return [
            Button::add('edit')
                ->slot('<i class="bx bx-edit-alt"></i> Edit')
                ->id()
                ->class('btn btn-ghost-primary waves-effect waves-light')
                ->dispatch('edit', ['rowId' => $row->rekanan_id]),
            Button::add('delete')
                ->slot('<i class="bx bx-trash-alt"></i> delete')
                ->id()
                ->class('btn btn-ghost-danger waves-effect waves-light')
                ->dispatch('openDeleteModal', [
                    'rowId' => $row->rekanan_id,
                    'jnskmrName' => $row->rekanan_name,
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
