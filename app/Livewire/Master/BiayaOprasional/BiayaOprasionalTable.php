<?php

namespace App\Livewire\Master\BiayaOprasional;

use App\Models\Master\biayaOperasional;
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

final class BiayaOprasionalTable extends PowerGridComponent
{
    public string $primaryKey = 'biayaops_id';
    public string $sortField = 'biayaops_id';


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
        return biayaOperasional::query()
            ->join('ms_tipe_biaya', 'ms_biaya_oprasional.tipebiaya_id', '=', 'ms_tipe_biaya.tipebiaya_id')
            ->where('ms_biaya_oprasional.deleted_at', null)
            ->select('ms_biaya_oprasional.*', 'ms_tipe_biaya.tipebiaya_name');
    }

    public function relationSearch(): array
    {
        return [];
    }

    public function fields(): PowerGridFields
    {
        return PowerGrid::fields()
            ->add('biayaops_id')
            ->add('biayaops_name')
            ->add('tipebiaya_id')
            ->add('nominal_biaya')
            ->add('created_by')
            ->add('updated_by')
            ->add('deleted_by')
            ->add('created_at');
    }

    public function columns(): array
    {
        return [
            Column::make('id', 'biayaops_id')
                ->sortable()
                ->searchable(),

            Column::make('nama biaya', 'biayaops_name')
                ->sortable()
                ->searchable(),

            Column::make('tipe biaya', 'tipebiaya_name')
                ->sortable()
                ->searchable(),

            Column::make('Nominal biaya', 'nominal_biaya')
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
        $data = biayaOperasional::query()->find($rowId);
        session()->put([
            'biayaops_id' => $rowId,
            'function' => 'edit'
        ]);
        redirect('/master/ops/biayaops/create');
    }
    #[\Livewire\Attributes\On('confirmDelete')]
    public function deleteRow($id)
    {
        $user = Auth::user();
        $data = biayaOperasional::find($id);
        if ($data) {
            $delete_data = $data->delete(); // Soft delete
            if ($delete_data) {
                $this->js("alert('jenis biaya \"{$data->biayaops_name}\" berhasil dihapus.')");
            } else {
                $this->js("alert('Gagal menghapus jenis biaya \"{$data->biayaops_name}\".')");
            }
        } else {
            $this->js("alert('Fitur tidak ditemukan.')");
        }
    }
    public function actions(biayaOperasional $row): array
    {
        return [
            Button::add('edit')
                ->slot('<i class="bx bx-edit-alt"></i> Edit')
                ->id()
                ->class('btn btn-ghost-primary waves-effect waves-light')
                ->dispatch('edit', ['rowId' => $row->biayaops_id]),
            Button::add('delete')
                ->slot('<i class="bx bx-trash-alt"></i> delete')
                ->id()
                ->class('btn btn-ghost-danger waves-effect waves-light')
                ->dispatch('openDeleteModal', [
                    'rowId' => $row->biayaops_id,
                    'jnskmrName' => $row->biayaops_name,
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
