<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Housekeeping extends MY_Controller {

  // ------------------------------------------------------------------------------------------------------- //
  // ------------------------------------------------ VIEWS ------------------------------------------------ //
  // ------------------------------------------------------------------------------------------------------- //

  function index() {
    $data = [
      'active' => 'rooms',
      'rooms' => $this->get_model->getRoomsWithRoomType(),
      'room_types' => $this->get_model->getRoomTypes(),
      'guests' => $this->get_model->getGuests(),
    ];

    $this->load->view('layout/header', $data);
    $this->load->view('body/frontdesk/rooms');
    $this->load->view('layout/footer');
  }
}
