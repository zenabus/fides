<?php

define('HOST', 'localhost');
define('USER', 'root');
define('PASS', '');
define('dbName', 'jrnvrjgbty');

$conn = mysqli_connect(HOST, USER, PASS, dbName) or die("Can't Connect");


$sql = "select * from rooms_booking inner join bookings on bookings.room = rooms_booking.id";
$result = mysqli_query($conn, $sql);

while ($row = mysqli_fetch_array($result)) {
  $id = $row['id'];
  echo '<br>';
  $room_number = $row['label'];
  echo '<br>';
  $name = $row['text'];
  $status = $row['status_if_created'];
  $email = $row['email_add'];
  $contact = $row['contact_no'];

  if ($status == 'Not Created') {
    $sql_form = 'insert into check_form set last_name ="' . $name . '" , connect_booking ="' . $id . '", contact="' . $contact . '", email ="' . $email . '"';
    if ($conn->query($sql_form)) {
    }
    $sql_get_check = "select * from check_form order by id desc limit 1";
    $result_check = mysqli_query($conn, $sql_get_check);
    $row = mysqli_fetch_array($result_check);
    $id_check = $row['id'];
    $check_datemodified = $row['date_modified'];
    ///////////////////////
    ////Update 2.0
    // $get_cha = $this->db->query('select * from charges_amen where amen_to_charge="'.$check_datemodified.'" and amen_name ="Early Check In"');
    //        $amenName="";
    //        $amedId="";
    //        $amenStat = "";
    //        if ($get_cha->num_rows() > 0)
    //        {
    //           $row = $get_cha->row(); 
    //           $amenName=$row->amen_name; 
    //           $amenId= $row->amen_id;
    //           $amenStat=$row->amen_stat;

    //        }
    //            if (empty($amenName)) {
    //              if ($amenStat =='Y') {
    //                # code...
    //              }else {
    $date = new \DateTime($check_datemodified);
    $sdate = date_format($date, 'Y-m-d h:i');
    $ssdate = date_format($date, 'Y-m-d');

    $ss1 = $ssdate . " " . "10:00";
    $ss2 = $ssdate . " " . "13:00";
    if ($sdate >= $ss1 && $sdate <= $ss2) {
      $this->db->query('insert into charges_amen set amen_name="Early Check In", amen_amount="560" ,amen_qty="1", amen_to_charge="' . $id_check . '"');
      //$this->db->query('update charges_amen set amen_stat="N" where amen_id="'.$amenId.'"');
    }
    //   }

    // }
    //update 2.0

    ///roomprice
    $sql_room_price = 'select * from room_type inner join rooms on room_type.id=rooms.room_type_id where rooms.room_number="' . $room_number . '"';
    $result_room_price = mysqli_query($conn, $sql_room_price);
    $row_price = mysqli_fetch_array($result_room_price);

    $price_room = $row_price['pricing_type'];
    //end room price/

    //bed price
    $sql_bed = 'select * from room_bed';
    $result_bed = mysqli_query($conn, $sql_bed);
    $row_bed = mysqli_fetch_array($result_bed);

    $price_bed = $row_bed['bed_pricing'];
    //end bed price

    // person
    $sql_person = 'select * from room_person';
    $result_person = mysqli_query($conn, $sql_person);
    $row_person = mysqli_fetch_array($result_person);

    $price_person = $row_person['person_pricing'];

    //end person





    $sql_check = 'insert into rooms_checked set 
				    price_bed = "' . $price_bed . '",
				    price_person = "' . $price_person . '",
				    price_room = "' . $price_room . '",

				    room_number ="' . $room_number . '" ,
				    check_id ="' . $id_check . '", 
				    connect_check ="' . $id . '" ';

    if ($conn->query($sql_check)) {
    } else {
    }

    $sql_update = 'update bookings set status_if_created="Created" where id="' . $id . '" ';

    if ($conn->query($sql_update)) {
    }
  }
}
