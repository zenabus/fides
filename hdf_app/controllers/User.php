<?php
defined('BASEPATH') or exit('No direct script access allowed');

class User extends MY_Controller {

  function index() {
    $this->load->view('login/login');
  }

  function destroy() {
    $this->insert_model->log('User logged out', 1);
    $this->session->sess_destroy();
    unset($_SESSION);
    redirect(base_url('index.php/user'));
  }

  function login() {
    $user = $this->get_model->authenticate();

    if (!$user) {
      $this->session->set_flashdata('error', 'Invalid account! Please try again.');
      $this->redirect();
    }

    $user_session = [
      'user_id' => $user->id,
      'name' => $user->name,
      'username' => $user->username,
      'user_type' => $user->user_type,
      'image' => $user->image_source,
      'connect' => true,
    ];

    $this->session->set_userdata($user_session);
    $this->session->set_flashdata('success', 'Welcome, ' . $user->name . '!');
    $this->insert_model->log('User logged in', 1);
    $this->update_model->updateLogin();

    if ($user->user_type == 'Admin') {
      redirect('main');
    } elseif ($user->user_type == 'Front Desk') {
      redirect('main');
    } elseif ($user->user_type == 'Superadmin') {
      redirect('main');
    } elseif ($user->user_type == 'Housekeeping') {
      redirect('housekeeping');
    } elseif ($user->user_type == 'Coffee Shop') {
      redirect('main/RestaurantDashboard');
    } elseif ($user->user_type == 'Restaurant') {
      redirect('main/RestaurantDashboard');
    }
  }
}
