<?php

use PhpOffice\PhpSpreadsheet\Writer\Pdf;

require('fpdf.php');


class myPDF extends FPDF{
    var $driverModel;
    var $period;
    var $footerText = "";

    function header(){
        $this->SetFillColor(255,255,255);
        $this->SetTextColor(0);
        $pointX = 290;
        $pointY = 15;
        $this->SetFont("Arial", "B", 16);
        //$this->Cell(X, Y, TEXT, BOARDER, 0, ALIGNMENT);
        //$this->Cell($pointX, $pointY, "Company Billing Report", 0, 0, 'C');
        $this->Cell(0, $pointY, "Company Billing Report", 0, 0, 'C');
        $this->Ln();
        $this->SetFont("Times", "", 12);
        $this->Cell(0, 0, "For the period of " . $this->period, 0, 0, 'C');
        $this->Ln(2);
        $this->Ln(2);
        $this->Ln(2);
        $this->Ln(2);
    }

    function footer(){
        $this->SetFillColor(255,255,255);
        $this->SetTextColor(0);
        $this->SetY(-15);
        $this->SetFont('Arial', '', 9);
       // dd($this->driverModel);
        $this->Cell(0, 10, strtoupper($this->footerText) . " (" . $this->period . "). This is a system generated report. Generated on " . date("Y-m-d H:i:s"), 0, 0, "L");
        $this->Cell(0, 10, "Page " .$this->PageNo() . "/{nb}", 0, 0, "R");
    }

    function generateSummaryText($company, $text){
            $this->Ln(2);
            $this->Ln(2);
            $this->SetFont("Times", "B", 14);
        if($text===""){
            $this->Cell(0, 0, strtoupper("*** INCOME Summary Report OF " . $company['name']) . " ***" , 0, 0, "C");
        }else{
            $this->Cell(0, 0, strtoupper($text) , 0, 0, "C");
        }
        $this->Ln(2);
            $this->Ln(2);
            $this->Ln(2);
            $this->Ln(2);
    }

    function generateCompanySummaryReport($company, $taxRate){
        $heigth = 6;
        $this->SetFillColor(255,255,255);
        $this->SetTextColor(0);

        $this->generateSummaryText($company, "");
        
        $this->SetFont("Arial", "B", 11);
        $this->Cell(35, $heigth, "Company Name:", 0, 0);
        $this->Cell(170, $heigth, $company['name'], 0, 0);
        $this->Ln();
        $this->Cell(35, $heigth, "Total # of Trucks:", 0, 0);
        $this->Cell(170, $heigth, count($company['trucks']), 0, 0);
        $this->Ln();
        $this->Cell(35, $heigth, "Total # of Trips:", 0, 0);
        $this->Cell(170, $heigth, $company['total_trips'], 0, 0);
        $this->Ln();
        $this->Cell(0, 0, "",1,0);
        $this->Ln();
        $this->generateSummaryDetails($company['trucks'], $taxRate, $company);

        
    }

