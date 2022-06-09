<?php

namespace App\Http\Controllers;

use App\Http\Requests\ExpenseFormRequest;
use App\Models\Expense;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ExpenseController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return "index of expenses";
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(ExpenseFormRequest $request)
    {
       // $input = $request->all();
          
        //dd($input);
        

        $data = $request->validated();
        $expense = new Expense();
        $expense->trip_id = $data['trip_id'];
        $expense->company_id = $data['company_id'];
        $expense->truck_id = $data['truck_id'];
        $expense->driver_id = $data['driver_id'];
        $expense->ref_no = $data['ref_no'];
        $expense->stock_source = $data['stock_source'];
        $expense->item = $data['item'];
        $expense->destination = $data['destination'];
        $expense->quantity = $data['quantity'];
        $expense->accumulated_total = $data['accumulated_total'];
        $expense->entry_by = $data['entry_by'];
        $expense->date = $data['date'];

        $saved = $expense->save();
        return response()->json(['message'=>'Expense added successfully']);

    //     // if(!$saved){
    //     //     abort(500, 'Error');
    //     // }

    //     $result = [
    //         'status' => $saved,
    //         'value' => 'This is the message',
    //         'alertType' =>'success'

    //     ];

    //    // dd($expense);
    //     return response()->json($saved);



        //return response()->json($result);
    //    return redirect()->route('dashboard.trip')
    //     ->with([ 
    //      'confirmationMessage' =>'Trip ID: ' . $expense->id .  " was created succesfully.",
    //      'alertType' =>'success' 
    //      ]);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Expense  $expense
     * @return \Illuminate\Http\Response
     */
    public function show(Expense $expense)
    {
        return "showing Expense";
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Expense  $expense
     * @return \Illuminate\Http\Response
     */
    public function edit(Expense $expense)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Expense  $expense
     * @return \Illuminate\Http\Response
     */
    public function update(ExpenseFormRequest $request, Expense $expense)
    {
        $data = $request->validated();
        //$expense = new Expense();
        $expense->trip_id = $data['trip_id'];
        $expense->company_id = $data['company_id'];
        $expense->truck_id = $data['truck_id'];
        $expense->driver_id = $data['driver_id'];
        $expense->ref_no = $data['ref_no'];
        $expense->stock_source = $data['stock_source'];
        $expense->item = $data['item'];
        $expense->destination = $data['destination'];
        $expense->quantity = $data['quantity'];
        $expense->accumulated_total = $data['accumulated_total'];
        $expense->entry_by = $data['entry_by'];
        $expense->date = $data['date'];

        $saved = $expense->save();
        return response()->json([
            'message' => 'Expense was updated successfuly!'
        ]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Expense  $expense
     * @return \Illuminate\Http\Response
     */
    public function destroy(Expense $expense)
    {
        $expense->delete();
        return response()->json([
            'message' => 'Expense deleted successfully!'
        ]);
    }

    public function getAjaxData(Request $request){


        //$params = 'Trip Id: ' . $trip . ' Truck Id: ' . $truck . ' Company iD: ' . $company . ' driver id: ' . $driver;
        //dd($params); 

        //DB::raw('CONCAT(drivers.firstname, " ", drivers.lastname) as driver'

        // $expense = DB::table('expenses')
        // ->join('companies' , 'expenses.company_id', "=", "companies.id")
        // ->join('trucks', 'expenses.truck_id', '=', 'trucks.id')
        // ->join('drivers', 'expenses.driver_id', '=', 'drivers.id')
        // ->select('expenses.*', 'companies.name as company', 'trucks.name as truck', DB::raw('CONCAT(drivers.firstname, " ", drivers.lastname) as driver'));
        // //->where('1' , "=" , '1')

        $companyJoin = ", ' '  as company";
        $truckJoin = ", ' '  as truck";
        $driverJoin = ", ' '  as driver";

        $rawQuery = DB::raw ('DISTINCT(expenses.id) as distinct_id, expenses.*');
        $expense = DB::table('expenses');
        if($request->has('company') && !empty($request->company)){
            $expense->join('companies' , 'expenses.company_id', "=", "companies.id");
            $companyJoin = ', companies.name as company';
        }
        if($request->has('truck') && !empty($request->truck)){
            $expense->join('trucks', 'expenses.truck_id', '=', 'trucks.id');
            $truckJoin = ', trucks.name as truck';
        }
        if($request->has('driver') && !empty($request->driver)){
            $expense->join('drivers', 'expenses.driver_id', '=', 'drivers.id');
            $driverJoin = DB::raw(', CONCAT(drivers.firstname, " ", drivers.lastname) as driver');
        }
        
        $expense->select(DB::raw($rawQuery . $companyJoin . $truckJoin . $driverJoin  ));
        //)
        //$expense->select('expenses.*', $companyJoin, $truckJoin, $driverJoin);
        //$expense->select('expenses.*', 'companies.name as company', 'trucks.name as truck', DB::raw('CONCAT(drivers.firstname, " ", drivers.lastname) as driver'));
        //->where('1' , "=" , '1')
        
        if($request->has('trip') && !empty($request->trip)){
            $expense->where('expenses.trip_id', $request->trip);
        }
        if($request->has('truck') && !empty($request->truck)){
            $expense->where('expenses.truck_id', $request->truck);
        }
        if($request->has('company') && !empty($request->company)){
            $expense->where('expenses.company_id', $request->company);
        }
        if($request->has('driver') && !empty($request->driver)){
            $expense->where('expenses.driver_id', $request->driver);
        }
        if($request->has('startDate') && !empty($request->startDate)){
           
            $expense->whereBetween('expenses.date',[date("Y-m-d", strtotime($request->startDate) ), date("Y-m-d", strtotime($request->endDate) ) ]);
        }
        $result = $expense->get();

        // for($i=0; $i<count($result); $i++){
        //     $result[$i]->trip_id = '<a target="_blank" href="'.  route("trip.show", $result[$i]->trip_id) .'">'. $result[$i]->trip_id .'  </a>';    
        // }
        
       //dd($result[0]->trip_id);
        
        
        
        
        
        //$expense->toSql();
        //->where('expenses.trip_id', '=', '100000');
       // $expense = Expense::find('1');
        //dd($expense->toSql());
        
       //return $params;
        return response()->json($result);
    }
}
