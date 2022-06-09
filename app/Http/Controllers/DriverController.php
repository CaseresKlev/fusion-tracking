<?php

namespace App\Http\Controllers;

use App\Http\Requests\DriverFormRequest;
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

    public function getData(Request $request){

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
             <a href="#"><i onclick="showReportGenerateModal(\'Generate Driver Report\', '. $datarow->id .', \'driver\')" class="fa fa-file" aria-hidden="true"></i></a>
             
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
        $settingController = new SettingsController();
        $status = $settingController->getSetting('APP', 'DRIVER', 'STATUS');

        $position = $settingController->getSetting('APP', 'DRIVER', 'POSITION');
        return view("driver.create_update", 
        [
            'actionMethod' => "create", 
            'actionDescription' => "Create Record", 
            'alertType' =>'success', 
            'status' => $status,
            'position' => $position
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(DriverFormRequest $request, Driver $driver)
    {
        
        ////METHOD PUT
        $data = $request->validated();
        $driver = new Driver();
        $driver->firstname = $data['firstname'];
        $driver->middlename = $data['middlename'];
        $driver->lastname = $data['lastname'];
        $driver->address = $data['address'];
        $driver->contact_no = $data['contact_no'];
        $driver->position = $data['position'];
        $driver->trip_status = $data['trip_status'];

        $driver->save();
        return redirect()->route('dashboard.driver')
        ->with([ 
         'confirmationMessage' =>'Driver ' . $driver->firstname . " " . $driver->lastname . " was created succesfully.",
         'alertType' =>'success' 
         ]);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Driver $driver)
    {
        //dd($driver);
        $settingController = new SettingsController();
        $status = $settingController->getSetting('APP', 'DRIVER', 'STATUS');

        $position = $settingController->getSetting('APP', 'DRIVER', 'POSITION');

        //$companyController = new CompanyController();
        //$company =  $companyController->getAllCompany();
        return view("driver.create_update", 
        [
            'actionMethod' => "view", 
            'actionDescription' => "View Record", 
            'alertType' =>'success', 
            'record' => $driver,
            'status' => $status,
            'position' => $position
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Driver $driver)
    {
        $settingController = new SettingsController();
        $status = $settingController->getSetting('APP', 'DRIVER', 'STATUS');

        $position = $settingController->getSetting('APP', 'DRIVER', 'POSITION');

        //$companyController = new CompanyController();
        //$company =  $companyController->getAllCompany();
        return view("driver.create_update", 
        [
            'actionMethod' => "edit", 
            'actionDescription' => "Edit Record", 
            'alertType' =>'success', 
            'record' => $driver,
            'status' => $status,
            'position' => $position
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(DriverFormRequest $request, Driver $driver)
    {
        ////METHOD PUT
        $data = $request->validated();
        $driver->firstname = $data['firstname'];
        $driver->middlename = $data['middlename'];
        $driver->lastname = $data['lastname'];
        $driver->address = $data['address'];
        $driver->contact_no = $data['contact_no'];
        $driver->position = $data['position'];
        $driver->trip_status = $data['trip_status'];

        $driver->save();
        return redirect()->route('dashboard.driver')
        ->with([ 
         'confirmationMessage' =>'Driver ' . $driver->firstname . " " . $driver->lastname . " was updated succesfully.",
         'alertType' =>'success' 
         ]);
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

    public function getAllDriver(){
        $data = Driver::select('id', 'firstname', 'middlename', 'lastname')->get();
        return $data;
    }
}
