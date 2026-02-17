<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Booking extends MY_Controller {

  function __construct() {
    parent::__construct();
    $this->load->config('payment_config');
  }

  function index() {
    $data['payment_details'] = $this->config->item('payment_details');
    $this->load->view('booking/booking', $data);
  }

  function book() {
    $guest = $this->get_model->checkGuest(TRUE);
    $email = $this->input->post('email');
    $_POST['guest_id'] = $guest ? $guest->guest_id : $this->insert_model->addGuest($this->input->post(), TRUE);
    [$booking_number] = $this->insert_model->book();

    // Prepare data for email view
    $data = [
      'first_name' => $this->input->post('first_name'),
      'last_name' => $this->input->post('last_name'),
      'check_in' => $this->input->post('check_in'),
      'check_out' => $this->input->post('check_out'),
      'nights' => $this->input->post('nights'),
      'request' => $this->input->post('request'),
      'verify_url' => base_url('index.php/booking/verify/') . $booking_number
    ];

    // Get Room Type info for the email
    $room_type = $this->get_model->getRoom($this->input->post('room_id'));
    $data['room_type'] = $room_type->room_type;
    $data['price'] = number_format($room_type->pricing_type, 2);
    $data['amount'] = number_format($room_type->pricing_type * .25, 2);

    $message = $this->load->view('emails/reservation', $data, TRUE);
    $this->sendMail($email, $message, 'Verify your reservation');

    echo $booking_number;
  }

  function verify($booking_number) {
    if (!$booking_number) show_404();

    $booking = $this->get_model->getBookingByBookingNumber($booking_number);
    if (!$booking) show_404();

    // Update Status
    $this->update_model->updateReservationStatus(3, $booking->booking_id);

    // Prepare Success Email
    $data = [
      'first_name' => $booking->first_name,
      'last_name' => $booking->last_name,
      'booking_number' => $booking->booking_number,
      'check_in' => $booking->check_in,
      'check_out' => $booking->check_out,
      'nights' => $booking->nights,
      'room_type' => $booking->room_type,
      'remarks' => $booking->remarks,
      'price' => number_format($booking->pricing_type, 2),
      'amount' => number_format($booking->pricing_type * 0.25, 2),
      'payment_details' => $this->config->item('payment_details')
    ];

    $message = $this->load->view('emails/verified', $data, TRUE);
    $this->sendMail($booking->email, $message, 'Reservation Verified');

    $this->load->view('booking/success');
  }

  function getAvailableRoomTypes($check_in, $check_out) {
    $room_types = $this->get_model->getRoomTypes(); // Keep for ordering strategy

    // Optimized: Bulk fetch
    $all_rooms_grouped = $this->get_model->getAllRoomsGrouped();
    $bookings_in_range = $this->get_model->getBookingsInRange($check_in, $check_out);

    // Map occupied room IDs
    $occupied_rooms = [];
    // Just to be safe, filter bookings that actually overlap the dates
    // (Though the model should have handled it, logic check is cheap)
    $dates = $this->getDaysInBetween($check_in, $check_out);

    foreach ($bookings_in_range as $booking) {
      // Model method getBookingsInRange already filters by date overlap logic
      $occupied_rooms[$booking['room_id']] = true;
    }

    foreach ($room_types as $key => $room_type) {
      $available = FALSE;
      $vacant_room_id = 0;

      // Check rooms for this type
      $type_rooms = isset($all_rooms_grouped[$room_type['id']]['rooms']) ? $all_rooms_grouped[$room_type['id']]['rooms'] : [];

      foreach ($type_rooms as $room) {
        if (!isset($occupied_rooms[$room['room_id']])) {
          $available = TRUE;
          $vacant_room_id = $room['room_id'];
          break; // Found one
        }
      }

      // Update result
      $room_types[$key]['available'] = $available;
      $room_types[$key]['room_id'] = $vacant_room_id;
    }

    echo json_encode($room_types);
  }
}
