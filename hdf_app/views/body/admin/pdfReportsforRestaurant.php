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

$pdf->cell(0,7,"Reports: ".$from." - ".$to."",0,1,'L');


//$pdf->cell(0,10,"",0,1,'L');
$pdf->cell(50,8,"OR Number",1,0,'C');
$pdf->cell(50,8,"Date Process",1,0,'C');
$pdf->cell(40,8,"Type of Payment",1,0,'C');
$pdf->cell(50,8,"Amount",1,1,'C');




$pdf->SetFont("Arial","",11);
foreach ($result as $data) {
  # code...

$pdf->cell(50,6,"FHDF".$data['id_reports']."",1,0,'L');
$pdf->cell(50,6,"".$data['date_process']."",1,0,'L');
$pdf->cell(40,6,"".$data['type_payment']."",1,0,'L');
$pdf->cell(50,6,"".$data['total_amount_process']."",1,1,'L');
}


$pdf->cell(0,3,"",0,1,'C');
$pdf->cell(50,7,"",0,0,'L');
$pdf->cell(50,7,"",0,0,'L');
$pdf->cell(40,7,"Total:",0,0,'L');
$pdf->cell(50,7,"P ".$total_result[0]['total']."",0,1,'L');




	

					



$pdf->output();


 ?>