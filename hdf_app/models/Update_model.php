<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Update_model extends CI_Model {

  function dd($data) {
    echo "<pre>";
    print_r(var_dump($data));
    die;
  }

  function updateRoomType($id, $data) {
    $this->db->where('id', $id)->update('room_type', $data);
  }

  function updatePricingRoomType($field, $value, $editid) {
    $this->db->query("update room_type set " . $field . "='" . $value . "' where id='" . $editid . "'");
  }

  function updatePricingBed($field, $value, $editid) {
    $this->db->query("update room_bed set " . $field . "='" . $value . "' where id='" . $editid . "'");
  }

  function updatePricingPerson($field, $value, $editid) {
    $this->db->query("update room_person set " . $field . "='" . $value . "' where id='" . $editid . "'");
  }

  function updateProductActive($id, $data) {
    $this->db->where('id', $id)->update('product_restaurant', $data);
  }

  function coffeeupdateProductActive($id, $data) {
    $this->db->where('id', $id)->update('product_coffeeshop', $data);
  }

  function updateDeduction($id, $data) {
    $this->db->where('id_ded', $id)->update('deduction', $data);
  }

  function coffeeupdateRestaurant($field, $value, $editid) {
    $this->db->query("update product_coffeeshop set " . $field . "='" . $value . "' where id='" . $editid . "'");
  }

  function coffeeshopupdatecart($product_cart_id, $data) {
    $this->db->where('id_cart', $product_cart_id)->update('coffeeshop_cart', $data);
  }

  function updateRestaurant($field, $value, $editid) {
    $this->db->query("update product_restaurant set " . $field . "='" . $value . "' where id='" . $editid . "'");
  }

  function updateRoom($id, $data) {
    $this->db->where('id', $id)->update('rooms', $data);
  }

  function updateRoomBooking($data, $id) {
    $this->db->where('room_number_id', $id)->update('rooms_booking', $data);
  }

  function frontdeskupdateRoom($room_number, $data) {
    $this->db->where('room_number', $room_number)->update('rooms', $data);
  }

  function updateUser($user_id = NULL) {
    if (!$user_id) {
      $user_id = $_SESSION['user_id'];
      $_SESSION['name'] = $_POST['name'];
    }
    $_SESSION['name'] = $_POST['name'];
    $this->db->where('id', $user_id)->update('users', $_POST);
  }

  function frontdeskUpdateCheckRoom($room_number, $data) {
    $this->db->where('room_number', $room_number)->update('rooms', $data);
  }

  function frontdeskUpdateCheckout($id, $data) {
    $this->db->where('id_rooms', $id)->update('rooms_checked', $data);
  }

  function frontdeskUpdateCheckIn($check_in_id, $data) {
    $this->db->where('id', $check_in_id)->update('check_form', $data);
  }

  function frontdeskUpdateCheckInBooking($connect, $data) {
    $this->db->where('id', $connect)->update('bookings', $data);
  }

  function updatecart($product_cart_id, $data) {
    $this->db->where('id_cart', $product_cart_id)->update('restaurant_cart', $data);
  }

  function updatecartforDeduction($user, $data) {
    $this->db->where('id_of_user', $user)->where('table_num', 'walkin')->where('status_cart', 'Not Deleted')->update('restaurant_cart', $data);
  }

  function pertableupdatecartforDeduction($user, $data, $redirect) {
    $this->db->where('id_of_user', $user)->where('table_num', $redirect)->where('status_cart', 'Not Deleted')->update('restaurant_cart', $data);
  }

  function updateChargetoRoomamount($amount, $charge_id, $res) {
    $this->db->query('update rooms_checked set restaurant_amount=(restaurant_amount) + "' . $amount . '" ,restaurant_charge="' . $res . '" ,total_balance=(total_balance) + "' . $amount . '" where id_rooms="' . $charge_id . '"');
  }

  function updateChargetoRoomamountcoff($amount, $charge_id, $res) {
    $this->db->query('update rooms_checked set cof_amount=(cof_amount) + "' . $amount . '" ,cof_charge="' . $res . '" ,total_balance=(total_balance) + "' . $amount . '" where id_rooms="' . $charge_id . '"');
  }

  function clearCart($id_reports, $res) {
    $this->db->query('update restaurant_cart set status_cart="Deleted" , id_for_reports="' . $id_reports . '" where table_num="walkin" and deliver_status="Pending" and type_process="' . $res . '" and status_cart="Not Deleted" ');
  }

  function clearCartPerTable($id_reports, $redi, $id_sess, $res) {
    $this->db->query('update restaurant_cart set status_cart="Deleted" , id_for_reports="' . $id_reports . '" where  type_process="' . $res . '" and table_num="' . $redi . '" and status_cart="Not Deleted" and account_process="' . $id_sess . '"');
  }

  function frontdeskclearCart($id_reports, $id_sess, $check_id) {
    $this->db->query('update rooms_checked set id_for_reports="' . $id_reports . '" where type_process="' . $id_sess . '" and check_id="' . $check_id . '"  ');
  }

  function updateReportsRestaurant($product_cart_id, $data) {
    $this->db->where('cart_id', $product_cart_id)->update('all_reports', $data);
  }

  function frontdeskUpdateRoomTypeReserved($id, $data) {
    $this->db->where('id', $id)->update('reserve_room_type', $data);
  }

  function frontdeskblockRoom($id, $data) {
    $this->db->where('id', $id)->update('rooms', $data);
  }

  function updateDateforBookingextend($id, $data) {
    $this->db->where('id', $id)->update('bookings', $data);
  }

  function frondeskUpdateRoomChecked($room_id, $data) {
    $this->db->where('id_rooms', $room_id)->update('rooms_checked', $data);
  }

  function housekeepingChangeStatus($id, $data) {
    $this->db->where('id', $id)->update('rooms', $data);
  }

  function housekeepingChangeStatusDelivered($id, $data) {
    $this->db->where('id_rooms', $id)->update('rooms_checked', $data);
  }

  function updatingTables($id, $data) {
    $this->db->where('id_table', $id)->update('num_tables', $data);
  }

  function coffeeshopupdatingTables($id, $data) {
    $this->db->where('id_table', $id)->update('coffee_tables', $data);
  }

  function frontdeskChangeStatusPaid($check_id) {
    $this->db->query('update check_form set status_payment="Paid" where id="' . $check_id . '"');
  }

  function frontdeskLock($id) {
    $this->db->query('update check_form set status="Locked" where id="' . $id . '"');
  }

  function updateStatusChecked($id, $data) {
    $this->db->where('id', $id)->update('bookings', $data);
  }

  function updateStatusRoomstohousekeeping($check, $room_label) {
    $this->db->where('label', $room_label)->update('rooms_booking', $check);
  }

  function changeStatusOfUsers($id, $data) {
    $this->db->where('id', $id)->update('users', $data);
  }

  function statusGuest($disabled, $guest_id) {
    $this->db->where('guest_id', $guest_id)->update('guests', ['guest_disabled' => $disabled]);
  }

  function updateGuest() {
    $guest_id = $_POST['guest_id'];
    unset($_POST['guest_id']);
    $this->db->where('guest_id', $guest_id)->update('guests', $_POST);
  }

  function changepassword() {
    $password = password_hash($_POST['password'], PASSWORD_BCRYPT);
    $this->db->where('id', $_SESSION['user_id'])->update('users', ['password' => $password]);
  }

  function updateReservationStatus($reservation_status, $booking_id) {
    $this->db->where('booking_id', $booking_id)->update('bookings', ['reservation_status' => $reservation_status]);
  }

  function verifyReservation($booking_number) {
    $this->db->where('booking_number', $booking_number)->update('bookings', ['reservation_status' => 3]);
  }

  function confirm() {
    $booking_id = $_POST['booking_id'];
    unset($_POST['booking_id']);
    $this->db->where('booking_id', $booking_id)->update('bookings', $_POST);
  }

  function updateExtras() {
    $booked_room_id = $_POST['booked_room_id'];
    unset($_POST['booked_room_id']);
    $this->db->where('booked_room_id', $booked_room_id)->update('booked_rooms', $_POST);
  }

  function updateDiscount() {
    $this->db->where('booked_room_id', $_POST['booked_room_id'])->update('booked_rooms', ['discount_id' => $_POST['discount_id']]);
  }
}
