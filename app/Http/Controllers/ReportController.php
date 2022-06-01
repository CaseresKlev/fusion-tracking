<?php

namespace App\Http\Controllers;

use App\Models\Driver;
use App\Models\Trip;
//use DateTime;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Nette\Utils\DateTime;
//require ('D:\DATDAT\fusion-tracking\resources\views\report\fpdf.php');
use FPDF;

class ReportController extends Controller
{

    public function generateDriverReport(Request $request){
    
        $from = strip_tags($request->from);
        $to = strip_tags($request->to);
        $id = strip_tags($request->id);

        $driverlist = array(); 
        $dataList = array();
        $tripCountList = array();
        $grossIncomeList = array();
        $netIncomeList = array();
        //dd($driverlist);
        if($request->id){
            //dd("valid: " . $request->id);
            array_push($driverlist, Driver::findOrFail($id)->toArray());
        }else{
            //dd("not valid! Go for report for all driver");
            $driverlist = Driver::all()->toArray();
        }

        //dd($driverlist);

        for($i=0; $i<count($driverlist); $i++){
            $driver = $driverlist[$i];
            //dd($driver);
            $data = DB::select(DB::raw('SELECT DATE_FORMAT(trips.date, "%d-%b-%Y") as date, trips.trip_ticket_id, trucks.name as truck_name, trips.source, trips.destination as dump_area, trips.weigth, trips.distance, trips.rate, trips.bill FROM `trips` INNER JOIN trucks WHERE trips.truck_id = trucks.id and trips.driver_id = ' . $driver['id'] . ' and trips.date BETWEEN "'. $from .'" and "'. $to .'"'));
            //dd($data);
            if (count($data) >= 1) {
                //dd("record found in trips table for the period " . $from . " to " . $to);
                array_push($dataList, $data);
           }
        }
        
        //dd($dataList);
        $shareQuery = DB::select("SELECT settings.app_value_1 FROM `settings` WHERE settings.app_name = 'APP' and settings.app_section = 'DRIVER' and settings.app_field = 'SHARE'");
        $share = $shareQuery[0]->app_value_1;
        
        //dd($share);
        for($i=0; $i<count($dataList); $i++){
            $row = $dataList[$i];
            $grossIncome = 0;
            $netIncome = 0;
            //dd($row);
            for($j=0; $j<count($row); $j++){
                $col = $row[$j];
                $grossIncome += $col->bill;
                
            }
             $netIncome = $grossIncome * $share;
             array_push($netIncomeList, $netIncome);
             array_push($grossIncomeList, $grossIncome);
             array_push($tripCountList, count($row));
        }

        //dd($netIncomeList);
        //dd($grossIncomeList);
        //dd($tripCountList);


        
        $dateFrom = DateTime::createFromFormat("Y-m-d", $from)->format("Y-d-m");
        $dateTo = DateTime::createFromFormat("Y-m-d", $to)->format("Y-d-m");
        $period = "";
        //dd(date_format(DateTime::createFromFormat("Y-m-d", $from), "F Y"));
        if (date_format(DateTime::createFromFormat("Y-m-d", $from), "F Y")===date_format(DateTime::createFromFormat("Y-m-d", $to), "F Y")) {
             $period .= date_format(DateTime::createFromFormat("Y-m-d", $from), "F") . " ";
             $period .= date_format(DateTime::createFromFormat("Y-m-d", $from), "d") . " - ";
             $period .= date_format(DateTime::createFromFormat("Y-m-d", $to), "d") . ", ";
             $period .= date_format(DateTime::createFromFormat("Y-m-d", $from), "Y");
            // year and month match
        }else{
            $period .= date_format(DateTime::createFromFormat("Y-m-d", $from), "F") . " ";
            $period .= date_format(DateTime::createFromFormat("Y-m-d", $from), "d") . ", ";
            $period .= date_format(DateTime::createFromFormat("Y-m-d", $from), "Y") . " to ";
            $period .= date_format(DateTime::createFromFormat("Y-m-d", $to), "F") . " ";
            $period .= date_format(DateTime::createFromFormat("Y-m-d", $to), "d") . ", ";
            $period .= date_format(DateTime::createFromFormat("Y-m-d", $to), "Y");
        }
        
        return view("report.driver_report",
        [
            "from"=> $from,
            "to" => $to,
            "dataList" => $dataList,
            "driverlist" => $driverlist,
            "tripCountList" => $tripCountList,
            "grossIncomeList" =>$grossIncomeList,
            "netIncomeList" =>$netIncomeList,
            "period" =>$period
        ]);
    }

    public function generateCompanyReport(){
        return "Company Reporting";
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view("report.index");
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
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
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
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
