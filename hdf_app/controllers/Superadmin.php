<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Superadmin extends CI_Controller {


  public function index() {
    if ($this->session->userdata('connect') == true);
    $id = $this->session->userdata('user_id');

    $data = array(
      'result_room' => $this->get_model->frontdeskRooms(),
      'result_av' => $this->get_model->frontdeskRommAv(),
      'result_un' => $this->get_model->frontdeskRommUn(),
      'get_user' => $this->get_model->frontdeskGetUserDatails($id),
      'notif' => $this->get_model->housekeepingGetNotif(),
      'room_types' => $this->get_model->getRoomTypes(),
      'rooms' => $this->get_model->getRooms(),
      'count_ar' => $this->get_model->countRoomAvailable(),
      'count_ur' => $this->get_model->countRoomUnAvailable(),

    );
    $this->load->view('body/superadmin/layout/header', $data);
    $this->load->view('body/superadmin/dashboard', $data);
    $this->load->view('body/superadmin/layout/footer');
  }

  ///////////////////////////////////////////
  //Room Types Inserting/ deleting /updating
  //////////////////////////////////////////


  public function roomTypes() {
    if ($this->session->userdata('connect') == true);
    $id = $this->session->userdata('user_id');

    $data['result_roomtype'] = $this->get_model->getRoomTypes();
    $data['get_user'] = $this->get_model->frontdeskGetUserDatails($id);
    $data['notif'] = $this->get_model->adminGetNotif();

    $this->load->view('body/superadmin/layout/header', $data);
    $this->load->view('body/superadmin/add_room_types', $data);
    $this->load->view('body/superadmin/layout/footer');
  }

  public function insertRoomType() {
    if (isset($_FILES['files'])) {
      if ($this->session->userdata('connect') == true);
      # code...
      $id = $this->session->userdata('user_id');

      $name = $_FILES['files']['name'];
      $type = explode('.', $name);
      $type = end($type);
      $size = $_FILES['files']['size'];
      $random_name = rand();
      $tmp = $_FILES['files']['tmp_name'];


      $name = $random_name . '.' . $type;

      move_uploaded_file($tmp, "uploaded_files/" . $name);


      $roomtype = $this->input->post('roomtype');
      $details = $this->input->post('details');
      $amenities = $this->input->post('amenities');
      $person = $this->input->post('persons');


      $data = array(
        'room_type' => $roomtype,
        'details' => $details,
        'upload_file' => $name,
        'amenities' => $amenities,
        'max_persons' => $person

      );
      $this->insert_model->addRoomType($data);


      // Set the success message
      if ($this->session->userdata('connect') == true);
      # code...
      $sess = $this->session->userdata('username');
      $data = array(
        'content' => '' . $sess . ' Created Room Types',
        'user' => $sess,
        'type' => 'Admin',

      );

      $this->insert_model->log($data);
      $this->session->set_flashdata('success', '$$');
      redirect('admin/roomTypes');
    }
    $this->session->set_flashdata('error', '$$');
    redirect('superadmin/roomTypes');
  }

  public function updateRoomtype($id) {
    if ($this->session->userdata('connect') == true);
    $ids = $this->session->userdata('user_id');
    $data = array(
      'result_roomtype' => $this->get_model->getRoomTypes(),
      'notif' => $this->get_model->adminGetNotif(),
      'result_update' => $this->get_model->getUpdateRoomType($id),
      'get_user' => $this->get_model->frontdeskGetUserDatails($ids),
      'notif' => $this->get_model->housekeepingGetNotif(),
    );
    $this->load->view('body/superadmin/layout/header', $data);
    $this->load->view('body/superadmin/update_room_types', $data);
    $this->load->view('body/superadmin/layout/footer');
  }
  public function updatingRoomTypes() {
    $this->form_validation->set_rules('roomtype', 'roomtype', 'required');

    if ($this->form_validation->run() != FALSE) {
      $id = $this->input->post('id');
      $roomtype = $this->input->post('roomtype');
      $details = $this->input->post('details');
      $amenities = $this->input->post('amenities');
      $person = $this->input->post('persons');

      $data = array(
        'room_type' => $roomtype,
        'details' => $details,
        'amenities' => $amenities,
        'max_persons' => $person
      );
      $this->update_model->updateRoomType($id, $data);


      // Set the success message
      $data = array(
        'content' => '' . $sess . ' Updated Room Types',
        'user' => $sess,
        'type' => 'Admin',

      );

      $this->insert_model->log($data);

      if ($this->session->userdata('connect') == true);
      # code...
      $sess = $this->session->userdata('username');
      $data = array(
        'content' => '' . $sess . ' Updated Room Types',
        'user' => $sess,
        'type' => 'Admin',

      );

      $this->insert_model->log($data);
      $this->session->set_flashdata('success', '$$');
      redirect('admin/updateRoomtype/' . $id);
    }
    redirect('superadmin/roomtype/');
  }

  public function updateRoomTypeImage() {
    if (isset($_FILES['files'])) {
      if ($this->session->userdata('connect') == true);
      # code...
      $id = $this->session->userdata('user_id');

      $name = $_FILES['files']['name'];
      $type = explode('.', $name);
      $type = end($type);
      $size = $_FILES['files']['size'];
      $random_name = rand();
      $tmp = $_FILES['files']['tmp_name'];


      $name = $random_name . '.' . $type;

      move_uploaded_file($tmp, "uploaded_files/" . $name);


      $id = $this->input->post('id');

      $data = array(

        'upload_file' => $name,

      );
      $this->update_model->updateRoomType($id, $data);


      // Set the success message
      if ($this->session->userdata('connect') == true);
      # code...
      $sess = $this->session->userdata('username');
      $data = array(
        'content' => '' . $sess . ' Updated the image of Room Type',
        'user' => $sess,
        'type' => 'Admin',

      );

      $this->insert_model->log($data);
      $this->session->set_flashdata('success', '$$');
      redirect('superadmin/updateRoomtype/' . $id);
    }
    $this->session->set_flashdata('error', '$$');
    redirect('superadmin/roomTypes');
  }

  public function deleteRoomType($id) {
    if ($this->session->userdata('connect') == true);
    # code...
    $sess = $this->session->userdata('username');
    $data = array(
      'content' => '' . $sess . ' Deleted Room Types',
      'user' => $sess,
      'type' => 'Admin',
    );

    $this->insert_model->log($data);
    $this->delete_model->deleteRoomType($id);
    $this->session->set_flashdata('success', '$$');
    redirect('superadmin/roomTypes');
  }



  /////////////////////////////////
  // adding updating deleting rooms
  ////////////////////////////////
  public function rooms() {
    if ($this->session->userdata('connect') == true);
    $id = $this->session->userdata('user_id');
    $data = array(
      'result_roomtype' => $this->get_model->getRoomTypes(),
      'notif' => $this->get_model->adminGetNotif(),
      'result_rooms' => $this->get_model->getRoom(),
      'get_user' => $this->get_model->frontdeskGetUserDatails($id)
    );
    $this->load->view('body/superadmin/layout/header', $data);
    $this->load->view('body/superadmin/add_rooms', $data);
    $this->load->view('body/superadmin/layout/footer');
  }

  public function insertRoom() {
    $this->form_validation->set_rules('room_number', 'room_number', 'required');
    $this->form_validation->set_rules('room_type_id', 'room_type_id', 'required');
    $this->form_validation->set_rules('person', 'person', 'required');

    if ($this->form_validation->run() != FALSE) {
      $room_number = $this->input->post('room_number');
      $room_type_id = $this->input->post('room_type_id');
      $person = $this->input->post('person');


      $validate_room_number = $this->db->query('select * from rooms where room_number="' . $room_number . '"');
      $room_num = "";
      if ($validate_room_number->num_rows() > 0) {
        $row = $validate_room_number->row();
        $room_num = $row->room_number;
      }


      if (empty($room_num)) {
        # code...

        $data = array(
          'room_number' => $room_number,
          'room_type_id' => $room_type_id,
          'persons' => $person,
        );
        $this->insert_model->addRoom($data);



        /////////////////////////////////	
        //insert booking
        $room_number = $this->db->query('select * from rooms order by id desc limit 1');
        $id = "";
        $type_id = "";
        $r_num = "";
        if ($room_number->num_rows() > 0) {
          $row = $room_number->row();
          $id = $row->id;
          $type_id = $row->room_type_id;
          $r_num = $row->room_number;
        }


        $data = array(
          'label' => $r_num,
          'type' => $type_id,
          'status' => '1',
          'room_number_id' => $id
        );
        $this->insert_model->addRoomBooking($data);


        ////////////////////////////

        if ($this->session->userdata('connect') == true);
        # code...
        $sess = $this->session->userdata('username');
        $data = array(
          'content' => '' . $sess . ' Created Room',
          'user' => $sess,
          'type' => 'Admin',

        );

        $this->insert_model->log($data);
        $this->session->set_flashdata('success', '$$');

        redirect('admin/rooms');
      } else {
        $this->session->set_flashdata('error', '$$');

        redirect('superadmin/rooms');
      }

      // Set the success message

      redirect('superadmin/rooms');
    }
    redirect('superadmin/rooms');
  }
  public function deleteRoom($id) {
    if ($this->session->userdata('connect') == true);
    # code...
    $sess = $this->session->userdata('username');
    $data = array(
      'content' => '' . $sess . ' Deleted Room',
      'user' => $sess,
      'type' => 'Admin',
    );

    $this->insert_model->log($data);
    $this->delete_model->deleteRoom($id);
    $this->session->set_flashdata('success', '$$');
    redirect('superadmin/rooms');
  }

  public function updateRoom($id) {
    if ($this->session->userdata('connect') == true);
    $ids = $this->session->userdata('user_id');
    $data = array(
      'result_roomtype' => $this->get_model->getRoomTypes(),
      'result_rooms' => $this->get_model->getRoom(),
      'notif' => $this->get_model->adminGetNotif(),
      'result_rooms_by_id' => $this->get_model->getRoomById($id),
      'get_user' => $this->get_model->frontdeskGetUserDatails($ids)
    );
    $this->load->view('body/superadmin/layout/header', $data);
    $this->load->view('body/superadmin/update_room', $data);
    $this->load->view('body/superadmin/layout/footer');
  }

  public function updatingRoom() {
    $this->form_validation->set_rules('room_number', 'room_number', 'required');
    $this->form_validation->set_rules('room_type_id', 'room_type_id', 'required');
    $this->form_validation->set_rules('person', 'person', 'required');

    if ($this->form_validation->run() != FALSE) {
      $id = $this->input->post('id');
      $room_number = $this->input->post('room_number');
      $room_type_id = $this->input->post('room_type_id');
      $person = $this->input->post('person');
      $validate_room_number = $this->db->query('select * from rooms where room_number="' . $room_number . '"');
      $room_num = "";
      if ($validate_room_number->num_rows() > 0) {
        $row = $validate_room_number->row();
        $room_num = $row->room_number;
      }
      if (empty($room_num)) {
        # code...

        $data = array(
          'room_number' => $room_number,
          'room_type_id' => $room_type_id,
          'persons' => $person,
        );
        $this->update_model->updateRoom($id, $data);

        //insert booking
        $room_number = $this->db->query('select * from rooms where id =' . $id . '');
        //$id="";
        $type_id = "";
        $r_num = "";
        if ($room_number->num_rows() > 0) {
          $row = $room_number->row();
          //$id=$row->id; 
          $type_id = $row->room_type_id;
          $r_num = $row->room_number;
        }


        $data = array(
          'label' => $r_num,
          'type' => $type_id,
        );
        $this->update_model->updateRoomBooking($data, $id);
        if ($this->session->userdata('connect') == true);
        # code...
        $sess = $this->session->userdata('username');
        $data = array(
          'content' => '' . $sess . ' Updated the Room',
          'user' => $sess,
          'type' => 'Admin',

        );

        $this->insert_model->log($data);
        $this->session->set_flashdata('success', 'sample');
      } else {
        $this->session->set_flashdata('error', '$$');
      }
      // Set the success message
      redirect('superadmin/rooms');
    }
    redirect('superadmin/rooms');
  }

  ////////////////
  // Create User
  ///////////////

  public function createUser() {
    if ($this->session->userdata('connect') == true);
    $id = $this->session->userdata('user_id');
    $data = array(
      'result_users' => $this->get_model->getUsers(),
      'notif' => $this->get_model->adminGetNotif(),
      'get_user' => $this->get_model->frontdeskGetUserDatails($id)

    );
    $this->load->view('body/superadmin/layout/header', $data);
    $this->load->view('body/superadmin/create_user', $data);
    $this->load->view('body/superadmin/layout/footer');
  }

  public function insertUser() {
    $this->form_validation->set_rules('user_type', 'user_type', 'required');
    $this->form_validation->set_rules('full_name', 'full_name', 'required');
    $this->form_validation->set_rules('contact', 'contact', 'required');
    $this->form_validation->set_rules('email', 'email', 'required');
    $this->form_validation->set_rules('username', 'username', 'required');

    if ($this->form_validation->run() != FALSE) {
      $user_type = $this->input->post('user_type');
      $full_name = $this->input->post('full_name');
      $contact = $this->input->post('contact');
      $email = $this->input->post('email');
      $username = $this->input->post('username');

      $data = array(
        'name' => $full_name,
        'username' => $username,
        'user_type' => $user_type,
        'contact' => $contact,
        'email' => $email,
      );
      $this->insert_model->createUsers($data);
      if ($this->session->userdata('connect') == true);
      # code...
      $sess = $this->session->userdata('username');
      $data = array(
        'content' => '' . $sess . ' Created a User',
        'user' => $sess,
        'type' => 'Admin',

      );

      $this->insert_model->log($data);


      // Set the success message
      $this->session->set_flashdata('success', '$$');
      redirect('superadmin/createUser');
    }
    redirect('superadmin/createUser');
  }

  public function deleteUsers($id) {
    if ($this->session->userdata('connect') == true);
    # code...
    $sess = $this->session->userdata('username');
    $data = array(
      'content' => '' . $sess . ' Deleted User',
      'user' => $sess,
      'type' => 'Admin',
    );

    $this->insert_model->log($data);
    $this->delete_model->deleteUsers($id);
    $this->session->set_flashdata('success', '$$');
    redirect('superadmin/createUser');
  }

  public function updateUser($id) {
    if ($this->session->userdata('connect') == true);
    $ids = $this->session->userdata('user_id');
    $data = array(
      'result_users' => $this->get_model->getUsers(),
      'result_users_id' => $this->get_model->updateUserId($id),
      'notif' => $this->get_model->adminGetNotif(),
      'get_user' => $this->get_model->frontdeskGetUserDatails($ids)
    );
    $this->load->view('body/superadmin/layout/header', $data);
    $this->load->view('body/superadmin/update_user', $data);
    $this->load->view('body/superadmin/layout/footer');
  }
  public function updatingUsers() {
    $this->form_validation->set_rules('user_type', 'user_type', 'required');
    $this->form_validation->set_rules('full_name', 'full_name', 'required');
    $this->form_validation->set_rules('contact', 'contact', 'required');
    $this->form_validation->set_rules('email', 'email', 'required');
    $this->form_validation->set_rules('username', 'username', 'required');
    $this->form_validation->set_rules('password', 'username', 'required');

    if ($this->form_validation->run() != FALSE) {
      $user_type = $this->input->post('user_type');
      $full_name = $this->input->post('full_name');
      $contact = $this->input->post('contact');
      $email = $this->input->post('email');
      $username = $this->input->post('username');
      $password = $this->input->post('password');
      $id = $this->input->post('id');

      $data = array(
        'name' => $full_name,
        'username' => $username,
        'user_type' => $user_type,
        'contact' => $contact,
        'email' => $email,
        'password' => $password,

      );
      $this->update_model->updateUser($data, $id);

      if ($this->session->userdata('connect') == true);
      # code...
      $sess = $this->session->userdata('username');
      $data = array(
        'content' => '' . $sess . ' Updated User',
        'user' => $sess,
        'type' => 'Admin',

      );

      $this->insert_model->log($data);


      // Set the success message
      $this->session->set_flashdata('success', '$$');
      redirect('superadmin/updateUser/' . $id);
    }
    redirect('superadmin/updateUser/' . $id);
  }

  ///////////////////////////////
  ///Pricing //////////////////
  /////////////////////////////


  public function pricing() {
    if ($this->session->userdata('connect') == true);
    $ids = $this->session->userdata('user_id');
    $data = array(
      'result_room' => $this->get_model->getRoomTypes(),
      'result_bed' => $this->get_model->getBed(),
      'result_person' => $this->get_model->getPerson(),
      'notif' => $this->get_model->adminGetNotif(),
      'get_user' => $this->get_model->frontdeskGetUserDatails($ids)
    );
    $this->load->view('body/superadmin/layout/header', $data);
    $this->load->view('body/superadmin/pricing', $data);
    $this->load->view('body/superadmin/layout/footer');
  }

  public function updatePricing() {
    if ($this->session->userdata('connect') == true);
    # code...
    $sess = $this->session->userdata('username');
    $data = array(
      'content' => '' . $sess . ' Updated Pricing',
      'user' => $sess,
      'type' => 'Admin',
    );

    $this->insert_model->log($data);
    $field = $_POST['field'];
    $value = $_POST['value'];
    $editid = $_POST['id'];
    $this->update_model->updatePricingRoomType($field, $value, $editid);
  }

  public function updatePricingBed() {
    if ($this->session->userdata('connect') == true);
    # code...
    $sess = $this->session->userdata('username');
    $data = array(
      'content' => '' . $sess . ' Updated Pricing',
      'user' => $sess,
      'type' => 'Admin',
    );

    $this->insert_model->log($data);
    $field = $_POST['field'];
    $value = $_POST['value'];
    $editid = $_POST['id'];
    $this->update_model->updatePricingBed($field, $value, $editid);
  }

  public function updatePricingPerson() {
    if ($this->session->userdata('connect') == true);
    # code...
    $sess = $this->session->userdata('username');
    $data = array(
      'content' => '' . $sess . ' Updated Pricing',
      'user' => $sess,
      'type' => 'Admin',
    );

    $this->insert_model->log($data);
    $field = $_POST['field'];
    $value = $_POST['value'];
    $editid = $_POST['id'];
    $this->update_model->updatePricingPerson($field, $value, $editid);
  }

  //////// admin product coffeeshop///


  public function CoffeeProduct() {
    if ($this->session->userdata('connect') == true);
    $id = $this->session->userdata('user_id');
    $data = array(
      'result_product_res' => $this->get_model->coffeegetProductRes(),
      'notif' => $this->get_model->adminGetNotif(),
      'get_user' => $this->get_model->frontdeskGetUserDatails($id)
    );
    $this->load->view('body/superadmin/layout/header', $data);
    $this->load->view('body/superadmin/coffeeshop_add_product', $data);
    $this->load->view('body/superadmin/layout/footer');
  }

  public function CoffeeAdd_product() {
    if ($this->session->userdata('connect') == true);
    # code...
    $sess = $this->session->userdata('username');
    $data = array(
      'content' => '' . $sess . ' Added a Product Coffee Shop',
      'user' => $sess,
      'type' => 'Admin',
    );

    $this->insert_model->log($data);
    $product_name = $this->input->post('prod_name');
    $product_price = $this->input->post('prod_price');

    $data = array(
      'product_name' => $product_name,
      'product_cost' => $product_price
    );

    $this->insert_model->CoffeeaddProductRes($data);
    $this->session->set_flashdata('success', '$$');
    redirect('superadmin/CoffeeProduct');
  }

  public function CoffeechnageInactive($id) {
    if ($this->session->userdata('connect') == true);
    # code...
    $sess = $this->session->userdata('username');
    $data = array(
      'content' => '' . $sess . ' Change to Inactive Product (Coffee Shop)',
      'user' => $sess,
      'type' => 'Admin',
    );

    $this->insert_model->log($data);
    $data = array(
      'product_status' => 'Inactive'
    );

    $this->update_model->coffeeupdateProductActive($id, $data);
    $this->session->set_flashdata('success', '$$');
    redirect('superadmin/CoffeeProduct');
  }

  public function CoffeechangeActive($id) {

    if ($this->session->userdata('connect') == true);
    # code...
    $sess = $this->session->userdata('username');
    $data = array(
      'content' => '' . $sess . ' Change to Active Product (Coffee Shop)',
      'user' => $sess,
      'type' => 'Admin',
    );

    $this->insert_model->log($data);
    $data = array(
      'product_status' => 'Active'
    );

    $this->update_model->coffeeupdateProductActive($id, $data);
    $this->session->set_flashdata('success', '$$');
    redirect('superadmin/CoffeeProduct');
  }



  public function CoffeedeleteResProduct($id) {
    if ($this->session->userdata('connect') == true);
    # code...
    $sess = $this->session->userdata('username');
    $data = array(
      'content' => '' . $sess . ' Deleted Product (Coffee Shop)',
      'user' => $sess,
      'type' => 'Admin',
    );

    $this->insert_model->log($data);
    $this->delete_model->coffeedeleteProductRes($id);
    $this->session->set_flashdata('success', '$$');
    redirect('superadmin/CoffeeProduct');
  }

  public function CoffeeupdatePricinResName() {
    if ($this->session->userdata('connect') == true);
    # code...
    $sess = $this->session->userdata('username');
    $data = array(
      'content' => '' . $sess . ' Updated Pricing (Coffee Shop)',
      'user' => $sess,
      'type' => 'Admin',
    );

    $this->insert_model->log($data);
    $field = $_POST['field'];
    $value = $_POST['value'];
    $editid = $_POST['id'];
    $this->update_model->coffeeupdateRestaurant($field, $value, $editid);
  }



  ////////admin product restauran/////

  public function resProduct() {
    if ($this->session->userdata('connect') == true);
    $id = $this->session->userdata('user_id');
    $data = array(
      'result_product_res' => $this->get_model->getProductRes('Restaurant'),
      'notif' => $this->get_model->adminGetNotif(),
      'get_user' => $this->get_model->frontdeskGetUserDatails($id)
    );
    $this->load->view('body/superadmin/layout/header', $data);
    $this->load->view('body/superadmin/restaurant_add_product', $data);
    $this->load->view('body/superadmin/layout/footer');
  }

  public function add_product() {
    $product_name = $this->input->post('prod_name');
    $product_price = $this->input->post('prod_price');

    $data = array(
      'product_name' => $product_name,
      'product_cost' => $product_price
    );

    $this->insert_model->addProductRes($data);
    if ($this->session->userdata('connect') == true);
    # code...
    $sess = $this->session->userdata('username');
    $data = array(
      'content' => '' . $sess . ' Added a Product (Restaurant)',
      'user' => $sess,
      'type' => 'Admin',
    );

    $this->insert_model->log($data);
    $this->session->set_flashdata('success', '$$');
    redirect('superadmin/resProduct');
  }

  public function chnageInactive($id) {
    $data = array(
      'product_status' => 'Inactive'
    );

    $this->update_model->updateProductActive($id, $data);

    if ($this->session->userdata('connect') == true);
    # code...
    $sess = $this->session->userdata('username');
    $data = array(
      'content' => '' . $sess . ' Change to Inactive Product (Restaurant)',
      'user' => $sess,
      'type' => 'Admin',
    );

    $this->insert_model->log($data);
    $this->session->set_flashdata('success', '$$');
    redirect('superadmin/resProduct');
  }

  public function changeActive($id) {
    $data = array(
      'product_status' => 'Active'
    );

    $this->update_model->updateProductActive($id, $data);


    if ($this->session->userdata('connect') == true);
    # code...
    $sess = $this->session->userdata('username');
    $data = array(
      'content' => '' . $sess . ' Change to Active Product (Restaurant)',
      'user' => $sess,
      'type' => 'Admin',
    );

    $this->insert_model->log($data);
    $this->session->set_flashdata('success', '$$');
    redirect('superadmin/resProduct');
  }



  public function deleteResProduct($id) {
    $this->delete_model->deleteProductRes($id);


    if ($this->session->userdata('connect') == true);
    # code...
    $sess = $this->session->userdata('username');
    $data = array(
      'content' => '' . $sess . ' Deleted a Product (Restaurant)',
      'user' => $sess,
      'type' => 'Admin',
    );

    $this->insert_model->log($data);
    $this->session->set_flashdata('success', '$$');
    redirect('superadmin/resProduct');
  }

  public function updatePricinResName() {

    if ($this->session->userdata('connect') == true);
    # code...
    $sess = $this->session->userdata('username');
    $data = array(
      'content' => '' . $sess . ' Updated Product Name(Restaurant)',
      'user' => $sess,
      'type' => 'Admin',
    );

    $this->insert_model->log($data);
    $field = $_POST['field'];
    $value = $_POST['value'];
    $editid = $_POST['id'];
    $this->update_model->updateRestaurant($field, $value, $editid);
  }

  /////////////////////////////////////////
  ////    Deductions	               //////
  ////////////////////////////////////////	
  public function deduction() {
    if ($this->session->userdata('connect') == true);
    $id = $this->session->userdata('user_id');
    $data = array(
      'result_deduction' => $this->get_model->getDeduction(),
      'notif' => $this->get_model->adminGetNotif(),
      'get_user' => $this->get_model->frontdeskGetUserDatails($id)
    );
    $this->load->view('body/superadmin/layout/header', $data);
    $this->load->view('body/superadmin/deduction', $data);
    $this->load->view('body/superadmin/layout/footer');
  }

  public function insertDeductions() {
    $name = $this->input->post('name');
    $percent = $this->input->post('percent');

    $data = array(
      'name' => $name,
      'deduction' => $percent,
    );
    $this->insert_model->addDeduction($data);


    if ($this->session->userdata('connect') == true);
    # code...
    $sess = $this->session->userdata('username');
    $data = array(
      'content' => '' . $sess . ' Created a Deduction',
      'user' => $sess,
      'type' => 'Admin',
    );

    $this->insert_model->log($data);
    $this->session->set_flashdata('success', '$$');
    redirect('superadmin/deduction');
  }

  public function deleteDeduction($id) {
    if ($this->session->userdata('connect') == true);
    # code...
    $sess = $this->session->userdata('username');
    $data = array(
      'content' => '' . $sess . ' Deleted a Deduction',
      'user' => $sess,
      'type' => 'Admin',
    );

    $this->insert_model->log($data);
    $this->delete_model->deleteDeduction($id);
    $this->session->set_flashdata('success', '$$');
    redirect('superadmin/deduction');
  }

  public function Updatededuction($id) {
    if ($this->session->userdata('connect') == true);
    $ids = $this->session->userdata('user_id');
    $data = array(
      'result_deduction' => $this->get_model->getDeduction(),
      'result_deduction_id' => $this->get_model->getDeductionById($id),
      'notif' => $this->get_model->adminGetNotif(),
      'get_user' => $this->get_model->frontdeskGetUserDatails($ids)
    );
    $this->load->view('body/superadmin/layout/header', $data);
    $this->load->view('body/superadmin/update_deduction', $data);
    $this->load->view('body/superadmin/layout/footer');
  }

  public function updatingDeductions() {
    $name = $this->input->post('name');
    $percent = $this->input->post('percent');
    $id = $this->input->post('id');

    $data = array(
      'name' => $name,
      'deduction' => $percent,
    );
    $this->update_model->updateDeduction($id, $data);
    if ($this->session->userdata('connect') == true);
    # code...
    $sess = $this->session->userdata('username');
    $data = array(
      'content' => '' . $sess . ' Updating Deduction',
      'user' => $sess,
      'type' => 'Admin',
    );

    $this->insert_model->log($data);
    $this->session->set_flashdata('success', '$$');
    redirect('superadmin/Updatededuction/' . $id);
  }


  public function Profile() {
    if ($this->session->userdata('connect') == true);
    $id = $this->session->userdata('user_id');
    $data = array(
      'get_user' => $this->get_model->frontdeskGetUserDatails($id),
      'notif' => $this->get_model->adminGetNotif(),

    );
    $this->load->view('body/superadmin/layout/header', $data);
    $this->load->view('body/superadmin/userprofile', $data);
    $this->load->view('body/superadmin/layout/footer');
  }

  public function UploadImage() {
    if (isset($_FILES['files'])) {
      if ($this->session->userdata('connect') == true);
      # code...
      $id = $this->session->userdata('user_id');

      $name = $_FILES['files']['name'];
      $type = explode('.', $name);
      $type = end($type);
      $size = $_FILES['files']['size'];
      $random_name = rand();
      $tmp = $_FILES['files']['tmp_name'];


      $name = $random_name . '.' . $type;

      move_uploaded_file($tmp, "uploaded_files/" . $name);

      $data = array(
        'image_source' => $name
      );
      $this->update_model->updateUser($data, $id);

      if ($this->session->userdata('connect') == true);
      # code...
      $sess = $this->session->userdata('username');
      $data = array(
        'content' => '' . $sess . ' Updated Image',
        'user' => $sess,
        'type' => 'Admin',

      );

      $this->insert_model->log($data);


      // Set the success message
      $this->session->set_flashdata('success', '$$');
      redirect('superadmin/Profile/');
    }
    $this->session->set_flashdata('error', '$$');
    redirect('superadmin/Profile/');
  }

  public function UpdateProfileDetails() {

    if ($this->session->userdata('connect') == true);
    # code...
    $id = $this->session->userdata('user_id');
    $full_name = $this->input->post('full_name');
    $contact = $this->input->post('contact');
    $email = $this->input->post('email');
    $username = $this->input->post('username');
    $password = $this->input->post('password');


    $data = array(
      'name' => $full_name,
      'username' => $username,
      'contact' => $contact,
      'email' => $email,
      'password' => $password,

    );
    $this->update_model->updateUser($data, $id);
    if ($this->session->userdata('connect') == true);
    # code...
    $sess = $this->session->userdata('username');
    $data = array(
      'content' => '' . $sess . ' Updated Details',
      'user' => $sess,
      'type' => 'Admin',
    );

    $this->insert_model->log($data);


    // Set the success message
    $this->session->set_flashdata('success', '$$');
    redirect('superadmin/Profile/' . $id);
  }

  public function createTables() {
    if ($this->session->userdata('connect') == true);
    $id = $this->session->userdata('user_id');
    $data = array(
      'result_table' => $this->get_model->getTables(),
      'notif' => $this->get_model->adminGetNotif(),
      'get_user' => $this->get_model->frontdeskGetUserDatails($id)
    );
    $this->load->view('body/superadmin/layout/header', $data);
    $this->load->view('body/superadmin/add_table', $data);
    $this->load->view('body/superadmin/layout/footer');
  }

  public function UpdateTables($id) {
    if ($this->session->userdata('connect') == true);
    $ids = $this->session->userdata('user_id');
    $data = array(
      'result_table' => $this->get_model->getTables(),
      'notif' => $this->get_model->adminGetNotif(),
      'result_by_id' => $this->get_model->updategetTables($id),
      'get_user' => $this->get_model->frontdeskGetUserDatails($ids)
    );

    // echo "<pre>"; print_r(var_dump($data['getuser']));die;
    $this->load->view('body/superadmin/layout/header', $data);
    $this->load->view('body/superadmin/update_table', $data);
    $this->load->view('body/superadmin/layout/footer');
  }


  public function InsertTable() {
    $table = $this->input->post('table_num');


    $validate_table_number = $this->db->query('select * from num_tables where table_number="' . $table . '"');
    $table_num = "";
    if ($validate_table_number->num_rows() > 0) {
      $row = $validate_table_number->row();
      $table_num = $row->table_number;
    }
    if (empty($table_num)) {
      # code...


      $data = array(
        'table_number' => $table
      );
      $this->insert_model->createTable($data);
      if ($this->session->userdata('connect') == true);
      # code...
      $sess = $this->session->userdata('username');
      $data = array(
        'content' => '' . $sess . ' Created a Table',
        'user' => $sess,
        'type' => 'Admin',

      );

      $this->insert_model->log($data);

      $this->session->set_flashdata('success', '$$');
    } else {

      $this->session->set_flashdata('error', '$$');
    }

    redirect('superadmin/createTables/');
  }

  public function UpdatingTable() {
    $table = $this->input->post('table_num');
    $id = $this->input->post('id');

    $validate_table_number = $this->db->query('select * from num_tables where table_number="' . $table . '"');
    $table_num = "";
    if ($validate_table_number->num_rows() > 0) {
      $row = $validate_table_number->row();
      $table_num = $row->table_number;
    }

    if (empty($table_num)) {
      # code...
      $data = array(
        'table_number' => $table
      );
      $this->update_model->updatingTables($id, $data);

      if ($this->session->userdata('connect') == true);
      # code...
      $sess = $this->session->userdata('username');
      $data = array(
        'content' => '' . $sess . ' Updated the table',
        'user' => $sess,
        'type' => 'Admin',

      );

      $this->insert_model->log($data);
      $this->session->set_flashdata('success', '$$');
    } else {
      $this->session->set_flashdata('error', '$$');
    }
    redirect('superadmin/UpdateTables/' . $id);
  }

  public function deleteTables($id) {
    if ($this->session->userdata('connect') == true);
    # code...
    $sess = $this->session->userdata('username');
    $data = array(
      'content' => '' . $sess . ' Deleted A tables',
      'user' => $sess,
      'type' => 'Admin',
    );

    $this->insert_model->log($data);
    $this->delete_model->deleteTables($id);
    $this->session->set_flashdata('success', '$$');
    redirect('superadmin/createTables');
  }

  /////////
  //Tables//
  /////////

  public function coffeeshopcreateTables() {
    if ($this->session->userdata('connect') == true);
    $id = $this->session->userdata('user_id');
    $data = array(
      'result_table' => $this->get_model->coffeeshopgetTables(),
      'notif' => $this->get_model->adminGetNotif(),
      'get_user' => $this->get_model->frontdeskGetUserDatails($id)
    );
    $this->load->view('body/superadmin/layout/header', $data);
    $this->load->view('body/superadmin/add_table_coffeeshop', $data);
    $this->load->view('body/superadmin/layout/footer');
  }

  public function coffeeshopUpdateTables($id) {
    if ($this->session->userdata('connect') == true);
    $ids = $this->session->userdata('user_id');
    $data = array(
      'result_table' => $this->get_model->coffeeshopgetTables(),
      'result_by_id' => $this->get_model->coffeeshopupdategetTables($id),
      'notif' => $this->get_model->adminGetNotif(),
      'get_user' => $this->get_model->frontdeskGetUserDatails($ids)
    );
    $this->load->view('body/superadmin/layout/header', $data);
    $this->load->view('body/superadmin/update_table_coffeeshop', $data);
    $this->load->view('body/superadmin/layout/footer');
  }


  public function coffeeshopInsertTable() {
    $table = $this->input->post('table_num');
    $data = array(
      'table_number' => $table
    );
    $this->insert_model->coffeeshopcreateTable($data);

    if ($this->session->userdata('connect') == true);
    # code...
    $sess = $this->session->userdata('username');
    $data = array(
      'content' => '' . $sess . ' Created a Table (Coffee Shop)',
      'user' => $sess,
      'type' => 'Admin',
    );

    $this->insert_model->log($data);
    $this->session->set_flashdata('success', '$$');
    redirect('superadmin/coffeeshopcreateTables/');
  }

  public function coffeeshopUpdatingTable() {
    $table = $this->input->post('table_num');
    $id = $this->input->post('id');
    $data = array(
      'table_number' => $table
    );
    $this->update_model->coffeeshopupdatingTables($id, $data);

    if ($this->session->userdata('connect') == true);
    # code...
    $sess = $this->session->userdata('username');
    $data = array(
      'content' => '' . $sess . ' Updated a Table (Coffee Shop)',
      'user' => $sess,
      'type' => 'Admin',
    );

    $this->insert_model->log($data);
    $this->session->set_flashdata('success', '$$');
    redirect('superadmin/coffeeshopcreateTables/' . $id);
  }

  public function coffeeshopdeleteTables($id) {
    if ($this->session->userdata('connect') == true);
    # code...
    $sess = $this->session->userdata('username');
    $data = array(
      'content' => '' . $sess . ' Deleted a Table (Coffee Shop)',
      'user' => $sess,
      'type' => 'Admin',
    );

    $this->insert_model->log($data);
    $this->delete_model->coffeeshopdeleteTables($id);
    $this->session->set_flashdata('success', '$$');
    redirect('superadmin/coffeeshopcreateTables');
  }

  public function activitylogs() {
    if ($this->session->userdata('connect') == true);
    $id = $this->session->userdata('user_id');
    $data = array(
      'result_logs' => $this->get_model->logs_activity(),
      'notif' => $this->get_model->adminGetNotif(),
      'get_user' => $this->get_model->frontdeskGetUserDatails($id)
    );
    $this->load->view('body/superadmin/layout/header', $data);
    $this->load->view('body/superadmin/activity_logs', $data);
    $this->load->view('body/superadmin/layout/footer');
  }

  public function userlogs() {
    if ($this->session->userdata('connect') == true);
    $id = $this->session->userdata('user_id');
    $data = array(
      'result_logs' => $this->get_model->insertEvent(),
      'notif' => $this->get_model->adminGetNotif(),
      'get_user' => $this->get_model->frontdeskGetUserDatails($id)
    );
    $this->load->view('body/superadmin/layout/header', $data);
    $this->load->view('body/superadmin/userlogs', $data);
    $this->load->view('body/superadmin/layout/footer');
  }

  public function reports() {
    if ($this->session->userdata('connect') == true);
    $id = $this->session->userdata('user_id');
    $data = array(
      'result_logs' => $this->get_model->insertEvent(),
      'notif' => $this->get_model->adminGetNotif(),
      'get_user' => $this->get_model->frontdeskGetUserDatails($id)
    );
    $this->load->view('body/superadmin/layout/header', $data);
    $this->load->view('body/superadmin/reports');
    $this->load->view('body/superadmin/layout/footer');
  }

  public function viewReports() {
    if ($this->session->userdata('connect') == true);
    $id = $this->session->userdata('user_id');

    $from = $this->input->post('from');
    $to = $this->input->post('to');
    $user_type = $this->input->post('user_type');





    if ($user_type == 'Front Desk') {
      $data = array(
        'user' => $user_type,
        'from' => $from,
        'to' => $to,
        'result' => $this->get_model->ViewreportsFrontdesk($from, $to),
        'total_result' => $this->get_model->ViewReportsTotalFrontdesk($from, $to)
      );

      $this->load->view('body/superadmin/pdfReportsFrontdesk', $data);
    } else {
      $data = array(
        'user' => $user_type,
        'from' => $from,
        'to' => $to,
        'result' => $this->get_model->Viewreports($from, $to, $user_type),
        'total_result' => $this->get_model->ViewReportsTotal($from, $to, $user_type)
      );
      $this->load->view('body/superadmin/pdfReports', $data);
    }
  }

  public function transactions() {
    if ($this->session->userdata('connect') == true);
    # code...
    $sess = $this->session->userdata('username');
    if ($this->session->userdata('connect') == true);
    $id = $this->session->userdata('user_id');
    $data = array(

      'get_user' => $this->get_model->frontdeskGetUserDatails($id),
      'result' => $this->get_model->reportTransactionsAdmin(),
    );
    $this->load->view('body/superadmin/layout/header', $data);
    $this->load->view('body/superadmin/transaction', $data);
    $this->load->view('body/superadmin/layout/footer');
  }


  public function printRecieptRestaurant($id_reports) {
    if ($this->session->userdata('connect') == true);
    $sess = $this->session->userdata('username');
    $id = $this->session->userdata('user_id');
    $reports = $this->db->query('select * from all_reports where id_reports="' . $id_reports . '" order by id_reports desc limit 1');
    $id_reports = "";
    $view = "";
    $give = "";
    $card = "";
    $acc  = "";
    $res = "";


    if ($reports->num_rows() > 0) {
      $row = $reports->row();
      $id_reports = $row->id_reports;
      $view = $row->view_reciept;
      $give = $row->amount_give;
      $card = $row->card_number;
      $acc = $row->account_process;
      $res = $row->type_process;
    }


    $data = array(
      'content' => '' . $sess . ' Printed a Reciept',
      'user' => $sess,
      'type' => 'Housekeeping',

    );

    $this->insert_model->log($data);
    $data = array(
      'id_reports' => $id_reports,
      'account' => $sess,
      'amount_give' => $give,
      'card_number' => $card,
      'result_product_name' => $this->get_model->getProductRes($res),
      'product_cart_receipt' => $this->get_model->AdmingetDataCartReciept($id_reports, $res),
      'total_amount_receipt' => $this->get_model->ADminrestaurantTotalBalanceReciept($id_reports),
    );
    $this->load->view('body/restaurant/print_process', $data);
  }

  public function printRecieptRestaurantPerTable($str) {
    $string = explode('M', $str);

    $id_reports = $string[0];
    $id = $string[1];
    if ($this->session->userdata('connect') == true);
    $sess = $this->session->userdata('username');
    // $id = $this->session->userdata('user_id');
    $reports = $this->db->query('select * from all_reports where id_reports="' . $id_reports . '" order by id_reports desc limit 1');
    $id_reports = "";
    $view = "";
    $give = "";
    $card = "";
    $acc  = "";
    $res = "";

    if ($reports->num_rows() > 0) {
      $row = $reports->row();
      $id_reports = $row->id_reports;
      $view = $row->view_reciept;
      $give = $row->amount_give;
      $card = $row->card_number;
      $acc = $row->account_process;
      $res = $row->type_process;
    }


    $data = array(
      'content' => '' . $sess . ' Printed a Reciept',
      'user' => $sess,
      'type' => 'Restaurant',

    );

    $this->insert_model->log($data);
    $data = array(
      'id_reports' => $id_reports,
      'account' => $sess,
      'amount_give' => $give,
      'card_number' => $card,
      'result_product_name' => $this->get_model->getProductRes($res),
      'product_cart_receipt' => $this->get_model->AdmingetDataCartRecieptpertable($id_reports, $id),
      'total_amount_receipt' => $this->get_model->AdminrestaurantTotalBalanceRecieptpertable($id_reports, $id),

    );
    $this->load->view('body/restaurant/print_per_table', $data);
  }


  public function cancelBooking() {
    if ($this->session->userdata('connect') == true);
    $id = $this->session->userdata('user_id');

    ///$data['result_roomtype'] = $this->get_model->getRoomTypes(); 
    $data['get_user'] = $this->get_model->frontdeskGetUserDatails($id);
    $data['notif'] = $this->get_model->adminGetNotif();

    $list = array(
      'result' => $this->get_model->viewAllBookings()
    );

    $this->load->view('body/superadmin/layout/header', $data);
    $this->load->view('body/admin/cancel_booking', $list);
    $this->load->view('body/admin/layout/footer');
  }

  public function cancelBookingProcess($id) {
    if ($this->session->userdata('connect') == true);
    $sess = $this->session->userdata('username');

    $this->db->query('delete from bookings where id ="' . $id . '"');
    $this->db->query('delete from rooms_checked where connect_check="' . $id . '"');
    $this->db->query('delete from check_form where connect_booking="' . $id . '"');

    $data = array(
      'content' => '' . $sess . ' canceled the Booking',
      'user' => $sess,
      'type' => 'Admin',
    );

    $this->insert_model->log($data);
    $this->session->set_flashdata('success', '$$');
    redirect('superadmin/cancelBooking/');
  }
}
