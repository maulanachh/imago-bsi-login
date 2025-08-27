<?php

namespace App\Livewire\Master\Sdm\Karyawan;

use App\Models\master\masterKaryawan;
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

final class MasterKaryawanTable extends PowerGridComponent
{
    use WithExport;
    public string $primaryKey = 'karyawan_id';

    public string $sortField = 'karyawan_id';
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
        return masterKaryawan::query()
            ->join('ms_pendidikan', 'ms_karyawan.pendidikan_id', '=', 'ms_pendidikan.pendidikan_id')
            ->join('ms_jenis_kelamin', 'ms_karyawan.jenkel_id', '=', 'ms_jenis_kelamin.jenkel_id')
            ->join('ms_pekerjaan', 'ms_karyawan.pekerjaan_id', '=', 'ms_pekerjaan.pekerjaan_id')
            ->select(
                'ms_karyawan.karyawan_id',
                'ms_karyawan.karyawan_name',
                'ms_jenis_kelamin.kelamin',
                'ms_karyawan.phone',
                'ms_karyawan.alamat',
                'ms_pekerjaan.pekerjaan_name',
            );
    }

    public function relationSearch(): array
    {
        return [];
    }

    public function fields(): PowerGridFields
    {
        return PowerGrid::fields()
            ->add('karyawan_id')
            ->add('karyawan_name')
            ->add('kelamin')
            ->add('phone')
            ->add('alamat')
            ->add('pekerjaan_name');
    }

    public function columns(): array
    {
        return [
            Column::make('id', 'karyawan_id')
                ->sortable()
                ->searchable(),

            Column::make('nama karyawan', 'karyawan_name')
                ->sortable()
                ->searchable(),

            Column::make('jenis kelamin', 'kelamin')
                ->sortable()
                ->searchable(),

            Column::make('nomer telefon', 'phone')
                ->sortable()
                ->searchable(),

            Column::make('alamat', 'alamat')
                ->sortable()
                ->searchable(),
            Column::make('jenis pekerjaan', 'pekerjaan_name')
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
        $jnskmr = masterKaryawan::query()->find($rowId);
        session()->put([
            'karyawan_id' => $rowId,
            'function' => 'edit'
        ]);
        redirect('/master/sdm/masterkaryawan/create');
    }

    public function actions(masterKaryawan $row): array
    {
        return [
            Button::add('edit')
                ->slot('<i class="bx bx-edit-alt"></i> Edit')
                ->id()
                ->class('btn btn-ghost-primary waves-effect waves-light')
                ->dispatch('edit', ['rowId' => $row->karyawan_id]),
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
