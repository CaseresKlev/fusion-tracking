<?php

namespace App\Http\Controllers;

use App\Models\Company;
use App\Models\Driver;
use App\Models\Expense;
use App\Models\Trip;
use App\Models\Truck;
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
        $period = $this->generateFormatedPeriod($from, $to);
        
        return view("report.driver_report",
        [
            "from"=> $from,
            "to" => $to,
            "dataList" => $dataList,
            "driverlist" => $driverlist,
            "tripCountList" => $tripCountList,
            "grossIncomeList" =>$grossIncomeList,
            "netIncomeList" =>$netIncomeList,
            "period" =>$period,
            "share" => $share
        ]);
    }

    public function generateFormatedPeriod($from, $to){
        //dd("Called");
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

        return $period;
    }

    public function generateCompanyReport(Request $request){
        
        $from = strip_tags($request->from);
        $to = strip_tags($request->to);
        $id = strip_tags($request->id);
        $period = $this->generateFormatedPeriod($from, $to);

        $companyList = array();
        if($request->id){
            //dd("valid: " . $request->id);
            array_push($companyList, Company::findOrFail($id)->toArray());
        }else{
            //dd("not valid! Go for report for all driver");
            $companyList = Company::all()->toArray();
        }


        //dd($companyList);
       // $companyTruckList = array();

        //assigning trucks to the company
        for($i=0; $i<count($companyList); $i++ ){
            $company = $companyList[$i];
            $truckList = Truck::where("company_id", "=", $company['id'])
                        ->get()
                        ->toArray();
            $companyList[$i]['trucks'] =  $truckList;
        }

        //assigning all expenses of the company
        for($i=0; $i<count($companyList); $i++ ){
            $company = $companyList[$i];
            $overallExpense = Expense::where("company_id", "=", $company['id'])
                        ->whereBetween('date', [$from, $to])
                        ->get()
                        ->toArray();
            $companyList[$i]['over_all_expense'] =  $overallExpense;
        }
        
        //dd($companyList[0]['trucks'][0]['id']);


        //assigning Trips Record to specific Truck of specific Company
        for($i=0; $i<count($companyList); $i++){
            $trucks = $companyList[$i]['trucks'];
            for($j=0; $j<count($trucks); $j++){
                //dd($companyList[$i]['trucks'][$j]);
                $companyList[$i]['trucks'][$j]['truck_total_expense'] = 0;
                $tripList = Trip::where("truck_id",  "=", $companyList[$i]['trucks'][$j]['id'])
                ->whereBetween('date', [$from, $to])
                ->get()
                ->toArray();

                // for($k=0; $k<count($tripList); $k++){
                //     for($l=0; $l<$tripList[$l]; $l++){
                //         $companyList[$i]['trucks'][$j]['truck_total_expense'] += $tripList[$l]['']
                //     }
                    
                // }
                $companyList[$i]['trucks'][$j]['trips'] = $tripList;
                //dd($expenseList);
            }
        }

        //assigning Expense to specific Truck of specific Company
        for($i=0; $i<count($companyList); $i++){
            $trucks = $companyList[$i]['trucks'];           
            for($j=0; $j<count($trucks); $j++){
                $companyList[$i]['trucks'][$j]['truck_total_expense'] = 0;
                $trips = $companyList[$i]['trucks'][$j]['trips'];
                for($k=0; $k<count($trips); $k++){
                    $expenses = Expense::where("trip_id", "=", $trips[$k]['id'])
                    ->whereBetween("date", [$from, $to])
                    ->get()
                    ->toArray();
                    for($l=0; $l<count($expenses); $l++){
                        $companyList[$i]['trucks'][$j]['truck_total_expense'] += $expenses[$l]['accumulated_total'];
                    }
                    $companyList[$i]['trucks'][$j]['trips'][$k]['expense'] = $expenses;
                }
            }
        }
        //dd($companyList); 

        //Calculating Gross Income of the company 
        for($i=0; $i<count($companyList); $i++){
            $trucks = $companyList[$i]['trucks'];
            $companyList[$i]['gross_income'] = 0;
            $companyList[$i]['total_trips'] = 0;
            for($j=0; $j<count($trucks); $j++){
                $companyList[$i]['trucks'][$j]['truck_total_income'] = 0;
                $trips = $companyList[$i]['trucks'][$j]['trips'];
                for($k=0; $k<count($trips); $k++){

                     //Computing Each Company gross total Income
                    $companyList[$i]['gross_income'] += $companyList[$i]['trucks'][$j]['trips'][$k]['bill'];
                    
                    //Computing each truck total income
                    $companyList[$i]['trucks'][$j]['truck_total_income'] += $companyList[$i]['trucks'][$j]['trips'][$k]['bill'];
                    
                    //Computing Each Company total trips
                    $companyList[$i]['total_trips']++;
                }
            }
        }
        //dd($companyList);

        $shareQuery = DB::select("SELECT settings.app_value_1 FROM `settings` WHERE settings.app_name = 'APP' and settings.app_section = 'TAX' and settings.app_field = 'RATE'");
        $taxRate = $shareQuery[0]->app_value_1;
        
       // dd($companyList);


        //return "Company Reporting " . $from . " " . $to . " " . $id;
        return view("report.company_report",
        [
            "from"=> $from,
            "to" => $to,
            "companyList" => $companyList,
            "period" =>$period,
            "taxRate" => $taxRate
        ]);
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
