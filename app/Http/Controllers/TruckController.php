<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Datatables\TruckDataTable;
use App\Models\Truck;
use App\Models\Setting;
use App\Http\Controllers\SettingsController;
use App\Http\Requests\TruckFormRequest;
use App\Models\Company;
use App\Models\Driver;
use App\Models\Trip;
use Illuminate\Support\Facades\Log;
use App\Models\Expense;

class TruckController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(TruckDataTable $dataTable)
    {
        return $dataTable->render("truck.index");
       // return view("truck.index");
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {

         $settingController = new SettingsController();
         $status = $settingController->getSetting('APP', 'TRUCK', 'STATUS');
 
         $companyController = new CompanyController();
         $company =  $companyController->getAllCompany();
        //Log::info(json_encode($status)); 
        return view("truck.create_update", 
        [
            'actionMethod' => "create", 
            'actionDescription' => "Create Record", 
            'alertType' =>'success', 
            'status' => $status,
            'companyList' => $company 
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(TruckFormRequest $request)
    {
        $data = $request->validated();
        $truck = new Truck();
        $truck->name = $data['name'];
        $truck->brand = $data['brand'];
        $truck->model = $data['model'];
        $truck->plate_no = $data['plate_no'];
        $truck->company_id = $data['company_id'];
        $truck->owner = $data['owner'];
        $truck->status = $data['status'];
        $truck->description = $data['description'];

        $truck->save();
        return redirect()->route('dashboard.truck')
        ->with([ 
         'confirmationMessage' =>'Truck ' . $truck->name . " | Plate Number: " . $truck->plate_no . " was created succesfully.",
         'alertType' =>'success' 
         ]);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Truck $truck)
    {
        $settingController = new SettingsController();
        $status = $settingController->getSetting('APP', 'TRUCK', 'STATUS');

        $companyController = new CompanyController();
        $company =  $companyController->getAllCompany();

        //added features
         $trip = new Trip();

        $truckController = new TruckController;
        $truckList = $truckController->getAllTruck();

        $driverController = new DriverController();
        $driver = $driverController->getAllDriver();
        // $truckController = new TruckController;
        // $truck = $truckController->getAllTruck();

        $expense = new Expense();
        $driverModel = Driver::find($truck->company_id);
        $companyModel = Company::find($truck->company_id);
        $modelTruck = Truck::find($trip->truck_id);

        return view("truck.create_update", 
        [
            'actionMethod' => "view", 
            'actionDescription' => "View Record", 
            'alertType' =>'success', 
            'record' => $truck,
            'status' => $status,
            'companyList' => $company,
            'expenseRecord' => $expense,
            'tripRecord' => $trip,
            'truckList' => $truckList,
            'driverList' => $driver,
            'modalActionMethod' =>"view",
            "modelTruck" => $truck,
            "tripModel" => $trip,
            "driverModel" => $driverModel,
            "companyModel" => $companyModel,
            "truckModel" => $modelTruck
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Truck $truck)
    {
        $settingController = new SettingsController();
        $status = $settingController->getSetting('APP', 'TRUCK', 'STATUS');

        $companyController = new CompanyController();
        $company =  $companyController->getAllCompany();
        return view("truck.create_update", 
        [
            'actionMethod' => "edit", 
            'actionDescription' => "Edit Record", 
            'alertType' =>'success', 
            'record' => $truck,
            'status' => $status,
            'companyList' => $company 
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(TruckFormRequest $request, Truck $truck)
    {
        $data = $request->validated();
        $truck->name = $data['name'];
        $truck->brand = $data['brand'];
        $truck->model = $data['model'];
        $truck->plate_no = $data['plate_no'];
        $truck->company_id = $data['company_id'];
        $truck->owner = $data['owner'];
        $truck->status = $data['status'];
        $truck->description = $data['description'];

        $truck->save();
        return redirect()->route('dashboard.truck')
        ->with([ 
         'confirmationMessage' =>'Truck ' . $truck->name . " | Plate Number: " . $truck->plate_no . " was updated succesfully.",
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
        $truck = Truck::find($id);
        $truck->delete();
        return redirect()->route('dashboard.truck')
       ->with([ 
        'confirmationMessage' => $truck->name . " was deleted succesfully.",
        'alertType' =>'success' 
        ]);
    }

    public function getAllTruck(){
        $data = Truck::select('id', 'name', 'plate_no', 'company_id')->get();
        return $data;
    }
}
