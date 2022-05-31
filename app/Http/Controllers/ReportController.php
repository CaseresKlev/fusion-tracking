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



    // $pdf = new FPDF();
    // $pdf->AddPage();
    // $pdf->SetFont('Arial','B',16);
    // $pdf->Cell(40,10,'Hello World!');
    // $pdf->Output();

        $from = $request->from;
        $to = $request->to;
        $id = $request->id;

        $driverModel = Driver::find($id);
        $data = DB::select(DB::raw('SELECT DATE_FORMAT(trips.date, "%c-%b-%Y") as date, trips.trip_ticket_id, trucks.name as truck_name, trips.source, trips.destination as dump_area, trips.weigth, trips.distance, trips.rate, trips.bill FROM `trips` INNER JOIN trucks WHERE trips.truck_id = trucks.id and trips.driver_id = 1'));
        $driverModel = Driver::find($id)->toArray();
        $grossIncome = 0;
        
        //dd($data);
        foreach($data as $row){
            $grossIncome += $row->bill;
        }
        $netIncome = $grossIncome * .10;
        $dateFrom = DateTime::createFromFormat("Y-m-d", $from)->format("Y-d-m");
        $dateTo = DateTime::createFromFormat("Y-m-d", $to)->format("Y-d-m");
        $period = "";
        
        if (date_format(DateTime::createFromFormat("Y-m-d", $from), "F")===date_format(DateTime::createFromFormat("Y-m-d", $to), "F")) {
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
        //dd($period);
        //dd(date_format(DateTime::createFromFormat("Y-m-d", $from), "F")===date_format(DateTime::createFromFormat("Y-m-d", $to), "F"));
        
        //dd($netIncome);

        
        //dd(count($data));
        return view("report.driver_report",
        [
            "from"=> $from,
            "to" => $to,
            "driverModel" => $driverModel,
            "data" => $data,
            "driverModel" => $driverModel,
            "tripCount" => count($data),
            "grossIncome" =>$grossIncome,
            "netIncome" =>$netIncome,
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