    function generateSummaryDetails($trucks, $taxRate, $company){
        $this->Ln(2);
        $this->Ln(2);

         $this->SetFillColor(255,0,0);
         $this->SetTextColor(255);
        // $this->SetDrawColor(128,0,0);
        // $this->SetLineWidth(.3);
        $this->SetFont("Arial", "B", 10);

        $w = array(37, 37, 37, 37, 40);
        //$this->Cell(15,7,"",0,0,'C');
        $header = array("TRUCK ID", "TRUCK NAME", "# OF TRIPS", "TOTAL INCOME", "TOTAL EXPENSE");
        for($i=0;$i<count($header);$i++){
            $this->Cell($w[$i],7,$header[$i],0,0,'C',true);
        }
        $this->Ln();
        $this->SetFillColor(255,255,255);
        $this->SetTextColor(0);
        

        $grossIncome = 0;
        $totalExpense = 0;
        for($i=0; $i<count($trucks); $i++){
            $truck = $trucks[$i];
            //$this->Cell(15,7,"",0,0,'C');
            $this->Cell($w[$i],7,$truck['id'],0,0,'C',true);
            $this->Cell($w[$i],7,$truck['name'],0,0,'C',true);
            if(count($truck['trips'])==0){
                $this->Cell($w[$i],7,"--",0,0,'C',true);
            }else{
                $this->Cell($w[$i],7,count($truck['trips']),0,0,'C',true);
            }

            $grossIncome += $truck['truck_total_income'];
            if($truck['truck_total_income']==0){
                $this->Cell($w[$i],7,"--",0,0,'R',true);
            }else{
                $this->Cell($w[$i],7, number_format(floatval($truck['truck_total_income']), 2, '.', ','),0,0,'R',true);
            }

            $totalExpense += $truck['truck_total_expense'];
            if($truck['truck_total_expense']==0){
                $this->Cell($w[$i],7,"--",0,0,'R',true);
            }else{
                $this->Cell($w[$i],7, number_format(floatval($truck['truck_total_expense']), 2, '.', ','),0,0,'R',true);
            }

            $this->Ln();
        }

        $this->Ln(2);
        $this->Ln(2);
        $this->Ln(2);
        $this->Ln(2);
        $this->Ln(2);
        $this->Cell(0,0,"",1,0,'C');
        $this->Ln(2);
        $this->Ln(2);
        $this->Ln(2);
        $this->Cell(15,7,"",0,0,'C');
        $this->Cell(40,7,"",0,0,'C');
        $this->Cell(40,7,"",0,0,'C');
        $this->Cell(40,7,"GROSS INCOME:",0,0,'R');
        $this->Cell(40,7, number_format(floatval($grossIncome), 2, '.', ',') ,0,0,'R');
        $this->Ln();
        $this->Ln(2);
        $this->Cell(15,7,"",0,0,'C');
        $this->Cell(40,7,"",0,0,'C');
        $this->Cell(40,7,"",0,0,'C');
        $this->Cell(40,7,"DEDUCTIONS",0,0,'R');
        //$this->Cell(40,7, "( " . number_format(floatval($totalExpense) , 2, '.', ',') . " )" ,0,0,'R');
        
        $totalTax = floatval($grossIncome) * $taxRate;
        $this->Ln();
        $this->Cell(15,7,"",0,0,'C');
        $this->Cell(40,7,"",0,0,'C');
        $this->Cell(40,7,"",0,0,'C');
        $this->Cell(40,7,"Less Tax " . ($taxRate * 100) . "%:",0,0,'R');
        $this->Cell(40,7, "( " . number_format( $totalTax, 2, '.', ',') . " )" ,0,0,'R');

        
        $this->Ln();
        $this->Cell(15,7,"",0,0,'C');
        $this->Cell(40,7,"",0,0,'C');
        $this->Cell(40,7,"",0,0,'C');
        $this->Cell(40,7,"Total Expense: ",0,0,'R');
        $this->Cell(40,7, "( " . number_format(floatval($totalExpense), 2, '.', ',') . " )"  ,0,0,'R');
        $this->Ln();
        $this->Cell(0,0,"",1,0,'C');
        
        $netIncome = $grossIncome - $totalTax - $totalExpense;
        $this->Ln();
        $this->Cell(15,7,"",0,0,'C');
        $this->Cell(40,7,"",0,0,'C');
        $this->Cell(40,7,"",0,0,'C');
        // $this->SetTextColor(255, 0, 0);
        $this->Cell(40,7,"NET INCOME: ",0,0,'R');
        $this->Cell(40,7, "PHP " . number_format(floatval($netIncome), 2, '.', ',')  ,0,0,'R');
        $this->SetTextColor(0,0,0);

        $this->Ln(2);
        $this->Ln(2);
        $this->Ln(2);
        $this->Ln(2);
        $this->Ln(2);
        $this->Ln(2);
        $this->Ln(2);
        $this->Ln(2);
        // $this->Ln(2);
        // $this->Ln(2);
        $this->SetFont("Arial", "B", 14);
        $this->Cell(0,7, "PHP   " . number_format(floatval($netIncome), 2, '.', ',') ,0,0,'C');
        $this->Ln();
        $this->SetFont("Arial", "", 10);
        $this->Cell(0,0, "" ,1,0,'C');
        $this->Ln();
        $this->Cell(0,7,"NET BILLING FOR THE PERIOD (". $this->period .")",0,0,'C');
        $this->Ln(2);
        $this->Ln(2);
        $this->Ln(2);
        $this->Ln(2);
        $this->Ln(2);
        $this->Ln(2);
        $this->Ln(2);
        $this->Cell(90,7,"Prepared By: ",0,0,'C');
        $this->Ln();
        $this->Cell(0,7,"____________________________________",0,0,'C');

        $this->generateTripDetails($trucks, $company);
        
       // $this->Ln();

        // for($i=0; $i<count($trucks); $i++){
        //     $this->SetFont("Arial", "B", 11);
        // }
    }

