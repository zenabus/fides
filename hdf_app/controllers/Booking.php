<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Booking extends MY_Controller {

  function index() {
    $this->load->view('booking/booking');
  }

  // ------ book franz - do not delete - book franz ------ //
  // function book() {
  //   $guest = $this->get_model->checkGuest();
  //   $last_name = $_POST['last_name'];
  //   $email = $_POST['email'];
  //   $_POST['guest_id'] = $guest ? $guest->guest_id : $this->insert_model->addGuest($_POST, TRUE);
  //   $data['booking_number'] = $this->insert_model->book();
  //   $data['date'] = date('l, F d, Y');
  //   $data['from'] = $_POST['check_in'];
  //   $data['to'] = $_POST['check_out'];
  //   $data['message'] = 'Mr/Mrs. ' . $last_name . ', this is your booking number. Please enter this code to the booking website to confirm your reservation. Thank you!';
  //   $reservation = $this->load->view('booking/reservation', $data, TRUE);
  //   // $this->sendMail($email, $reservation, 'Reservation Confirmation');
  //   echo $data['booking_number'];
  // }
  // ------ book franz - do not delete - book franz ------ //

  function book() {
    $guest = $this->get_model->checkGuest();
    $email = $_POST['email'];
    $_POST['guest_id'] = $guest ? $guest->guest_id : $this->insert_model->addGuest($_POST, TRUE);
    [$booking_number] = $this->insert_model->book();
    $message = $this->reservationMessage($_POST['guest_id'], $booking_number);
    $this->sendMail($email, $message, 'Verify your reservation');
    echo $booking_number;
  }

  function verify($booking_number) {
    $booking = $this->get_model->getBookingByBookingNumber($booking_number);
    $message = $this->successMessage($booking);
    $this->update_model->updateReservationStatus(3, $booking->booking_id);
    $this->sendMail($booking->email, $message, 'Reservation Verified');
    $this->load->view('booking/success');
  }

  function getAvailableRoomTypes($check_in, $check_out) {
    $room_types = $this->get_model->getRoomTypes();
    $dates = $this->getDaysInBetween($check_in, $check_out);

    foreach ($room_types as $key => $room_type) {
      $occupied = [];
      $all_rooms = [];
      $rooms = $this->get_model->getRoomIdsByRoomType($room_type['id']);
      foreach ($rooms as $room) {
        array_push($all_rooms, $room['room_id']);
      }

      $bookings = $this->get_model->getBookingsByRoomType($room_type['id']);
      foreach ($bookings as $booking) {
        $in = $this->toDashedDate($booking['check_in']);
        $out = $this->toDashedDate($booking['check_out']);
        if (in_array($in, $dates, TRUE) || in_array($out, $dates, TRUE)) {
          array_push($occupied, $booking['room_id']);
        }
      }
      $vacant = $this->removeDuplicate($all_rooms, $occupied);
      $room_count = $this->get_model->getRoomCountByRoomType($room_type['id']);
      $room_types[$key]['available'] =  $room_count > count($occupied) ? TRUE : FALSE;
      $room_types[$key]['room_id'] = isset($vacant[0]) ? $vacant[0] : 0;
    }

    echo json_encode($room_types);
  }

  function reservationMessage($guest_id, $booking_number) {
    $guest = $this->get_model->getGuest($guest_id);
    $check_in = $_POST['check_in'];
    $check_out = $_POST['check_out'];
    $nights = $_POST['nights'];
    $room_type = $this->get_model->getRoom($_POST['room_id']);
    $price = number_format($room_type->pricing_type, 2);
    $amount = number_format($room_type->pricing_type * .25, 2);
    $request = $_POST['request'];
    $verify_url = base_url('index.php/booking/verify/') . $booking_number;

    $message = "Good day <strong>{$guest->first_name} {$guest->last_name}!</strong><br>
      <p>Your reservation details are as follow(s):</p>
      Check In Date(s): <strong>{$check_in}</strong><br>
      Check Out Date(s): <strong>{$check_out}</strong><br>
      Number of Night(s): <strong>{$nights}</strong><br>
      Room Type Reservation: <strong>{$room_type->room_type}</strong><br>
      Total Price: <strong>Php {$price}</strong><br>
      Amount to be paid: <strong>Php {$amount}</strong> / (25%)<br>
      Special Request(s): <strong>{$request}</strong>
      <p>To verify your email please click the button below:</p>
      <a href='{$verify_url}'>
        <img src='https://studentclearinghouse.info/help/wp-content/uploads/2015/12/verify-now.png' height='60'>
      </a>
      <p>We look forward to welcoming you soon!</p>
      <img src='https://booking.hoteldefides.com/assets/assets/img/hdf_logo_brown.png' height='40'>";

    return $message;
  }

  function successMessage($booking) {
    $price = number_format($booking->pricing_type, 2);
    $minimum = number_format($booking->pricing_type * 0.25, 2);
    $message = "Good day <strong>{$booking->first_name} {$booking->last_name}!</strong><br>
      <p><strong>Your reservation has been verified!</strong></p>
      <p>Your Reservation ID: <strong>{$booking->booking_number}</strong></p>
      <p>Your reservation details are as follow(s):</p>
      Check In Date(s): <strong>{$booking->check_in}</strong><br>
      Check Out Date(s): <strong>{$booking->check_out}</strong><br>
      Number of Night(s): <strong>{$booking->nights}</strong><br>
      Room Type Reservation: <strong>{$booking->room_type}</strong><br>
      Total Price: <strong>Php {$price}</strong><br>
      Amount to be paid: <strong>Php {$minimum}</strong> / (25%)<br>
      Special Request(s): <strong>{$booking->remarks}</strong><br>
      <p>As part of our Payment Policy, we will be collecting you the amount of <strong>Php {$minimum}</strong> / (25%) from your total amount of <strong>Php {$price}</strong> as guaranteed booking within three (3) days.</p>
      <p>You can pay thru GCash or Bank Deposit with the following details:</p>
      <strong>For GCash Payment:</strong>
      <ul>
        <li>Name: <strong>Carlos Ortiz</strong></li>
        <li>Number: <strong>0946 346 0194</strong></li>
        <li>Message: <strong>Reservation Payment for **Your Reservation ID**</strong></li>
      </ul>
      <strong>For Bank Deposit:</strong>
      <ol>
        <li>Banco De Oro (BDO)</li>
        <ul>
          <li>Account Name: <strong>JACO and JULS HOTEL & RESTAURANT CORP.</strong></li>
          <li>Account Number: <strong>010588002648</strong></li>
        </ul>
        <li>Landbank</li>
        <ul>
          <li>Account Name: <strong>JACO and JULS HOTEL & RESTAURANT CORP.</strong></li>
          <li>Account Number: <strong>000182-1227-00</strong></li>
        </ul>
      </ol>

      If payment has successfully made kindly send a copy or a screenshot in reply of this email or to our Facebook Page <strong>https://www.facebook.com/HoteldeFides/</strong>.
           
      <p>We look forward to welcoming you soon!</p>

      <img src='https://booking.hoteldefides.com/assets/assets/img/hdf_logo_brown.png' height='40'>";
    return $message;
  }
}
