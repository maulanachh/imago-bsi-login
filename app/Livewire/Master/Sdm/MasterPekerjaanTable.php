<?php

namespace App\Livewire\Master\Sdm;

use App\Models\master\MasterPekerjaan;
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

final class MasterPekerjaanTable extends PowerGridComponent
{
    use WithExport;
    public string $primaryKey = 'pekerjaan_id';

    public string $sortField = 'pekerjaan_id';
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
        return MasterPekerjaan::query();
    }

    public function relationSearch(): array
    {
        return [];
    }

    public function fields(): PowerGridFields
    {
        return PowerGrid::fields()
            ->add('pekerjaan_id')
            ->add('pekerjaan_code')
            ->add('pekerjaan_name')
            ->add('created_by')
            ->add('updated_by')
            ->add('deleted_by')
            ->add('created_at');
    }

    public function columns(): array
    {
        return [
            Column::make('Pekerjaan id', 'pekerjaan_id')
                ->sortable()
                ->searchable(),

            Column::make('Pekerjaan name', 'pekerjaan_name')
                ->sortable()
                ->searchable(),

            Column::make('Created at', 'created_at')
                ->sortable()
                ->searchable(),

            Column::action('Action')
        ];
    }

    public function filters(): array
    {
        return [];
    }
    #[\Livewire\Attributes\On('confirmDeletejnspekerjaan')]
    public function deleteRow($id)
    {
        $user = Auth::user();
        $data_jnspekerjaan = MasterPekerjaan::find($id);
        if ($data_jnspekerjaan) {
            $delete_data = $data_jnspekerjaan->delete(); // Soft delete
            if ($delete_data) {
                $this->js("alert('Jenis Kamar \"{$data_jnspekerjaan->pekerjaan_name}\" berhasil dihapus.')");
            } else {
                $this->js("alert('Gagal menghapus Jenis Kamar \"{$data_jnspekerjaan->pekerjaan_name}\".')");
            }
        } else {
            $this->js("alert('Fitur tidak ditemukan.')");
        }
    }
    #[\Livewire\Attributes\On('edit')]
    public function edit($rowId): void
    {
        //$this->js('alert(' . $rowId . ')');
        $jnskmr = MasterPekerjaan::query()->find($rowId);
        session()->put([
            'pekerjaan_id' => $rowId,
            'function' => 'edit'
        ]);
        redirect('/master/sdm/masterpekerjaan/create');
    }

    public function actions(MasterPekerjaan $row): array
    {
        return [
            Button::add('edit')
                ->slot('<i class="bx bx-edit-alt"></i> Edit')
                ->id()
                ->class('btn btn-ghost-primary waves-effect waves-light')
                ->dispatch('edit', ['rowId' => $row->pekerjaan_id]),
            Button::add('delete')
                ->slot('<i class="bx bx-trash-alt"></i> delete')
                ->id()
                ->class('btn btn-ghost-danger waves-effect waves-light')
                ->dispatch('openDeleteModal', [
                    'rowId' => $row->pekerjaan_id,
                    'jnskmrName' => $row->pekerjaan_name,
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
