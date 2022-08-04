<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Booking extends MY_Controller {

  function index() {
    $this->load->view('booking/booking');
  }

  function book() {
    $guest = $this->get_model->checkGuest();
    $last_name = $_POST['last_name'];
    $email = $_POST['email'];
    $_POST['guest_id'] = $guest ? $guest->guest_id : $this->insert_model->addGuest($_POST, TRUE);
    $data['booking_number'] = $this->insert_model->book();
    $data['date'] = date('l, F d, Y');
    $data['from'] = $_POST['check_in'];
    $data['to'] = $_POST['check_out'];
    $data['message'] = 'Mr/Mrs. ' . $last_name . ', this is your booking number. Please enter this code to the booking website to confirm your reservation. Thank you!';
    $reservation = $this->load->view('booking/reservation', $data, TRUE);
    // $this->sendMail($email, $reservation, 'Reservation Confirmation');
    echo $data['booking_number'];
  }

  function verify($booking_number) {
    $this->update_model->verifyReservation($booking_number);
    echo TRUE;
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
      // log_message('error', 'Bookings: ' . json_encode($bookings));
      // log_message('error', '------------------------------------');
      foreach ($bookings as $booking) {

        $in = $this->toDashedDate($booking['check_in']);
        $out = $this->toDashedDate($booking['check_out']);
        // log_message('error', 'check_in: ' . $check_in);
        // log_message('error', 'check_out: ' . $check_out);
        // log_message('error', 'dates: ' . json_encode($dates));
        // log_message('error', 'in: ' . in_array($in, $dates, TRUE));
        // log_message('error', 'out: ' . in_array($out, $dates, TRUE));
        if (in_array($in, $dates, TRUE) || in_array($out, $dates, TRUE)) {
          // log_message('error', 'pushed');
          array_push($occupied, $booking['room_id']);
        }
      }
      log_message('error', 'all_rooms: ' . json_encode($all_rooms));
      log_message('error', 'occupied: ' . json_encode($occupied));
      $vacant = $this->removeDuplicate($all_rooms, $occupied);
      $room_count = $this->get_model->getRoomCountByRoomType($room_type['id']);
      $room_types[$key]['available'] =  $room_count > count($occupied) ? TRUE : FALSE;
      $room_types[$key]['room_id'] = isset($vacant[0]) ? $vacant[0] : 0;

      // log_message('error', '------------------------------------');
      log_message('error', 'vacant: ' . json_encode($vacant));
      // $this->dd($vacant);
      // log_message('error', 'booking_count: ' . $booking_count);
      // log_message('error', 'room_count: ' . $room_count);
    }

    echo json_encode($room_types);
  }
}
