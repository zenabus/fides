<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Delete_model extends CI_Model {

  function deleteRoomType($id) {
    $this->db->where('id', $id)->delete('room_type');
  }

  function chargeRestoCoffDelete($id) {
    $this->db->where('charge_id', $id)->delete('charges_fo');
  }

  function chargeAmenDelete($id) {
    $this->db->where('amen_id', $id)->delete('charges_amen');
  }

  function deleteDeduction($id) {
    $this->db->where('id_ded', $id)->delete('deduction');
  }

  function coffeedeleteProductRes($id) {
    $this->db->where('id', $id)->delete('product_coffeeshop');
  }

  function deleteReportscoffeeshop($id) {
    $this->db->where('cart_id', $id)->delete('all_reports');
  }

  function coffeeshopdeletecart($id) {
    $this->db->where('id_cart', $id)->delete('coffeeshop_cart');
  }

  function CoffeeshopclearCart() {
    $this->db->query('delete from coffeeshop_cart where table_num="walkin"');
  }

  function deleteProductRes($id) {
    $this->db->where('id', $id)->delete('product_restaurant');
  }
  function deleteRoom($id) {
    $this->db->where('id', $id)->delete('rooms');
  }

  function deleteUsers($id) {
    $this->db->where('id', $id)->delete('users');
  }

  function deletecart($id) {
    $this->db->where('id_cart', $id)->delete('restaurant_cart');
  }

  function coffeeshopclearCartPerTable($id) {
    $this->db->query('delete from coffeeshop_cart where table_num="' . $id . '"');
  }

  function deleteReportsRestaurant($id) {
    $this->db->where('cart_id', $id)->delete('all_reports');
  }

  function frontdeskDeleteRoomTypeReserved($id) {
    $this->db->where('id', $id)->delete('reserve_room_type');
  }

  function frontdeskRoomChecked($id) {
    $this->db->where('id_rooms', $id)->delete('rooms_checked');
  }

  function deleteTables($id) {
    $this->db->where('id_table', $id)->delete('num_tables');
  }

  function coffeeshopdeleteTables($id) {
    $this->db->where('id_table', $id)->delete('coffee_tables');
  }

  function deleteCategory($category_id) {
    $this->db->where('category_id', $category_id)->delete('categories');
  }

  function deleteCharge($charge_id) {
    $this->db->where('charge_id', $charge_id)->delete('charges');
  }

  function removeCharge($table, $booked_room_id) {
    $this->db->where($table . '_id', $booked_room_id)->delete($table);
  }

  function removeRoom($booked_room_id) {
    $this->db->where('booked_room_id', $booked_room_id)->delete('booked_rooms');
    $this->db->where('booked_room_id', $booked_room_id)->delete('charges_food');
    $this->db->where('booked_room_id', $booked_room_id)->delete('charges_other');
  }
}
