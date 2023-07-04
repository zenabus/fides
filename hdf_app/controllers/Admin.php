<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Admin extends MY_Controller {

  function __construct() {
    parent::__construct();
    $this->load->vars([
      'cash' => $this->get_model->getCurrentCash(),
      'remitted' => $this->get_model->getRemitted(date_create()->modify('-1 days')->format('Y-m-d'))
    ]);
  }

  function roomTypes() {
    $data['active'] = 'rooms';
    $data['room_types'] = $this->get_model->getRoomTypes();
    $this->load->view('layout/header', $data);
    $this->load->view('body/admin/room_types');
    $this->load->view('layout/footer');
  }

  function charges() {
    $data['active'] = 'charges';
    $data['categories'] = $this->get_model->getCategories();
    $data['charges'] = $this->get_model->getCharges();
    $data['bed'] = $this->get_model->getPrice('Bed');
    $data['person'] = $this->get_model->getPrice('Person');
    $this->load->view('layout/header', $data);
    $this->load->view('body/admin/charges');
    $this->load->view('layout/footer');
  }

  function roomRates() {
    $data['active'] = 'room_rates';
    $data['room_types'] = $this->get_model->getRoomTypes();
    $data['bed'] = $this->get_model->getPrice('Bed');
    $data['person'] = $this->get_model->getPrice('Person');
    $this->load->view('layout/header', $data);
    $this->load->view('body/admin/room_rates');
    $this->load->view('layout/footer');
  }

  function discounts() {
    $data['active'] = 'discounts';
    $data['discounts'] = $this->get_model->getDiscounts();
    $this->load->view('layout/header', $data);
    $this->load->view('body/admin/discounts');
    $this->load->view('layout/footer');
  }

  function users() {
    $data['active'] = 'users';
    $data['users'] = $this->get_model->getUsers();
    foreach ($data['users'] as $i => $user) {
      $data['users'][$i]['last_login_ago'] = $this->timeAgo($user['last_login']);
    }
    $this->load->view('layout/header', $data);
    $this->load->view('body/admin/users');
    $this->load->view('layout/footer');
  }

  function addRoom() {
    $room_type = $this->get_model->getRoomType($_POST['room_type_id']);
    $this->insert_model->addRoom();
    $this->insert_model->log("Added a new {$room_type->room_type}, room #{$_POST['room_number']}", 2);
    $this->session->set_flashdata('success', 'Room successfully added!');
    $this->redirect();
  }

  function deleteRoom($room_id) {
    $room = $this->get_model->getRoom($room_id);
    $this->delete_model->deleteRoom($room_id);
    $this->insert_model->log("Deleted {$room->room_type}, room #{$room->room_number}", 3);
    $this->session->set_flashdata('success', 'Room successfully deleted!');
    $this->redirect();
  }

  function updateRoom() {
    $room_type = $this->get_model->getRoomType($_POST['room_type_id']);
    $this->update_model->updateRoom();
    $this->insert_model->log("Updated {$room_type->room_type}, room #{$_POST['room_number']}", 4);
    $this->session->set_flashdata('success', 'Room successfully updated!');
    $this->redirect();
  }

  function addRoomType() {
    $this->insert_model->addRoomType();
    $this->insert_model->log("Added new room type, {$_POST['room_type']}", 2);
    $this->session->set_flashdata('success', 'Room type successfully added!');
    $this->redirect();
  }

  function deleteRoomType($room_type_id) {
    $room_type = $this->get_model->getRoomType($room_type_id);
    $old_image = 'assets/img/rooms/' . $room_type->upload_file;
    $this->unlink($old_image);
    $this->delete_model->deleteRoomType($room_type_id);
    $this->insert_model->log("Deleted room type, {$room_type->room_type}", 3);
    $this->session->set_flashdata('success', 'Room type successfully deleted!');
    $this->redirect();
  }

  function updateRoomType() {
    $this->update_model->updateRoomType();
    $this->insert_model->log("Updated room type, {$_POST['room_type']}", 4);
    $this->session->set_flashdata('success', 'Room type successfully updated!');
    $this->redirect();
  }

  function updateRoomImage() {
    $_POST['upload_file'] = $this->uploadImage('image', 'rooms');
    $room_type = $this->get_model->getRoomType($_POST['room_type_id']);
    $old_image = 'assets/img/rooms/' . $room_type->upload_file;

    $this->update_model->updateRoomType();
    $this->unlink($old_image);
    $this->insert_model->log("Updated a room type image of {$room_type->room_type}", 4);
    $this->session->set_flashdata('success', 'Room type image successfully updated!');
    $this->redirect();
  }

  function addPayment() {
    $amount = $_POST['payment_amount'];
    $booked_room_id = $_POST['payment_booked_room_id'];
    $_POST['booking_id'] = $_POST['payment_booking_id'];
    $_POST['payment_option'] = $_POST['payment_payment_option'];

    if ($_POST['payment_payment_option'] == 'Cash') {
      $_POST['payment_details'] = '';
    } else {
      $_POST['payment_details'] = $_POST['payment_card_number'];
    }

    $this->insert_model->addPayment('advance', $amount, $booked_room_id);
    $this->insert_model->log("Added a new advance payment to {$_POST['category']}", 2);
    $this->session->set_flashdata('success', 'Advance payment successfully added!');
    $this->redirect();
  }

  function addCategory() {
    $this->insert_model->addCategory();
    $this->insert_model->log("Added a new category, {$_POST['category']}", 2);
    $this->session->set_flashdata('success', 'Category successfully added!');
    $this->redirect();
  }

  function deleteCategory($category_id) {
    $category = $this->get_model->getCategory($category_id);
    $this->delete_model->deleteCategory($category_id);
    $this->insert_model->log("Deleted a category, {$category->category}", 3);
    $this->session->set_flashdata('success', 'Category successfully deleted!');
    $this->redirect();
  }

  function updateCategory() {
    $this->update_model->updateCategory();
    $this->insert_model->log("Updated a category, {$_POST['category']}", 4);
    $this->session->set_flashdata('success', 'Category successfully updated!');
    $this->redirect();
  }

  function addCharge() {
    $amount = number_format($_POST['charge_amount']);
    $this->insert_model->addCharge();
    $this->insert_model->log("Added a new charge, {$_POST['charge']} amounting ₱{$amount}", 2);
    $this->session->set_flashdata('success', 'Charge successfully added!');
    $this->redirect();
  }

  function deleteCharge($charge_id) {
    $charge = $this->get_model->getCharge($charge_id);
    $amount = number_format($charge->charge_amount);
    $this->delete_model->deleteCharge($charge_id);
    $this->insert_model->log("Delete a charge, {$charge->charge} amounting ₱{$amount}", 3);
    $this->session->set_flashdata('success', 'Charge successfully deleted!');
    $this->redirect();
  }

  function updateCharge() {
    $amount = number_format($_POST['charge_amount']);
    $this->update_model->updateCharge();
    $this->insert_model->log("Updated a charge, {$_POST['charge']} amounting ₱{$amount}", 4);
    $this->session->set_flashdata('success', 'Charge successfully updated!');
    $this->redirect();
  }

  function updateExtra() {
    $type = $_POST['price_id'] == 1 ? 'bed' : 'person';
    $this->update_model->updateExtra();
    $this->insert_model->log("Updated price of extra {$type} to {$_POST['price']}", 4);
    $this->session->set_flashdata('success', 'Price of extra successfully updated!');
    $this->redirect();
  }

  function addDiscount() {
    $this->insert_model->addDiscount();
    $this->insert_model->log("Added a new discount, {$_POST['discount_type']} with {$_POST['percentage']}%", 2);
    $this->session->set_flashdata('success', 'Discount successfully added!');
    $this->redirect();
  }

  function deleteDiscount($discount_id) {
    $discount = $this->get_model->getDiscount($discount_id);
    $this->delete_model->deleteDiscount($discount_id);
    $this->insert_model->log("Deleted a discount, {$discount->discount_type} with {$discount->percentage}%", 3);
    $this->session->set_flashdata('success', 'Discount successfully deleted!');
    $this->redirect();
  }

  function updateDiscount() {
    $this->update_model->updateDiscounts();
    $this->insert_model->log("Updated a discount, {$_POST['discount_type']} with {$_POST['percentage']}%", 4);
    $this->session->set_flashdata('success', 'Discount successfully updated!');
    $this->redirect();
  }

  function addUser() {
    $this->insert_model->addUser();
    $this->insert_model->log("Added a new user account for {$_POST['name']}", 2);
    $this->session->set_flashdata('success', 'User successfully added!');
    $this->redirect();
  }

  function changeStatus($user_id, $status) {
    $user = $this->get_model->getUser($user_id);
    $this->update_model->changeStatus($user_id, $status);
    $status = strtolower($status);
    $this->insert_model->log('Updated user status', 4);
    $this->insert_model->log("Updated user status for {$user->name} to {$status}", 4);
    $this->session->set_flashdata('success', "User is now {$status}!");
    $this->redirect();
  }

  function updateUser() {
    $this->update_model->updateUser();
    $this->insert_model->log("Updated user details of {$_POST['name']}", 4);
    $this->session->set_flashdata('success', 'User successfully updated!');
    $this->redirect();
  }

  function resetPassword($user_id) {
    $user = $this->get_model->getUser($user_id);
    $this->update_model->resetPassword($user_id);
    $this->insert_model->log("Reset user password of {$user->name}", 4);
    $this->session->set_flashdata('success', 'User password successfully reset!');
    $this->redirect();
  }
}
