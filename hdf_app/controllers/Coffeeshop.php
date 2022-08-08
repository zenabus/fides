<?php
defined('BASEPATH') or exit('No direct script access allowed');

class coffeeshop extends CI_Controller {


  /////////////////////////////////////////////
  //// restauran /////////////////////////////
  /////////////////////////////////////////	 


  public function coffeeshopDashboard() {
    if ($this->session->userdata('connect') == true);
    # code...
    $sess = $this->session->userdata('username');
    if ($this->session->userdata('connect') == true);
    $id = $this->session->userdata('user_id');
    $data = array(

      'get_user' => $this->get_model->frontdeskGetUserDatails($id)
    );
    $this->load->view('body/coffeeshop/layout/header', $data);
    $this->load->view('body/coffeeshop/dashboard');
    $this->load->view('body/coffeeshop/layout/footer');
  }
  public function coffeeshopProfile() {
    if ($this->session->userdata('connect') == true);
    # code...
    $id = $this->session->userdata('user_id');
    $data = array(
      'get_user' => $this->get_model->frontdeskGetUserDatails($id),


    );
    $this->load->view('body/coffeeshop/layout/header', $data);
    $this->load->view('body/coffeeshop/userprofile', $data);
    $this->load->view('body/coffeeshop/layout/footer');
  }

