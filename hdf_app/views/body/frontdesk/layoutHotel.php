<?php 

require("assets/rpdf.php");

$pdf=new RPDF();

//$pdf->AddPage("P","legal");
$pdf->AddPage("P","letter");
$pdf->SetFont("Arial","",9);

foreach ($result_room_checked as $data) {



                              $date1 = $connect_book[0]['start_date'];

                            $date2 = $connect_book[0]['end_date'];

                            $start = new DateTime($date1);

                            $end = new DateTime($date2);



                            $diff = $start->diff($end);



                            $days_ren = $diff->format('%r%a');

                             $update_price_rooms =$this->db->query('select * from room_type where id="'.$connect_book[0]['type'].'"');
                              $price_per_room_type="";
                              $room_by_type="";
                              if ($update_price_rooms->num_rows() > 0)
                              {
                                 $row = $update_price_rooms->row(); 
                                 $price_per_room_type=$row->pricing_type; 
                                 $room_by_type = $row->room_type;
                       
                              }



                              $id = $data['id_rooms'];

                              $breakfast = $data['breakfast_id'];

                              $price_room = $price_per_room_type+$breakfast;

                              $price_room_days = $price_room * $days_ren;

                              $price_person = $data['price_person'];

                              $add_person = $data['add_person'];

                              $total_person = $price_person * $add_person;





                              $price_bed = $data['price_bed'];

                              $add_bed = $data['add_bed'];

                              $total_bed = $price_bed * $add_bed;



                              $deduction = $data['name'];

                              $ded_percent = $data['price_deduct'];



                              $total_in = $total_person + $total_bed + $price_room_days; 

                              $total_percent = $total_in * ".$ded_percent";



                              $resamount = $data['restaurant_amount'];
                              $cofamount = $data['cof_amount'];

                             $total_in_all = ($total_in - $total_percent)+$cofamount+$resamount;


                             //echo $connect_book[0]['type'];

                            






                 

                                            

}

// $pdf->cell(0,5,"jjj",0,1,'C'); 192

$pdf->Image('http://booking.hoteldefides.com/assets/img/fidesform2.png',15,150,178);
$pdf->Image('http://booking.hoteldefides.com/assets/img/fidesform1.png',15,0,180);

$pdf->TextWithDirection(142,32,"".$connect_book[0]['label']."",'');

//room type and check i
$pdf->TextWithDirection(55,39.5,"".$room_by_type."",'');
$pdf->TextWithDirection(138,39.5,"".$date1."",'');

//room rate and check out
$pdf->TextWithDirection(55,45,"".$price_per_room_type."",'');
$pdf->TextWithDirection(138,45,"".$date2."",'');

//last name
$pdf->TextWithDirection(41,58,"".$result_room_form[0]['last_name']."",'');
$pdf->TextWithDirection(87,58,"".$result_room_form[0]['first_name']."",'');
$pdf->TextWithDirection(137,58,"".$result_room_form[0]['middle_name']."",'');

$pdf->TextWithDirection(57,70.5,"".$result_room_form[0]['address']."",'');

//contact No. Birthday
$pdf->TextWithDirection(57,76,"".$result_room_form[0]['contact']."",'');
$pdf->TextWithDirection(115,90,"",'');


//email and nat
$pdf->TextWithDirection(57,81,"".$result_room_form[0]['email']."",'');
$pdf->TextWithDirection(119,94.5,"",'');

//company name
$pdf->TextWithDirection(62,99,"",'');

$pdf->TextWithDirection(66,103.5,"",'');

$pdf->TextWithDirection(40,111.5,"",'');

$pdf->TextWithDirection(57,117,"",'');


$pdf->TextWithDirection(41,222,"".$date1."",'');
$pdf->TextWithDirection(116,222,"".$date2."",'');
// $pdf->Image('http://booking.hoteldefides.com/assets/img/2form.PNG',21,120,178);
// $pdf->Image('http://booking.hoteldefides.com/assets/img/1form.PNG',15,10,180);

// $pdf->Image('http://booking.hoteldefides.com/assets/img/3.PNG',16,600,178);
// $pdf->Image('http://booking.hoteldefides.com/assets/img/4.PNG',16,192,178);
// //room no
// $pdf->TextWithDirection(132,49,"".$connect_book[0]['label']."",'');

// //room type and check i
// $pdf->TextWithDirection(55,59.5,"".$room_by_type."",'');
// $pdf->TextWithDirection(125,59.5,"".$date1."",'');

// //room rate and check out
// $pdf->TextWithDirection(55,64,"".$price_per_room_type."",'');
// $pdf->TextWithDirection(125,64,"".$date2."",'');

// //last name
// $pdf->TextWithDirection(47,77.5,"".$result_room_form[0]['last_name']."                                 ".$result_room_form[0]['first_name']."                      ".$result_room_form[0]['middle_name']."",'');

// $pdf->TextWithDirection(50,85.5,"".$result_room_form[0]['address']."",'');

// //contact No. Birthday
// $pdf->TextWithDirection(55,90,"".$result_room_form[0]['contact']."",'');
// $pdf->TextWithDirection(115,90,"",'');


// //email and nat
// $pdf->TextWithDirection(47,94.5,"".$result_room_form[0]['email']."",'');
// $pdf->TextWithDirection(119,94.5,"",'');

// //company name
// $pdf->TextWithDirection(62,99,"",'');

// $pdf->TextWithDirection(66,103.5,"",'');

// $pdf->TextWithDirection(40,111.5,"",'');

// $pdf->TextWithDirection(57,117,"",'');


// $pdf->TextWithDirection(41,267.5,"".$date1."",'');
// $pdf->TextWithDirection(110,267.5,"".$date2."",'');


// $pdf->cell(0,1000,"",0,1,'C');
// $pdf->Image('http://booking.hoteldefides.com/assets/img/3.PNG',16,10,178);
// $pdf->Image('http://booking.hoteldefides.com/assets/img/4.PNG',16,192,178);
$pdf->output();



 ?>