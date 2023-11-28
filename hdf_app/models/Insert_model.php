<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Insert_model extends CI_Model {

  function dd($data) {
    echo "<pre>";
    print_r(var_dump($data));
    die;
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
      'c_in' => $this->toDashedDate($_POST['check_in']),
      'c_out' => $this->toDashedDate($_POST['check_out']),
      'nights' => $_POST['nights'],
      'dates' => json_encode($_POST['dates']),
    ];
  }

  function book() {
    $this->db->insert('bookings', $this->getBookingData());
    $booking_id = $this->db->insert_id();
    $this->db->insert('booked_rooms', $this->getBookedRoomData($booking_id));
    $booked_room_id = $this->db->insert_id();
    $booking_number = 'HDF' . str_pad($booking_id, 5, '0', STR_PAD_LEFT);
    $this->db->where('booking_id', $booking_id)->update('bookings', ['booking_number' => $booking_number]);
    $_POST['booking_id'] = $booking_id;
    return [$booking_number, $booked_room_id];
  }

  // 0 - checkin 
  // 1 - walkin 
  // 2 - online 
  // 3 - verified 
  // 4 - cancelled reservation 
  // 5 - confirmed 
  // 6 - cancelled booking 

  function massBook() {
    $data = [
      'guest_id' => $_POST['guest_id'],
      'booking_type' => $_POST['rdo_booking_type'],
      'arrival' => $_POST['check_in_mass'],
      'departure' => $_POST['check_out_mass'],
      'reservation_status' => $_POST['rdo_booking_type'] == 'Check In' ? 0 : 1
    ];
    if ($_POST['rdo_booking_type'] == 'reservation') {
      $data['reservation_type'] = 'Arrival/Tentative';
    }
    $this->db->insert('bookings', $data);
    $booking_id = $this->db->insert_id();
    $booking_number = 'HDF' . str_pad($booking_id, 5, '0', STR_PAD_LEFT);
    $this->db->where('booking_id', $booking_id)->update('bookings', ['booking_number' => $booking_number]);

    foreach (json_decode($_POST['room_ids']) as $room_id) {
      $room_data = [
        'booking_id' => $booking_id,
        'room_id' => $room_id,
        'check_in' => $_POST['check_in_mass'],
        'check_out' => $_POST['check_out_mass'],
        'c_in' => $this->toDashedDate($_POST['check_in_mass']),
        'c_out' => $this->toDashedDate($_POST['check_out_mass']),
        'nights' => $_POST['nights'],
        'dates' => json_encode($_POST['dates']),
      ];

      $this->db->insert('booked_rooms', $room_data);
    }

    return [$booking_id, $booking_number];
  }

  function toDashedDate($date) {
    [$month, $day, $year] = explode('/', $date);
    return $year . '-' . $month . '-' . $day;
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
    $_POST['c_in'] = $this->toDashedDate($_POST['check_in']);
    $_POST['c_out'] = $this->toDashedDate($_POST['check_out']);
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

  function addPayment($payment_for, $amount, $booked_room_id) {
    $data = [
      'booking_id' => $_POST['booking_id'],
      'booked_room_id' => $booked_room_id,
      'payment_option' => $_POST['payment_option'],
      'amount' => $amount,
      'payment_details' => $_POST['payment_details'],
      'payment_for' => $payment_for,
      'user_id' => $_SESSION['user_id'],
    ];

    $this->db->insert('booking_payment', $data);
    if ($_POST['payment_option'] == 'Cash') {
      $this->addCash($amount);
    }
  }

  function addCash($amount, $deduct = FALSE) {
    $amount = str_replace(',', '', $amount);
    $cash = $this->db->order_by('cash_id', 'DESC')->limit(1)->get('cash')->row();
    if ($deduct) {
      $cash = $cash->cash_amount - $amount;
    } else {
      $cash = $cash->cash_amount + $amount;
    }
    $this->db->insert('cash', ['cash_amount' => $cash]);
  }

  function addBookingLog($log) {
    $data = [
      'booking_id' => $_POST['booking_id'],
      'user_id' => $_SESSION['user_id'],
      'activity' => $log
    ];
    $this->db->insert('booking_logs', $data);
  }

  function addBookingLogAjax($log, $post) {
    $data = [
      'booking_id' => $post['booking_id'],
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
    if (isset($_POST['using_formula'])) {
      $_POST['using_formula'] = 1;
    }
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

  function addRefund() {
    unset($_POST['booking_number']);
    $_POST['user_id'] = $_SESSION['user_id'];
    $this->db->insert('booking_refund', $_POST);
  }

  function remit() {
    $_POST['user_id'] = $_SESSION['user_id'];
    $_POST['remittance_date'] = date_create()->modify('-1 days')->format('Y-m-d');
    $this->addCash($_POST['remitted_amount'], TRUE);
    $this->db->insert('remittances', $_POST);
  }

  function addSales() {
    $this->db->insert('sales', $_POST);
  }

  function addCollectable() {
    $this->db->insert('collectables', $_POST);
  }

  function addCount() {
  }
}
