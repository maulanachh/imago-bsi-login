<?php

namespace App\Livewire\Master\FNB;

use App\Models\master\fnb;
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

final class FnbTable extends PowerGridComponent
{
    use WithExport;
    public string $primaryKey = 'fnb_id';

    public string $sortField = 'fnb_id';
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
        return fnb::query();
    }

    public function relationSearch(): array
    {
        return [];
    }

    public function fields(): PowerGridFields
    {
        return PowerGrid::fields()
            ->add('fnb_id')
            ->add('fnb_name')
            ->add('stock')
            ->add('harga')
            ->add('created_by')
            ->add('updated_by')
            ->add('deleted_by')
            ->add('created_at');
    }

    public function columns(): array
    {
        return [
            Column::make('Fnb id', 'fnb_id')
                ->sortable()
                ->searchable(),

            Column::make('Fnb name', 'fnb_name')
                ->sortable()
                ->searchable(),

            Column::make('Stock', 'stock')
                ->sortable()
                ->searchable(),

            Column::make('Harga', 'harga'),

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
        $data = fnb::query()->find($rowId);
        session()->put([
            'fnb_id' => $rowId,
            'function' => 'edit'
        ]);
        redirect('/master/fnb/create');
    }
    #[\Livewire\Attributes\On('confirmDelete')]
    public function deleteRow($id)
    {
        $user = Auth::user();
        $data = fnb::find($id);
        if ($data) {
            $delete_data = $data->delete(); // Soft delete
            if ($delete_data) {
                $this->js("alert('rekening bank \"{$data->fnb_name}\" berhasil dihapus.')");
            } else {
                $this->js("alert('Gagal menghapus rekening bank \"{$data->fnb_name}\".')");
            }
        } else {
            $this->js("alert('Fitur tidak ditemukan.')");
        }
    }
    public function actions(fnb $row): array
    {
        return [
            Button::add('edit')
                ->slot('<i class="bx bx-edit-alt"></i> Edit')
                ->id()
                ->class('btn btn-ghost-primary waves-effect waves-light')
                ->dispatch('edit', ['rowId' => $row->fnb_id]),
            Button::add('delete')
                ->slot('<i class="bx bx-trash-alt"></i> delete')
                ->id()
                ->class('btn btn-ghost-danger waves-effect waves-light')
                ->dispatch('openDeleteModal', [
                    'rowId' => $row->fnb_id,
                    'jnskmrName' => $row->fnb_name,
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
