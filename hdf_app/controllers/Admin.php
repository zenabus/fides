<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Admin extends MY_Controller {

  function roomTypes() {
    $data['active'] = 'rooms';
    $data['room_types'] = $this->get_model->getRoomTypes();
    $this->load->view('layout/header', $data);
    $this->load->view('body/admin/room_types');
    $this->load->view('layout/footer');
  }

  function addRoom() {
    $this->insert_model->addRoom();
    $this->session->set_flashdata('success', 'Room successfully added!');
    $this->redirect();
  }

  function deleteRoom($room_id) {
    $this->delete_model->deleteRoom($room_id);
    $this->session->set_flashdata('success', 'Room successfully deleted!');
    $this->redirect();
  }

  function updateRoom() {
    $this->update_model->updateRoom();
    $this->session->set_flashdata('success', 'Room successfully updated!');
    $this->redirect();
  }

  function addRoomType() {
    $this->insert_model->addRoomType();
    $this->session->set_flashdata('success', 'Room type successfully added!');
    $this->redirect();
  }

  function deleteRoomType($room_type_id) {
    $room_type = $this->get_model->getRoomType($room_type_id);
    $old_image = 'assets/img/rooms/' . $room_type->upload_file;
    $this->unlink($old_image);
    $this->delete_model->deleteRoomType($room_type_id);
    $this->session->set_flashdata('success', 'Room type successfully deleted!');
    $this->redirect();
  }

  function updateRoomType() {
    $this->update_model->updateRoomType();
    $this->session->set_flashdata('success', 'Room type successfully updated!');
    $this->redirect();
  }

  function updateRoomImage() {
    $_POST['upload_file'] = $this->uploadImage('image', 'rooms');
    $room_type = $this->get_model->getRoomType($_POST['room_type_id']);
    $old_image = 'assets/img/rooms/' . $room_type->upload_file;

    $this->update_model->updateRoomType();
    $this->unlink($old_image);
    $this->session->set_flashdata('success', 'Room type image successfully updated!');
    $this->redirect();
  }
}
