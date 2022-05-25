<?php

namespace App\Http\Controllers;

use App\Http\Requests\TripFormRequest;
use App\Models\Driver;
use App\Models\Expense;
use Illuminate\Http\Request;
use App\Models\Trip;
use Yajra\DataTables\Facades\DataTables;

class TripController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('trip.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $truckController = new TruckController;
        $truck = $truckController->getAllTruck();

        $driverController = new DriverController();
        $driver = $driverController->getAllDriver();
        return view("trip.create_update", 
        [
            'actionMethod' => "create", 
            'actionDescription' => "Create Record", 
            'truckList' => $truck,
            'driverList' => $driver
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(TripFormRequest $request)
    {
        $data = $request->validated();
        $trip = new Trip();
        $trip->driver_id = $data['driver_id'];
        $trip->truck_id = $data['truck_id'];
        $trip->trip_ticket_id = $data['trip_ticket_id'];
        $trip->source = $data['source'];
        $trip->destination = $data['destination'];
        $trip->distance = $data['distance'];
        $trip->weigth = $data['weigth'];
        $trip->rate = $data['rate'];
        $trip->bill = $trip->rate * $trip->weigth * $trip->distance;
        $trip->date = $data['date'];
        $trip->material = $data['material'];
        $trip->contractor = $data['contractor'];
        $trip->loaded_by = $data['loaded_by'];
        $trip->loaded_time = $data['loaded_time'];
        $trip->tx_no = $data['tx_no'];
        $trip->entry_by = 1;

        
       // print("Driver ID: " . $request['driver_id']);
        $trip->save();
        
       return redirect()->route('dashboard.trip')
        ->with([ 
         'confirmationMessage' =>'Trip ID: ' . $trip->id .  " was created succesfully.",
         'alertType' =>'success' 
         ]);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Trip $trip)
    {
        $truckController = new TruckController;
        $truck = $truckController->getAllTruck();

        $driverController = new DriverController();
        $driver = $driverController->getAllDriver();

        $companyController = new CompanyController;
        $company = $companyController->getAllCompany();

        $expense = new Expense();
        return view("trip.create_update", 
        [
            'actionMethod' => "view", 
            'actionDescription' => "View Record", 
            'record' => $trip,
            'truckList' => $truck,
            'driverList' => $driver,
            'companyList' => $company,
            'tripRecord' => $trip,
            'expenseRecord' => $expense,
            'modalActionMethod' =>"view",
            //'modalFormAction' => route('expense')
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Trip $trip)
    {
        $truckController = new TruckController;
        $truck = $truckController->getAllTruck();

        $driverController = new DriverController();
        $driver = $driverController->getAllDriver();
        return view("trip.create_update", 
        [
            'actionMethod' => "edit", 
            'actionDescription' => "Edit Record", 
            'record' => $trip,
            'truckList' => $truck,
            'driverList' => $driver
        ]); 
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(TripFormRequest $request, Trip $trip)
    {
        $data = $request->validated();
        $trip->driver_id = $data['driver_id'];
        $trip->truck_id = $data['truck_id'];
        $trip->trip_ticket_id = $data['trip_ticket_id'];
        $trip->source = $data['source'];
        $trip->destination = $data['destination'];
        $trip->distance = $data['distance'];
        $trip->weigth = $data['weigth'];
        $trip->rate = $data['rate'];
        $trip->bill = $trip->rate * $trip->weigth * $trip->distance;
        $trip->date = $data['date'];
        $trip->material = $data['material'];
        $trip->contractor = $data['contractor'];
        $trip->loaded_by = $data['loaded_by'];
        $trip->loaded_time = $data['loaded_time'];
        $trip->tx_no = $data['tx_no'];
        $trip->entry_by = 1;

        
       // print("Driver ID: " . $request['driver_id']);
        $trip->save();
        
       return redirect()->route('dashboard.trip')
        ->with([ 
         'confirmationMessage' =>'Trip ID: ' . $trip->id .  " was updated succesfully.",
         'alertType' =>'success' 
         ]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Trip $trip)
    {
        $trip->delete();
        return redirect()->route('dashboard.trip')
       ->with([ 
        'confirmationMessage' => "Trip ID: " . $trip->id . " was deleted succesfully.",
        'alertType' =>'success' 
        ]); 
    }

    public function ajaxGetData(){
       // $data = Trip::query();

       $trips = Trip::join('trucks','trips.truck_id', "=", "trucks.id")
       ->join('drivers', 'trips.driver_id', "=", 'drivers.id')
       ->select(['trips.*', 'trucks.name as truck_name', 'trucks.plate_no',  Trip::raw("CONCAT(drivers.firstname, ' ', drivers.lastname) AS driver_name")]);
        return DataTables::of($trips)
        ->addIndexColumn()
        ->addColumn('action', function($dataRow){
            $row = '<div class="row">
            <div class="col icons-option class="text-right"" >
            <a href="' . route("trip.show", $dataRow->id) . '"><i class="fa-solid fa-eye"></i></a>
            <a href="' . route("trip.edit",$dataRow->id) . '"><i class="fas fa-edit"></i></a>
            <a href="#" onclick="deleteRecord('. $dataRow->id .', \'Trip ID: '. $dataRow->id .'\')"><i class="fa-solid fa-trash-can"></i></a>
            
                </div>
            </div>
            
            <form action="' . route("trip.destroy", $dataRow->id) . '" method="POST" class="hidden" id="form-delete-'. $dataRow->id .'" 
            >
   <input name="_method" type="hidden" value="DELETE">
   '. csrf_field() .'
</form>
            
            ';
            return $row;
        })
        ->addColumn('truck_tooltip', function($dataRow){
            return '<a href="'. route("truck.show", $dataRow->truck_id ) .'" target="_blank"><span data-toggle="tooltip" title="Truck ID: '. $dataRow->truck_id .'">' . $dataRow->truck_name . ' - '. $dataRow->plate_no . '</span></a>';
        })
        ->addColumn('driver_tooltip', function($dataRow){
            return '<a href="'. route("driver.show", $dataRow->driver_id ) .'" target="_blank"><span data-toggle="tooltip" title="Driver ID: '. $dataRow->driver_id .'">' . $dataRow->driver_name . '</span></a>';
            //return [$dataRow->driver_id, $dataRow->driver_name];
        })
        ->escapeColumns([])
        ->make(true);
    }


    public function showTripTicketDetails($trip_ticket_id){
        return "show trip ticket details " . $trip_ticket_id ;
    }




    public function getTripBydateRange(Request $request){
        // $data = Trip::query();

       $trips = Trip::join('trucks','trips.truck_id', "=", "trucks.id")
       ->join('drivers', 'trips.driver_id', "=", 'drivers.id')
       ->select(['trips.*', 'trucks.name as truck_name', 'trucks.plate_no',  Trip::raw("CONCAT(drivers.firstname, ' ', drivers.lastname) AS driver_name")])
       ->whereBetween('trips.date',[$request->startDate, $request->endDate]);
        
       
       return DataTables::of($trips)
        ->addIndexColumn()
        ->addColumn('action', function($dataRow){
            $row = '<div class="row">
            <div class="col icons-option class="text-right"" >
            <a href="' . route("trip.show", $dataRow->id) . '"><i class="fa-solid fa-eye"></i></a>
            <a href="' . route("trip.edit",$dataRow->id) . '"><i class="fas fa-edit"></i></a>
            <a href="#" onclick="deleteRecord('. $dataRow->id .', \'Trip ID: '. $dataRow->id .'\')"><i class="fa-solid fa-trash-can"></i></a>
            
                </div>
            </div>
            
            <form action="' . route("trip.destroy", $dataRow->id) . '" method="POST" class="hidden" id="form-delete-'. $dataRow->id .'" 
            >
   <input name="_method" type="hidden" value="DELETE">
   '. csrf_field() .'
</form>
            
            ';
            return $row;
        })
        ->addColumn('truck_tooltip', function($dataRow){
            return '<a href="'. route("truck.show", $dataRow->truck_id ) .'" target="_blank"><span data-toggle="tooltip" title="Truck ID: '. $dataRow->truck_id .'">' . $dataRow->truck_name . ' - '. $dataRow->plate_no . '</span></a>';
        })
        ->addColumn('driver_tooltip', function($dataRow){
            return '<a href="'. route("driver.show", $dataRow->driver_id ) .'" target="_blank"><span data-toggle="tooltip" title="Driver ID: '. $dataRow->driver_id .'">' . $dataRow->driver_name . '</span></a>';
            //return [$dataRow->driver_id, $dataRow->driver_name];
        })
        ->escapeColumns([])
        ->make(true);
    }
}
