<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Main extends MY_Controller {

  function __construct() {
    parent::__construct();
    $this->load->vars([
      'notif' => $this->get_model->frontdeskGetNotif()
    ]);
  }

  // ------------------------------------------------------------------------------------------------------- //
  // ------------------------------------------------ VIEWS ------------------------------------------------ //
  // ------------------------------------------------------------------------------------------------------- //

  function index() {
    $data = array(
      'rooms' => $this->get_model->getRoomsWithRoomType(),
      'available' => $this->get_model->getFrontDeskRooms(),
      'unavailable' => $this->get_model->getFrontDeskRooms(0),
      'room_types' => $this->get_model->getRoomTypes(),
      'guests' => $this->get_model->getGuests(),
      'active' => 'dashboard'
    );

    $this->load->view('body/frontdesk/layout/header', $data);
    $this->load->view('body/frontdesk/dashboard');
    $this->load->view('body/frontdesk/components/modal-reservation');
    $this->load->view('body/frontdesk/layout/footer');
  }

  function calendar($year, $month) {
    $this->load->library('calendar');

    $data = [
      'active' => 'calendar',
      'rooms' => $this->get_model->getRoomsWithRoomType(),
      'bookings' => $this->get_model->getBookings(),
      'days' => $this->calendar->get_total_days($month, $year),
      'month' => $this->calendar->get_month_name($month),
      'guests' => $this->get_model->getGuests(),
      'm' => str_pad($month, 2, '0', STR_PAD_LEFT),
      'y' => $year,
    ];

    $this->load->view('body/frontdesk/layout/header', $data);
    $this->load->view('body/frontdesk/calendar');
    $this->load->view('body/frontdesk/components/modal-reservation');
    $this->load->view('body/frontdesk/layout/footer');
  }

  function calendarWindow($year, $month) {
    $this->load->library('calendar');

    $data = [
      'active' => 'calendar',
      'rooms' => $this->get_model->getRoomsWithRoomType(),
      'bookings' => $this->get_model->getBookings(),
      'days' => $this->calendar->get_total_days($month, $year),
      'month' => $this->calendar->get_month_name($month),
      'next_month' => $this->calendar->get_month_name(str_pad($month + 1, 2, '0', STR_PAD_LEFT)),
      'm' => str_pad($month, 2, '0', STR_PAD_LEFT),
      'y' => $year,
    ];

    $this->load->view('body/frontdesk/calendar-window', $data);
  }

  function rooms() {
    $data = [
      'active' => 'rooms',
      'rooms' => $this->get_model->getRoomsWithRoomType(),
      'guests' => $this->get_model->getGuests(),
    ];

    $this->load->view('body/frontdesk/layout/header', $data);
    $this->load->view('body/frontdesk/rooms');
    $this->load->view('body/frontdesk/components/modal-reservation');
    $this->load->view('body/frontdesk/layout/footer');
  }

  function guests() {
    $data = array(
      'active' => 'guests',
      'guests_active' => $this->get_model->getGuests(),
      'guests_inactive' => $this->get_model->getGuests(1),
      'getRoomType' => $this->get_model->getRoomTypes(),
      'getRoom' => $this->get_model->getRoom()
    );
    $this->load->view('body/frontdesk/layout/header', $data);
    $this->load->view('body/frontdesk/guests');
    $this->load->view('body/frontdesk/layout/footer');
  }

  function profile() {
    $data = [
      'active' => 'account',
      'profile' => $this->get_model->getProfile()
    ];
    $this->load->view('body/frontdesk/layout/header', $data);
    $this->load->view('body/frontdesk/profile');
    $this->load->view('body/frontdesk/layout/footer');
  }

  function reservations($reservation_type) {
    $data = [
      'active' => $reservation_type,
      'getRoomType' => $this->get_model->getRoomTypes(),
      'getRoom' => $this->get_model->getRoom(),
      'guests' => $this->get_model->getGuests(),
    ];
    $data['reservations'] = $this->get_model->getReservations($reservation_type == 'walkin' ? ['Arrival/Tentative', 'Confirmed'] : ['Online']);
    $this->load->view('body/frontdesk/layout/header', $data);
    $this->load->view('body/frontdesk/reservations-' . $reservation_type, $data);
    $this->load->view('body/frontdesk/components/modal-reservation');
    $this->load->view('body/frontdesk/layout/footer');
  }

  function bookings() {
    $data['active'] = 'bookings';
    $data['bookings'] = $this->get_model->getBookingsByStatus();

    $i = 0;
    foreach ($data['bookings'] as $booking) {
      $data['bookings'][$i]['rooms'] = $this->get_model->getBookedRooms($booking['booking_id']);
      $data['bookings'][$i]['payment'] = $this->get_model->getPaymentTotal($booking['booking_id']);
      $data['bookings'][$i++]['payments'] = $this->get_model->getPayment($booking['booking_id']);
    }

    $this->load->view('body/frontdesk/layout/header', $data);
    $this->load->view('body/frontdesk/bookings');
    $this->load->view('body/frontdesk/layout/footer');
  }

  function booking($booking_number) {
    $data['active'] = 'bookings';
    $data['booking'] = $this->get_model->getBookingByBookingNumber($booking_number);
    $data['booked_rooms'] = $this->get_model->getBookedRooms($data['booking']->booking_id);
    $data['bed'] = $this->get_model->getPrice('Bed');
    $data['person'] = $this->get_model->getPrice('Person');
    $data['discounts'] = $this->get_model->getDiscounts();
    $data['categories'] = $this->get_model->getCategories();
    $data['charges'] = $this->get_model->getCharges();
    $data['payment'] = $this->get_model->getPaymentTotal($data['booking']->booking_id);

    $i = 0;
    foreach ($data['booked_rooms'] as $room) {
      $data['booked_rooms'][$i]['restaurant'] = $this->get_model->getRoomCharges($room['booked_room_id'], 'Restaurant');
      $data['booked_rooms'][$i]['coffeeshop'] = $this->get_model->getRoomCharges($room['booked_room_id'], 'Coffeeshop');
      $data['booked_rooms'][$i++]['amenities'] = $this->get_model->getRoomAmenities($room['booked_room_id']);
    }

    $room_charges = $this->get_model->getRoomChargesTotal($data['booking']->booking_id);
    $amenities = $this->get_model->getRoomAmenitiesTotal($data['booking']->booking_id);
    // $this->dd($room_charges);
    $data['charges_total'] = $room_charges->total + $amenities->total;

    $this->load->view('body/frontdesk/layout/header', $data);
    $this->load->view('body/frontdesk/booking');
    $this->load->view('body/frontdesk/layout/footer');
  }

  function charges() {
    $data['active'] = 'charges';
    $data['categories'] = $this->get_model->getCategories();
    $data['charges'] = $this->get_model->getCharges();
    $this->load->view('body/frontdesk/layout/header', $data);
    $this->load->view('body/frontdesk/charges');
    $this->load->view('body/frontdesk/layout/footer');
  }

  // ------------------------------------------------------------------------------------------------------- //
  // ------------------------------------------------ FRANZ ------------------------------------------------ //
  // ------------------------------------------------------------------------------------------------------- //

  function book() {
    if (!$_POST['guest_id']) {
      $_POST['guest_id'] = $this->insert_model->addGuest($_POST, TRUE);
    }
    $room = $this->get_model->getRoomById($_POST['room_id']);
    $name = $_POST['first_name'] . ' ' . $_POST['last_name'];
    $type = $_POST['booking_type'] == 'Check In' ? 'booked' : 'reserved';
    $this->insert_model->book();
    $this->insert_model->addPayment();
    $this->session->set_flashdata('success', 'Successfully ' . $type . ' ' . $name . ' in room ' . $room->room_number);
    $this->redirect();
  }

  function addGuest() {
    $guest = $this->get_model->checkGuest();

    if ($guest) {
      $name = $guest->first_name . ' ' . $guest->middle_name . ' ' . $guest->last_name;
      $this->session->set_flashdata('error', $name . ' already exist on the guest list.');
      $this->redirect();
      die;
    }

    $name = $_POST['first_name'] . ' ' . $_POST['middle_name'] . ' ' . $_POST['last_name'];
    $this->insert_model->addGuest(NULL);
    $this->session->set_flashdata('success', 'Successfully added ' . $name . ' to the guest list.');
    $this->redirect();
  }

  function updateGuest() {
    $this->update_model->updateGuest();
    $name = $_POST['first_name'] . ' ' . $_POST['middle_name'] . ' ' . $_POST['last_name'];
    $this->session->set_flashdata('success', 'Successfully updated ' . $name);
    $this->redirect();
  }

  function statusGuest($disabled, $guest_id) {
    $guest = $this->get_model->getGuest($guest_id);
    $name = $guest->first_name . ' ' . $guest->middle_name . ' ' . $guest->last_name;
    $this->update_model->statusGuest($disabled, $guest_id);
    $this->session->set_flashdata('success', 'Successfully updated status of ' . $name);
    $this->redirect();
  }

  function changePassword() {
    $user = $this->get_model->getProfile();

    if (!password_verify($_POST['old_password'], $user->password)) {
      $this->session->set_flashdata('error', 'Incorrect old password!');
      $this->redirect();
      die;
    }

    if ($_POST['password'] != $_POST['confirm_password']) {
      $this->session->set_flashdata('error', 'New password and confirm password does not match!');
      $this->redirect();
      die;
    }

    $this->session->set_flashdata('success', 'Password successfully changed.');
    $this->update_model->changePassword();
    $this->redirect();
  }

  function updateReservationStatus($reservation_status, $booking_id) {
    $this->update_model->updateReservationStatus($reservation_status, $booking_id);
    $this->session->set_flashdata('success', 'Reservation status successfully cancelled.');
    $this->redirect();
  }

  function confirm() {
    $this->update_model->updateReservationStatus(5, $_POST['booking_id']);
    $this->update_model->updateBooking();
    $this->session->set_flashdata('success', 'Reservation successfully verified!');
    $this->redirect();
  }

  function updateExtras() {
    $this->update_model->updateExtras();
    $this->session->set_flashdata('success', 'Extra bed/person successfully updated!');
    $this->redirect();
  }

  function updateDiscount() {
    $this->update_model->updateDiscount();
    $this->session->set_flashdata('success', 'Discount successfully updated!');
    $this->redirect();
  }

  function bookRoom() {
    $this->insert_model->bookRoom();
    $this->session->set_flashdata('success', 'Room successfully added!');
    $this->redirect();
  }

  function removeRoom($booked_room_id) {
    $this->delete_model->removeRoom($booked_room_id);
    $this->session->set_flashdata('success', 'Room successfully removed!');
    $this->redirect();
  }

  function changeRoom() {
    $this->update_model->changeRoom();
    $this->session->set_flashdata('success', 'Room successfully changed!');
    $this->redirect();
  }

  function addCharges() {
    $this->insert_model->addCharges();
    $this->session->set_flashdata('success', 'Charges successfully added!');
    $this->redirect();
  }

  function addCategory() {
    $this->insert_model->addCategory();
    $this->session->set_flashdata('success', 'Category successfully added!');
    $this->redirect();
  }

  function deleteCategory($category_id) {
    $this->delete_model->deleteCategory($category_id);
    $this->session->set_flashdata('success', 'Category successfully deleted!');
    $this->redirect();
  }

  function updateCategory() {
    $this->update_model->updateCategory();
    $this->session->set_flashdata('success', 'Category successfully updated!');
    $this->redirect();
  }

  function addCharge() {
    $this->insert_model->addCharge();
    $this->session->set_flashdata('success', 'Charge successfully added!');
    $this->redirect();
  }

  function deleteCharge($charge_id) {
    $this->delete_model->deleteCharge($charge_id);
    $this->session->set_flashdata('success', 'Charge successfully deleted!');
    $this->redirect();
  }

  function updateCharge() {
    $this->update_model->updateCharge();
    $this->session->set_flashdata('success', 'Charge successfully updated!');
    $this->redirect();
  }

  function addOtherCharges() {
    $this->insert_model->addOtherCharges();
    $this->session->set_flashdata('success', 'Charges successfully added!');
    $this->redirect();
  }

  function addPayment() {
    $this->insert_model->addPayment();
    $this->session->set_flashdata('success', 'Payment successfully added!');
    $this->redirect();
  }

  function updateRefund() {
    $this->update_model->updateRefund();
    $this->session->set_flashdata('success', 'Refund successfully updated!');
    $this->redirect();
  }

  function completeOrder($booking_id) {
    $this->update_model->updateReservationStatus(-1, $booking_id);
    $this->session->set_flashdata('success', 'Order successfully completed!');
    $this->redirect();
  }

  function removeExtra($column, $booked_room_id) {
    $this->update_model->removeExtra($column, $booked_room_id);
    $this->session->set_flashdata('success', 'Extra ' . str_replace('extra_', '', $column) . ' successfully removed!');
    $this->redirect();
  }

  function removeCharge($table, $booked_room_id) {
    $this->delete_model->removeCharge($table, $booked_room_id);
    $this->session->set_flashdata('success', 'Charge successfully removed!');
    $this->redirect();
  }

  function updateOccupant() {
    $occupant = "{$_POST['guest']} / {$_POST['contact']} / {$_POST['email']}";
    $this->update_model->updateOccupant($occupant);
    $this->session->set_flashdata('success', 'Occupant successfully updated!');
    $this->redirect();
  }

  function updateNotes() {
    $this->update_model->updateBooking();
    $this->session->set_flashdata('success', 'Notes successfully updated!');
    $this->redirect();
  }
}
