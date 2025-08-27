<?php

namespace App\Livewire\Setting\Developer;

use App\Models\feature;
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
use App\Models\rolegroupFeature;

final class FeatureTable extends PowerGridComponent
{
    use WithExport;
    public string $primaryKey = 'feature_id';
    public string $sortField = 'feature_id';
    public function setUp(): array
    {
        // $this->showCheckBox();

        return [
            Header::make()->showSearchInput(),
            Footer::make()
                ->showPerPage()
                ->showRecordCount(),
        ];
    }

    public function datasource(): Builder
    {
        return feature::query();
    }

    public function relationSearch(): array
    {
        return [];
    }

    public function fields(): PowerGridFields
    {
        return PowerGrid::fields()
            ->add('feature_id')
            ->add('feature_code')
            ->add('feature_name')
            ->add('feature_route_link')
            ->add('created_at');
    }

    public function columns(): array
    {
        return [
            Column::make('Id Fitur', 'feature_id')
                ->sortable()
                ->searchable(),

            Column::make('Kode Fitur', 'feature_code')
                ->sortable()
                ->searchable(),

            Column::make('Nama Fitur', 'feature_name')
                ->sortable()
                ->searchable(),

            Column::make('URL Fitur', 'feature_route_link')
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
    #[\Livewire\Attributes\On('confirmDeleteFitur')]
    public function deleteRow($id)
    {
        $user = Auth::user();
        $data_feature = feature::find($id);
        if ($data_feature) {
            $delete_data = $data_feature->delete(); // Soft delete
            if ($delete_data) {
                $data_feature->update([
                    'deleted_by' => $user->user_id
                ]);
                $data_rolegroup_feature = rolegroupFeature::where('role_feature_feature_id', $data_feature->feature_id)->first();
                if ($data_rolegroup_feature) {
                    $delete_data_rolegroup_feature = $data_rolegroup_feature->delete();
                    if ($delete_data_rolegroup_feature) {
                        $data_rolegroup_feature->update([
                            'is_active' => null,
                            'deleted_by' => $user->user_id
                        ]);
                    }
                }
                $this->js("alert('Fitur \"{$data_feature->feature_name}\" berhasil dihapus.')");
                redirect('/setting/developer/masterfitur');
            } else {
                $this->js("alert('Gagal menghapus Fitur \"{$data_feature->feature_name}\".')");
            }
        } else {
            $this->js("alert('Fitur tidak ditemukan.')");
        }
    }
    #[\Livewire\Attributes\On('edit')]
    public function edit($rowId): void
    {
        //$this->js('alert(' . $rowId . ')');
        $features = feature::query()->find($rowId);
        session()->put([
            'feature_id' => $rowId,
            'function' => 'edit'
        ]);
        redirect('/setting/developer/masterfitur/loadfeature');
    }

    public function actions(feature $row): array
    {
        return [
            Button::add('edit')
                ->slot('<i class="bx bx-edit-alt"></i> Edit')
                ->id()
                ->class('btn btn-ghost-primary waves-effect waves-light')
                ->dispatch('edit', ['rowId' => $row->feature_id]),
            Button::add('delete')
                ->slot('<i class="bx bx-trash-alt"></i> delete')
                ->id()
                ->class('btn btn-ghost-danger waves-effect waves-light')
                ->dispatch('openDeleteModal', [
                    'rowId' => $row->feature_id,
                    'roleName' => $row->feature_name,
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
