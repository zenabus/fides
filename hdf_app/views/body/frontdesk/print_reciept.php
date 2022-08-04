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

$pdf->cell(0,10,"",0,1,'L');

 						

$pdf->SetFont("Arial","B",12);
$pdf->Image('assets/img/header.PNG',10,10,200);
$pdf->cell(0,5,"",0,1,'L');
$pdf->SetFont("","",10);
$pdf->cell(0,5,"Acknowledgment Reciept",0,1,'C');
$pdf->cell(0,5,"",0,1,'L');
$pdf->SetFont("Arial","",9);
$pdf->cell(150,4,"Name: ".$result_room_form[0]['first_name']."  ".$result_room_form[0]['last_name']."",0,0,'L');
$dates =date("F d, Y");
$pdf->cell(0,4,"".$dates."",0,1,'L');


$pdf->cell(150,4,"Address: ".$result_room_form[0]['address']."",0,1,'L');
$pdf->cell(150,4,"Contact No.: ".$result_room_form[0]['contact']."",0,1,'L');
$pdf->cell(150,4,"Email Address: ".$result_room_form[0]['email']."",0,1,'L');
$pdf->cell(150,4,"Company: N/A",0,1,'L');

// $pdf->cell(0,5,"OR# FHDF".$id_reports."",0,1,'L');

$pdf->cell(0,5,"",0,1,'L');

$pdf->cell(30,4,"Date",1,0,'L');
$pdf->cell(55,4,"Particulars",1,0,'L');
$pdf->cell(25,4,"Reference",1,0,'L');
$pdf->cell(25,4,"Charges",1,0,'L');
$pdf->cell(25,4,"Payment",1,0,'L');
$pdf->cell(25,4,"Balance",1,1,'L');


// $pdf->cell(30,4,"Date",1,0,'L');
// $pdf->cell(55,4,"Particulars",1,0,'L');
// $pdf->cell(25,4,"Reference",1,0,'L');
// $pdf->cell(25,4,"Charges",1,0,'L');
// $pdf->cell(25,4,"Payment",1,0,'L');
// $pdf->cell(25,4,"Balance",1,1,'L');

// $pdf->cell(30,4,"",'L,R',0,'L');
// $pdf->cell(55,4,"",'R',0,'L');
// $pdf->cell(25,4,"",'R',0,'L');
// $pdf->cell(25,4,"",'R',0,'L');
// $pdf->cell(25,4,"",'R',0,'L');
// $pdf->cell(25,4,"",'R',1,'L');

// $pdf->cell(30,4,"",'L,R',0,'L');
// $pdf->cell(55,4,"",'R',0,'L');
// $pdf->cell(25,4,"",'R',0,'L');
// $pdf->cell(25,4,"",'R',0,'L');
// $pdf->cell(25,4,"",'R',0,'L');
// $pdf->cell(25,4,"",'R',1,'L');






