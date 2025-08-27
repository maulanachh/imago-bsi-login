<?php

namespace App\Livewire\Master\Customers;

use App\Models\master\customers;
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

final class CustomerTable extends PowerGridComponent
{
    use WithExport;
    public string $primaryKey = 'cus_id';

    public string $sortField = 'cus_id';
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
        return customers::query();
    }

    public function relationSearch(): array
    {
        return [];
    }

    public function fields(): PowerGridFields
    {
        return PowerGrid::fields()
            ->add('cus_id')
            ->add('cus_name')
            ->add('cus_address')
            ->add('cus_phone')
            ->add('cus_email')
            ->add('jnsidentity_id')
            ->add('cus_identity_number')
            ->add('created_by')
            ->add('updated_by')
            ->add('deleted_by')
            ->add('created_at');
    }

    public function columns(): array
    {
        return [
            Column::make('Cus id', 'cus_id')
                ->sortable()
                ->searchable(),

            Column::make('Cus name', 'cus_name')
                ->sortable()
                ->searchable(),

            Column::make('Cus address', 'cus_address')
                ->sortable()
                ->searchable(),

            Column::make('Cus phone', 'cus_phone')
                ->sortable()
                ->searchable(),

            Column::make('Cus email', 'cus_email')
                ->sortable()
                ->searchable(),

            Column::make('Cus identity number', 'cus_identity_number')
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
        $data = customers::query()->find($rowId);
        session()->put([
            'cus_id' => $rowId,
            'function' => 'edit'
        ]);
        redirect('/master/customer/mastercustomer/create');
    }

    public function actions(customers $row): array
    {
        return [
            Button::add('edit')
                ->slot('<i class="bx bx-edit-alt"></i> Edit')
                ->id()
                ->class('btn btn-ghost-primary waves-effect waves-light')
                ->dispatch('edit', ['rowId' => $row->cus_id]),
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
