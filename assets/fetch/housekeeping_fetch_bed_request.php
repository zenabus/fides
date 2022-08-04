<?php
	
  //      $conn = mysql_connect('localhost', 'root', '');
	 //  	$db   = mysql_select_db('fides');

		// $sql = "select * from rooms_checked where room_status ='Checked In' and add_bed <> 0 order by bed_status desc limit 100";
		// $res = mysql_query($sql);
		// $result = array();
 
		// while( $row = mysql_fetch_array($res) )
		//     array_push($result, array('room_number' => $row[1],
		// 	                          'add_bed'  => $row[4],
		// 				  'bed_status' => $row[16]));
 
		// echo json_encode(array("result" => $result));
		

$request = "select * from rooms_checked where room_status ='Checked In' and add_bed <> 0 order by bed_status desc limit 100";

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
			                          'add_bed'  => $row['add_bed'],
						  'bed_status' => $row['bed_status']));

echo json_encode(array("result" => $result));

?>