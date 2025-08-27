<?php

namespace App\Livewire\Setting\User;

use App\Models\ACL\user;
use App\Models\User as ModelsUser;
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

final class UserTable extends PowerGridComponent
{
    use WithExport;
    public string $primaryKey = 'user_id';

    public string $sortField = 'user_id';
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
        return User::query()
            ->join('roles', 'users.role_id', '=', 'roles.role_id')
            ->join('ms_karyawan', 'users.karyawan_id', '=', 'ms_karyawan.karyawan_id')
            ->select(
                'users.user_id',
                'users.user_name',
                'roles.role_name',
                'ms_karyawan.karyawan_name'
            );
    }

    public function relationSearch(): array
    {
        return [];
    }

    public function fields(): PowerGridFields
    {
        return PowerGrid::fields()
            ->add('user_name')
            ->add('role_id')
            ->add('karyawan_id')
            ->add('created_at');
    }

    public function columns(): array
    {
        return [

            Column::make('id', 'user_id')
                ->sortable()
                ->searchable(),

            Column::make('User name', 'user_name')
                ->sortable()
                ->searchable(),

            Column::make('Role User', 'role_name')
                ->sortable()
                ->searchable(),

            Column::make('Nama Karyawan', 'karyawan_name')
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
        $user = User::query()->find($rowId);
        session()->put([
            'user_id' => $rowId,
            'function' => 'edit'
        ]);
        redirect('/setting/masteruser/users/create');
    }
    #[\Livewire\Attributes\On('confirmDelete')]
    public function deleteRow($id)
    {
        $user = Auth::user();
        $data = user::find($id);
        if ($data) {
            $delete_data = $data->delete(); // Soft delete
            if ($delete_data) {
                $this->js("alert('User \"{$data->user_name}\" berhasil dihapus.')");
            } else {
                $this->js("alert('Gagal menghapus User \"{$data->user_name}\".')");
            }
        } else {
            $this->js("alert('Fitur tidak ditemukan.')");
        }
    }
    public function actions(User $row): array
    {
        return [
            Button::add('edit')
                ->slot('<i class="bx bx-edit-alt"></i> Edit')
                ->id()
                ->class('btn btn-ghost-primary waves-effect waves-light')
                ->dispatch('edit', ['rowId' => $row->user_id]),
            Button::add('delete')
                ->slot('<i class="bx bx-trash-alt"></i> delete')
                ->id()
                ->class('btn btn-ghost-danger waves-effect waves-light')
                ->dispatch('openDeleteModal', [
                    'rowId' => $row->user_id,
                    'jnskmrName' => $row->user_name,
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