$pdf->SetFont("Arial","",9);



	



						foreach ($result_room_checked as $data) {



                            $date1 = $connect_book[0]['start_date'];

                            $date2 = $connect_book[0]['end_date'];

                            $start = new DateTime($date1);

                            $end = new DateTime($date2);



                            $diff = $start->diff($end);



                            $days_ren = $diff->format('%r%a');





                              $id = $data['id_rooms'];

                              $breakfast = $data['breakfast_id'];

                              $price_room = $data['price_room']+$breakfast;

                              $price_room_days = $price_room * $days_ren;

                              $price_person = $data['price_person'];

                              $add_person = $data['add_person'];

                              $total_person = $price_person * $add_person;





                              $price_bed = $data['price_bed'];

                              $add_bed = $data['add_bed'];

                              $total_bed = $price_bed * $add_bed;



                              $deduction = $data['name'];

                              $ded_percent = $data['price_deduct'];


                              $amen = $result_room_form[0]['amenities_amount'];
                               $price_ref_amount = $result_room_form[0]['refund_amount'];
                               $price_res_charge = $result_room_form[0]['res_charge'];
                               $price_coffee_charge = $result_room_form[0]['coffee_charge'];
                               $card_advance =$result_room_form[0]['card_advance']; 
                              //$total_in = $total_person + $total_bed + $price_room_days; 

                                ///update 2.0///////
                                $total_charge_resto['restoTotal'];
                                $total_charge_coffee['cofTotal'];
                                $total_charge_amen['AmTotal'];
                                $total_in = $total_person + $total_bed + $price_room_days + $amen + $total_charge_resto['restoTotal'] + $total_charge_coffee['cofTotal'] +$total_charge_amen['AmTotal']; ;
                                //////////////////
                                ///end update 2.0//

                              $total_percent = $price_room_days * ".$ded_percent";



                              $total_in_all = $total_in - $total_percent;

                              $total = $data['total_balance'];





                              //$this->db->query('update rooms_checked set total_balance="'.$total_in_all.'" where id_rooms="'.$id.'"'); 







$pdf->cell(30,4,"".$date1."",'L,R',0,'L');
$pdf->cell(55,4,"Room ".$data['room_number']." ".$days_ren."nights/s ",'R',0,'L');
$pdf->cell(25,4,"",'R',0,'L');
$pdf->cell(25,4,"".number_format($price_room_days,2)."",'R',0,'L');
$pdf->cell(25,4,"",'R',0,'L');
$pdf->cell(25,4,"".number_format($price_room_days,2)."",'R',1,'L');

$totalMinusDeduction = $price_room_days - $total_percent;
$pdf->cell(30,4,"",'L,R',0,'L');
$pdf->cell(55,4,"Deduction (".$deduction.")",'R',0,'L');
$pdf->cell(25,4,"",'R',0,'L');
$pdf->cell(25,4,"-".number_format($total_percent,2)."",'R',0,'L');
$pdf->cell(25,4,"",'R',0,'L');
$pdf->cell(25,4,"".number_format($totalMinusDeduction,2)."",'R',1,'L');



$totalPlusExtrabed = $totalMinusDeduction + $total_bed;
$pdf->cell(30,4,"",'L,R',0,'L');
$pdf->cell(55,4,"Extra Bed(".$add_bed.")",'R',0,'L');
$pdf->cell(25,4,"",'R',0,'L');
$pdf->cell(25,4,"".number_format($total_bed,2)."",'R',0,'L');
$pdf->cell(25,4,"",'R',0,'L');
$pdf->cell(25,4,"".number_format($totalPlusExtrabed,2)."",'R',1,'L');

$totalPlusExtraperson = $totalPlusExtrabed + $total_person;
$pdf->cell(30,4,"",'L,R',0,'L');
$pdf->cell(55,4,"Extra Bed(".$add_person.")",'R',0,'L');
$pdf->cell(25,4,"",'R',0,'L');
$pdf->cell(25,4,"".number_format($total_person,2)."",'R',0,'L');
$pdf->cell(25,4,"",'R',0,'L');
$pdf->cell(25,4,"".number_format($totalPlusExtraperson,2)."",'R',1,'L');

// $totalPlusAmenities = $totalPlusExtraperson + $amen;
// $pdf->cell(30,4,"",'L,R',0,'L');
// $pdf->cell(55,4,"Amenities",'R',0,'L');
// $pdf->cell(25,4,"",'R',0,'L');
// $pdf->cell(25,4,"".number_format($amen,2)."",'R',0,'L');
// $pdf->cell(25,4,"",'R',0,'L');
// $pdf->cell(25,4,"".number_format($totalPlusAmenities,2)."",'R',1,'L');
////////////////
///update 2.0///////////
if (!empty($get_charge_coffee)) {
	# code...
	$b = 0;
	foreach ($get_charge_coffee as $rowcof) {
		$b+= $rowcof['charge_amount'];
		$c= $b + $totalPlusExtraperson; 
		$pdf->cell(30,4,"",'L,R',0,'L');
		$pdf->cell(55,4,"".$rowcof['charge_name']."",'R',0,'L');
		$pdf->cell(25,4,"".$rowcof['charge_ref']."",'R',0,'L');
		$pdf->cell(25,4,"".number_format($rowcof['charge_amount'],2)."",'R',0,'L');
		$pdf->cell(25,4,"",'R',0,'L');
		$pdf->cell(25,4,"".number_format($c,2)."",'R',1,'L');

	//$b++;	
	}
} else {
	$c = 0 + $totalPlusExtraperson;
}

if (!empty($get_charge_resto)) {
	$d = 0;
		foreach ($get_charge_resto as $rowresto) {
			$d+= $rowresto['charge_amount'];
			$e= $d + $c; 
			$pdf->cell(30,4,"",'L,R',0,'L');
			$pdf->cell(55,4,"".$rowresto['charge_name']."",'R',0,'L');
			$pdf->cell(25,4,"".$rowresto['charge_ref']."",'R',0,'L');
			$pdf->cell(25,4,"".number_format($rowresto['charge_amount'],2)."",'R',0,'L');
			$pdf->cell(25,4,"",'R',0,'L');
			$pdf->cell(25,4,"".number_format($e,2)."",'R',1,'L');

		//$b++;	
		}
} else {
	$e = 0 + $c;
}
		
if (!empty($get_charge_amen)) {
	$f = 0;
		foreach ($get_charge_amen as $rowamen) {
			$f+= $rowamen['amen_amount'];
			$g= $f + $e; 
			$pdf->cell(30,4,"",'L,R',0,'L');
			$pdf->cell(55,4,"".$rowamen['amen_name']."",'R',0,'L');
			$pdf->cell(25,4,"",'R',0,'L');
			$pdf->cell(25,4,"".number_format($rowamen['amen_amount'],2)."",'R',0,'L');
			$pdf->cell(25,4,"",'R',0,'L');
			$pdf->cell(25,4,"".number_format($g,2)."",'R',1,'L');

		//$b++;	
		}
} else {
	$g = 0 + $e;
}





/////////////////
///Update 2.0 //
/////////////////
// $totalPlusResto = $totalPlusAmenities + $price_res_charge;
// $pdf->cell(30,4,"",'L,R',0,'L');
// $pdf->cell(55,4,"Restaurant",'R',0,'L');
// $pdf->cell(25,4,"".$c."",'R',0,'L');
// $pdf->cell(25,4,"".number_format($price_res_charge,2)."",'R',0,'L');
// $pdf->cell(25,4,"",'R',0,'L');
// $pdf->cell(25,4,"".number_format($totalPlusResto,2) ."",'R',1,'L');

// $totalPLusCoffee = $totalPlusResto + $price_coffee_charge;
// $pdf->cell(30,4,"",'L,R',0,'L');
// $pdf->cell(55,4,"Coffee Shop",'R',0,'L');
// $pdf->cell(25,4,"",'R',0,'L');
// $pdf->cell(25,4,"".number_format($price_coffee_charge,2)."",'R',0,'L');
// $pdf->cell(25,4,"",'R',0,'L');
// $pdf->cell(25,4,"".number_format($totalPLusCoffee,2)."",'R',1,'L');

if(!empty($data['restaurant_amount'])) {

  // $pdf->cell(30,4,"Charge To:",0,0,'L');

  // $pdf->cell(80,4,"Restaurant",0,0,'L');

  // $pdf->cell(40,4,"",0,'L');

  // $pdf->cell(0,4,"".$data['restaurant_amount']."",0,1,'L');

$pdf->cell(30,4,"",'L,R',0,'L');
$pdf->cell(55,4,"Restaurant",'R',0,'L');
$pdf->cell(25,4,"",'R',0,'L');
$pdf->cell(25,4,"".$data['restaurant_amount']."",'R',0,'L');
$pdf->cell(25,4,"",'R',0,'L');
$pdf->cell(25,4,"".$data['restaurant_amount']."",'R',1,'L');

}

if(!empty($data['cof_amount'])) {

// $pdf->cell(30,4,"Charge To:",0,0,'L');

// $pdf->cell(80,4,"Coffee Shop",0,0,'L');

// $pdf->cell(40,4,"",0,'L');

$pdf->cell(30,4,"",'L,R',0,'L');
$pdf->cell(55,4,"Coffee Shop",'R',0,'L');
$pdf->cell(25,4,"",'R',0,'L');
$pdf->cell(25,4,"".$data['cof_amount']."",'R',0,'L');
$pdf->cell(25,4,"",'R',0,'L');
$pdf->cell(25,4,"".$data['cof_amount']."",'R',1,'L');

}

// $pdf->cell(30,4,"",0,0,'L');

// $pdf->cell(80,4," ",0,0,'L');

// $pdf->cell(40,4,"Advance Payment ",0,'L');

// $pdf->cell(0,4,"- ".$advance."",0,1,'L');



$advance = $result_room_form[0]['advance_payment'];
$test1 = $result_total[0]['total']-$advance;

$totalMInusRefund = $g - $price_ref_amount;
$pdf->cell(30,4,"",'L,R',0,'L');
$pdf->cell(55,4,"Refund",'R',0,'L');
$pdf->cell(25,4,"",'R',0,'L');
$pdf->cell(25,4,"",'R',0,'L');
$pdf->cell(25,4,"".number_format($price_ref_amount,2)."",'R',0,'L');
$pdf->cell(25,4,"".number_format($totalMInusRefund,2)."",'R',1,'L');

$test2 = $test1 - $price_ref_amount;
$test3 = $advance + $price_ref_amount +$card_advance;

$totalMinusCash = $totalMInusRefund - $advance;
$pdf->cell(30,4,"",'L,R',0,'L');
$pdf->cell(55,4,"Advance Payment CASH",'R',0,'L');
$pdf->cell(25,4,"",'R',0,'L');
$pdf->cell(25,4,"",'R',0,'L');
$pdf->cell(25,4,"".number_format($advance,2)."",'R',0,'L');
$pdf->cell(25,4,"".number_format($totalMinusCash,2)."",'R',1,'L');

$totalMinusCard = $totalMinusCash - $card_advance;
$pdf->cell(30,4,"",'L,R',0,'L');
$pdf->cell(55,4,"Advance Payment CARD",'R',0,'L');
$pdf->cell(25,4,"",'R',0,'L');
$pdf->cell(25,4,"",'R',0,'L');
$pdf->cell(25,4,"".number_format($card_advance,2)."",'R',0,'L');
$pdf->cell(25,4,"".number_format($totalMinusCard,2)."",'R',1,'L');





}

