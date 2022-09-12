<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Insert_model extends CI_Model {

  function dd($data) {
    echo "<pre>";
    print_r(var_dump($data));
    die;
  }

  function frontdeskInsertRoomsChecked($data) {
    $this->db->insert('rooms_checked', $data);
  }

  function insertEvent($data) {
    $this->db->insert('events', $data);
  }

  function addRoomBooking($data) {
    $this->db->insert('rooms_booking', $data);
  }

  function addDeduction($data) {
    $this->db->insert('deduction', $data);
  }

  function CoffeeaddProductRes($data) {
    $this->db->insert('product_coffeeshop', $data);
  }

  function addingCartCoffeeshop($data) {
    $this->db->insert('coffeeshop_cart', $data);
  }

  function addProductRes($data) {
    $this->db->insert('product_restaurant', $data);
  }

  function addingCartRestaurant($data) {
    $this->db->insert('restaurant_cart', $data);
  }

  function createUsers($data) {
    $this->db->insert('users', $data);
  }

  function frontdeskCheckingIn($data) {
    $this->db->insert('check_form', $data);
  }

  function frontdeskinsertRoomType($data) {
    $this->db->insert('reserve_room_type', $data);
  }

  function housekeepingInsertNotif($data) {
    $this->db->insert('notification', $data);
  }

  function log($content, $log_type = 0) {
    $data = [
      'user_id' => $_SESSION['user_id'],
      'content' => $content,
      'log_type' => $log_type,
      'ip_address' => $this->input->ip_address()
    ];
    $this->db->insert('user_logs', $data);
  }

  function reports($data) {
    $this->db->insert('all_reports', $data);
  }

  function createTable($data) {
    $this->db->insert('num_tables', $data);
  }

  function coffeeshopcreateTable($data) {
    $this->db->insert('coffee_tables', $data);
  }

  function insertReserveUsingOnlineBooking($data) {
    $this->db->insert('bookings', $data);
  }

  function insertChargetoFO($data) {
    $this->db->insert('charges_fo', $data);
  }

  function addAmenchargestoFO($data) {
    $this->db->insert('charges_amen', $data);
  }

  // ------------------------------------------------------------------------------------------------------- //
  // ------------------------------------------------ FRANZ ------------------------------------------------ //
  // ------------------------------------------------------------------------------------------------------- //

  function getBookingData() {
    if ($_POST['booking_type'] == 'Check In') {
      $_POST['reservation_type'] = NULL;
      $_POST['reservation_status'] = 0;
      if ($_POST['check_in'] == date('m/d/Y')) {
        $this->db->where('id', $_POST['room_id'])->update('rooms', ['room_status_id' => 8]);
      }
    } else {
      $_POST['reservation_status'] = $_POST['reservation_type'] == 'Online' ? 2 : 1;
    }

    return [
      'guest_id' => $_POST['guest_id'],
      'booking_type' => $_POST['booking_type'],
      'arrival' => $_POST['check_in'],
      'departure' => $_POST['check_out'],
      'request' => $_POST['request'],
      'remarks' => $_POST['remarks'],
      'reservation_type' => $_POST['reservation_type'],
      'reservation_status' => $_POST['reservation_status']
    ];
  }

  function getBookedRoomData($booking_id) {
    return [
      'booking_id' => $booking_id,
      'room_id' => $_POST['room_id'],
      'check_in' => $_POST['check_in'],
      'check_out' => $_POST['check_out'],
      'nights' => $_POST['nights'],
    ];
  }

  function book() {
    $this->db->insert('bookings', $this->getBookingData());
    $booking_id = $this->db->insert_id();
    $this->db->insert('booked_rooms', $this->getBookedRoomData($booking_id));
    $booking_number = 'HDF' . str_pad($booking_id, 5, '0', STR_PAD_LEFT);
    $this->db->where('booking_id', $booking_id)->update('bookings', ['booking_number' => $booking_number]);
    $_POST['booking_id'] = $booking_id;
    return [$booking_number, $booking_id];
  }

  function addGuest($guest, $post = FALSE) {
    if ($post) {
      $data = [
        'first_name' => $guest['first_name'] ?? '',
        'middle_name' => $guest['middle_name'] ?? '',
        'last_name' => $guest['last_name'] ?? '',
        'contact' => $guest['contact'] ?? '',
        'email' => $guest['email'] ?? '',
        'company_name' => $guest['company_name'] ?? '',
        'suffix' => $guest['suffix'] ?? '',
        'plate_no' => $guest['plate_no'] ?? '',
        'birthday' => $guest['birthday'] ?? '',
        'nationality' => $guest['nationality'] ?? '',
      ];
    } else {
      unset($_POST['guest_id']);
      $data = $_POST;
    }
    $this->db->insert('guests', $data);
    return $this->db->insert_id();
  }

  function bookRoom() {
    unset($_POST['booked_room_id']);
    $this->db->insert('booked_rooms', $_POST);
    return $this->db->insert_id();
  }

  function addCharges() {
    unset($_POST['booking_id']);
    $this->db->insert('charges_food', $_POST);
  }

  function addCategory() {
    unset($_POST['category_id']);
    $this->db->insert('categories', $_POST);
  }

  function addCharge() {
    unset($_POST['charge_id']);
    $this->db->insert('charges', $_POST);
  }

  function addOtherCharges() {
    unset($_POST['booking_id']);
    $this->db->insert('charges_other', $_POST);
  }

  function addPayment() {
    $data = [
      'booking_id' => $_POST['booking_id'],
      'payment_option' => $_POST['payment_option'],
      'amount' => $_POST['amount'],
      'card_number' => $_POST['card_number'],
    ];

    $this->db->insert('booking_payment', $data);
  }

  function addBookingLog($log) {
    $data = [
      'booking_id' => $_POST['booking_id'],
      'user_id' => $_SESSION['user_id'],
      'activity' => $log
    ];
    $this->db->insert('booking_logs', $data);
  }

  function addRoom() {
    unset($_POST['room_id']);
    $this->db->insert('rooms', $_POST);
  }

  function addRoomType() {
    unset($_POST['room_type_id']);
    $this->db->insert('room_type', $_POST);
  }

  function addDiscount() {
    unset($_POST['discount_id']);
    $this->db->insert('discounts', $_POST);
  }

  function addUser() {
    unset($_POST['user_id']);
    $_POST['password'] = password_hash($_POST['password'], PASSWORD_BCRYPT);
    $this->db->insert('users', $_POST);
  }

  function addEarlyCheckin($booked_room_id) {
    $data = [
      'booked_room_id' => $booked_room_id,
      'charge_id' => 32,
      'charge_quantity' => 1
    ];
    $this->db->insert('charges_other', $data);
  }
}
