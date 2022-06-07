<?php

namespace App\DataTables;

use App\Models\Company;
use Yajra\DataTables\Html\Button;
use Yajra\DataTables\Html\Column;
use Yajra\DataTables\Html\Editor\Editor;
use Yajra\DataTables\Html\Editor\Fields;
use Yajra\DataTables\Services\DataTable;

class CompanyDataTable extends DataTable
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
                <a href="' . route("company.show", $dataRow->id) . '"><i class="fa-solid fa-eye"></i></a>
                <a href="' . route("company.edit",$dataRow->id) . '"><i class="fas fa-edit"></i></a>
                <a href="#"><i onclick="showReportGenerateModal(\'Generate Company Report\', '. $dataRow->id .', \'company\');" class="fa fa-file" aria-hidden="true"></i></a>
                <a href="#" onclick="deleteRecord('. $dataRow->id .', \''. $dataRow->name .'\')"><i class="fa-solid fa-trash-can"></i></a>
                </div>
                </div>
                
                <form action="' . route("company.destroy", $dataRow->id) . '" method="POST" class="hidden" id="form-delete-'. $dataRow->id .'" 
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
     * @param \App\Models\Company $model
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function query(Company $model)
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
                    ->setTableId('company-table')
                    ->columns($this->getColumns())
                    ->minifiedAjax()
                    ->parameters([
                        'dom' => 'Blfrtip',
                        'buttons' => ['csv', 'excel', 'pdf', 'print', 'reset', 'reload'],
                        'responsive'=> true,
                        'columnDefs' => array(
                            ['responsivePriority' => 1, 'targets'=> 0]
                            )
                    ])
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
             'name',
             'address',
             'contact_no',
             'email',
             'description',
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
        return 'Company_' . date('YmdHis');
    }
}