$pdf->cell(30,4,"",'L,B,R',0,'L');
$pdf->cell(55,4,"",'B,R',0,'L');
$pdf->cell(25,4,"",'B,R',0,'L');
$pdf->cell(25,4,"",'B,R',0,'L');
$pdf->cell(25,4,"",'B,R',0,'L');
$pdf->cell(25,4,"",'B,R',1,'L');




$pdf->cell(30,4,"",'L,B',0,'L');
$pdf->cell(55,4,"",'B',0,'L');
$pdf->cell(25,4,"Total",'B',0,'R');
$pdf->cell(25,4,"".number_format($total,2)."",1,0,'L');
$pdf->cell(25,4,"".number_format($test3,2)."",1,0,'L');
$pdf->cell(25,4,"".number_format($test2,2)."",1,1,'L');












// $pdf->cell(0,5,"",0,1,'C');

// $pdf->SetFont("Arial","",12);





// $advance = $result_room_form[0]['advance_payment'];



// $pdf->cell(0,5,"",0,1,'C');



// $pdf->cell(30,4,"",0,0,'L');

// $pdf->cell(80,4," ",0,0,'L');

// $pdf->cell(40,4,"Advance Payment ",0,'L');

// $pdf->cell(0,4,"- ".$advance."",0,1,'L');





