<?php
	
  //      $conn = mysql_connect('localhost', 'root', '');
	 //  	$db   = mysql_select_db('fides');

		// $sql = "select * from room_type inner join rooms on room_type.id=rooms.room_type_id where status_by_room ='Under Cleaning'";
		// $res = mysql_query($sql);
		// $result = array();
 
		// while( $row = mysql_fetch_array($res) )
		//     array_push($result, array('room_number' => $row[6],
		// 	                          'room_type'  => $row[1],
		// 				  'status_by_room' => $row[11]));
 
		// echo json_encode(array("result" => $result));


$request = "select * from room_type inner join rooms on room_type.id=rooms.room_type_id where status_by_room ='Under Cleaning'";

// connection to the database
try {
    $bdd = new PDO('mysql:host=localhost;dbname=jrnvrjgbty', 'jrnvrjgbty', 'WHaFtk8RNV');
} catch (Exception $e) {
    exit('Unable to connect to database.');
}

$result2 = $bdd->query($request) or die(print_r($bdd->errorInfo()));
$result = array();

while($row = $result2->fetch(PDO::FETCH_ASSOC))
		    array_push($result, array('room_number' => $row['room_number'],
			                          'room_type'  => $row['room_type'],
						  'status_by_room' => $row['status_by_room']));

echo json_encode(array("result" => $result));


		
?>