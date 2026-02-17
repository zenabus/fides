Good day <strong><?= $first_name ?> <?= $last_name ?>!</strong><br>

<p><strong>Your reservation has been verified!</strong></p>
<p>Your Reservation ID: <strong><?= $booking_number ?></strong></p>

<p>Your reservation details are as follow(s):</p>
Check In Date(s): <strong><?= $check_in ?></strong><br>
Check Out Date(s): <strong><?= $check_out ?></strong><br>
Number of Night(s): <strong><?= $nights ?></strong><br>
Room Type Reservation: <strong><?= $room_type ?></strong><br>
Total Price: <strong>Php <?= $price ?></strong><br>
Amount to be paid: <strong>Php <?= $amount ?></strong> / (25%)<br>
Special Request(s): <strong><?= $remarks ?></strong><br>

<p>As part of our Payment Policy, we will be collecting the amount of <strong>Php <?= $amount ?></strong> / (25%) from your total amount of <strong>Php <?= $price ?></strong> as guaranteed booking within three (3) days.</p>

<p>You can pay thru GCash or Bank Deposit with the following details:</p>

<?php foreach ($payment_details as $type => $details): ?>
  <strong>For <?= $details['label'] ?>:</strong>
  <ul>
    <li>Account Name: <strong><?= $details['name'] ?></strong></li>
    <li>Account Number: <strong><?= $details['number'] ?></strong></li>
  </ul>
<?php endforeach; ?>

<p>If payment has successfully made kindly send a copy or a screenshot in reply of this email or to our Facebook Page <strong>https://www.facebook.com/HoteldeFides/</strong>.</p>

<p>We look forward to welcoming you soon!</p>

<img src='https://booking.hoteldefides.com/assets/assets/img/hdf_logo_brown.png' height='40'>