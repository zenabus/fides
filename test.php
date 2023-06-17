<?php
// Return current date from the remote server
$date = date('d-m-y h:i:s');
echo $date;


$datetime = new DateTime('now', new DateTimeZone($timezone));

echo "$datetime";
?>
