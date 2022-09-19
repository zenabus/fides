<?php
defined('BASEPATH') or exit('No direct script access allowed');

require 'vendor/autoload.php';

use Dompdf\Dompdf;

class Main extends MY_Controller {

  function __construct() {
    parent::__construct();
  }

  // ------------------------------------------------------------------------------------------------------- //
  // ------------------------------------------------ VIEWS ------------------------------------------------ //
  // ------------------------------------------------------------------------------------------------------- //

  function index() {
    $data['rooms'] = $this->get_model->getRoomsWithRoomType();
    $data['available'] = $this->get_model->getFrontDeskRooms();
    $data['unavailable'] = $this->get_model->getFrontDeskRooms(0);
    $data['room_types'] = $this->get_model->getRoomTypes();
    $data['guests'] = $this->get_model->getGuests();
    $data['active'] = 'dashboard';

    $this->load->view('layout/header', $data);
    $this->load->view('body/frontdesk/dashboard');
    $this->load->view('body/frontdesk/components/modal_reservation');
    $this->load->view('layout/footer');
  }

  function calendarData($year, $month) {
    $this->load->library('calendar');

    $data['active'] = 'calendar';
    $data['rooms'] = $this->get_model->getRoomsWithRoomType();
    $data['bookings'] = $this->get_model->getBookings();
    $data['days'] = $this->calendar->get_total_days($month, $year);
    $data['month'] = $this->calendar->get_month_name($month);
    $data['next_month'] = $this->calendar->get_month_name(str_pad($month + 1, 2, '0', STR_PAD_LEFT));
    $data['m'] = str_pad($month, 2, '0', STR_PAD_LEFT);
    $data['y'] = $year;
    $data['guests'] = $this->get_model->getGuests();
    foreach ($data['bookings'] as $i => $booking) {
      $data['bookings'][$i]['dates_between'] = $this->datesBetween($booking['check_in'], $booking['check_out']);
    }
    return $data;
  }

  function calendar($year, $month, $window = FALSE) {
    $data = $this->calendarData($year, $month);
    if ($window) {
      $this->load->view('body/frontdesk/calendar-window', $data);
    } else {
      $this->load->view('layout/header', $data);
      $this->load->view('body/frontdesk/calendar');
      $this->load->view('body/frontdesk/components/modal_reservation');
      $this->load->view('layout/footer');
    }
  }

  function rooms() {
    $data['active'] = 'rooms';
    $data['rooms'] = $this->get_model->getRoomsWithRoomType();
    $data['room_types'] = $this->get_model->getRoomTypes();
    $data['guests'] = $this->get_model->getGuests();
    $data['statuses'] = $this->get_model->getRoomStatuses();

    $this->load->view('layout/header', $data);
    $this->load->view('body/frontdesk/rooms');
    $this->load->view('body/frontdesk/components/modal_reservation');
    $this->load->view('layout/footer');
  }

  function guests() {
    $data['active'] = 'guests';
    $data['guests_active'] = $this->get_model->getGuests();
    $data['guests_inactive'] = $this->get_model->getGuests(1);
    $data['getRoomType'] = $this->get_model->getRoomTypes();
    $data['getRoom'] = $this->get_model->getRooms();

    foreach ($data['guests_active'] as $i => $guest) {
      $data['guests_active'][$i]['last_checkin_ago'] = $this->timeAgo($guest['last_checkin']);
    }

    foreach ($data['guests_inactive'] as $i => $guest) {
      $data['guests_inactive'][$i]['last_checkin_ago'] = $this->timeAgo($guest['last_checkin']);
    }

    $this->load->view('layout/header', $data);
    $this->load->view('body/frontdesk/guests');
    $this->load->view('layout/footer');
  }

