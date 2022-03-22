<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Datatables\TruckDataTable;
use App\Models\Truck;

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
        return 'Creating of truck ';
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        return 'Storing of truck ';
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Truck $truck)
    {
        return view("truck.create_update", 
        [
            'actionMethod' => "view", 
            'actionDescription' => "View Record", 
            'alertType' =>'success', 
            'record' => $truck 
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
        return view("truck.create_update", 
        [
            'actionMethod' => "edit", 
            'actionDescription' => "View Record", 
            'alertType' =>'success', 
            'record' => $truck 
        ]);
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
        return 'Updating of truck ' . $id;
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
}
