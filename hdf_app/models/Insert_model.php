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

  function addRoomType($data) {
    $this->db->insert('room_type', $data);
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

  function addRoom($data) {
    $this->db->insert('rooms', $data);
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
      'user_id' => $this->session->userdata('user_id'),
      'content' => $content,
      'log_type' => $log_type,
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



  function unsetGuestPost() {
    unset($_POST['first_name']);
    unset($_POST['middle_name']);
    unset($_POST['last_name']);
    unset($_POST['contact']);
    unset($_POST['email']);
    unset($_POST['company_name']);
  }

  // function getDaysInBetween($check_in, $check_out) {
  //   $days = [];
  //   $start = new DateTime($check_in);
  //   $end = new DateTime($check_out);
  //   $end = $end->modify('+1 day');

  //   $interval = new DateInterval('P1D');
  //   $dates = new DatePeriod($start, $interval, $end);

  //   foreach ($dates as $date) {
  //     array_push($days, $date->format("Y-m-d"));
  //   }

  //   return $days;
  // }

  // $booking_number = strtoupper($_POST['first_name'][0] . $_POST['middle_name'][0] . $_POST['last_name'][0] . date('ymdhis'));

  function book() {
    if ($_POST['booking_type'] == 'Check In') {
      $_POST['reservation_type'] = NULL;
      if ($_POST['check_in'] == date('m/d/Y')) {
        $this->db->where('id', $_POST['room_id'])->update('rooms', ['room_status_id' => 8]);
      }
    } else {
      $_POST['reservation_status'] = $_POST['reservation_type'] == 'Online' ? 2 : 1;
    }
    $_POST['booking_number'] = '';
    // $_POST['check_in_date'] = $this->toDashedDate($_POST['check_in']);
    // $_POST['check_out_date'] = $this->toDashedDate($_POST['check_out']);
    // $_POST['dates'] = json_encode($this->getDaysInBetween($_POST['check_in'], $_POST['check_out']));
    $this->unsetGuestPost();
    $this->db->insert('bookings', $_POST);
    $booking_id = $this->db->insert_id();
    $booking_number = 'HDF' . $booking_id;
    $this->db->where('booking_id', $booking_id)->update('bookings', ['booking_number' => $booking_number]);
    return $booking_number;
  }

  function addGuest($guest, $post = FALSE) {
    if ($post) {
      $data = [
        'first_name' => $guest['first_name'],
        'middle_name' => $guest['middle_name'],
        'last_name' => $guest['last_name'],
        'contact' => $guest['contact'],
        'email' => $guest['email'],
        'company_name' => $guest['company_name']
      ];
    } else {
      unset($_POST['guest_id']);
      $data = $_POST;
    }
    $this->db->insert('guests', $data);
    return $this->db->insert_id();
  }
}