  function guest($guest_id) {
    $data['active'] = 'guests';
    $data['guest'] = $this->get_model->getGuest($guest_id);
    $data['bookings'] = $this->get_model->getBookingsByGuest($guest_id, [0, -1, 6]);
    $data['reservations'] = $this->get_model->getBookingsByGuest($guest_id, [1, 2, 3]);

    foreach ($data['bookings'] as $i => $booking) {
      $data['bookings'][$i]['rooms'] = $this->get_model->getBookedRooms($booking['booking_id']);
      $data['bookings'][$i]['payment'] = $this->get_model->getPaymentTotal($booking['booking_id']);
      $data['bookings'][$i]['payments'] = $this->get_model->getPayments($booking['booking_id']);
    }
    foreach ($data['reservations'] as $i => $booking) {
      $data['reservations'][$i]['rooms'] = $this->get_model->getBookedRooms($booking['booking_id']);
      $data['reservations'][$i]['payment'] = $this->get_model->getPaymentTotal($booking['booking_id']);
      $data['reservations'][$i]['payments'] = $this->get_model->getPayments($booking['booking_id']);
    }
    $this->load->view('layout/header', $data);
    $this->load->view('body/frontdesk/guest');
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

  function checkout() {
    $data['active'] = 'checkout';
    $data['checkouts'] = $this->get_model->getCheckouts();
    $data['bed'] = $this->get_model->getPrice('Bed');
    $data['person'] = $this->get_model->getPrice('Person');
    $data['statuses'] = $this->get_model->getRoomStatuses();

    foreach ($data['checkouts'] as $i => $row) {
      $data['checkouts'][$i]['restaurant'] = $this->get_model->getRoomCharges($row['booked_room_id'], 'Restaurant');
      $data['checkouts'][$i]['coffeeshop'] = $this->get_model->getRoomCharges($row['booked_room_id'], 'Coffeeshop');
      $data['checkouts'][$i]['amenities'] = $this->get_model->getRoomAmenities($row['booked_room_id']);
    }

    $this->load->view('layout/header', $data);
    $this->load->view('body/frontdesk/checkout');
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

    foreach ($data['reservations'] as $i => $booking) {
      $data['reservations'][$i]['rooms'] = $this->get_model->getBookedRooms($booking['booking_id']);
      $data['reservations'][$i]['payment'] = $this->get_model->getPaymentTotal($booking['booking_id']);
      $data['reservations'][$i]['payments'] = $this->get_model->getPayments($booking['booking_id']);
    }

    $this->load->view('layout/header', $data);
    $this->load->view('body/frontdesk/reservations-' . $reservation_type);
    $this->load->view('body/frontdesk/components/modal_reservation');
    $this->load->view('layout/footer');
  }

  function bookings() {
    $data['active'] = 'bookings';
    $data['bookings'] = $this->get_model->getBookingsByStatus([0, -1, 6]);

    foreach ($data['bookings'] as $i => $booking) {
      $data['bookings'][$i]['rooms'] = $this->get_model->getBookedRooms($booking['booking_id']);
      $data['bookings'][$i]['payment'] = $this->get_model->getPaymentTotal($booking['booking_id']);
      $data['bookings'][$i]['payments'] = $this->get_model->getPayments($booking['booking_id']);
      $data['bookings'][$i]['refund'] = $this->get_model->getRefundTotal($booking['booking_id']);
      $data['bookings'][$i]['refunds'] = $this->get_model->getRefunds($booking['booking_id']);
    }

    $this->load->view('layout/header', $data);
    $this->load->view('body/frontdesk/bookings');
    $this->load->view('layout/footer');
  }

  function booking($booking_number) {
    $data['active'] = 'bookings';
    $data['booking'] = $this->get_model->getBookingByBookingNumber($booking_number);
    $data['booked_rooms'] = $this->get_model->getBookedRooms($data['booking']->booking_id);
    $data['archived_rooms'] = $this->get_model->getBookedRooms($data['booking']->booking_id, 1);
    $data['checkout_rooms'] = $this->get_model->getBookedRooms($data['booking']->booking_id, 2);
    $data['bed'] = $this->get_model->getPrice('Bed');
    $data['person'] = $this->get_model->getPrice('Person');
    $data['discounts'] = $this->get_model->getDiscounts();
    $data['categories'] = $this->get_model->getCategories();
    $data['charges'] = $this->get_model->getCharges();
    $data['refund'] = $this->get_model->getRefundTotal($data['booking']->booking_id);
    $data['refunds'] = $this->get_model->getRefunds($data['booking']->booking_id);
    $data['payment'] = $this->get_model->getPaymentTotal($data['booking']->booking_id);
    $data['payments'] = $this->get_model->getPayments($data['booking']->booking_id);
    $data['logs'] = $this->get_model->getBookingLogs($data['booking']->booking_id);
    foreach ($data['logs'] as $i => $log) {
      $data['logs'][$i]['ago'] = $this->timeAgo($log['booking_log_added']);
    }

    foreach ($data['booked_rooms'] as $i => $room) {
      $data['booked_rooms'][$i]['restaurant'] = $this->get_model->getRoomCharges($room['booked_room_id'], 'Restaurant');
      $data['booked_rooms'][$i]['coffeeshop'] = $this->get_model->getRoomCharges($room['booked_room_id'], 'Coffeeshop');
      $data['booked_rooms'][$i]['amenities'] = $this->get_model->getRoomAmenities($room['booked_room_id']);
      $data['booked_rooms'][$i]['payment_room'] = $this->get_model->getPaymentByType($room['booked_room_id'], 'room');
      $data['booked_rooms'][$i]['payment_restaurant'] = $this->get_model->getPaymentByType($room['booked_room_id'], 'restaurant');
      $data['booked_rooms'][$i]['payment_coffeeshop'] = $this->get_model->getPaymentByType($room['booked_room_id'], 'coffeeshop');
      $data['booked_rooms'][$i]['payment_addons'] = $this->get_model->getPaymentByType($room['booked_room_id'], 'addons');
      $data['booked_rooms'][$i]['payment'] = $this->get_model->getPaymentByBookedRoom($room['booked_room_id']);
      $data['booked_rooms'][$i]['refund'] = $this->get_model->getRefundByBookedRoom($room['booked_room_id']);
    }

    $room_charges = $this->get_model->getRoomChargesTotal($data['booking']->booking_id);
    $amenities = $this->get_model->getRoomAmenitiesTotal($data['booking']->booking_id);
    $data['charges_total'] = $room_charges->total + $amenities->total;

    $this->load->view('layout/header', $data);
    $this->load->view('body/frontdesk/booking');
    $this->load->view('layout/footer');
  }

  function logs() {
    $data['active'] = 'logs';
    $data['logs'] = $this->get_model->getLogs();
    foreach ($data['logs'] as $i => $log) {
      $data['logs'][$i]['ago'] = $this->timeAgo($log['date_entered']);
    }
    $this->load->view('layout/header', $data);
    $this->load->view('body/frontdesk/logs');
    $this->load->view('layout/footer');
  }

  function user($user_id) {
    $data['active'] = 'users';
    $data['user'] = $this->get_model->getUser($user_id);
    $data['logs'] = $this->get_model->getLogsByUser($user_id);
    foreach ($data['logs'] as $i => $log) {
      $data['logs'][$i]['ago'] = $this->timeAgo($log['date_entered']);
    }
    $this->load->view('layout/header', $data);
    $this->load->view('body/frontdesk/user');
    $this->load->view('layout/footer');
  }

  function registration($booking_id) {
    $image = file_get_contents(base_url('assets/img/registration_form_letter.jpg'));
    $data['image'] = 'data:image/jpg;base64,' . base64_encode($image);
    $data['booking'] = $this->get_model->getBooking($booking_id);
    $data['booked_rooms'] = $this->get_model->getBookedRooms($booking_id);
    $view = $this->load->view('body/frontdesk/components/registration_form', $data, TRUE);
    $dompdf = new Dompdf();
    $dompdf->set_option('dpi', 300);
    $dompdf->loadHtml($view);
    $dompdf->render();
    if (isset($data['booking']->middle_name[0])) {
      $middle = $data['booking']->middle_name[0];
    } else {
      $middle = '';
    }
    $name = $data['booking']->first_name[0] . $middle . $data['booking']->last_name[0];
    $dompdf->stream($data['booking']->booking_number . ' - ' . $name . ' - Guest Registration Form', ['Attachment' => FALSE]);
  }

  function receipt($booking_id, $room = FALSE) {
    $image = file_get_contents(base_url('assets/img/acknowledgement_receipt.jpg'));
    $data['bed'] = $this->get_model->getPrice('Bed');
    $data['person'] = $this->get_model->getPrice('Person');
    $data['image'] = 'data:image/jpg;base64,' . base64_encode($image);
    $data['booking'] = $this->get_model->getBooking($booking_id);
    $data['booked_rooms'] = $this->get_model->getBookedRooms($data['booking']->booking_id);
    $data['refund'] = $this->get_model->getRefundTotal($data['booking']->booking_id);
    $data['payment'] = $this->get_model->getPaymentTotal($data['booking']->booking_id);
    $room_charges = $this->get_model->getRoomChargesTotal($data['booking']->booking_id);
    $amenities = $this->get_model->getRoomAmenitiesTotal($data['booking']->booking_id);
    $data['charges_total'] = $room_charges->total + $amenities->total;

    foreach ($data['booked_rooms'] as $i => $room) {
      $data['booked_rooms'][$i]['restaurant'] = $this->get_model->getRoomCharges($room['booked_room_id'], 'Restaurant');
      $data['booked_rooms'][$i]['coffeeshop'] = $this->get_model->getRoomCharges($room['booked_room_id'], 'Coffeeshop');
      $data['booked_rooms'][$i]['amenities'] = $this->get_model->getRoomAmenities($room['booked_room_id']);
    }

    $view = $this->load->view('body/frontdesk/components/receipt', $data, TRUE);
    $dompdf = new Dompdf();
    $dompdf->set_option('dpi', 300);
    $dompdf->loadHtml($view);
    $dompdf->render();
    if (isset($data['booking']->middle_name[0])) {
      $middle = $data['booking']->middle_name[0];
    } else {
      $middle = '';
    }
    $name = $data['booking']->first_name[0] . $middle . $data['booking']->last_name[0];
    $dompdf->stream($data['booking']->booking_number . ' - ' . $name . ' - Acknowledgment Receipt', ['Attachment' => FALSE]);
  }

  function soa($booked_room_id) {
    $image = file_get_contents(base_url('assets/img/acknowledgement_receipt.jpg'));
    $data['bed'] = $this->get_model->getPrice('Bed');
    $data['person'] = $this->get_model->getPrice('Person');
    $data['image'] = 'data:image/jpg;base64,' . base64_encode($image);
    $data['booking'] = $this->get_model->getBookingByBookedRoom($booked_room_id);
    $data['booked_rooms'] = $this->get_model->getBookedRoomById($booked_room_id);
    $data['refund'] = $this->get_model->getRefundByBookedRoom($booked_room_id);
    $data['payment'] = $this->get_model->getPaymentByBookedRoom($booked_room_id);
    $room_charges = $this->get_model->getRoomChargesByRoomId($booked_room_id);
    $amenities = $this->get_model->getRoomAmenitiesByRoomId($booked_room_id);
    $data['charges_total'] = $room_charges->total + $amenities->total;

    foreach ($data['booked_rooms'] as $i => $booked_room) {
      $data['booked_rooms'][$i]['restaurant'] = $this->get_model->getRoomCharges($booked_room_id, 'Restaurant');
      $data['booked_rooms'][$i]['coffeeshop'] = $this->get_model->getRoomCharges($booked_room_id, 'Coffeeshop');
      $data['booked_rooms'][$i]['amenities'] = $this->get_model->getRoomAmenities($booked_room_id);
    }

    $view = $this->load->view('body/frontdesk/components/receipt', $data, TRUE);
    $dompdf = new Dompdf();
    $dompdf->set_option('dpi', 300);
    $dompdf->loadHtml($view);
    $dompdf->render();
    if (isset($data['booking']->middle_name[0])) {
      $middle = $data['booking']->middle_name[0];
    } else {
      $middle = '';
    }
    // $name = $data['booking']->first_name[0] . $middle . $data['booking']->last_name[0];
    $name = 'as';
    $dompdf->stream($data['booked_rooms'][0]['booking_id'] . ' - ' . $name . ' - Statement of Account', ['Attachment' => FALSE]);
  }

  // ------------------------------------------------------------------------------------------------------- //
  // ------------------------------------------------ FRANZ ------------------------------------------------ //
  // ------------------------------------------------------------------------------------------------------- //

  function updateProfile() {
    $_SESSION['name'] = $_POST['name'];
    $this->update_model->updateProfile();
    $this->insert_model->log('Updated his/her profile', 1);
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
    $this->insert_model->log('Updated his/her profile picture', 1);
    $this->session->set_flashdata('success', 'Profile picture successfully updated');
    redirect('main/profile/');
  }

  function book() {
    $booking_id = $_POST['booking_id'];
    unset($_POST['booking_id']);
    if (!$_POST['guest_id']) {
      $_POST['guest_id'] = $this->insert_model->addGuest($_POST, TRUE);
    }
    $room = $this->get_model->getRoom($_POST['room_id']);
    $name = $_POST['first_name'] . ' ' . $_POST['last_name'];
    $type = $_POST['booking_type'] == 'Check In' ? 'booked' : 'reserved';
    [$booking_number, $booked_room_id] = $this->insert_model->book();
    $log = ucfirst("{$type} {$name} in room {$room->room_number}");
    $this->insert_model->log($log);
    $this->insert_model->addBookingLog($log);
    $this->update_model->updateCheckIn($_POST['guest_id']);
    $this->session->set_flashdata('success', "Successfully {$type} {$name} in room {$room->room_number}");

    // $booked_room = $this->get_model->getBookedRoom($booking_id);
    if ($_POST['check_in'] == date('m/d/Y')) {
      log_message('error', $booked_room_id);
      $this->earlyCheckIn($booked_room_id);
    }

    if ($_POST['booking_type'] == 'Check In') {
      redirect(base_url('index.php/main/booking/' . $booking_number));
    } else {
      $this->redirect();
    }
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
    $this->insert_model->log('Added new guest, ' . $name, 2);
    $this->session->set_flashdata('success', 'Successfully added ' . $name . ' to the guest list.');
    $this->redirect();
  }

  function updateGuest() {
    $name = $_POST['first_name'] . ' ' . $_POST['middle_name'] . ' ' . $_POST['last_name'];
    if (isset($_POST['booking_number'])) {
      $log = "<b>{$_POST['booking_number']}</b> → Updated guest details";
      $this->insert_model->addBookingLog($log);
    } else {
      $log = "Updated guest details of " . $name;
    }
    $this->insert_model->log($log);
    $this->update_model->updateGuest();
    $this->session->set_flashdata('success', 'Successfully updated ' . $name);
    $this->redirect();
  }

  function statusGuest($disabled, $guest_id) {
    $guest = $this->get_model->getGuest($guest_id);
    $name = $guest->first_name . ' ' . $guest->middle_name . ' ' . $guest->last_name;
    $this->update_model->statusGuest($disabled, $guest_id);
    $this->insert_model->log('Updated status of ' . $name, 3);
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

    $this->insert_model->log('Changed his/her password', 1);
    $this->session->set_flashdata('success', 'Password successfully changed.');
    $this->update_model->changePassword();
    $this->redirect();
  }

  function updateReservation() {
    unset($_POST['action']);
    unset($_POST['rdo_booking_type']);
    unset($_POST['booking_type']);
    [$arrival, $departure] = $this->getMinMax($_POST['booking_id']);
    $this->update_model->updateBookedRoomNights();
    $this->update_model->updateBooking($arrival, $departure, $_POST['booked_room_id']);
    unset($_POST['check_in']);
    unset($_POST['check_out']);
    unset($_POST['nights']);
    unset($_POST['room_id']);
    $name = "{$_POST['first_name']} {$_POST['middle_name']} {$_POST['last_name']} {$_POST['suffix']}";
    $this->update_model->updateReservation();
    unset($_POST['request']);
    unset($_POST['remarks']);
    unset($_POST['reservation_type']);
    $this->update_model->updateGuest();
    $this->insert_model->log("Updated reservation details of <b> {$name}", 4);
    $this->session->set_flashdata('success', 'Reservation successfully updated.');
    $this->redirect();
  }

  function earlyCheckIn($booked_room_id) {
    if (date('H') >= 6 && date('H') <= 11) {
      log_message('error', $booked_room_id);
      $this->insert_model->addEarlyCheckin($booked_room_id);
    }
  }

  function checkIn($booking_id = NULL) {
    if (!$booking_id) {
      $booking_id = $_POST['booking_id'];
    }
    $booked_room = $this->get_model->getBookedRoom($booking_id);
    if ($_POST['check_in'] == date('m/d/Y')) {
      $this->earlyCheckIn($booked_room->booked_room_id);
    }
    $this->update_model->updateBookedRoomNights();
    $booking_number = 'HDF' . str_pad($booking_id, 5, '0', STR_PAD_LEFT);
    $log = "<b>{$booking_number}</b> → Successfully checked in!";
    $_POST['booking_id'] = $booking_id;
    $this->update_model->updateReservationStatus(0, $booking_id);
    $this->insert_model->log('Checked in a reservation: #' . $booking_number);
    $this->insert_model->addBookingLog($log);
    $this->session->set_flashdata('success', 'Reservation successfully checked in.');
    redirect(base_url('index.php/main/booking/' . $booking_number));
  }

  function cancelReservation($booking_id = NULL) {
    if (!$booking_id) {
      $booking_id = $_POST['booking_id'];
      $this->update_model->updateReason();
    }
    if (isset($_POST['type'])) {
      $type = 'booking';
      $reservation_status = 6;
    } else {
      $type = 'reservation';
      $reservation_status = 4;
    }
    $this->update_model->updateReservationStatus($reservation_status, $booking_id);
    $booking_number = 'HDF' . str_pad($booking_id, 5, '0', STR_PAD_LEFT);
    $log = "<b>{$booking_number}</b> → Cancelled a {$type}!";
    $this->insert_model->addBookingLog($log);
    $this->insert_model->log("Cancelled a {$type}: #" . $booking_number, 4);
    $this->session->set_flashdata('success', $type . ' successfully cancelled.');
    $this->redirect();
  }

  function confirm() {
    $this->update_model->updateReservationStatus(5, $_POST['booking_id']);
    $this->insert_model->addPayment();
    $booking_number = 'HDF' . str_pad($_POST['booking_id'], 5, '0', STR_PAD_LEFT);
    $this->insert_model->log('Verified a reservation: #' . $booking_number, 4);
    $this->session->set_flashdata('success', 'Reservation successfully verified!');
    $this->redirect();
  }

  function updateExtras() {
    $room = $this->get_model->getBookedRoom($_POST['booked_room_id']);
    $this->update_model->updateExtras();
    $beds = $_POST['extra_bed'] == 1 ? '' : 's';
    $persons = $_POST['extra_person'] == 1 ? '' : 's';
    $log = "<b>{$room->room_number} {$room->room_type_abbr}</b> → Updated extras: <b>{$_POST['extra_bed']} extra bed{$beds}</b> and <b>{$_POST['extra_person']} extra person{$persons}</b>";
    $this->insert_model->addBookingLog($log);
    $this->insert_model->log($log);
    $this->session->set_flashdata('success', 'Extra bed/person successfully updated!');
    $this->redirect();
  }

  function updateDiscount() {
    $this->update_model->updateDiscount();
    $booked_room = $this->get_model->getBookedRoom($_POST['booked_room_id']);
    $discount = $this->get_model->getDiscount($_POST['discount_id']);
    $log = "<b>{$booked_room->room_number} {$booked_room->room_type_abbr}</b> → Set room discount of <b>{$discount->percentage}% ({$discount->discount_type})</b>";
    $this->insert_model->addBookingLog($log);
    $this->insert_model->log($log);
    $this->session->set_flashdata('success', 'Discount successfully updated!');
    $this->redirect();
  }

  function bookRoom() {
    $this->insert_model->bookRoom();
    $room = $this->get_model->getRoom($_POST['room_id']);
    $s = $_POST['nights'] == 1 ? '' : 's';
    $log = "<b>{$room->room_number} {$room->room_type_abbr}</b> → Booked room for <b>{$_POST['nights']} night{$s}</b> from <b>{$_POST['check_in']}</b> to <b>{$_POST['check_out']}</b>";
    [$arrival, $departure] = $this->getMinMax($_POST['booking_id']);
    $this->insert_model->addBookingLog($log);
    $this->insert_model->log($log);
    $this->update_model->updateBooking($arrival, $departure, $_POST['booking_id']);
    $this->session->set_flashdata('success', 'Room successfully added!');
    $this->redirect();
  }

  function removeRoom() {
    $booked_room_id = $_POST['booked_room_id'];
    $booked_room = $this->get_model->getBookedRoom($booked_room_id);
    [$arrival, $departure] = $this->getMinMax($booked_room->booking_id);
    $_POST['booking_id'] = $booked_room->booking_id;
    $this->update_model->processRoom($booked_room_id, 1);
    $s = $booked_room->nights == 1 ? '' : 's';
    $log = "<b>{$booked_room->room_number} {$booked_room->room_type_abbr}</b> → Removed room <b>{$booked_room->nights} night{$s}</b> from <b>{$booked_room->check_in}</b> to <b>{$booked_room->check_out}</b>";
    $this->insert_model->addBookingLog($log);
    $this->insert_model->log($log);
    $this->update_model->updateBooking($arrival, $departure, $booked_room->booking_id);
    $this->session->set_flashdata('success', 'Room successfully removed!');
    $this->redirect();
  }

  function checkoutRoom() {
    $booked_room_id = $_POST['booked_room_id'];
    $booked_room = $this->get_model->getBookedRoom($booked_room_id);
    [$arrival, $departure] = $this->getMinMax($booked_room->booking_id);
    $_POST['booking_id'] = $booked_room->booking_id;
    $this->update_model->processRoom($booked_room_id, 2);
    $s = $booked_room->nights == 1 ? '' : 's';
    $log = "<b>{$booked_room->room_number} {$booked_room->room_type_abbr}</b> → Checked out room <b>{$booked_room->nights} night{$s}</b> from <b>{$booked_room->check_in}</b> to <b>{$booked_room->check_out}</b>";
    $this->insert_model->addBookingLog($log);
    $this->insert_model->log($log);
    $this->update_model->updateBooking($arrival, $departure, $booked_room->booking_id);
    $this->session->set_flashdata('success', 'Room successfully checked out!');
    $this->redirect();
  }

  function getMinMax($booking_id) {
    $check_ins = [];
    $check_outs = [];
    $dates = $this->get_model->getDates($booking_id);
    foreach ($dates as $date) {
      array_push($check_ins, $this->toDashedDate($date['check_in']));
      array_push($check_outs, $this->toDashedDate($date['check_out']));
    }
    return [$this->toSlashedDate(min($check_ins)), $this->toSlashedDate(max($check_outs))];
  }

  function changeRoom() {
    $room_from = $this->get_model->getBookedRoom($_POST['booked_room_id']);
    $this->update_model->changeRoom();
    [$arrival, $departure] = $this->getMinMax($_POST['booking_id']);
    $room_to = $this->get_model->getRoom($_POST['room_id']);
    $s1 = $room_from->nights == 1 ? '' : 's';
    $s2 = $_POST['nights'] == 1 ? '' : 's';
    $log = "<b>{$room_to->room_number} {$room_to->room_type_abbr}</b> → Changed room from <b>{$room_from->room_type_abbr} {$room_from->room_number}</b> {$room_from->nights} night{$s1} {$room_from->check_in} - {$room_from->check_out} to <b>{$room_to->room_number} {$room_to->room_type_abbr}</b> {$_POST['nights']} night{$s2} {$_POST['check_in']} - {$_POST['check_out']}";
    $this->insert_model->addBookingLog($log);
    $this->insert_model->log($log);
    $this->update_model->updateBooking($arrival, $departure, $_POST['booked_room_id']);
    $this->session->set_flashdata('success', 'Room successfully changed!');
    $this->redirect();
  }

  function addCharges() {
    $booked_room = $this->get_model->getBookedRoom($_POST['booked_room_id']);
    $amount = number_format($_POST['charges_food_amount']);
    $s = $_POST['charges_food_quantity'] == 1 ? '' : 's';
    $log = "<b>{$booked_room->room_number} {$booked_room->room_type_abbr}</b> → Added <b>{$_POST['charge_type']}</b> charge: <b>Ref. {$_POST['reference']} {$_POST['particulars']} {$_POST['charges_food_quantity']}</b> pc{$s} for ₱<b>{$amount}</b> each";
    $this->insert_model->addBookingLog($log);
    $this->insert_model->log($log);
    $this->insert_model->addCharges();
    $this->session->set_flashdata('success', 'Charges successfully added!');
    $this->redirect();
  }

  function addOtherCharges() {
    $charge = $this->get_model->getCharge($_POST['charge_id']);
    $booked_room = $this->get_model->getBookedRoom($_POST['booked_room_id']);
    $cost = number_format($charge->charge_amount);
    $log = "<b>{$booked_room->room_number} {$booked_room->room_type_abbr}</b> → Added {$_POST['charge_quantity']} {$charge->category} - {$charge->charge} amounting ₱{$cost} each";
    $this->insert_model->addBookingLog($log);
    $this->insert_model->log($log);
    $this->insert_model->addOtherCharges();
    $this->session->set_flashdata('success', 'Charges successfully added!');
    $this->redirect();
  }

  function addPayment() {
    $room = $this->get_model->getBookedRoomById($_POST['booked_room_id']);
    $room = $room[0]['room_number'] . ' ' . $room[0]['room_type_abbr'];
    $amount = number_format($_POST['amount']);
    $option = strtolower($_POST['payment_option']);
    $log = "<b>{$_POST['booking_number']}</b> → Added <b>{$_POST['payment_for']}</b> payment to <b>{$room}</b> using <b>{$option}</b> amounting ₱<b>{$amount}</b>";
    $this->insert_model->addBookingLog($log);
    $this->insert_model->log($log);
    $this->insert_model->addPayment();
    $this->session->set_flashdata('success', 'Payment successfully added!');
    $this->redirect();
  }

  function addRefund() {
    $room = $this->get_model->getBookedRoomById($_POST['booked_room_id']);
    $room = $room[0]['room_number'] . ' ' . $room[0]['room_type_abbr'];
    $refund = number_format($_POST['booking_refund']);
    $log = "<b>{$_POST['booking_number']}</b> → Added refund amount of ₱<b>{$refund}</b> to <b>{$room}</b> with a reason of <b>{$_POST['booking_refund_reason']}</b>";
    $this->insert_model->addBookingLog($log);
    $this->insert_model->log($log);
    $this->insert_model->addRefund();
    $this->session->set_flashdata('success', 'Refund successfully added!');
    $this->redirect();
  }

  function completeOrder($booking_id, $booking_number) {
    $log = "<b>{$booking_number}</b> → Successfully completed order!";
    $_POST['booking_id'] = $booking_id;
    $this->insert_model->addBookingLog($log);
    $this->insert_model->log($log);
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
    $this->insert_model->log($log);
    $this->update_model->removeExtra($column, $booked_room_id);
    $this->session->set_flashdata('success', 'Extra ' . str_replace('extra_', '', $column) . ' successfully removed!');
    $this->redirect();
  }

  function removeCharge($table, $charge_id) {
    $charge = $this->get_model->getChargeByTable($charge_id, $table);
    $booked_room = $this->get_model->getBookedRoom($charge->booked_room_id);
    if ($table == 'charges_food') {
      $type = strtolower($charge->charge_type);
      $amount = number_format($charge->charges_food_amount);
      $s = $charge->charges_food_quantity == 1 ? '' : 's';
      $log = "<b>{$booked_room->room_number} {$booked_room->room_type_abbr}</b> → Removed <b>{$type}</b> charge: Ref. <b>{$charge->reference} {$charge->particulars} {$charge->charges_food_quantity}</b> pc{$s} for ₱<b>{$amount}</b> each";
    } else {
      $amount = number_format($charge->charge_amount);
      $log = "<b>{$booked_room->room_number} {$booked_room->room_type_abbr}</b> → Removed <b>{$charge->charge_quantity}</b> <b>{$charge->category}</b> - <b>{$charge->charge}</b> amounting ₱<b>{$amount}</b> each";
    }
    $_POST['booking_id'] = $booked_room->booking_id;
    $this->insert_model->addBookingLog($log);
    $this->insert_model->log($log);
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
    $this->insert_model->log($log);
    $this->session->set_flashdata('success', 'Occupant successfully updated!');
    $this->redirect();
  }

  function updateNotes() {
    $this->update_model->updateNotes();
    $booking_number = 'HDF' . str_pad($_POST['booking_id'], 5, '0', STR_PAD_LEFT);
    $log = "<b>{$booking_number}</b> → Updated notes to <b>{$_POST['remarks']}</b>";
    $this->insert_model->addBookingLog($log);
    $this->insert_model->log($log);
    $this->session->set_flashdata('success', 'Notes successfully updated!');
    $this->redirect();
  }

  function updateRequest() {
    $this->update_model->updateRequest();
    $booking_number = 'HDF' . str_pad($_POST['booking_id'], 5, '0', STR_PAD_LEFT);
    $log = "<b>{$booking_number}</b> → Updated special request(s) to <b>{$_POST['request']}</b>";
    $this->insert_model->addBookingLog($log);
    $this->insert_model->log($log);
    $this->session->set_flashdata('success', 'Special Request(s) / allergence  successfully updated!');
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
    $this->insert_model->log($log);
    $this->delete_model->deletePayment($booking_payment_id);
    $this->session->set_flashdata('success', 'Payment successfully removed!');
    $this->redirect();
  }

  function deleteRefund($booking_refund_id) {
    $refund = $this->get_model->getRefundById($booking_refund_id);
    $amount = number_format($refund->booking_refund);
    $booking_number = 'HDF' . str_pad($refund->booking_id, 5, '0', STR_PAD_LEFT);
    $option = strtolower($refund->payment_option);
    $log = "<b>{$booking_number}</b> → Removed <b>{$option}</b> payment amounting ₱<b>{$amount}</b>";
    $_POST['booking_id'] = $refund->booking_id;
    $this->insert_model->addBookingLog($log);
    $this->insert_model->log($log);
    $this->delete_model->deleteRefund($booking_refund_id);
    $this->session->set_flashdata('success', 'Refund successfully removed!');
    $this->redirect();
  }

  function updateRoomStatus() {
    $room = $this->get_model->getRoom($_POST['room_id']);
    $old_status = $this->get_model->getRoomStatuses($room->room_status_id);
    $room_status = $this->get_model->getRoomStatuses($_POST['room_status_id']);
    $this->update_model->updateRoomStatus();
    $this->insert_model->log("Updated room status of <b>{$room->room_number} {$room->room_type_abbr}</b> from <b>{$old_status->description}</b> to <b>{$room_status->description}</b>", 4);
    $this->session->set_flashdata('success', 'Room status  successfully updated!');
    $this->redirect();
  }
}
