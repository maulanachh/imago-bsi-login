<?php

namespace App\Livewire\Master\Msops\FasilitasKamar;

use App\Models\master\fasilitasKamar;
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

final class FasilitasKamarTable extends PowerGridComponent
{
    use WithExport;
    public string $primaryKey = 'faskmr_id';

    public string $sortField = 'faskmr_id';
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
        return fasilitasKamar::query();
    }

    public function relationSearch(): array
    {
        return [];
    }

    public function fields(): PowerGridFields
    {
        return PowerGrid::fields()
            ->add('faskmr_id')
            ->add('faskmr_name')
            ->add('faskmr_desc')
            ->add('tarif_exc');
    }

    public function columns(): array
    {
        return [
            Column::make('id', 'faskmr_id')
                ->sortable()
                ->searchable(),

            Column::make('nama fasilitas', 'faskmr_name')
                ->sortable()
                ->searchable(),

            Column::make('deskripsi', 'faskmr_desc')
                ->sortable()
                ->searchable(),

            Column::make('tarif exclude', 'tarif_exc')
                ->sortable()
                ->searchable(),

            Column::action('Action')
        ];
    }

    public function filters(): array
    {
        return [];
    }
    #[\Livewire\Attributes\On('confirmDeleteFasilitas')]
    public function deleteRow($id)
    {
        $user = Auth::user();
        $data_fasilitas = fasilitasKamar::find($id);
        if ($data_fasilitas) {
            $delete_data = $data_fasilitas->delete(); // Soft delete
            if ($delete_data) {
                $data_fasilitas->update([
                    'deleted_by' => $user->user_id
                ]);
                $this->js("alert('Fasilitas \"{$data_fasilitas->faskmr_name}\" berhasil dihapus.')");
            } else {
                $this->js("alert('Gagal menghapus Fasilitas \"{$data_fasilitas->faskmr_name}\".')");
            }
        } else {
            $this->js("alert('Fitur tidak ditemukan.')");
        }
    }
    #[\Livewire\Attributes\On('edit')]
    public function edit($rowId): void
    {
        //$this->js('alert(' . $rowId . ')');
        $features = fasilitasKamar::query()->find($rowId);
        session()->put([
            'faskmr_id' => $rowId,
            'function' => 'edit'
        ]);
        redirect('/master/ops/fasilitaskamar/create');
    }
    public function actions(fasilitasKamar $row): array
    {
        return [
            Button::add('edit')
                ->slot('<i class="bx bx-edit-alt"></i> Edit')
                ->id()
                ->class('btn btn-ghost-primary waves-effect waves-light')
                ->dispatch('edit', ['rowId' => $row->faskmr_id]),
            Button::add('delete')
                ->slot('<i class="bx bx-trash-alt"></i> delete')
                ->id()
                ->class('btn btn-ghost-danger waves-effect waves-light')
                ->dispatch('openDeleteModal', [
                    'rowId' => $row->faskmr_id,
                    'fasilitasName' => $row->faskmr_name,
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
