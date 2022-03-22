<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;
use App\Models\Driver;


class DriverController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view("driver.index");
    }

    function getData(Request $request){

        $data = Driver::query();
        //print_r($data);
        return Datatables::of(Driver::query())
        ->addIndexColumn()
        //  ->parameters([
        //      'dom' => 'Bfrtip',
        //      'buttons' => ['excel', 'pdf'],
        //   ])
         ->addColumn("action", function($datarow){
             return '<div class="row">
             <div class="col icons-option" >
             <a href="' . route("driver.show", $datarow->id) . '"><i class="fa-solid fa-eye"></i></a>
             <a href="' . route("driver.edit", $datarow->id) . '"><i class="fas fa-edit"></i></a>
             <a href="#" onclick="deleteRecord('. $datarow->id .',\''. $datarow->firstname .' ' . $datarow->lastname .'\')"><i class="fa-solid fa-trash-can"></i></a>
             </div>
             </div>
             
             <form action="' . route("driver.destroy", $datarow->id) . '" method="POST" class="hidden" id="form-delete-'. $datarow->id .'" 
             >
    <input name="_method" type="hidden" value="DELETE">
    '. csrf_field() .'
</form>
             
             ';
         })
        ->make(true);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return 'Creating User';
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        ////METHOD PUT
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        // return view('user.profile', [
        //     'driver' => Driver::findOrFail($id)
        // ]);
        return 'Showing Record id: ' . $id;
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        return 'Editing Record id: ' . $id;
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //METHOD PUT
        return 'Updating Record id: ' . $id;
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $driver = Driver::find($id);
        $driver->delete();
    
       return redirect()->route('dashboard.driver')
       ->with([ 
        'confirmationMessage' => $driver->firstname . ' ' . $driver->middlename . " " . $driver->lastname . " was deleted succesfully.",
        'alertType' =>'success' 
        ]);
    }
}
