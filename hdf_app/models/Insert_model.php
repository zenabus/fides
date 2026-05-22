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
    $booking_type = $_POST['booking_type'] ?? '';
    if ($booking_type == 'Check In') {
      $_POST['reservation_type'] = NULL;
      $_POST['reservation_status'] = 0;
      if (isset($_POST['check_in']) && $_POST['check_in'] == date('m/d/Y')) {
        $this->db->where('id', $_POST['room_id'])->update('rooms', ['room_status_id' => 8]);
      }
    } else {
      $_POST['reservation_status'] = ($_POST['reservation_type'] ?? '') == 'Online' ? 2 : 1;
    }

    return [
      'guest_id' => $_POST['guest_id'] ?? NULL,
      'booking_type' => $booking_type,
      'arrival' => $_POST['check_in'] ?? '',
      'departure' => $_POST['check_out'] ?? '',
      'request' => $_POST['request'] ?? '',
      'remarks' => $_POST['remarks'] ?? '',
      'reservation_type' => $_POST['reservation_type'] ?? NULL,
      'reservation_status' => $_POST['reservation_status'] ?? 0
    ];
  }

  function getBookedRoomData($booking_id) {
    $dates = $_POST['dates'] ?? NULL;
    if (empty($dates) && isset($_POST['check_in'], $_POST['check_out'])) {
      $this->load->helper('hdf_utility');
      $dates = datesBetween($_POST['check_in'], $_POST['check_out'], 'Y-m-d');
    }
    return [
      'booking_id' => $booking_id,
      'room_id' => $_POST['room_id'] ?? NULL,
      'check_in' => $_POST['check_in'] ?? '',
      'check_out' => $_POST['check_out'] ?? '',
      'c_in' => isset($_POST['check_in']) ? $this->toDashedDate($_POST['check_in']) : '',
      'c_out' => isset($_POST['check_out']) ? $this->toDashedDate($_POST['check_out']) : '',
      'nights' => $_POST['nights'] ?? 0,
      'dates' => json_encode($dates),
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
      'guest_id' => $_POST['guest_id'] ?? NULL,
      'booking_type' => $_POST['rdo_booking_type'] ?? '',
      'arrival' => $_POST['check_in_mass'] ?? '',
      'departure' => $_POST['check_out_mass'] ?? '',
      'reservation_status' => ($_POST['rdo_booking_type'] ?? '') == 'Check In' ? 0 : 1
    ];
    if (($_POST['rdo_booking_type'] ?? '') == 'reservation') {
      $data['reservation_type'] = 'Arrival/Tentative';
    }
    $this->db->insert('bookings', $data);
    $booking_id = $this->db->insert_id();
    $booking_number = 'HDF' . str_pad($booking_id, 5, '0', STR_PAD_LEFT);
    $this->db->where('booking_id', $booking_id)->update('bookings', ['booking_number' => $booking_number]);

    $dates = $_POST['dates'] ?? NULL;
    if (empty($dates) && isset($_POST['check_in_mass'], $_POST['check_out_mass'])) {
      $this->load->helper('hdf_utility');
      $dates = datesBetween($_POST['check_in_mass'], $_POST['check_out_mass'], 'Y-m-d');
    }

    foreach (json_decode($_POST['room_ids'] ?? '[]') as $room_id) {
      $room_data = [
        'booking_id' => $booking_id,
        'room_id' => $room_id,
        'check_in' => $_POST['check_in_mass'] ?? '',
        'check_out' => $_POST['check_out_mass'] ?? '',
        'c_in' => isset($_POST['check_in_mass']) ? $this->toDashedDate($_POST['check_in_mass']) : '',
        'c_out' => isset($_POST['check_out_mass']) ? $this->toDashedDate($_POST['check_out_mass']) : '',
        'nights' => $_POST['nights'] ?? 0,
        'dates' => json_encode($dates),
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
        'first_name' => trim($guest['first_name'] ?? ''),
        'middle_name' => trim($guest['middle_name'] ?? ''),
        'last_name' => trim($guest['last_name'] ?? ''),
        'contact' => trim($guest['contact'] ?? ''),
        'email' => trim($guest['email'] ?? ''),
        'company_name' => trim($guest['company_name'] ?? ''),
        'suffix' => trim($guest['suffix'] ?? ''),
        'plate_no' => trim($guest['plate_no'] ?? ''),
        'birthday' => trim($guest['birthday'] ?? ''),
        'nationality' => trim($guest['nationality'] ?? ''),
      ];
    } else {
      unset($_POST['guest_id']);
      // Loop through POST and trim everything
      foreach ($_POST as $key => $value) {
        if (is_string($value)) {
          $_POST[$key] = trim($value);
        }
      }
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
    if (!empty($_POST['remittance_date'])) {
      $_POST['remittance_date'] = date('Y-m-d', strtotime($_POST['remittance_date']));
    } else {
      $_POST['remittance_date'] = date_create()->modify('-1 days')->format('Y-m-d');
    }
    $this->addCash($_POST['remitted_amount'], TRUE);
    $this->db->insert('remittances', $_POST);
  }

  function addSales() {
    $cleanDate = date('Y-m-d', strtotime($_POST['sales_date']));
    $targetDateTime = $cleanDate . ' ' . date('H:i:s');
    
    $remarks = $_POST['sales_remarks'] ?? '';
    $method = $_POST['sales_method'] ?? 'Cash';
    
    if ($method == 'Card' && !empty($_POST['card_number'])) {
      $remarks = trim($remarks . " (Card: **** " . $_POST['card_number'] . ")");
    } else if ($method == 'Check') {
      $check_details = array_filter([
        $_POST['check_name'] ?? '',
        $_POST['check_number'] ?? '',
        $_POST['check_branch'] ?? '',
        !empty($_POST['check_date']) ? date('m/d/Y', strtotime($_POST['check_date'])) : ''
      ]);
      if (!empty($check_details)) {
        $remarks = trim($remarks . " (Check: " . implode(' | ', $check_details) . ")");
      }
    } else if ($method == 'Bank Transfer') {
      $bank_details = array_filter([
        $_POST['bank_name'] ?? '',
        $_POST['bank_number'] ?? '',
        !empty($_POST['bank_date']) ? date('m/d/Y', strtotime($_POST['bank_date'])) : ''
      ]);
      if (!empty($bank_details)) {
        $remarks = trim($remarks . " (Bank: " . implode(' | ', $bank_details) . ")");
      }
    }

    $data = [
      'sales_amount' => $_POST['sales_amount'],
      'sales_method' => $method,
      'sales_type' => $_POST['sales_type'],
      'or_name' => $_POST['or_name'] ?? '',
      'or_no' => $_POST['or_no'] ?? '',
      'sales_remarks' => $remarks,
      'sales_date' => $cleanDate,
      'sales_added' => $targetDateTime
    ];

    $this->db->insert('sales', $data);
  }

  function addCollectable() {
    $cleanDate = date('Y-m-d', strtotime($_POST['collectable_date']));
    $targetDateTime = $cleanDate . ' ' . date('H:i:s');
    $_POST['collectable_date'] = $cleanDate;
    $_POST['collectable_added'] = $targetDateTime;
    $this->db->insert('collectables', $_POST);
  }

  function addExpense() {
    $cleanDate = date('Y-m-d', strtotime($_POST['expense_date']));
    $targetDateTime = $cleanDate . ' ' . date('H:i:s');
    $_POST['expense_date'] = $cleanDate;
    $_POST['expense_added'] = $targetDateTime;
    $this->db->insert('expenses', $_POST);
  }
}
