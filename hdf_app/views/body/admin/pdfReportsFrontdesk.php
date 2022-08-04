<?php 

require("assets/pdf/fpdf.php");
$pdf=new FPDF();
$pdf->AddPage();
//$str = utf8_decode("Ñ");







$pdf->SetFont("Arial","",12);
$pdf->cell(0,5,"",0,1,'C');
$pdf->SetFont("Arial","B",12);
$pdf->cell(0,5,"Hotel De Fides",0,1,'C');
$pdf->SetFont("Arial","",12);
$pdf->cell(0,5,"Reports",0,1,'C');

 						
$pdf->SetFont("Arial","B",12);
$pdf->cell(0,10,"",0,1,'L');

//$pdf->cell(0,7,"Reports: ".$from." - ".$to." (".$user.")",0,1,'L');
$pdf->cell(0,7,"Reports: ".$from." - ".$to." ",0,1,'L');


//$pdf->cell(0,10,"",0,1,'L');
$pdf->cell(50,8,"OR Number",1,0,'C');
$pdf->cell(50,8,"Date Process",1,0,'C');
$pdf->cell(40,8,"Type of Payment",1,0,'C');
$pdf->cell(50,8,"Amount",1,1,'C');




$pdf->SetFont("Arial","",11);
$f=0;
$g=0;
$h=0;
foreach ($result as $data) {
$f+=$data['refund_am'];
$g+=$data['ad_cash'];
$h+=$data['ad_card'];
  # code...
//update 2.0
$total_amount = $data['total_amount_process'] + $data['ad_cash'] + $data['ad_card'] - $data['refund_am'];
$pdf->cell(50,6,"FHDF".$data['id_reports']."",1,0,'L');
$pdf->cell(50,6,"".$data['date_process']."",1,0,'L');
$pdf->cell(40,6,"".$data['type_payment']."",1,0,'L');
$pdf->cell(50,6,"".number_format($total_amount,2)."",1,1,'L');
}

$total= $total_result[0]['total']+$g+$h-$f;
$pdf->cell(0,3,"",0,1,'C');
$pdf->cell(50,7,"",0,0,'L');
$pdf->cell(50,7,"",0,0,'L');
$pdf->cell(40,7,"Total:",0,0,'L');
$pdf->cell(50,7,"P ".number_format($total,2)."",0,1,'L');
//end update 2.0



	

					



$pdf->output();


 ?>