  public function coffeeshopUploadImage() {
    if ($this->session->userdata('connect') == true);
    # code...
    $sess = $this->session->userdata('username');
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

      $data = array(
        'content' => '' . $sess . ' Updated Picture',
        'user' => $sess,
        'type' => 'Restaurant',

      );

      $this->insert_model->log($data);

      // Set the success message
      $this->session->set_flashdata('success', '$$');
      redirect('main/RestaurantProfile/');
    }
    $this->session->set_flashdata('error', '$$');
    redirect('main/HousekeepingProfile/');
  }


  public function coffeeshopUpdateProfileDetails() {
    if ($this->session->userdata('connect') == true);
    # code...
    $sess = $this->session->userdata('username');

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
    $data = array(
      'content' => '' . $sess . ' Updated Details',
      'user' => $sess,
      'type' => 'Restaurant',

    );

    $this->insert_model->log($data);


    // Set the success message
    $this->session->set_flashdata('success', '$$');
    redirect('main/coffeeshopProfile/' . $id);
  }
  public function PerTable() {

    if ($this->session->userdata('connect') == true);
    $id = $this->session->userdata('user_id');
    $data = array(
      'result_table' => $this->get_model->getTables(),

      'get_user' => $this->get_model->frontdeskGetUserDatails($id)
    );
    $this->load->view('body/coffeeshop/layout/header', $data);
    $this->load->view('body/coffeeshop/pertable', $data);
    $this->load->view('body/coffeeshop/layout/footer');
  }

  public function PerTableProcess($id) {
    if ($this->session->userdata('connect') == true);
    $ids = $this->session->userdata('user_id');
    $data = array(
      'id' => $id,
      'result_name' => $this->get_model->getTablesbyId($id),
      'result_product_name' => $this->get_model->getProductRes(),
      'product_cart' => $this->get_model->getDataCartbyTable($id),
      'product_cart_deleted' => $this->get_model->getDataCartDeliveredPertable($id),
      'result_deduction' => $this->get_model->frontdeskgetDeduction(),
      'total_amount' => $this->get_model->restaurantTotalBalancePerTable($id),
      'get_user' => $this->get_model->frontdeskGetUserDatails($ids)



    );

    $this->load->view('body/coffeeshop/layout/header', $data);
    $this->load->view('body/coffeeshop/table_process', $data);
    $this->load->view('body/coffeeshop/layout/footer');
  }

  public function PerTableadddeductioncoffeeshop() {
    if ($this->session->userdata('connect') == true);
    # code...
    $sess = $this->session->userdata('username');

    $redirect = $this->input->post('redirect');
    $deduction = $this->input->post('deduction');
    $person = $this->input->post('person');
    $id_no = $this->input->post('id_no');
    $name_client = $this->input->post('name_client');
    $user = $this->input->post('user');

    $ded = $this->db->query('select * from deduction where id_ded ="' . $deduction . '"');
    $result_percent = "";
    $dd = "";
    if ($ded->num_rows() > 0) {
      $row = $ded->row();
      $result_percent = $row->deduction;
      $name_of_deduction = $row->name;
    }


    $data = array(
      'deduction_type' => $name_of_deduction,
      'id_number' => $id_no,
      'name_of_client' => $name_client,
      'deduction_percent' => $result_percent,
      'divide_person' => $person

    );
    $this->update_model->pertableupdatecartforDeduction($user, $data, $redirect);
    $data = array(
      'content' => '' . $sess . ' Added a Deduction',
      'user' => $sess,
      'type' => 'Restaurant',

    );

    $this->insert_model->log($data);
    $this->session->set_flashdata('success', '$$');
    redirect('main/PerTableProcess/' . $redirect);
  }
  public function process() {
    if ($this->session->userdata('connect') == true);
    $id = $this->session->userdata('user_id');
    $data = array(

      'result_product_name' => $this->get_model->getProductRes(),
      'product_cart' => $this->get_model->getDataCart(),
      'product_cart_deleted' => $this->get_model->getDataCartDelivered(),
      'result_deduction' => $this->get_model->frontdeskgetDeduction(),
      'total_amount' => $this->get_model->restaurantTotalBalance(),

      'get_user' => $this->get_model->frontdeskGetUserDatails($id)


    );
    $this->load->view('body/coffeeshop/layout/header', $data);
    $this->load->view('body/coffeeshop/process', $data);
    $this->load->view('body/coffeeshop/layout/footer');
  }

  public function adddeductionRestaurant() {
    if ($this->session->userdata('connect') == true);
    # code...
    $sess = $this->session->userdata('username');
    $deduction = $this->input->post('deduction');
    $id_no = $this->input->post('id_no');
    $name_client = $this->input->post('name_client');
    $user = $this->input->post('user');

    $ded = $this->db->query('select * from deduction where id_ded ="' . $deduction . '"');
    $result_percent = "";
    $dd = "";
    if ($ded->num_rows() > 0) {
      $row = $ded->row();
      echo $result_percent = $row->deduction;
      echo $name_of_deduction = $row->name;
    }


    $data = array(
      'deduction_type' => $name_of_deduction,
      'id_number' => $id_no,
      'name_of_client' => $name_client,
      'deduction_percent' => $result_percent,

    );
    $this->update_model->updatecartforDeduction($user, $data);

    $data = array(
      'content' => '' . $sess . ' Added a Deduction',
      'user' => $sess,
      'type' => 'Restaurant',

    );

    $this->insert_model->log($data);
    $this->session->set_flashdata('success', '$$');
    redirect('main/process');
  }

  public function addCartcoffeeshop() {
    if ($this->session->userdata('connect') == true);
    # code...
    $sess = $this->session->userdata('username');
    $product_id = $this->input->post('product_name');
    $product_qty = $this->input->post('product_qty');

    $cost = $this->db->query('select * from product_coffeeshop where id="' . $product_id . '"');
    $cost_res = "";
    $name_prod = "";
    if ($cost->num_rows() > 0) {
      $row = $cost->row();
      $cost_res = $row->product_cost;
      $name_prod = $row->product_name;
    }
    $total_amount = $cost_res * $product_qty;

    if ($this->session->userdata('connect') == true) {
      # code...
      $sess = $this->session->userdata('username');
      $id_sess = $this->session->userdata('user_id');
    }
    $get_id = $this->db->query('select * from coffeeshop_cart where account_process="' . $id_sess . '" and type_process ="Coffee Shop" order by id_cart desc limit 1');
    $result_id = "";

    if ($get_id->num_rows() > 0) {
      $row = $get_id->row();
      $result_id = $row->id_cart;
    }


    $data = array(
      'product_id' => $product_id,
      'product_cost' => $cost_res,
      'product_qty' => $product_qty,
      'id_of_user' => $sess,
      'account_process' => $id_sess,
      'type_process' => 'Restaurant',
      'total_cart_amount' => $total_amount,
      'reciept_code' => $result_id
    );
    $this->insert_model->addingCartRestaurant($data);



    $data = array(
      'name' => $name_prod,
      'qty' => $product_qty,
      'account_process' => $id_sess,
      'type_process' => 'Restaurant',
      'total_amount_process' => $total_amount,
      'cart_id' => $result_id,
      'unit_cost' => $cost_res
    );
    $this->insert_model->reports($data);
    $data = array(
      'content' => '' . $sess . 'Added Order to cart',
      'user' => $sess,
      'type' => 'Restaurant',

    );

    $this->insert_model->log($data);

    $this->session->set_flashdata('success', '$$');
    redirect('main/process');
  }

  public function addCartcoffeeshopPerTable() {
    if ($this->session->userdata('connect') == true);
    # code...
    $sess = $this->session->userdata('username');
    $table_number = $this->input->post('table_number');
    $product_id = $this->input->post('product_name');
    $product_qty = $this->input->post('product_qty');

    $cost = $this->db->query('select * from product_coffeeshop where id="' . $product_id . '"');
    $cost_res = "";
    $name_prod = "";
    if ($cost->num_rows() > 0) {
      $row = $cost->row();
      $cost_res = $row->product_cost;
      $name_prod = $row->product_name;
    }
    $total_amount = $cost_res * $product_qty;

    if ($this->session->userdata('connect') == true) {
      # code...
      $sess = $this->session->userdata('username');
      $id_sess = $this->session->userdata('user_id');
    }


    $data = array(
      'product_id' => $product_id,
      'product_cost' => $cost_res,
      'product_qty' => $product_qty,
      'id_of_user' => $sess,
      'account_process' => $id_sess,
      'type_process' => 'Restaurant',
      'total_cart_amount' => $total_amount,
      'table_num' => $table_number
    );
    $this->insert_model->addingCartRestaurant($data);

    $get_id = $this->db->query('select * from coffeeshop_cart where account_process="' . $id_sess . '" and type_process ="Coffee Shop" order by id_cart desc limit 1');
    $result_id = "";
    if ($get_id->num_rows() > 0) {
      $row = $get_id->row();
      $result_id = $row->id_cart;
    }

    $data = array(
      'name' => $name_prod,
      'qty' => $product_qty,
      'account_process' => $id_sess,
      'type_process' => 'Restaurant',
      'total_amount_process' => $total_amount,
      'cart_id' => $result_id,
      'unit_cost' => $cost_res
    );
    $this->insert_model->reports($data);

    $data = array(
      'content' => '' . $sess . ' Added Order to Cart',
      'user' => $sess,
      'type' => 'Restaurant',

    );

    $this->insert_model->log($data);

    $this->session->set_flashdata('success', '$$');
    redirect('main/PerTableProcess/' . $table_number);
  }

  public function deletecoffeeshopCart($id) {
    if ($this->session->userdata('connect') == true);
    # code...
    $sess = $this->session->userdata('username');
    $data = array(
      'content' => '' . $sess . ' Canceled order in cart',
      'user' => $sess,
      'type' => 'Restaurant',

    );

    $this->insert_model->log($data);
    $this->delete_model->deletecart($id);
    $this->delete_model->deleteReportsRestaurant($id);
    $this->session->set_flashdata('success', '$$');
    redirect('main/process');
  }

  //deliverd
  public function coffeeshopChangeToDelivered($product_cart_id) {
    if ($this->session->userdata('connect') == true);
    # code...
    $sess = $this->session->userdata('username');
    $data = array(
      'content' => '' . $sess . ' Release Order',
      'user' => $sess,
      'type' => 'Restaurant',

    );

    $this->insert_model->log($data);
    $data = array(
      'deliver_status' => 'Delivered'
    );
    $this->update_model->updatecart($product_cart_id, $data);
    $this->session->set_flashdata('success', '$$');
    redirect('main/process');
  }

  public function coffeeshopChangeToDeliveredPertable($str) {
    if ($this->session->userdata('connect') == true);
    # code...
    $sess = $this->session->userdata('username');
    $data = array(
      'content' => '' . $sess . ' Release Order',
      'user' => $sess,
      'type' => 'Restaurant',

    );

    $this->insert_model->log($data);
    $string = explode('H', $str);
    $product_cart_id = $string[0];
    $redirect = $string[1];
    $data = array(
      'deliver_status' => 'Delivered'
    );
    $this->update_model->updatecart($product_cart_id, $data);
    $this->session->set_flashdata('success', '$$');
    redirect('main/PertableProcess/' . $redirect);
  }

  public function deletecoffeeshopCartPerTable($str) {
    if ($this->session->userdata('connect') == true);
    # code...
    $sess = $this->session->userdata('username');
    $data = array(
      'content' => '' . $sess . ' Canceled order in the Cart',
      'user' => $sess,
      'type' => 'Restaurant',

    );

    $this->insert_model->log($data);
    $string = explode('H', $str);
    $id = $string[0];
    $redirect = $string[1];
    $this->delete_model->deletecart($id);
    $this->delete_model->deleteReportsRestaurant($id);
    $this->session->set_flashdata('success', '$$');
    redirect('main/PerTableProcess/' . $redirect);
  }

  public function clearCart() {
    if ($this->session->userdata('connect') == true);
    # code...
    $sess = $this->session->userdata('username');
    $data = array(
      'content' => '' . $sess . ' Clear cart',
      'user' => $sess,
      'type' => 'Restaurant',

    );

    $this->insert_model->log($data);
    $this->update_model->clearCart();
    $this->session->set_flashdata('success', '$$');
    redirect('main/process');
  }

  public function clearCartPerTable($id) {
    if ($this->session->userdata('connect') == true);
    # code...
    $sess = $this->session->userdata('username');
    $data = array(
      'content' => '' . $sess . ' Cleared Cart',
      'user' => $sess,
      'type' => 'Restaurant',

    );

    $this->insert_model->log($data);
    $this->update_model->clearCartPerTable($id);
    $this->session->set_flashdata('success', '$$');
    redirect('main/PerTableProcess/' . $id);
  }

  public function updatecoffeeshopCart() {
    if ($this->session->userdata('connect') == true);
    # code...
    $sess = $this->session->userdata('username');
    $product_cart_id = $this->input->post('id');
    $product_id = $this->input->post('prodid');
    $product_qty = $this->input->post('qty');

    $cost = $this->db->query('select * from product_coffeeshop where id="' . $product_id . '"');
    $cost_res = "";
    $name_prod = "";
    if ($cost->num_rows() > 0) {
      $row = $cost->row();
      $cost_res = $row->product_cost;
      $name_prod = $row->product_name;
    }
    $total_amount = $cost_res * $product_qty;

    if ($this->session->userdata('connect') == true) {
      # code...
      $sess = $this->session->userdata('username');
      $id_sess = $this->session->userdata('user_id');
    }


    $data = array(
      'product_cost' => $cost_res,
      'product_qty' => $product_qty,
      'id_of_user' => $sess,
      'account_process' => $id_sess,
      'type_process' => 'Restaurant',
      'total_cart_amount' => $total_amount
    );
    $this->update_model->updatecart($product_cart_id, $data);



    $data = array(
      'qty' => $product_qty,
      'account_process' => $id_sess,
      'type_process' => 'Restaurant',
      'total_amount_process' => $total_amount,
    );
    $this->update_model->updateReportsRestaurant($product_cart_id, $data);

    $data = array(
      'content' => '' . $sess . ' Updated order in the cart',
      'user' => $sess,
      'type' => 'Restaurant',

    );

    $this->insert_model->log($data);

    $this->session->set_flashdata('success', '$$');
    redirect('main/process');
  }

  public function updatecoffeeshopCartPerTable() {
    if ($this->session->userdata('connect') == true);
    # code...
    $sess = $this->session->userdata('username');
    $redirect = $this->input->post('redirect');
    $product_cart_id = $this->input->post('id');
    $product_id = $this->input->post('prodid');
    $product_qty = $this->input->post('qty');

    $cost = $this->db->query('select * from product_restaurant where id="' . $product_id . '"');
    $cost_res = "";
    $name_prod = "";
    if ($cost->num_rows() > 0) {
      $row = $cost->row();
      $cost_res = $row->product_cost;
      $name_prod = $row->product_name;
    }
    $total_amount = $cost_res * $product_qty;

    if ($this->session->userdata('connect') == true) {
      # code...
      $sess = $this->session->userdata('username');
      $id_sess = $this->session->userdata('user_id');
    }


    $data = array(
      'product_cost' => $cost_res,
      'product_qty' => $product_qty,
      'id_of_user' => $sess,
      'account_process' => $id_sess,
      'type_process' => 'Restaurant',
      'total_cart_amount' => $total_amount
    );
    $this->update_model->updatecart($product_cart_id, $data);



    $data = array(
      'qty' => $product_qty,
      'account_process' => $id_sess,
      'type_process' => 'Restaurant',
      'total_amount_process' => $total_amount,
    );
    $this->update_model->updateReportsRestaurant($product_cart_id, $data);

    $data = array(
      'content' => '' . $sess . ' Updated order in the cart',
      'user' => $sess,
      'type' => 'Restaurant',

    );

    $this->insert_model->log($data);

    $this->session->set_flashdata('success', '$$');
    redirect('main/PerTableProcess/' . $redirect);
  }

  public function coffeeshopReports() {
    if ($this->session->userdata('connect') == true);
    # code...
    $sess = $this->session->userdata('username');
    if ($this->session->userdata('connect') == true);
    $id = $this->session->userdata('user_id');
    $data = array(

      'get_user' => $this->get_model->frontdeskGetUserDatails($id)
    );
    $this->load->view('body/coffeeshop/layout/header', $data);
    $this->load->view('body/coffeeshop/reports');
    $this->load->view('body/coffeeshop/layout/footer');
  }
  public function coffeeshopviewReports() {
    if ($this->session->userdata('connect') == true);
    $id = $this->session->userdata('user_id');

    $from = $this->input->post('from');
    $to = $this->input->post('to');





    $data = array(
      'from' => $from,
      'to' => $to,
      'result' => $this->get_model->restaurantViewreports($from, $to, $id),
      'total_result' => $this->get_model->restaurantViewReportsTotal($from, $to, $id)
    );

    $this->load->view('body/admin/pdfReports', $data);
  }

  public function printRecieptcoffeeshop() {
    if ($this->session->userdata('connect') == true);
    # code...
    $sess = $this->session->userdata('username');
    $data = array(
      'content' => '' . $sess . ' Printed a Reciept',
      'user' => $sess,
      'type' => 'Housekeeping',

    );

    $this->insert_model->log($data);
    $data = array(
      'result_product_name' => $this->get_model->getProductRes(),
      'product_cart' => $this->get_model->getDataCart(),
      'total_amount' => $this->get_model->restaurantTotalBalance()
    );
    $this->load->view('body/coffeeshop/print_process', $data);
  }


  public function printRecieptcoffeeshopPerTable($id) {
    if ($this->session->userdata('connect') == true);
    # code...
    $sess = $this->session->userdata('username');
    $data = array(
      'content' => '' . $sess . ' Printed a Reciept',
      'user' => $sess,
      'type' => 'Housekeeping',

    );

    $this->insert_model->log($data);
    $data = array(
      'id' => $id,
      'result_name' => $this->get_model->getTablesbyId($id),
      'result_product_name' => $this->get_model->getProductRes(),
      'product_cart' => $this->get_model->getDataCartbyTable($id),
      'total_amount' => $this->get_model->restaurantTotalBalancePerTable($id)
    );
    $this->load->view('body/coffeeshop/print_per_table', $data);
  }
}
