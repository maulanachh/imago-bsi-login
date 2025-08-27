<?php

namespace App\Livewire\Master\Msops\ExtraCharge;

use App\Models\master\extraCharge;
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

final class ExtraChargeTable extends PowerGridComponent
{
    use WithExport;
    public string $primaryKey = 'charge_id';

    public string $sortField = 'charge_id';
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
        return extraCharge::query();
    }

    public function relationSearch(): array
    {
        return [];
    }

    public function fields(): PowerGridFields
    {
        return PowerGrid::fields()
            ->add('charge_id')
            ->add('charge_code')
            ->add('charge_name')
            ->add('charge_desc')
            ->add('tarif_charge')
            ->add('created_by')
            ->add('updated_by')
            ->add('deleted_by')
            ->add('created_at');
    }

    public function columns(): array
    {
        return [
            Column::make('Charge id', 'charge_id')
                ->sortable()
                ->searchable(),

            Column::make('Charge name', 'charge_name')
                ->sortable()
                ->searchable(),

            Column::make('Charge desc', 'charge_desc')
                ->sortable()
                ->searchable(),

            Column::make('Tarif charge', 'tarif_charge')
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
        $data = extraCharge::query()->find($rowId);
        session()->put([
            'charge_id' => $rowId,
            'function' => 'edit'
        ]);
        redirect('/master/ops/extracharge/create');
    }
    #[\Livewire\Attributes\On('confirmDelete')]
    public function deleteRow($id)
    {
        $user = Auth::user();
        $data = extraCharge::find($id);
        if ($data) {
            $delete_data = $data->delete(); // Soft delete
            if ($delete_data) {
                $this->js("alert('item \"{$data->charge_name}\" berhasil dihapus.')");
            } else {
                $this->js("alert('Gagal menghapus item \"{$data->charge_name}\".')");
            }
        } else {
            $this->js("alert('Fitur tidak ditemukan.')");
        }
    }
    public function actions(extraCharge $row): array
    {
        return [
            Button::add('edit')
                ->slot('<i class="bx bx-edit-alt"></i> Edit')
                ->id()
                ->class('btn btn-ghost-primary waves-effect waves-light')
                ->dispatch('edit', ['rowId' => $row->charge_id]),
            Button::add('delete')
                ->slot('<i class="bx bx-trash-alt"></i> delete')
                ->id()
                ->class('btn btn-ghost-danger waves-effect waves-light')
                ->dispatch('openDeleteModal', [
                    'rowId' => $row->charge_id,
                    'jnskmrName' => $row->charge_name,
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
