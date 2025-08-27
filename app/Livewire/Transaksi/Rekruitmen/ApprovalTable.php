<?php

namespace App\Livewire\Transaksi\Rekruitmen;

use App\Models\Transaksi\rekruitmen;
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

final class ApprovalTable extends PowerGridComponent
{
    use WithExport;
    public string $primaryKey = 'rekruitmen_id';

    public string $sortField = 'rekruitmen_id';
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
        return rekruitmen::query()
            ->join('ms_stts_rekruitmen', 'tr_rekruitmen.sttsrekruit_id', '=', 'ms_stts_rekruitmen.sttsrekruit_id')
            ->join('ms_jenis_kelamin', 'tr_rekruitmen.jenkel_id', '=', 'ms_jenis_kelamin.jenkel_id')
            ->join('ms_pekerjaan', 'tr_rekruitmen.pekerjaan_id', '=', 'ms_pekerjaan.pekerjaan_id')
            ->select(
                'tr_rekruitmen.rekruitmen_id',
                'tr_rekruitmen.karyawan_name',
                'ms_pekerjaan.pekerjaan_name',
                'ms_stts_rekruitmen.sttsrekruit_name',
            )
            ->orderByRaw('CASE WHEN tr_rekruitmen.sttsrekruit_id = 2 THEN 0 ELSE 1 END')
            ->orderBy('tr_rekruitmen.rekruitmen_id');
    }

    public function relationSearch(): array
    {
        return [];
    }

    public function fields(): PowerGridFields
    {
        return PowerGrid::fields()
            ->add('rekruitmen_id')
            ->add('pekerjaan_id')
            ->add('jenkel_id')
            ->add('pendidikan_id')
            ->add('leader_id')
            ->add('sttsrekruit_id')
            ->add('karyawan_name')
            ->add('tempat_lahir')
            ->add('tgl_lahir_formatted', fn(rekruitmen $model) => Carbon::parse($model->tgl_lahir)->format('d/m/Y'))
            ->add('phone')
            ->add('alamat')
            ->add('created_by')
            ->add('updated_by')
            ->add('deleted_by')
            ->add('created_at');
    }

    public function columns(): array
    {
        return [
            Column::make('id', 'rekruitmen_id'),
            Column::make('nama', 'karyawan_name')
                ->sortable()
                ->searchable(),

            Column::make('pekerjaan', 'pekerjaan_name')
                ->sortable()
                ->searchable(),

            Column::make('status pengajuan', 'sttsrekruit_name')
                ->sortable()
                ->searchable(),
            Column::action('Action')
        ];
    }

    public function filters(): array
    {
        return [
            Filter::datepicker('tgl_lahir'),
        ];
    }

    #[\Livewire\Attributes\On('edit')]
    public function edit($rowId): void
    {
        //$this->js('alert(' . $rowId . ')');
        $data = rekruitmen::query()->find($rowId);

        session()->put([
            'rekruitmen_id' => $rowId,
            'function' => 'edit'
        ]);
        redirect('/transaksi/approval/create');
    }
    #[\Livewire\Attributes\On('confirmDelete')]
    public function deleteRow($id)
    {
        $data = rekruitmen::find($id);
        if ($data->sttsrekruit_id == 2) {
            $delete_data = $data->delete(); // Soft delete
            if ($delete_data) {
                $this->js("alert('rekruitmen \"{$data->karyawan_name}\" berhasil dibatalkan.')");
            } else {
                $this->js("alert('Gagal menghapus rekruitmen \"{$data->karyawan_name}\".')");
            }
        } else {
            $this->js("alert('data sudah diproses, tidak bisa dibatalkan !!')");
        }
    }
    public function actions(rekruitmen $row): array
    {
        return [
            Button::add('edit')
                ->slot('<i class="bx bx-edit-alt"></i> Edit')
                ->id()
                ->class('btn btn-ghost-primary waves-effect waves-light')
                ->dispatch('edit', ['rowId' => $row->rekruitmen_id]),
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
