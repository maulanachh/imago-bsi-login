<?php

namespace App\Livewire\Setting\Role;

use App\Models\roleGroup;
use Illuminate\Support\Carbon;
use Illuminate\Database\Eloquent\Builder;
use Livewire\Features\SupportNavigate\SupportNavigate;
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

final class RoleGroupTable extends PowerGridComponent
{
    use WithExport;
    public string $primaryKey = 'role_id';

    public string $sortField = 'role_id';
    public $roleName;

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
        return roleGroup::query();
    }

    public function relationSearch(): array
    {
        return [];
    }

    public function fields(): PowerGridFields
    {
        return PowerGrid::fields()
            ->add('role_id')
            ->add('role_name')
            ->add('created_at');
    }

    public function columns(): array
    {
        return [
            Column::make('Role id', 'role_id')
                ->sortable()
                ->searchable(),

            Column::make('Role name', 'role_name')
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
    #[\Livewire\Attributes\On('confirmDeleteRoleGroup')]
    public function deleteRow($id)
    {

        $data_rolegroup = RoleGroup::find($id);
        if ($id === 1) {
            $this->js("alert('Role group \"{$data_rolegroup->role_name}\" tidak boleh dihapus.')");
        } else if ($data_rolegroup) {
            $data_rolegroup->delete(); // Soft delete
            $this->js("alert('Role group \"{$data_rolegroup->role_name}\" berhasil dihapus.')");
        } else {
            $this->js("alert('Role group tidak ditemukan.')");
        }
    }
    #[\Livewire\Attributes\On('edit')]
    public function edit($rowId): void
    {
        //$this->js('alert(' . $rowId . ')');
        $data_rolegroup = roleGroup::query()->find($rowId);
        session()->put([
            'role_id' => $rowId,
            'function' => 'edit'
        ]);
        redirect('/setting/masteruser/rolegroup/loadrolegroup');
    }

    public function actions(roleGroup $row): array
    {

        return [
            Button::add('edit')
                ->slot('<i class="bx bx-edit-alt"></i> Edit')
                ->id()
                ->class('btn btn-ghost-primary waves-effect waves-light')
                ->dispatch('edit', ['rowId' => $row->role_id]),
            Button::add('delete')
                ->slot('<i class="bx bx-trash-alt"></i> delete')
                ->id()
                ->class('btn btn-ghost-danger waves-effect waves-light')
                ->dispatch('openDeleteModal', [
                    'rowId' => $row->role_id,
                    'roleName' => $row->role_name,
                ])

        ];
    }
}
