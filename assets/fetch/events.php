<?php
// List of events
$json = array();

// Query that retrieves events
$request = "SELECT * FROM events";

// connection to the database
try {
    $bdd = new PDO('mysql:host=localhost;dbname=jovinman_ihotelier_hoteldefides_db', 'jovinman_hdf', 'L28lZ^Gp69VQ');
} catch (Exception $e) {
    exit('Unable to connect to database.');
}
// Execute the query
$result = $bdd->query($request) or die(print_r($bdd->errorInfo()));

// sending the encoded result to success page
echo json_encode($result->fetchAll(PDO::FETCH_ASSOC));

?>
