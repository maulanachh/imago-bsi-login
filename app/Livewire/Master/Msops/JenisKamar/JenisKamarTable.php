<?php

namespace App\Livewire\master\msops\JenisKamar;

use App\Models\master\jenisKamar;
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

final class JenisKamarTable extends PowerGridComponent
{
    use WithExport;
    public string $primaryKey = 'jnskmr_id';

    public string $sortField = 'jnskmr_id';
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
        return jenisKamar::query();
    }

    public function relationSearch(): array
    {
        return [];
    }

    public function fields(): PowerGridFields
    {
        return PowerGrid::fields()
            ->add('jnskmr_id')
            ->add('jnskmr_code')
            ->add('jnskmr_name')
            ->add('jnskmr_desc')
            ->add('created_by')
            ->add('updated_by')
            ->add('deleted_by')
            ->add('created_at');
    }

    public function columns(): array
    {
        return [
            Column::make('id', 'jnskmr_id')
                ->sortable()
                ->searchable(),

            Column::make('jenis kamar', 'jnskmr_name')
                ->sortable()
                ->searchable(),

            Column::make('deskripsi', 'jnskmr_desc')
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
        $jnskmr = jenisKamar::query()->find($rowId);
        session()->put([
            'jnskmr_id' => $rowId,
            'function' => 'edit'
        ]);
        redirect('/master/ops/jeniskamar/create');
    }
    #[\Livewire\Attributes\On('confirmDeletejnskmr')]
    public function deleteRow($id)
    {
        $user = Auth::user();
        $data_jnskmr = jenisKamar::find($id);
        if ($data_jnskmr) {
            $delete_data = $data_jnskmr->delete(); // Soft delete
            if ($delete_data) {
                $data_jnskmr->update([
                    'deleted_by' => $user->user_id
                ]);
                $this->js("alert('Jenis Kamar \"{$data_jnskmr->jnskmr_name}\" berhasil dihapus.')");
            } else {
                $this->js("alert('Gagal menghapus Jenis Kamar \"{$data_jnskmr->jnskmr_name}\".')");
            }
        } else {
            $this->js("alert('Fitur tidak ditemukan.')");
        }
    }
    public function actions(jenisKamar $row): array
    {
        return [
            Button::add('edit')
                ->slot('<i class="bx bx-edit-alt"></i> Edit')
                ->id()
                ->class('btn btn-ghost-primary waves-effect waves-light')
                ->dispatch('edit', ['rowId' => $row->jnskmr_id]),
            Button::add('delete')
                ->slot('<i class="bx bx-trash-alt"></i> delete')
                ->id()
                ->class('btn btn-ghost-danger waves-effect waves-light')
                ->dispatch('openDeleteModal', [
                    'rowId' => $row->jnskmr_id,
                    'jnskmrName' => $row->jnskmr_name,
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
