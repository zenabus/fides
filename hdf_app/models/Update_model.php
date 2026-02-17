<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Update_model extends CI_Model {

  function dd($data) {
    echo "<pre>";
    print_r(var_dump($data));
    die;
  }

  function updateProfile($user_id = NULL) {
    if (!$user_id) {
      $user_id = $_SESSION['user_id'];
      $_SESSION['name'] = $_POST['name'];
    }
    $_SESSION['name'] = $_POST['name'];
    $this->db->where('id', $user_id)->update('users', $_POST);
  }

  function updateImage($image) {
    $this->db->where('id', $_SESSION['user_id'])->update('users', ['image_source' => $image]);
  }

  function statusGuest($disabled, $guest_id) {
    $this->db->where('guest_id', $guest_id)->update('guests', ['guest_disabled' => $disabled]);
  }

  function updateGuest() {
    $guest_id = $_POST['guest_id'];
    unset($_POST['guest_id']);
    unset($_POST['booking_number']);
    unset($_POST['booking_id']);
    unset($_POST['room_id']);
    $this->db->where('guest_id', $guest_id)->update('guests', $_POST);
  }

  function updateGuestName() {
    $data = [
      'first_name' => $_POST['first_name'],
      'middle_name' => $_POST['middle_name'],
      'last_name' => $_POST['last_name'],
      'suffix' => $_POST['suffix'],
      'contact' => $_POST['contact']
    ];
    $this->db->where('guest_id', $_POST['guest_id'])->update('guests', $data);
  }

  function updateGuestFromReservation() {
    $data = [
      'first_name' => $_POST['first_name'],
      'middle_name' => $_POST['middle_name'],
      'last_name' => $_POST['last_name'],
      'contact' => $_POST['contact'],
      'suffix' => $_POST['suffix'],
    ];
    $this->db->where('guest_id', $_POST['guest_id'])->update('guests', $data);
  }

  function trimGuests() {
    $this->db->query("UPDATE guests SET first_name = TRIM(first_name), middle_name = TRIM(middle_name), last_name = TRIM(last_name), contact = TRIM(contact), email = TRIM(email) WHERE TRIM(first_name) != first_name OR TRIM(middle_name) != middle_name OR TRIM(last_name) != last_name OR TRIM(contact) != contact OR TRIM(email) != email");
  }

  function changepassword() {
    $password = password_hash($_POST['password'], PASSWORD_BCRYPT);
    $this->db->where('id', $_SESSION['user_id'])->update('users', ['password' => $password]);
  }

  function updateReservationStatus($reservation_status, $booking_id) {
    $this->db->where('booking_id', $booking_id)->update('bookings', ['reservation_status' => $reservation_status]);
  }

  function updateNotes() {
    $data = ['remarks' => $_POST['remarks']];
    $this->db->where('booking_id', $_POST['booking_id'])->update('bookings', $data);
  }

  function updateRequest() {
    $data = ['request' => $_POST['request']];
    $this->db->where('booking_id', $_POST['booking_id'])->update('bookings', $data);
  }

  function updateExtras() {
    $booked_room_id = $_POST['booked_room_id'];
    unset($_POST['booked_room_id']);
    $this->db->where('booked_room_id', $booked_room_id)->update('booked_rooms', $_POST);
  }

  function updateDiscount() {
    $this->db->where('booked_room_id', $_POST['booked_room_id'])->update('booked_rooms', ['discount_id' => $_POST['discount_id']]);
  }

  function toDashedDate($date) {
    [$month, $day, $year] = explode('/', $date);
    return $year . '-' . $month . '-' . $day;
  }

  function changeRoom() {
    $booked_room_id = $_POST['booked_room_id'];
    unset($_POST['booked_room_id']);
    $_POST['c_in'] = $this->toDashedDate($_POST['check_in']);
    $_POST['c_out'] = $this->toDashedDate($_POST['check_out']);
    $_POST['dates'] = json_encode(datesBetween($_POST['check_in'], $_POST['check_out'], 'Y-m-d'));
    $this->db->where('booked_room_id', $booked_room_id)->update('booked_rooms', $_POST);
  }

  function changeRoomAjax($post) {
    $booked_room_id = $post['booked_room_id'];
    unset($post['booked_room_id']);
    $post['c_in'] = $this->toDashedDate($post['check_in']);
    $post['c_out'] = $this->toDashedDate($post['check_out']);
    $_POST['dates'] = json_encode(datesBetween($post['check_in'], $post['check_out'], 'Y-m-d'));
    $this->db->where('booked_room_id', $booked_room_id)->update('booked_rooms', $post);
  }

  function updateCategory() {
    $category_id = $_POST['category_id'];
    unset($_POST['category_id']);
    $this->db->where('category_id', $category_id)->update('categories', $_POST);
  }

  function updateCharge() {
    $charge_id = $_POST['charge_id'];
    unset($_POST['charge_id']);
    $this->db->where('charge_id', $charge_id)->update('charges', $_POST);
  }

  function removeExtra($column, $booked_room_id) {
    $this->db->where('booked_room_id', $booked_room_id)->update('booked_rooms', [$column => 0]);
  }

  function updateOccupant($occupant) {
    $this->db->where('booked_room_id', $_POST['booked_room_id'])->update('booked_rooms', ['occupant' => $occupant]);
  }

  function updateRoom() {
    $room_id = $_POST['room_id'];
    unset($_POST['room_id']);
    $this->db->where('id', $room_id)->update('rooms', $_POST);
  }

  function updateRoomType() {
    $room_type_id = $_POST['room_type_id'];
    unset($_POST['room_type_id']);
    $this->db->where('id', $room_type_id)->update('room_type', $_POST);
  }

  function updateExtra() {
    $this->db->where('price_id', $_POST['price_id'])->update('prices', ['price' => $_POST['price']]);
  }

  function updateDiscounts() {
    $discount_id = $_POST['discount_id'];
    unset($_POST['discount_id']);
    if (isset($_POST['using_formula'])) {
      $_POST['using_formula'] = 1;
    } else {
      $_POST['using_formula'] = 0;
    }
    $this->db->where('discount_id', $discount_id)->update('discounts', $_POST);
  }

  function updateUser() {
    $user_id = $_POST['user_id'];
    unset($_POST['user_id']);
    unset($_POST['password']);
    $this->db->where('id', $user_id)->update('users', $_POST);
  }

  function changeStatus($user_id, $status) {
    $this->db->where('id', $user_id)->update('users', ['status' => $status]);
  }

  function resetPassword($user_id) {
    $password = password_hash('hdf2022', PASSWORD_BCRYPT);
    $this->db->where('id', $user_id)->update('users', ['password' => $password]);
  }

  function updateLogin() {
    $this->db->where('id', $_SESSION['user_id'])->update('users', ['last_login' => date('Y-m-d H:i:s')]);
  }

  function updateCheckIn($guest_id) {
    $this->db->where('guest_id', $guest_id)->update('guests', ['last_checkin' => date('Y-m-d H:i:s')]);
  }

  function updateBooking($arrival, $departure, $booking_id) {
    $this->db->where('booking_id', $booking_id)->update('bookings', ['arrival' => $arrival, 'departure' => $departure]);
  }

  function updateReservation() {
    $booking_id = $_POST['booking_id'];
    unset($_POST['booking_id']);
    $data = [
      'reservation_type' => $_POST['reservation_type'],
      'request' => $_POST['request'],
      'remarks' => $_POST['remarks']
    ];

    $this->db->where('booking_id', $booking_id)->update('bookings', $data);
  }

  function updateReason() {
    $this->db->where('booking_id', $_POST['booking_id'])->update('bookings', ['cancel_reason' => $_POST['cancel_reason']]);
  }

  function updateBookedRoomNights() {
    $data = [
      'nights' => $_POST['nights'],
      'check_in' => $_POST['check_in'],
      'check_out' => $_POST['check_out'],
      'c_in' => $this->toDashedDate($_POST['check_in']),
      'c_out' => $this->toDashedDate($_POST['check_out']),
      'dates' => json_encode($this->datesBetween($_POST['check_in'], $_POST['check_out'], 'Y-m-d'))
    ];
    $this->db->where('room_id', $_POST['room_id'])
      ->where('booking_id', $_POST['booking_id'])
      ->update('booked_rooms', $data);
  }

  function processRoom($booked_room_id, $archive, $early = FALSE) {
    $data = [
      'booked_room_archived' => $archive,
      'process_reason' => $_POST['process_reason'],
      'processed_by' => $_SESSION['name']
    ];
    if ($early) {
      $data['early_check_out'] = $_POST['today'];
    }
    $this->db->where('booked_room_id', $booked_room_id)->update('booked_rooms', $data);
    if ($archive != 2) {
      $this->db->where('booked_room_id', $booked_room_id)->delete('charges_food');
      $this->db->where('booked_room_id', $booked_room_id)->delete('charges_other');
    }
  }

  function updateRoomStatus() {
    $data = [
      'room_status_id' => $_POST['room_status_id'],
      'last_updated_by' => $_SESSION['name'],
    ];
    $this->db->where('id', $_POST['room_id'])->update('rooms', $data);
  }

  function chargeTo() {
    $this->db->where('booking_id', $_POST['booking_id'])->update('bookings', ['charged_to' => $_POST['guest_id']]);
  }

  function updateBookedRoomDates($booked_room_id, $data) {
    $this->db->where('booked_room_id', $booked_room_id)->update('booked_rooms', $data);
  }
}
