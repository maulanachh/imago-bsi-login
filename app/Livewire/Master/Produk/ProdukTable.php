<?php

namespace App\Livewire\Master\Produk;

use App\Models\master\Produk;
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

final class ProdukTable extends PowerGridComponent
{
    use WithExport;
    public string $primaryKey = 'produk_id';

    public string $sortField = 'produk_id';
    public function setUp(): array
    {
        return [
            Exportable::make('export')
                ->striped()
                ->type(Exportable::TYPE_XLS, Exportable::TYPE_CSV),
            Header::make()->showSearchInput(),
            Footer::make()
                ->showPerPage()
                ->showRecordCount(),
        ];
    }

    public function datasource(): Builder
    {
        return Produk::query();
    }

    public function relationSearch(): array
    {
        return [];
    }

    public function fields(): PowerGridFields
    {
        return PowerGrid::fields()
            ->add('produk_id')
            ->add('produk_name');
    }

    public function columns(): array
    {
        return [
            Column::make('Produk id', 'produk_id'),

            Column::make('Produk name', 'produk_name')
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
        $data = Produk::query()->find($rowId);
        session()->put([
            'produk_id' => $rowId,
            'function' => 'edit'
        ]);
        redirect('/master/ops/produk/create');
    }
    #[\Livewire\Attributes\On('confirmDelete')]
    public function deleteRow($id)
    {
        $user = Auth::user();
        $data = Produk::find($id);
        if ($data) {
            $delete_data = $data->delete(); // Soft delete
            if ($delete_data) {
                $this->js("alert('produk \"{$data->produk_name}\" berhasil dihapus.')");
            } else {
                $this->js("alert('Gagal menghapus produk \"{$data->produk_name}\".')");
            }
        } else {
            $this->js("alert('Fitur tidak ditemukan.')");
        }
    }

    public function actions(produk $row): array
    {
        return [
            Button::add('edit')
                ->slot('<i class="bx bx-edit-alt"></i> Edit')
                ->id()
                ->class('btn btn-ghost-primary waves-effect waves-light')
                ->dispatch('edit', ['rowId' => $row->produk_id]),
            Button::add('delete')
                ->slot('<i class="bx bx-trash-alt"></i> delete')
                ->id()
                ->class('btn btn-ghost-danger waves-effect waves-light')
                ->dispatch('openDeleteModal', [
                    'rowId' => $row->produk_id,
                    'jnskmrName' => $row->produk_name,
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
