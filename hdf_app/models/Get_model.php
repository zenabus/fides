<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Get_model extends CI_Model {

  function dd($data) {
    echo "<pre>";
    print_r(var_dump($data));
    die;
  }

  function getRooms() {
    return $this->db->query('SELECT * FROM room_type INNER JOIN rooms ON room_type.id=rooms.room_type_id')->result_array();
  }

  function getRoom($room_id) {
    return $this->db->join('room_type', 'room_type.id=rooms.room_type_id')->where('rooms.id', $room_id)->get('rooms')->row();
  }

  function getUsers() {
    return $this->db->order_by('status')->order_by('user_type')->order_by('name')->get('users')->result_array();
  }

  function getUser($user_id) {
    return $this->db->where('id', $user_id)->get('users')->row();
  }

  function getFrontDeskRooms($status = 1) {
    $status = $status ? 'room_status_id' : 'room_status_id!=';
    return $this->db->select('*, rooms.id AS room_id')
      ->join('room_type', 'room_type.id=rooms.room_type_id')
      ->join('room_statuses', 'room_statuses.id=rooms.room_status_id')
      ->where($status, 4)
      ->order_by('room_number')
      ->get('rooms')->result_array();
  }

  function getRoomsWithRoomType() {
    return $this->db->select('*, rooms.id AS room_id')
      ->join('room_type', 'room_type.id=rooms.room_type_id')
      ->join('room_statuses', 'room_statuses.id=rooms.room_status_id')
      ->order_by('room_number')
      ->get('rooms')->result_array();
  }

  function getRoomIdsByRoomType($room_type_id) {
    $this->db->select('rooms.id AS room_id');
    $this->db->join('room_type', 'room_type.id=rooms.room_type_id');
    $this->db->join('room_statuses', 'room_statuses.id=rooms.room_status_id');
    $this->db->where('room_type.id', $room_type_id);
    $this->db->order_by('room_number');
    return $this->db->get('rooms')->result_array();
  }

  function getGuests($guest_disabled = 0) {
    return $this->db->where('guest_disabled', $guest_disabled)->order_by('first_name')->get('guests')->result_array();
  }

  function getGuest($guest_id) {
    return $this->db->where('guest_id', $guest_id)->get('guests')->row();
  }

  function checkGuest() {
    return $this->db->where('first_name', $_POST['first_name'])
      ->where('middle_name', $_POST['middle_name'])
      ->where('last_name', $_POST['last_name'])
      ->get('guests')->row();
  }

  function getBookings($booked_room_archived = [0, 2]) {
    return $this->db->join('booked_rooms', 'booked_rooms.booking_id=bookings.booking_id')
      ->join('rooms', 'rooms.id=booked_rooms.room_id')
      ->join('guests', 'guests.guest_id=bookings.guest_id')
      ->where_in('reservation_status', [-1, 0, 1, 2])
      ->where_in('booked_room_archived', $booked_room_archived)
      ->get('bookings')->result_array();
  }

  function getBooking($booking_id) {
    return $this->db->join('booked_rooms', 'booked_rooms.booking_id=bookings.booking_id')
      ->join('rooms', 'rooms.id=booked_rooms.room_id')
      ->join('guests', 'guests.guest_id=bookings.guest_id')
      ->where('bookings.booking_id', $booking_id)
      ->get('bookings')->row();
  }

  function getBookingByBookedRoom($booked_room_id) {
    return $this->db->join('booked_rooms', 'booked_rooms.booking_id=bookings.booking_id')
      ->join('rooms', 'rooms.id=booked_rooms.room_id')
      ->join('guests', 'guests.guest_id=bookings.guest_id')
      ->where('booked_rooms.booked_room_id', $booked_room_id)
      ->get('bookings')->row();
  }

  function getBookingByBookingNumber($booking_number) {
    return $this->db->join('guests', 'guests.guest_id=bookings.guest_id')
      ->where('booking_number', $booking_number)
      ->get('bookings')->row();
  }

  function authenticate() {
    $data = $this->db->where('status', 'Active')->where('username', $_POST['username'])->get('users')->row();

    if ($data) {
      if (password_verify($_POST['password'], $data->password)) {
        return $data;
      }
    }

    return FALSE;
  }

  function getProfile() {
    return $this->db->where('id', $_SESSION['user_id'])->get('users')->row();
  }

  function getRoomsById($room_id) {
    return $this->db->where('room_type_id', $room_id)->order_by('room_number', 'asc')->get('rooms')->result_array();
  }

  function getRoomByRoomNumber($room_number) {
    return $this->db->where('room_number', $room_number)->get('rooms')->row();
  }

  function getRoomByType($room) {
    return $this->db->where('room_type', $room)->get('room_type')->row();
  }

  function getReservations($type) {
    return $this->db->join('guests', 'guests.guest_id=bookings.guest_id')
      ->join('booked_rooms', 'booked_rooms.booking_id=bookings.booking_id')
      ->join('rooms', 'rooms.id=booked_rooms.room_id')
      ->join('room_type', 'room_type.id=rooms.room_type_id')
      ->where_in('reservation_type', $type)
      ->get('bookings')->result_array();
  }

  function getBookingsByStatus($status = [0, -1]) {
    return $this->db->join('guests', 'guests.guest_id=bookings.guest_id')
      ->where_in('reservation_status', $status)
      ->get('bookings')->result_array();
  }

  function getRoomTypes() {
    return $this->db->order_by('rank')->get('room_type')->result_array();
  }

  function getBookingsByRoomType($room_type_id) {
    return $this->db->select('check_in, check_out, room_number, room_type, rooms.id AS room_id')
      ->join('rooms', 'rooms.id=booked_rooms.room_id')
      ->join('room_type', 'room_type.id=rooms.room_type_id')
      ->where('room_type_id', $room_type_id)
      ->get('booked_rooms')->result_array();
  }

  function getRoomCountByRoomType($room_type_id) {
    return $this->db->where('room_type_id', $room_type_id)->count_all_results('rooms');
  }

  function getBookedRoomsGroupedByDate($booking_id, $check_in = NULL) {
    return $this->db->where('booking_id', $booking_id)
      ->join('rooms', 'rooms.id=booked_rooms.room_id')
      ->join('room_type', 'room_type.id=rooms.room_type_id')
      ->join('discounts', 'discounts.discount_id=booked_rooms.discount_id')
      ->order_by('booked_room_id', 'DESC')
      ->where_in('booked_room_archived', [0, 2])
      ->where('check_in', $check_in)
      ->get('booked_rooms')->result_array();
  }

  function getBookedRooms($booking_id, $booked_room_archived = [0, 2]) {
    return $this->db->where('booking_id', $booking_id)
      ->join('rooms', 'rooms.id=booked_rooms.room_id')
      ->join('room_type', 'room_type.id=rooms.room_type_id')
      ->join('discounts', 'discounts.discount_id=booked_rooms.discount_id')
      ->order_by('booked_room_id', 'DESC')
      ->where_in('booked_room_archived', $booked_room_archived)
      ->get('booked_rooms')->result_array();
  }

  function getBookedRoomById($booked_room_id, $array = FALSE) {
    $this->db->where('booked_room_id', $booked_room_id);
    $this->db->join('rooms', 'rooms.id=booked_rooms.room_id');
    $this->db->join('room_type', 'room_type.id=rooms.room_type_id');
    $this->db->join('discounts', 'discounts.discount_id=booked_rooms.discount_id');
    $this->db->order_by('booked_room_id', 'DESC');
    if ($array) {
      return  $this->db->get('booked_rooms')->result_array();
    } else {
      return  $this->db->get('booked_rooms')->row();
    }
  }

  function getBookedRoom($booked_room_id) {
    return $this->db->where('booked_room_id', $booked_room_id)
      ->join('rooms', 'rooms.id=booked_rooms.room_id')
      ->join('room_type', 'room_type.id=rooms.room_type_id')
      ->get('booked_rooms')->row();
  }

  function getPrice($description) {
    return $this->db->where('description', $description)->get('prices')->row();
  }

  function getDiscounts() {
    return $this->db->order_by('discount_type', 'ASC')->get('discounts')->result_array();
  }

  function getDiscount($discount_id) {
    return $this->db->where('discount_id', $discount_id)->get('discounts')->row();
  }

  function getCategories() {
    return $this->db->order_by('category')->get('categories')->result_array();
  }

  function getCategory($category_id) {
    return $this->db->where('category_id', $category_id)->get('categories')->result_array();
  }

  function getCharges() {
    return $this->db->join('categories', 'categories.category_id=charges.category_id')->order_by('category')->order_by('charge')->get('charges')->result_array();
  }

  function getCharge($charge_id) {
    return $this->db->where('charge_id', $charge_id)->join('categories', 'categories.category_id=charges.category_id')->get('charges')->row();
  }

  function ByType($booking_id) {
    return $this->db->where('booking_id', $booking_id)->order_by('booking_payment_added', 'DESC')->get('booking_payment')->result_array();
  }

  function getPaymentTotal($booking_id) {
    return $this->db->select_sum('amount')->where('booking_id', $booking_id)->get('booking_payment')->row();
  }

  function getRoomPaymentTotal($booked_room_id) {
    return $this->db->select_sum('amount')->where('booked_room_id', $booked_room_id)->get('booking_payment')->row();
  }

  function getAdvanceByBookedRoom($booked_room_id) {
    return $this->db->where('booked_room_id', $booked_room_id)->get('booking_payment')->row();
  }

  function getPayments($booking_id) {
    return $this->db->join('booked_rooms', 'booked_rooms.booked_room_id=booking_payment.booked_room_id')
      ->join('rooms', 'rooms.id=booked_rooms.room_id')
      ->join('room_type', 'room_type.id=rooms.room_type_id')
      ->join('users', 'users.id=booking_payment.user_id')
      ->order_by('booking_payment_added', 'DESC')
      ->where('booking_payment.booking_id', $booking_id)->get('booking_payment')->result_array();
  }

  function getRefunds($booking_id) {
    return $this->db->join('booked_rooms', 'booked_rooms.booked_room_id=booking_refund.booked_room_id')
      ->join('rooms', 'rooms.id=booked_rooms.room_id')
      ->join('room_type', 'room_type.id=rooms.room_type_id')
      ->join('users', 'users.id=booking_refund.user_id')
      ->order_by('booking_refund_added', 'DESC')
      ->where('booking_refund.booking_id', $booking_id)->get('booking_refund')->result_array();
  }

  function getRefundTotal($booking_id) {
    return $this->db->select_sum('booking_refund')->where('booking_id', $booking_id)->get('booking_refund')->row();
  }

  function getRefundByBookedRoom($booked_room_id) {
    return $this->db->select_sum('booking_refund')->where('booked_room_id', $booked_room_id)->get('booking_refund')->row();
  }

  function getRoomCharges($booked_room_id, $charge_type, $total = FALSE) {
    if ($total) {
      $this->db->select_sum('(charges_food_quantity * charges_food_amount)', 'total');
    }
    $this->db->where('booked_room_id', $booked_room_id);
    $this->db->where('charge_type', $charge_type);
    if ($total) {
      return $this->db->get('charges_food')->row();
    } else {
      return $this->db->get('charges_food')->result_array();
    }
  }

  function getRoomChargesv2($booked_room_id) {
    $this->db->where('booked_room_id', $booked_room_id);
    return $this->db->get('charges_food')->result_array();
  }

  function getRoomAmenitiesByRoomId($booked_room_id) {
    return $this->db->select_sum('(charge_quantity * charge_amount)', 'total')
      ->join('charges', 'charges.charge_id=charges_other.charge_id')
      ->join('booked_rooms', 'booked_rooms.booked_room_id=charges_other.booked_room_id')
      ->join('bookings', 'bookings.booking_id=booked_rooms.booking_id')
      ->where('booked_rooms.booked_room_id', $booked_room_id)
      ->get('charges_other')->row();
  }

  function getRoomAmenities($booked_room_id, $total = FALSE) {
    if ($total) {
      $this->db->select_sum('(charge_quantity * charge_amount)', 'total');
    }
    $this->db->join('charges', 'charges.charge_id=charges_other.charge_id');
    $this->db->join('categories', 'categories.category_id=charges.category_id');
    $this->db->where('booked_room_id', $booked_room_id);
    $this->db->order_by('category');
    if ($total) {
      return $this->db->get('charges_other')->row();
    } else {
      return $this->db->get('charges_other')->result_array();
    }
  }

  function getEarlyCheckout($booked_room_id) {
    $this->db->join('charges', 'charges.charge_id=charges_other.charge_id');
    $this->db->join('categories', 'categories.category_id=charges.category_id');
    $this->db->where('booked_room_id', $booked_room_id);
    $this->db->where('charges_other.charge_id', 39);
    $this->db->order_by('category');
    return $this->db->get('charges_other')->row();
  }

  function getChargesTotal($booking_id) {
    $this->db->select_sum('(charges_food_quantity * charges_food_amount)', 'total')
      ->join('booked_rooms', 'booked_rooms.booked_room_id=charges_food.booked_room_id')
      ->join('bookings', 'bookings.booking_id=booked_rooms.booking_id')
      ->where('bookings.booking_id', $booking_id)
      ->get('charges_food')->row();
  }

  function getAmenitiesTotal($booking_id) {
    return $this->db->select_sum('(charge_quantity * charge_amount)', 'total')
      ->join('charges', 'charges.charge_id=charges_other.charge_id')
      ->join('booked_rooms', 'booked_rooms.booked_room_id=charges_other.booked_room_id')
      ->join('bookings', 'bookings.booking_id=booked_rooms.booking_id')
      ->where('bookings.booking_id', $booking_id)
      ->get('charges_other')->row();
  }

  function getRoomChargesByRoomId($booked_room_id) {
    return $this->db->select_sum('(charges_food_quantity * charges_food_amount)', 'total')
      ->join('booked_rooms', 'booked_rooms.booked_room_id=charges_food.booked_room_id')
      ->join('bookings', 'bookings.booking_id=booked_rooms.booking_id')
      ->where('booked_rooms.booked_room_id', $booked_room_id)
      ->get('charges_food')->row();
  }


  function getBookingLogs($booking_id) {
    return $this->db->join('users', 'users.id=booking_logs.user_id')->order_by('booking_log_added', 'DESC')->where('booking_id', $booking_id)->get('booking_logs')->result_array();
  }

  function getChargeByTable($charge_id, $table) {
    if ($table == 'charges_other') {
      $this->db->join('charges', 'charges.charge_id=charges_other.charge_id');
      $this->db->join('categories', 'categories.category_id=charges.category_id');
    }
    $this->db->where($table . '_id', $charge_id);
    return $this->db->get($table)->row();
  }

  function getPaymentById($booking_payment_id) {
    return $this->db->where('booking_payment_id', $booking_payment_id)->get('booking_payment')->row();
  }

  function getRefundById($booking_refund_id) {
    return $this->db->where('booking_refund_id', $booking_refund_id)->get('booking_refund')->row();
  }

  function getRoomType($room_type_id) {
    return $this->db->where('id', $room_type_id)->get('room_type')->row();
  }

  function getLogs() {
    $this->db->order_by('user_logs.id', 'DESC');
    $this->db->join('users', 'users.id=user_logs.user_id');
    if ($_SESSION['user_type'] != 'Admin' && $_SESSION['user_type'] != 'Superadmin') {
      $this->db->where('user_id', $_SESSION['user_id']);
    } else {
      $this->db->where('user_id!=', 34);
    }
    return $this->db->get('user_logs')->result_array();
  }

  function getDates($booking_id) {
    return $this->db->select('check_in, check_out')->where('booking_id', $booking_id)->get('booked_rooms')->result_array();
  }

  function getBookingsByGuest($guest_id, $reservation_status) {
    return $this->db->join('booked_rooms', 'booked_rooms.booking_id=bookings.booking_id')
      ->join('rooms', 'rooms.id=booked_rooms.room_id')
      ->join('guests', 'guests.guest_id=bookings.guest_id')
      ->where('guests.guest_id', $guest_id)
      ->where_in('reservation_status', $reservation_status)
      ->group_by('booking_number')
      ->get('bookings')->result_array();
  }

  function getLogsByUser($user_id) {
    $this->db->order_by('user_logs.id', 'DESC');
    $this->db->join('users', 'users.id=user_logs.user_id');
    $this->db->where('user_id', $user_id);
    return $this->db->get('user_logs')->result_array();
  }

  function getCheckouts() {
    return $this->db->join('bookings', 'bookings.booking_id=booked_rooms.booking_id')
      ->join('rooms', 'rooms.id=booked_rooms.room_id')
      ->join('room_type', 'room_type.id=rooms.room_type_id')
      ->join('guests', 'guests.guest_id=bookings.guest_id')
      ->join('room_statuses', 'room_statuses.id=rooms.room_status_id')
      ->where_in('reservation_status', [0, -1])
      ->where('check_out', date('m/d/Y'))
      ->order_by('room_number')
      ->get('booked_rooms')->result_array();
  }

  function getRoomStatuses($room_status_id = NULL) {
    if ($room_status_id) {
      return $this->db->where('id', $room_status_id)->get('room_statuses')->row();
    } else {
      return $this->db->get('room_statuses')->result_array();
    }
  }

  function getPaymentByType($booked_room_id, $payment_for, $payment_option = NULL, $date = NULL) {
    if ($payment_option) {
      return $this->db->select_sum('amount')
        ->where('booked_room_id', $booked_room_id)
        ->where('payment_for', $payment_for)
        ->where('payment_option', $payment_option)
        ->like('booking_payment_added', $date)
        ->get('booking_payment')->row();
    } else {
      return $this->db->select_sum('amount')
        ->where('booked_room_id', $booked_room_id)
        ->where('payment_for', $payment_for)
        ->get('booking_payment')->row();
    }
  }

  function getDCR() {
    return $this->db->select('booking_payment_id, CAST(booking_payment_added as DATE) as payment_added, count(*) as count, sum(amount) as sum')
      ->group_by('payment_added')
      ->order_by('payment_added', 'DESC')
      ->get('booking_payment')->result_array();
  }

  function getDCRTotal($payment_option) {
    return $this->db->select('booking_payment_id, CAST(booking_payment_added as DATE) as payment_added, sum(amount) as sum')
      ->where_in('payment_option', $payment_option)
      ->group_by('payment_added')
      ->order_by('payment_added', 'DESC')
      ->get('booking_payment')->result_array();
  }

  function getPaymentsByDateGrouped($date) {
    return $this->db->join('booked_rooms', 'booked_rooms.booked_room_id=booking_payment.booked_room_id')
      ->join('rooms', 'rooms.id=booked_rooms.room_id')
      ->join('room_type', 'room_type.id=rooms.room_type_id')
      ->join('bookings', 'bookings.booking_id=booked_rooms.booking_id')
      ->join('guests', 'guests.guest_id=bookings.guest_id')
      ->like('booking_payment_added', $date)
      ->group_by('booking_payment.booked_room_id')
      ->get('booking_payment')->result_array();
  }

  function getCurrentCash() {
    return $this->db->order_by('cash_id', 'DESC')->limit(1)->get('cash')->row();
  }

  function getRemitted($date) {
    return $this->db->join('users', 'users.id=remittances.user_id')->where('remittance_date', $date)->get('remittances')->row();
  }

  function getPaymentsByDate($date) {
    return $this->db->join('booked_rooms', 'booked_rooms.booked_room_id=booking_payment.booked_room_id')
      ->join('rooms', 'rooms.id=booked_rooms.room_id')
      ->join('room_type', 'room_type.id=rooms.room_type_id')
      ->join('bookings', 'bookings.booking_id=booked_rooms.booking_id')
      ->join('guests', 'guests.guest_id=bookings.guest_id')
      ->join('users', 'users.id=booking_payment.user_id')
      ->like('booking_payment_added', $date)
      ->order_by('booking_payment_id', 'DESC')
      ->get('booking_payment')->result_array();
  }

  function getSalesByDate($date) {
    return $this->db->where('sales_date', $date)->get('sales')->result_array();
  }

  function getCollectablesByDate($date) {
    return $this->db->where('collectable_date', $date)->get('collectables')->result_array();
  }

  function getExpensesByDate($date) {
    return $this->db->where('expense_date', $date)->get('expenses')->result_array();
  }

  function getSales($date, $total = FALSE) {
    if ($total) {
      return $this->db->select_sum('sales_amount')->where('sales_date', $date)->get('sales')->row();
    } else {
      return $this->db->where('sales_date', $date)->get('sales')->result_array();
    }
  }

  function getCollectables($date, $total = FALSE) {
    if ($total) {
      return $this->db->select_sum('collectable_amount')->where('collectable_date', $date)->get('collectables')->row();
    } else {
      return $this->db->where('collectable_date', $date)->get('collectables')->result_array();
    }
  }

  function getExpenses($date, $total = FALSE) {
    if ($total) {
      return $this->db->select_sum('expense_amount')->where('expense_date', $date)->get('expenses')->row();
    } else {
      return $this->db->where('expense_date', $date)->get('expenses')->result_array();
    }
  }

  function getExpenseByDateAndType($date, $type) {
    return $this->db->select_sum('expense_amount')->where('expense_type', $type)->where('expense_date', $date)->get('expenses')->row();
  }

  function getSalesByDateAndType($date, $type) {
    return $this->db->select_sum('sales_amount')->where('sales_type', $type)->where('sales_date', $date)->get('sales')->row();
  }

  function getHotelSales($date) {
    return $this->db->where_in('payment_for', ['room', 'advance', 'addons'])->like('booking_payment_added', $date)->get('booking_payment')->result_array();
  }

  function getEventSales($date) {
    return $this->db->where_in('sales_type', ['Event', 'Pool'])->like('sales_added', $date)->get('sales')->result_array();
  }

  function getHotelExpense($date) {
    return $this->db->where_in('expense_type', ['Hotel', 'Pool'])->like('expense_added', $date)->get('expenses')->result_array();
  }

  function getEventExpense($date) {
    return $this->db->where_in('expense_type', ['Event'])->like('expense_added', $date)->get('expenses')->result_array();
  }

  function getChargedBookings($guest_id = null) {
    if (!$guest_id) {
      return $this->db->join('guests', 'guests.guest_id=bookings.guest_id')
        ->join('booked_rooms', 'booked_rooms.booking_id=bookings.booking_id')
        ->join('rooms', 'rooms.id=booked_rooms.room_id')
        ->join('room_type', 'room_type.id=rooms.room_type_id')
        ->join('discounts', 'discounts.discount_id=booked_rooms.discount_id')
        ->order_by('room_number', 'ASC')
        ->where('charged_to !=', 0)
        ->get('bookings')->result_array();
    } else {
      return $this->db->join('guests', 'guests.guest_id=bookings.guest_id')
        ->where('charged_to', $guest_id)
        ->get('bookings')->result_array();
    }
  }

  function checkConflict($date) {
    return $this->db->where_in('room_id', json_decode($_POST['room_ids']))
      ->where('"' . $date . '" BETWEEN c_in and c_out', NULL, FALSE)
      ->get('booked_rooms')->result_array();
  }

  function checkAvailableRooms($date) {
    return $this->db->where('"' . $date . '" BETWEEN c_in and c_out', NULL, FALSE)
      ->get('booked_rooms')->result_array();
  }

  function checkAvailableDates($date, $room_id) {
    return $this->db->where('room_id', $room_id)
      ->where('"' . $date . '" BETWEEN c_in and c_out', NULL, FALSE)
      ->get('booked_rooms')->result_array();
  }

  function getAllBookedRooms() {
    return $this->db->get('booked_rooms')->result_array();
  }
}
