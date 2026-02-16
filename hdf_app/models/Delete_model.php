<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Delete_model extends CI_Model {

  function deleteCategory($category_id) {
    $this->db->where('category_id', $category_id)->delete('categories');
    $this->db->where('category_id', $category_id)->delete('charges');
  }

  function deleteCharge($charge_id) {
    $this->db->where('charge_id', $charge_id)->delete('charges');
  }

  function removeCharge($table, $charge_id) {
    $this->db->where($table . '_id', $charge_id)->delete($table);
  }

  function removeRoom($booked_room_id) {
    $this->db->where('booked_room_id', $booked_room_id)->delete('booked_rooms');
    $this->db->where('booked_room_id', $booked_room_id)->delete('charges_food');
    $this->db->where('booked_room_id', $booked_room_id)->delete('charges_other');
  }

  function deletePayment($booking_payment_id) {
    $this->db->where('booking_payment_id', $booking_payment_id)->delete('booking_payment');
  }

  function deleteRefund($booking_refund_id) {
    $this->db->where('booking_refund_id', $booking_refund_id)->delete('booking_refund');
  }

  function deleteRoom($room_id) {
    $this->db->where('id', $room_id)->delete('rooms');
  }

  function deleteRoomType($room_type_id) {
    $this->db->where('id', $room_type_id)->delete('room_type');
  }

  function deleteDiscount($discount_id) {
    $this->db->where('discount_id', $discount_id)->delete('discounts');
  }
}
