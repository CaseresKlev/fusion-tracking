<?php

namespace App\DataTables;

use App\Models\Truck;
use Yajra\DataTables\Html\Button;
use Yajra\DataTables\Html\Column;
use Yajra\DataTables\Services\DataTable;

class TruckDataTable extends DataTable
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
                <div class="col icons-option" >
                <a href="' . route("truck.show", $dataRow->id) . '"><i class="fa-solid fa-eye"></i></a>
                <a href="' . route("truck.edit",$dataRow->id) . '"><i class="fas fa-edit"></i></a>
                <a href="#" onclick="deleteRecord('. $dataRow->id .', \''. $dataRow->name .'\')"><i class="fa-solid fa-trash-can"></i></a>
                </div>
                </div>
                
                <form action="' . route("truck.destroy", $dataRow->id) . '" method="POST" class="hidden" id="form-delete-'. $dataRow->id .'" 
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
     * @param \App\Models\Truck $model
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function query(Truck $model)
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
                    ->setTableId('truck-table')
                    ->columns($this->getColumns())
                    ->minifiedAjax()
                    ->dom('Blfrtip')
                    ->orderBy(1);
                    
    }

    /**
     * Get columns.
     *
     * @return array
     */
    protected function getColumns()
    {
        return [
            /*Column::computed('action')
                  ->exportable(false)
                  ->printable(false)
                  ->width(60)
                  ->addClass('text-center'),
            Column::make('id'),
            Column::make('add your columns'),
            Column::make('created_at'),
            Column::make('updated_at'),*/
            'name',
            'brand',
            'model',
            'plate_no',
            'company_id',
            'owner',
            'status',
            'description',
            //Column::make('updated_at'),
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
        return 'Truck_' . date('YmdHis');
    }
}
