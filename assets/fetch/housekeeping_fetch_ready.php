<?php
	
  //      $conn = mysqli_connect('localhost', 'root', '');
	 //  	$db   = mysqli_select_db('fides');

		// $sql = "select * from room_type inner join rooms on room_type.id=rooms.room_type_id where status_by_room ='EMPTY'";
		// $res = mysqli_query($sql);
		// $result = array();
 
		// while( $row = mysqli_fetch_array($res) )
		//     array_push($result, array('room_number' => $row[7],
		// 	                          'room_type'  => $row[1],
		// 				  'status_by_room' => $row[11]));
 
		// echo json_encode(array("result" => $result));

$request = "select * from room_type inner join rooms on room_type.id=rooms.room_type_id where status_by_room ='EMPTY'";

// connection to the database
try {
    $bdd = new PDO('mysql:host=localhost;dbname=jrnvrjgbty', 'jrnvrjgbty', 'WHaFtk8RNV');
} catch (Exception $e) {
    exit('Unable to connect to database.');
}
// Execute the query
$result2 = $bdd->query($request) or die(print_r($bdd->errorInfo()));
$result = array();

while($row = $result2->fetch(PDO::FETCH_ASSOC))
		    array_push($result, array('room_number' => $row['room_number'],
			                          'room_type'  => $row['room_type'],
						  'status_by_room' => $row['status_by_room']));

echo json_encode(array("result" => $result));
// sending the encoded result to success page
//echo json_encode($result->fetchAll(PDO::FETCH_ASSOC));


		
?>