    function generateTripDetails($truckList, $company){
        
        for($t=0; $t<count($truckList); $t++){
            
            $truck = $truckList[$t];

            if($truck['truck_total_income']>0){
                $this->AddPage("P", "A4", 0);
                $this->generateSummaryText($truckList, "*** TRIPS DETAILS OF ". $company['name'] ."***");
                $heigth = 6;
                $this->SetFont("Arial", "B", 11);
                
                $this->Cell(35, $heigth, "Company Name:", 0, 0);
                $this->Cell(100, $heigth, $company['name'], 0, 0);
                $this->Cell(35, $heigth, "Total # of Trips:", 0, 0);
                $this->Cell(0, $heigth, count($truck['trips']), 0, 0);
                $this->Ln();
                $this->Cell(35, $heigth, "Truck Name:", 0, 0);
                $this->Cell(100, $heigth, $truck['name'], 0, 0);
                $this->Cell(35, $heigth, "Gross Income:", 0, 0);
                $this->Cell(0, $heigth, number_format(floatval($truck['truck_total_income']), 2, '.', ',') , 0, 0);
                $this->Ln();

                $this->Cell(0, 0, "",1,0);
                $this->Ln();
                $this->Ln(2);

                $this->SetFillColor(255,0,0);
                $this->SetTextColor(255);
                $this->SetDrawColor(128,0,0);
                $this->SetLineWidth(.3);
                $this->SetFont("Arial", "B", 10);

                $w = array(25, 25, 37, 37, 15, 15, 15, 22);
                //$this->Cell(15,7,"",0,0,'C');
                $header = array("DATE", "TICKET #", "SOURCE", "DUMP", "DIST." , "WMT", "RATE", "TOTAL");
                for($i=0;$i<count($header);$i++){
                    $this->Cell($w[$i],7,$header[$i],1,0,'C',true);
                }
                $this->Ln();

                $tripList = $truck['trips'];
                $x = 0;

                $this->SetFillColor(255,255, 255);
                $this->SetTextColor(0);
                $this->SetDrawColor(128,0,0);
                $this->SetLineWidth(.3);
                for($i=0;$i<count($tripList);$i++){
                    $trip = $tripList[$i];
                    $this->Cell($w[0],7,$trip['date'],1,0,'C',true);
                    $this->Cell($w[1],7,$trip['trip_ticket_id'],1,0,'C',true);
                    $this->Cell($w[2],7,$trip['source'],1,0,'C',true);
                    $this->Cell($w[3],7,$trip['destination'],1,0,'C',true);
                    $this->Cell($w[4],7, number_format(floatval($trip['distance']) , 2, '.', ','),1,0,'R',true);
                    $this->Cell($w[5],7, number_format(floatval($trip['weigth']) , 2, '.', ','),1,0,'R',true);
                    $this->Cell($w[6],7, number_format(floatval($trip['rate']) , 2, '.', ','),1,0,'R',true);
                    $this->Cell($w[7],7, number_format(floatval($trip['bill']) , 2, '.', ','),1,0,'R',true);
                    $this->Ln();
                }
            }
            
        }

        $this->generateExpenses($truckList, $company);
        
       // $this->generateSummaryDetails($company['trucks'], $taxRate);

        
    }

