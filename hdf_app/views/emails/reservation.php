Good day <strong><?= $first_name ?> <?= $last_name ?>!</strong><br>
<p>Your reservation details are as follow(s):</p>
Check In Date(s): <strong><?= $check_in ?></strong><br>
Check Out Date(s): <strong><?= $check_out ?></strong><br>
Number of Night(s): <strong><?= $nights ?></strong><br>
Room Type Reservation: <strong><?= $room_type ?></strong><br>
Total Price: <strong>Php <?= $price ?></strong><br>
Amount to be paid: <strong>Php <?= $amount ?></strong> / (25%)<br>
Special Request(s): <strong><?= $request ?></strong>

<p>To verify your email please click the button below:</p>
<a href='<?= $verify_url ?>'>
  <img src='https://studentclearinghouse.info/help/wp-content/uploads/2015/12/verify-now.png' height='60'>
</a>

<p>We look forward to welcoming you soon!</p>
<img src='https://booking.hoteldefides.com/assets/assets/img/hdf_logo_brown.png' height='40'>