// $pdf->cell(0,3,"",0,1,'C');

// $pdf->cell(0,2,"",'T',1,'C');





// if (!empty($result_restaurant_charge)){ 



// $pdf->cell(30,4,"",0,0,'L');

// $pdf->cell(80,4," ",0,0,'L');

// $pdf->cell(40,4,"Remaining Balance ",0,'L');

// $pdf->cell(0,4,"".$result_total[0]['total']+$restotal -$advance."",0,1,'L');



// } else { 



$pdf->cell(30,4,"",0,0,'L');

$pdf->cell(80,4," ",0,0,'L');

$pdf->cell(40,4,"Total Balance:  ",0,'L');
$test1 = $result_total[0]['total']-$advance -$price_ref_amount -$card_advance;
$pdf->cell(0,4,"".number_format($test1,2)."",0,1,'L');



  $pdf->cell(30,4,"",0,0,'L');

  $pdf->cell(80,4,"",0,0,'L');

  $pdf->cell(40,4,"Amount Paid: ",0,'L');

  $pdf->cell(0,4,"".number_format($amount_give,2)."",0,1,'L');



  $pdf->cell(30,4,"",0,0,'L');

  $pdf->cell(80,4,"",0,0,'L');

  $pdf->cell(40,4,"Change: ",0,'L');

$test2 = $amount_give-($result_total[0]['total']-$advance-$price_ref_amount);
  $pdf->cell(0,4,"".number_format($test2,2)."",0,1,'L');



// } 



  $pdf->cell(0,3,"",0,1,'C');

    $pdf->cell(0,2,"",'T',1,'C');

if (!empty($card_number)) {

  # code...



    $pdf->cell(40,4,"Card Number",0,0,'L');

  $pdf->cell(50,4,"".$card_number."",0,0,'L');

  $pdf->cell(30,4," ",0,'L');

  $pdf->cell(0,4,"",0,1,'L');

}

  // $pdf->cell(40,4,"Account Process",0,0,'L');

  // $pdf->cell(50,4,"".$account."",0,0,'L');

  // $pdf->cell(30,4," ",0,'L');

  // $pdf->cell(0,4,"",0,1,'L');










//$pdf->Image('assets/img/fides.PNG',10,150,190);






$pdf->output();





 ?>