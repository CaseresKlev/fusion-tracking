<?php

namespace App\DataTables;

use App\Models\Setting;
use Yajra\DataTables\Html\Button;
use Yajra\DataTables\Html\Column;
use Yajra\DataTables\Html\Editor\Editor;
use Yajra\DataTables\Html\Editor\Fields;
use Yajra\DataTables\Services\DataTable;

class SettingDataTable extends DataTable
{
    /**
     * Build DataTable class.
     *
     * @param mixed $query Results from query() method.
     * @return \Yajra\DataTables\DataTableAbstract
     */
    public function dataTable($query)
    {
        return datatables()
            ->eloquent($query)
            ->addColumn('action', function($dataRow){
                return '<div class="row">
                <div class="col icons-option class="text-right"" >
                <a href="' . route("settings.show", $dataRow->id) . '"><i class="fa-solid fa-eye"></i></a>
                <a href="' . route("settings.edit",$dataRow->id) . '"><i class="fas fa-edit"></i></a>
                <a href="#" onclick="deleteRecord('. $dataRow->id .', \''. $dataRow->name .'\')"><i class="fa-solid fa-trash-can"></i></a>
                </div>
                </div>
                
                <form action="' . route("settings.destroy", $dataRow->id) . '" method="POST" class="hidden" id="form-delete-'. $dataRow->id .'" 
                >
       <input name="_method" type="hidden" value="DELETE">
       '. csrf_field() .'
    </form>
                
                ';
            });
    }

    /**
     * Get query source of dataTable.
     *
     * @param \App\Models\Setting $model
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function query(Setting $model)
    {
        return $model->newQuery();
    }

    /**
     * Optional method if you want to use html builder.
     *
     * @return \Yajra\DataTables\Html\Builder
     */
    public function html()
    {
        return $this->builder()
                    ->setTableId('setting-table')
                    ->columns($this->getColumns())
                    ->minifiedAjax()
                    // ->dom('Bfrtip')
                    ->orderBy(1);
                    // ->buttons(
                    //     Button::make('create'),
                    //     Button::make('export'),
                    //     Button::make('print'),
                    //     Button::make('reset'),
                    //     Button::make('reload')
                    // );
    }

    /**
     * Get columns.
     *
     * @return array
     */
    protected function getColumns()
    {
        return [
            'app_name',
            'app_section',
            'app_field',
            'app_value_1',
            'app_vaue_2',
            'app_value_3',
            Column::make('action'),
        ];
    }

    /**
     * Get filename for export.
     *
     * @return string
     */
    protected function filename()
    {
        return 'Setting_' . date('YmdHis');
    }
}
