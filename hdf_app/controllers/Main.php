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

    $this->load->view('layout/header', $data);
    $this->load->view('body/frontdesk/dashboard');
    $this->load->view('body/frontdesk/components/modal-reservation');
    $this->load->view('layout/footer');
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

    $this->load->view('layout/header', $data);
    $this->load->view('body/frontdesk/calendar');
    $this->load->view('body/frontdesk/components/modal-reservation');
    $this->load->view('layout/footer');
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
      'room_types' => $this->get_model->getRoomTypes(),
      'guests' => $this->get_model->getGuests(),
    ];

    $this->load->view('layout/header', $data);
    $this->load->view('body/frontdesk/rooms');
    $this->load->view('body/frontdesk/components/modal-reservation');
    $this->load->view('layout/footer');
  }

  function guests() {
    $data = array(
      'active' => 'guests',
      'guests_active' => $this->get_model->getGuests(),
      'guests_inactive' => $this->get_model->getGuests(1),
      'getRoomType' => $this->get_model->getRoomTypes(),
      'getRoom' => $this->get_model->getRooms()
    );
    $this->load->view('layout/header', $data);
    $this->load->view('body/frontdesk/guests');
    $this->load->view('layout/footer');
  }

  function profile() {
    $data = [
      'active' => 'account',
      'profile' => $this->get_model->getProfile()
    ];
    $this->load->view('layout/header', $data);
    $this->load->view('body/frontdesk/profile');
    $this->load->view('layout/footer');
  }

  function reservations($reservation_type) {
    $data = [
      'active' => $reservation_type,
      'getRoomType' => $this->get_model->getRoomTypes(),
      'getRoom' => $this->get_model->getRooms(),
      'guests' => $this->get_model->getGuests(),
    ];
    $data['reservations'] = $this->get_model->getReservations($reservation_type == 'walkin' ? ['Arrival/Tentative', 'Confirmed'] : ['Online']);

    $i = 0;
    foreach ($data['reservations'] as $booking) {
      $data['reservations'][$i]['rooms'] = $this->get_model->getBookedRooms($booking['booking_id']);
      $data['reservations'][$i]['payment'] = $this->get_model->getPaymentTotal($booking['booking_id']);
      $data['reservations'][$i++]['payments'] = $this->get_model->getPayment($booking['booking_id']);
    }

    $this->load->view('layout/header', $data);
    $this->load->view('body/frontdesk/reservations-' . $reservation_type);
    $this->load->view('body/frontdesk/components/modal-reservation');
    $this->load->view('layout/footer');
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

    $this->load->view('layout/header', $data);
    $this->load->view('body/frontdesk/bookings');
    $this->load->view('layout/footer');
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
    $data['payments'] = $this->get_model->getPayment($data['booking']->booking_id);
    $data['logs'] = $this->get_model->getBookingLogs($data['booking']->booking_id);

    $i = 0;
    foreach ($data['booked_rooms'] as $room) {
      $data['booked_rooms'][$i]['restaurant'] = $this->get_model->getRoomCharges($room['booked_room_id'], 'Restaurant');
      $data['booked_rooms'][$i]['coffeeshop'] = $this->get_model->getRoomCharges($room['booked_room_id'], 'Coffeeshop');
      $data['booked_rooms'][$i++]['amenities'] = $this->get_model->getRoomAmenities($room['booked_room_id']);
    }

    $room_charges = $this->get_model->getRoomChargesTotal($data['booking']->booking_id);
    $amenities = $this->get_model->getRoomAmenitiesTotal($data['booking']->booking_id);
    // $this->dd($data['logs']);
    $data['charges_total'] = $room_charges->total + $amenities->total;

    $this->load->view('layout/header', $data);
    $this->load->view('body/frontdesk/booking');
    $this->load->view('layout/footer');
  }

  function charges() {
    $data['active'] = 'charges';
    $data['categories'] = $this->get_model->getCategories();
    $data['charges'] = $this->get_model->getCharges();
    $this->load->view('layout/header', $data);
    $this->load->view('body/frontdesk/charges');
    $this->load->view('layout/footer');
  }

  // ------------------------------------------------------------------------------------------------------- //
  // ------------------------------------------------ FRANZ ------------------------------------------------ //
  // ------------------------------------------------------------------------------------------------------- //

  function updateProfile() {
    $_SESSION['name'] = $_POST['name'];
    $this->update_model->updateUser();
    $this->session->set_flashdata('success', 'Profile successfully updated');
    $this->redirect();
  }

  function uploadprofileImage() {
    $user = $this->get_model->getUser($_SESSION['user_id']);
    $name = $this->uploadImage('files', 'users');
    $old_image = 'assets/img/users/' . $user->image_source;
    $_SESSION['image'] = $name;
    $this->update_model->updateImage($name);
    $this->unlink($old_image);
    $this->session->set_flashdata('success', 'Profile picture successfully updated');
    redirect('main/profile/');
  }

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
    $name = $_POST['first_name'] . ' ' . $_POST['middle_name'] . ' ' . $_POST['last_name'];
    $log = "<b>{$_POST['booking_number']}</b> → Updated guest details";
    $this->insert_model->addBookingLog($log);
    $this->update_model->updateGuest();
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
    $this->insert_model->addPayment();
    $this->session->set_flashdata('success', 'Reservation successfully verified!');
    $this->redirect();
  }

  function updateExtras() {
    $room = $this->get_model->getBookedRoom($_POST['booked_room_id']);
    $this->update_model->updateExtras();
    $log = "<b>{$room->room_number} {$room->room_type_abbr}</b> → Updated extras: <b>{$_POST['extra_bed']} extra bed(s)</b> and <b>{$_POST['extra_person']} extra person(s)</b>";
    $this->insert_model->addBookingLog($log);
    $this->session->set_flashdata('success', 'Extra bed/person successfully updated!');
    $this->redirect();
  }

  function updateDiscount() {
    $this->update_model->updateDiscount();
    $booked_room = $this->get_model->getBookedRoom($_POST['booked_room_id']);
    $discount = $this->get_model->getDiscount($_POST['discount_id']);
    $log = "<b>{$booked_room->room_number} {$booked_room->room_type_abbr}</b> → Set room discount of <b>{$discount->percentage}% ({$discount->discount_type})</b>";
    $this->insert_model->addBookingLog($log);
    $this->session->set_flashdata('success', 'Discount successfully updated!');
    $this->redirect();
  }

  function bookRoom() {
    $this->insert_model->bookRoom();
    $room = $this->get_model->getRoom($_POST['room_id']);
    $log = "<b>{$room->room_number} {$room->room_type_abbr}</b> → Booked room for <b>{$_POST['nights']} night(s)</b> from <b>{$_POST['check_in']}</b> to <b>{$_POST['check_out']}</b>";
    $this->insert_model->addBookingLog($log);
    $this->session->set_flashdata('success', 'Room successfully added!');
    $this->redirect();
  }

  function removeRoom($booked_room_id) {
    $booked_room = $this->get_model->getBookedRoom($booked_room_id);
    $_POST['booking_id'] = $booked_room->booking_id;
    $this->delete_model->removeRoom($booked_room_id);
    $log = "<b>{$booked_room->room_number} {$booked_room->room_type_abbr}</b> → Removed room <b>{$booked_room->nights} night(s)</b> from <b>{$booked_room->check_in}</b> to <b>{$booked_room->check_out}</b>";
    $this->insert_model->addBookingLog($log);
    $this->session->set_flashdata('success', 'Room successfully removed!');
    $this->redirect();
  }

  function changeRoom() {
    $room_from = $this->get_model->getBookedRoom($_POST['booked_room_id']);
    $this->update_model->changeRoom();
    $room_to = $this->get_model->getRoom($_POST['room_id']);
    $log = "<b>{$room_to->room_number} {$room_to->room_type_abbr}</b> → Changed room from <b>{$room_from->room_type_abbr} {$room_from->room_number}</b> {$room_from->nights} night(s) {$room_from->check_in} - {$room_from->check_out} to <b>{$room_to->room_number} {$room_to->room_type_abbr}</b> {$_POST['nights']} night(s) {$_POST['check_in']} - {$_POST['check_out']}";
    $this->insert_model->addBookingLog($log);
    $this->session->set_flashdata('success', 'Room successfully changed!');
    $this->redirect();
  }

  function addCharges() {
    $booked_room = $this->get_model->getBookedRoom($_POST['booked_room_id']);
    $amount = number_format($_POST['charges_food_amount']);
    $log = "<b>{$booked_room->room_number} {$booked_room->room_type_abbr}</b> → Added <b>{$_POST['charge_type']}</b> charge: <b>Ref. {$_POST['reference']} {$_POST['particulars']} {$_POST['charges_food_quantity']}</b> pc(s) for ₱<b>{$amount}</b> each";
    $this->insert_model->addBookingLog($log);
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
    $charge = $this->get_model->getCharge($_POST['charge_id']);
    $booked_room = $this->get_model->getBookedRoom($_POST['booked_room_id']);
    $cost = number_format($charge->charge_amount);
    $log = "<b>{$booked_room->room_number} {$booked_room->room_type_abbr}</b> → Added {$_POST['charge_quantity']} {$charge->category} - {$charge->charge} amounting ₱{$cost} each";
    $this->insert_model->addBookingLog($log);
    $this->insert_model->addOtherCharges();
    $this->session->set_flashdata('success', 'Charges successfully added!');
    $this->redirect();
  }

  function addPayment() {
    $amount = number_format($_POST['amount']);
    $option = strtolower($_POST['payment_option']);
    $log = "<b>{$_POST['booking_number']}</b> → Added <b>{$option}</b> payment amounting ₱<b>{$amount}</b>";
    $this->insert_model->addBookingLog($log);
    $this->insert_model->addPayment();
    $this->session->set_flashdata('success', 'Payment successfully added!');
    $this->redirect();
  }

  function updateRefund() {
    $booking = $this->get_model->getBookingByBookingNumber($_POST['booking_number']);
    $previous = number_format($booking->refund);
    $current = number_format($_POST['refund']);
    $log = "<b>{$_POST['booking_number']}</b> → Update refund amount from ₱<b>{$previous}</b> to ₱<b>{$current}</b>";
    $this->insert_model->addBookingLog($log);
    $this->update_model->updateRefund();
    $this->session->set_flashdata('success', 'Refund successfully updated!');
    $this->redirect();
  }

  function completeOrder($booking_id, $booking_number) {
    $log = "<b>{$booking_number}</b> → Successfully completed order!";
    $_POST['booking_id'] = $booking_id;
    $this->insert_model->addBookingLog($log);
    $this->update_model->updateReservationStatus(-1, $booking_id);
    $this->session->set_flashdata('success', 'Order successfully completed!');
    $this->redirect();
  }

  function removeExtra($column, $booked_room_id) {
    $booked_room = $this->get_model->getBookedRoom($booked_room_id);
    $type = str_replace('extra_', '', $column) . '(s)';
    $extra = $column == 'extra_bed' ? $booked_room->extra_bed : $booked_room->extra_person;
    $log = "<b>{$booked_room->room_number} {$booked_room->room_type_abbr}</b> → Removed <b>{$extra} extra {$type}</b>";
    $_POST['booking_id'] = $booked_room->booking_id;
    $this->insert_model->addBookingLog($log);
    $this->update_model->removeExtra($column, $booked_room_id);
    $this->session->set_flashdata('success', 'Extra ' . str_replace('extra_', '', $column) . ' successfully removed!');
    $this->redirect();
  }

  function removeCharge($table, $charge_id) {
    $charge = $this->get_model->getChargeByTable($charge_id, $table);
    $booked_room = $this->get_model->getBookedRoom($charge->booked_room_id);
    if ($table == 'charges_food') {
      $type = strtolower($charge->charge_type);
      $amount = number_format($charge->charges_food_quantity);
      $log = "<b>{$booked_room->room_number} {$booked_room->room_type_abbr}</b> → Removed <b>{$type}</b> charge: Ref. <b>{$charge->reference} {$charge->particulars} {$charge->charges_food_quantity}</b> pc(s) for ₱<b>{$amount}</b> each";
    } else {
      $amount = number_format($charge->charge_amount);
      $log = "<b>{$booked_room->room_number} {$booked_room->room_type_abbr}</b> → Removed <b>{$charge->charge_quantity}</b> <b>{$charge->category}</b> - <b>{$charge->charge}</b> amounting ₱<b>{$amount}</b> each";
    }
    $_POST['booking_id'] = $booked_room->booking_id;
    $this->insert_model->addBookingLog($log);
    $this->delete_model->removeCharge($table, $charge_id);
    $this->session->set_flashdata('success', 'Charge successfully removed!');
    $this->redirect();
  }

  function updateOccupant() {
    $occupant = "{$_POST['guest']} / {$_POST['contact']} / {$_POST['email']}";
    $this->update_model->updateOccupant($occupant);
    $booked_room = $this->get_model->getBookedRoom($_POST['booked_room_id']);
    $log = "<b>{$booked_room->room_number} {$booked_room->room_type_abbr}</b> → Set <b>{$_POST['guest']}</b> / {$_POST['contact']} / {$_POST['email']} as occupant";
    $this->insert_model->addBookingLog($log);
    $this->session->set_flashdata('success', 'Occupant successfully updated!');
    $this->redirect();
  }

  function updateNotes() {
    $this->update_model->updateBooking();
    $booking_number = 'HDF' . str_pad($_POST['booking_id'], 5, '0', STR_PAD_LEFT);
    $log = "<b>{$booking_number}</b> → Updated notes";
    $this->insert_model->addBookingLog($log);
    $this->session->set_flashdata('success', 'Notes successfully updated!');
    $this->redirect();
  }

  function deletePayment($booking_payment_id) {
    $payment = $this->get_model->getPaymentById($booking_payment_id);
    $amount = number_format($payment->amount);
    $booking_number = 'HDF' . str_pad($payment->booking_id, 5, '0', STR_PAD_LEFT);
    $option = strtolower($payment->payment_option);
    $log = "<b>{$booking_number}</b> → Removed <b>{$option}</b> payment amounting ₱<b>{$amount}</b>";
    $_POST['booking_id'] = $payment->booking_id;
    $this->insert_model->addBookingLog($log);
    $this->delete_model->deletePayment($booking_payment_id);
    $this->session->set_flashdata('success', 'Payment successfully removed!');
    $this->redirect();
  }
}