    public function generateExpenses($truckList, $company){
        $over_all_expense = 0;
        $over_all_expense_list = $company['over_all_expense'];
        for($i=0; $i<count($over_all_expense_list); $i++){
            $o_expense = $over_all_expense_list[$i];
            $over_all_expense += $o_expense['accumulated_total'];
        }

        if($over_all_expense>0){
            $this->AddPage("P", "A4", 0);
            $this->generateSummaryText($company, "*** EXPENSES DETAILS OF ". $company['name'] ."***");
            $heigth = 6;
            $this->SetFont("Arial", "B", 10);

            
            $this->Cell(35, $heigth, "Company Name:", 0, 0);
            $this->Cell(100, $heigth, $company['name'], 0, 0);
            $this->Ln();
            $this->Cell(35, $heigth, "Total Expenses:", 0, 0);
            $this->Cell(100, $heigth, number_format(floatval($over_all_expense) , 2, '.', ',') , 0, 0);
            $this->Ln();
            $this->Cell(0, 0, "",1,0); 
            $this->Ln();
            $this->Ln(2);

            $this->SetFillColor(255,0,0);
            $this->SetTextColor(255);
            $this->SetDrawColor(128,0,0);
            $this->SetLineWidth(.3);
            $this->SetFont("Arial", "B", 9);

            $header = array("DATE", "REF.#/PPIS#", "ITEM", "TRUCK NAME", "QTY", "TOTAL", "BY");
            $w = array(20, 25, 30, 30, 15, 25, 40);
            for($i=0;$i<count($header);$i++){
                $this->Cell($w[$i],7,$header[$i],1,0,'C',true);
            }

            $this->Ln();

            $this->SetFillColor(255,255, 255);
            $this->SetTextColor(0);
            $this->SetDrawColor(128,0,0);
            $this->SetLineWidth(.3);

            for($t=0; $t<count($truckList); $t++){
                $truck = $truckList[$t];
                $tripList = $truck['trips'];

                for($i=0; $i<count($tripList); $i++){
                    $expenseList = $tripList[$i]['expense'];
                    //dd($expenseList);
                    for($j=0; $j<count($expenseList); $j++){
                        $expense = $expenseList[$j];
                        $this->Cell($w[0],7,$expense['date'],1,0,'C',true);
                        $this->Cell($w[1],7,$expense['ref_no'],1,0,'C',true);
                        $this->Cell($w[2],7,$expense['item'],1,0,'C',true);
                        $this->Cell($w[3],7,$truck['name'],1,0,'C',true);
                        //$this->Cell($w[4],7, "",1,0,'R',true);
                        $this->Cell($w[4],7, number_format(floatval($expense['quantity']) , 2, '.', ','),1,0,'R',true);
                        $this->Cell($w[5],7, number_format(floatval($expense['accumulated_total']) , 2, '.', ','),1,0,'R',true);
                        $this->Cell($w[6],7, $expense['entry_by'] ,1,0,'C',true);
                        $this->Ln();
                    }
                }
            }
        }
        
        
    }


    // Colored table
    function FancyTable($header, $data)
    {
        // Colors, line width and bold font
        //$this->SetY(150);
        $this->SetFillColor(255,0,0);
        $this->SetTextColor(255);
        $this->SetDrawColor(128,0,0);
        $this->SetLineWidth(.3);
        $this->SetFont("Arial", "B", 10);
        //$this->SetFont('','B');
        // Header
        $w = array(30, 30, 30, 40, 40, 20, 20, 30, 30);
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
            //$i++;
            $j = 0;
            foreach($row as $col){
                $align = "L";
                $val = "";
                if($j>=5){
                    $align = "R";
                    $val = number_format(floatval($col), 2, '.', ',');
                }else{
                    $val = $col;
                }
                $this->Cell($w[$j],6,$val,1, 0, $align);
                $j++;
                //$this->Ln();
            }
                //dd($row);
                

            $this->Ln();
            $fill = !$fill;
        }
        // Closing line
        $this->Cell(array_sum($w),0,'','T');
    }
}

$pdf = new myPDF();

$pdf->period = $period;
$pdf->footerText = "COMP. BILLING REPORT";

//assigning Gross Income to company
for($i=0; $i<count($companyList); $i++){
    
    $pdf->AddPage("P", "A4", 0);
    // $company = $companyList[$i];
    $pdf->generateCompanySummaryReport($companyList[$i], $taxRate);

    // $trucks = $company['trucks'];
    // $pdf->generateSummaryDetails($trucks);
}





$pdf->AliasNbPages();
$pdf->SetFont('Arial','B',16);



$filename = "COMPANY REPORT (". $period .")";
//$pdf->Output("D", strtoupper($driverModel['lastname'] . " income report ") . "(" . $from . " to " . $to . ")". ".pdf");
$pdf->Output("D", strtoupper($filename). ".pdf");
?>
