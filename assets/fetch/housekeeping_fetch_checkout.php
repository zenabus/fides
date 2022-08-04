<?php
	
  //      $conn = mysql_connect('localhost', 'root', '');
	 //  	$db   = mysql_select_db('fides');

		// $sql = "select * from room_type inner join rooms on room_type.id=rooms.room_type_id where status_by_room ='Checkout'";
		// $res = mysql_query($sql);
		// $result = array();
 
		// while( $row = mysql_fetch_array($res) )
		//     array_push($result, array('room_number' => $row[6],
		// 	                          'room_type'  => $row[1],
		// 				  'status_by_room' => $row[11]));
 
		// echo json_encode(array("result" => $result));

$request = "select * ,room_types_booking.name as room_type from rooms_booking inner join room_types_booking on rooms_booking.type= room_types_booking.id inner join room_statuses on rooms_booking.status = room_statuses.id'";

// connection to the database
try {
    $bdd = new PDO('mysql:host=localhost;dbname=jrnvrjgbty', 'jrnvrjgbty', 'WHaFtk8RNV');
} catch (Exception $e) {
    exit('Unable to connect to database.');
}

$result2 = $bdd->query($request) or die(print_r($bdd->errorInfo()));
$result = array();

while($row = $result2->fetch(PDO::FETCH_ASSOC))
					if ($row['room_type'] == 'DR') {
                          $type='Deluxe';
                      }elseif ($row['room_type'] == 'SSR') {
                       $type='Seaside Suite';
                      }elseif ($row['room_type'] == 'ER') {
                        $type='Executive';
                      }elseif ($row['room_type'] == 'ESR') {
                        $type='Executive Suite';
                      }else{
                        $type='';
                      }

		    array_push($result, array('room_number' => $row['label'],
			                          'room_type'  => $type,
						  'status_by_room' => $row['name']));

echo json_encode(array("result" => $result));

		
?>