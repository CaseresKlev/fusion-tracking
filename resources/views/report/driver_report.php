<?php

use PhpOffice\PhpSpreadsheet\Writer\Pdf;

require('fpdf.php');


class myPDF extends FPDF{
    var $driverModel;
    var $period;
    function header(){
        $pointX = 290;
        $pointY = 8;
        $this->SetFont("Arial", "B", 16);
        //$this->Cell(X, Y, TEXT, BOARDER, 0, ALIGNMENT);
        $this->Cell($pointX, $pointY, "Driver Billing Report", 0, 0, 'C');
        $this->Ln();
        $this->SetFont("Times", "", 12);
        $this->Cell($pointX, $pointY, "For the Period of " . $this->period, 0, 0, 'C');
        $this->Ln(2);
    }

    function footer(){
        $this->SetY(-15);
        $this->SetFont('Arial', '', 9);
       // dd($this->driverModel);
        $this->Cell(0, 10, strtoupper($this->driverModel['firstname'] . " " . $this->driverModel['lastname']) . " INCOME REPORT ( " . $this->period . " ). Generated: " . date("Y-m-d H:i:s"), 0, 0, "L");
        $this->Cell(0, 10, "Page " .$this->PageNo() . "/{nb}", 0, 0, "R");
    }

    function generateDriverInfo($driverID, $driverName, $from, $to, $totalTrips, $grossIncome, $netIncome ){
        $heigth = 6;
        $this->Ln();
        $this->Ln();
        $this->Ln();
        $this->SetFont("Arial", "B", 11);
        $this->Cell(35, $heigth, "Driver ID:", 0, 0);
        $this->Cell(170, $heigth, $driverID, 0, 0);
        $this->Cell(38, $heigth, "# of Trip(s): ", 0, 0);
        $this->Cell(0, $heigth, $totalTrips, 0, 0);
        $this->Ln();
        $this->Cell(35, $heigth, "Driver Name: ", 0, 0);
        $this->Cell(170, $heigth, $driverName, 0, 0);
        $this->Cell(38, $heigth, "Gross Income: ", 0, 0);
        $this->Cell(38, $heigth, $grossIncome, 0, 0);
        $this->Ln();
        $this->Cell(205, $heigth, "", 0, 0);
        $this->Cell(38, $heigth, "Net Income (10%): ", 0, 0);
        // Colors, line width and bold font
        $this->SetFillColor(0,255,0);
        $this->SetTextColor(255,0,0);
        $this->SetFont("Arial", "B", 14);
        //$this->SetDrawColor(128,0,0);
        //$this->SetLineWidth(.3);
        //$this->SetFont('','B');
        $this->Cell(0, $heigth, $netIncome, 0, 0);
        $this->Ln();
        
        // $this->SetFillColor(200,220,255);
        // $this->Cell(0, $heigth, "Share:  " . "                 Php " . $totalSHare, 0, 0);
        // $this->Ln();
        
    }


    function LoadData($file)
    {
        // Read file lines
        $lines = file($file);
        $data = array();
        foreach($lines as $line)
            $data[] = explode(';',trim($line));
        return $data;
    }

    // Simple table
    function BasicTable($header, $data)
    {
        // Header
        foreach($header as $col)
            $this->Cell(40,7,$col,1);
        $this->Ln();

        //dd($data);
        // Data
        foreach($data as $row)
        {
            foreach($row as $col)
                //dd($row);
                $this->Cell(40,6,$col,1);
            $this->Ln();
            //$this->Cell(40,6,$row['id'],1);

            //$this->Ln();
        }
    }

    // Colored table
    function FancyTable($header, $data)
    {
        // Colors, line width and bold font
        $this->SetFillColor(255,0,0);
        $this->SetTextColor(255);
        $this->SetDrawColor(128,0,0);
        $this->SetLineWidth(.3);
        $this->SetFont("Arial", "B", 10);
        //$this->SetFont('','B');
        // Header
        $w = array(30, 30, 30, 30, 30, 30, 30, 30, 30);
        for($i=0;$i<count($header);$i++)
            $this->Cell($w[$i],7,$header[$i],1,0,'C',true);
        $this->Ln();
        // Color and font restoration
        $this->SetFillColor(224,235,255);
        $this->SetTextColor(0);
        //$this->SetFont('');
        $this->SetFont("Arial", "", 10);
        // Data
        $fill = false;
        foreach($data as $row)
        {
            // $this->Cell($w[0],6,$row[0],'LR',0,'L',$fill);
            // $this->Cell($w[1],6,$row[1],'LR',0,'L',$fill);
            // $this->Cell($w[2],6,number_format($row[2]),'LR',0,'R',$fill);
            // $this->Cell($w[3],6,number_format($row[3]),'LR',0,'R',$fill);
            foreach($row as $col)
                //dd($row);
                $this->Cell(30,6,$col,1);
            $this->Ln();

            //$this->Ln();
            $fill = !$fill;
        }
        // Closing line
        $this->Cell(array_sum($w),0,'','T');
    }
}

$pdf = new myPDF();

$pdf->driverModel = $driverModel;
$pdf->period = $period;
$pdf->AddPage("L", "A4", 0);
$pdf->AliasNbPages();
$pdf->SetFont('Arial','B',16);
//dd($driverModel['id']);
$pdf->generateDriverInfo($driverModel['id'], $driverModel['firstname'] . " " . $driverModel['lastname'], $from, $to, $tripCount, $grossIncome, $netIncome);
//$pdf->Cell(40,10,'From: ' . $from . " To: " . $to . " ID: " . $driverModel->id);

//TABLE
$header = array('DATE', 'TRIP TICKET', 'DT #', 'SOURCE', 'DUMP AREA', 'WMT', 'DIST.', 'RATE per KM', 'AMOUNT');
$pdf->Ln();
// $pdf->Ln();
//$data = $pdf->LoadData('countries.txt');
$pdf->FancyTable($header, $data);
$pdf->Output("D");
?>
