<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Housekeeping extends MY_Controller {

  // ------------------------------------------------------------------------------------------------------- //
  // ------------------------------------------------ VIEWS ------------------------------------------------ //
  // ------------------------------------------------------------------------------------------------------- //

  function index() {
    $data['active'] = 'rooms';
    $data['rooms'] = $this->get_model->getRoomsWithRoomType();
    $data['room_types'] = $this->get_model->getRoomTypes();
    $data['guests'] = $this->get_model->getGuests();
    $data['statuses'] = $this->get_model->getRoomStatuses();

    $this->load->view('layout/header', $data);
    $this->load->view('body/frontdesk/rooms');
    $this->load->view('layout/footer');
  }
}
