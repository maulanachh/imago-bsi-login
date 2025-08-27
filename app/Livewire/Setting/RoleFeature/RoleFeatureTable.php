<?php

namespace App\Livewire\Setting\RoleFeature;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Carbon;
use PowerComponents\LivewirePowerGrid\Button;
use PowerComponents\LivewirePowerGrid\Column;
use PowerComponents\LivewirePowerGrid\Exportable;
use PowerComponents\LivewirePowerGrid\Facades\Filter;
use PowerComponents\LivewirePowerGrid\Footer;
use PowerComponents\LivewirePowerGrid\Header;
use PowerComponents\LivewirePowerGrid\PowerGrid;
use PowerComponents\LivewirePowerGrid\PowerGridFields;
use PowerComponents\LivewirePowerGrid\PowerGridComponent;
use Illuminate\Support\Facades\DB;
use App\Models\rolegroupFeature;

final class RoleFeatureTable extends PowerGridComponent
{
    public string $primaryKey = 'role_feature_role_id';
    public string $sortField = 'role_feature_role_id';
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
        return rolegroupFeature::query()
            ->join('roles', 'role_features.role_feature_role_id', '=', 'roles.role_id')
            ->groupBy('role_features.role_feature_role_id')
            ->select(
                'role_features.role_feature_role_id',
                'roles.role_name',
                DB::raw('COUNT(role_features.role_feature_feature_id) as feature_count')
            );
    }

    public function fields(): PowerGridFields
    {
        return PowerGrid::fields()
            ->add('role_feature_id');
    }

    public function columns(): array
    {
        return [
            Column::make('ID', 'role_feature_role_id')
                ->searchable()
                ->sortable(),

            Column::make('Role Name', 'role_name')
                ->field('role_name')
                ->searchable()
                ->sortable(),

            Column::make('Jumlah Fitur Tersedia', 'feature_count')
                ->field('feature_count')
                ->sortable(),

        ];
    }

    public function filters(): array
    {
        return [
            Filter::inputText('name'),
            Filter::datepicker('created_at_formatted', 'created_at'),
        ];
    }

    #[\Livewire\Attributes\On('edit')]
    public function edit($rowId): void
    {
        $this->js('alert(' . $rowId . ')');
    }

    // public function actions($row): array
    // {
    //     return [];
    // }

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
