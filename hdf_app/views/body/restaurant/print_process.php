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
$pdf->cell(0,5,"Official Reciept",0,1,'C');
$pdf->cell(0,5,"Restaurant",0,1,'C');

 						
$pdf->SetFont("Arial","B",12);
$pdf->cell(0,10,"",0,1,'L');
$pdf->cell(40,4,"OR# RHDF".$id_reports."",0,1,'L');

$pdf->cell(0,10,"",0,1,'L');
$pdf->cell(40,4,"Ref No.",0,0,'L');
$pdf->cell(50,4,"Product Name",0,0,'L');
$pdf->cell(40,4,"QTY",0,0,'L');
$pdf->cell(30,4,"Unit Cost",0,'L');
$pdf->cell(0,4,"Total Cost",0,1,'L');


$pdf->cell(0,5,"",0,1,'C');
$pdf->SetFont("Arial","",12);

							foreach ($product_cart_receipt as $data) {
                                      # code...
                              $product_cost =  $data['product_cost'];
                              $product_qty =  $data['product_qty'];
                              $total = $product_cost * $product_qty;
                                
$pdf->cell(40,4,"HFRES".$data['id_cart']."",0,0,'L');
$pdf->cell(50,4,"".$data['product_name']."",0,0,'L');
$pdf->cell(40,4,"".$product_qty."",0,0,'L');
$pdf->cell(30,4,"".$product_cost."",0,'L');
$pdf->cell(0,4,"".$total."",0,1,'L');

							}


	

					

/////////////
//////////
					foreach ($product_cart_receipt as $data){
                      $type = $data['deduction_type'];
                      $id_num = $data['id_number'];
                      $client = $data['name_of_client'];
                      $percent = $data['deduction_percent'];

                    } 

               
if (!empty($product_cart_receipt)) {
	# code...

  
	$dis = $total_amount_receipt[0]['total']*".$percent";

    $pdf->cell(0,3,"",0,1,'C');
	$pdf->cell(0,2,"",'T',1,'C');

    $pdf->cell(80,4,"(Discount)".$type."",0,0,'L');
	$pdf->cell(50,4,"",0,0,'L');
	$pdf->cell(30,4,"".$percent."% ",0,'L');
	$pdf->cell(0,4,"-".$dis."",0,1,'L');                         

	$pdf->cell(0,3,"",0,1,'C');
	$pdf->cell(0,2,"",'T',1,'C');

	$pdf->cell(80,4,"",0,0,'L');
	$pdf->cell(50,4,"",0,0,'L');
	$pdf->cell(30,4,"Total: ",0,'L');
	$pdf->cell(0,4,"".$total_amount_receipt[0]['total']-$dis."",0,1,'L');

	$pdf->cell(80,4,"",0,0,'L');
	$pdf->cell(50,4,"",0,0,'L');
	$pdf->cell(30,4,"Amount Gave: ",0,'L');
	$pdf->cell(0,4,"".$amount_give."",0,1,'L');


	$pdf->cell(80,4,"",0,0,'L');
	$pdf->cell(50,4,"",0,0,'L');
	$pdf->cell(30,4,"Change: ",0,'L');
	$pdf->cell(0,4,"".$amount_give-($total_amount_receipt[0]['total']-$dis)."",0,1,'L');

} else {
	$pdf->cell(0,3,"",0,1,'C');
	$pdf->cell(0,2,"",'T',1,'C');

	$pdf->cell(80,4,"",0,0,'L');
	$pdf->cell(50,4,"",0,0,'L');
	$pdf->cell(30,4,"Total: ",0,'L');
	$pdf->cell(0,4,"".$total_amount_receipt[0]['total']."",0,1,'L');

	$pdf->cell(80,4,"",0,0,'L');
	$pdf->cell(50,4,"",0,0,'L');
	$pdf->cell(30,4,"Amount Gave: ",0,'L');
	$pdf->cell(0,4,"".$amount_give."",0,1,'L');

	$pdf->cell(80,4,"",0,0,'L');
	$pdf->cell(50,4,"",0,0,'L');
	$pdf->cell(30,4,"Change: ",0,'L');
	$pdf->cell(0,4,"".$amount_give-$total_amount_receipt[0]['total']."",0,1,'L');


}

  	$pdf->cell(0,3,"",0,1,'C');
  	$pdf->cell(0,2,"",'T',1,'C');
if (!empty($card_number)) {
	# code...

    $pdf->cell(40,4,"Card Number",0,0,'L');
	$pdf->cell(50,4,"".$card_number."",0,0,'L');
	$pdf->cell(30,4," ",0,'L');
	$pdf->cell(0,4,"",0,1,'L');
}
	$pdf->cell(40,4,"Account Process",0,0,'L');
	$pdf->cell(50,4,"".$account."",0,0,'L');
	$pdf->cell(30,4," ",0,'L');
	$pdf->cell(0,4,"",0,1,'L');












$pdf->output();


 ?>