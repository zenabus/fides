<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Main extends MY_Controller {

  function __construct() {
    parent::__construct();
    $this->load->vars([
      'notif' => $this->get_model->frontdeskGetNotif()
    ]);
  }

  // ------------------------------------------------------------------------------------------------------- //
  // ------------------------------------------------ VIEWS ------------------------------------------------ //
  // ------------------------------------------------------------------------------------------------------- //

  function listOfCheckedInAdmin() {
    if ($this->session->userdata('connect') == true) {
      $sess = $this->session->userdata('username');
      $id = $this->session->userdata('user_id');
    }

    $data = array(
      'result_checked' => $this->get_model->frontdeskListOfCheckedIn(),
      'get_user' => $this->get_model->frontdeskGetUserDatails($id)
    );
    $this->load->view('body/admin/layout/header', $data);
    $this->load->view('body/frontdesk/list_of_check_in', $data);
    $this->generateToInsert();
  }

  function CalendarCheckin() {
    if ($this->session->userdata('connect') == true);
    $id = $this->session->userdata('user_id');

    $data = array(
      'get_user' => $this->get_model->frontdeskGetUserDatails($id)
    );
    $this->load->view('body/frontdesk/layout/header', $data);
    $this->load->view('body/frontdesk/calendar_checkin');
    $this->load->view('body/frontdesk/layout/footer');
  }

  function calendarDetails() {
    if ($this->session->userdata('connect') == true);
    $id = $this->session->userdata('user_id');

    $data = array(
      'get_user' => $this->get_model->frontdeskGetUserDatails($id)
    );
    $this->load->view('body/frontdesk/layout/header', $data);
    $this->load->view('body/frontdesk/calender_details');
    $this->load->view('body/frontdesk/layout/footer');
  }

  function roomCalendar() {
    if ($this->session->userdata('connect') == true);
    $id = $this->session->userdata('user_id');

    $data = array(
      'get_user' => $this->get_model->frontdeskGetUserDatails($id)
    );
    //$this->load->view('body/frontdesk/layout/header',$data);
    $this->load->view('body/frontdesk/room_calendar');
    //$this->load->view('body/frontdesk/layout/footer');
    $this->generateToInsert();
  }

  function generateToInsert() {
    $this->load->view('body/frontdesk/generateInsert');
  }

  function frontdeskTransactions() {
    if ($this->session->userdata('connect') == true) {
      $id = $this->session->userdata('user_id');
    }

    $data = array(
      'active' => 'transactions',

      'result' => $this->get_model->reportTransactionsfrontdesk(),
    );

    $this->load->view('body/frontdesk/layout/header', $data);
    $this->load->view('body/frontdesk/transactions', $data);
    $this->load->view('body/frontdesk/layout/footer');
  }

  function all() {
    $this->load->view('body/frontdesk/layout/header');
    $this->load->view('body/frontdesk/information');
    $this->load->view('body/frontdesk/layout/footer');
  }

  function listOfReservation() {
    if ($this->session->userdata('connect') == true);
    $id = $this->session->userdata('user_id');
    $data = array(
      'result_reservation' => $this->get_model->frontdeskGetReservation(),

    );
    $this->load->view('body/frontdesk/layout/header', $data);
    $this->load->view('body/frontdesk/list_of_reservation', $data);
    $this->load->view('body/frontdesk/layout/footer');
  }

  function addReservation() {
    if ($this->session->userdata('connect') == true);
    $id = $this->session->userdata('user_id');
    $data = array(
      'result_rooms' => $this->get_model->frontdeskRooms(),
      'result_room_types' => $this->get_model->getRoomTypes(),

      'get_user' => $this->get_model->frontdeskGetUserDatails($id)

    );

    $this->load->view('body/frontdesk/layout/header', $data);
    $this->load->view('body/frontdesk/add_reservation', $data);
    $this->load->view('body/frontdesk/layout/footer');
  }

  function ListOfVerify() {
    $data = array(
      'active' => 'online',
      'result_reservation' => [],
      'result_reservation_cancel' => [],

      'getRoomType' => $this->get_model->getRoomTypes(),
      'getRoom' => $this->get_model->getRoom()

    );
    $this->load->view('body/frontdesk/layout/header', $data);
    $this->load->view('body/frontdesk/list_to_verify', $data);
    $this->load->view('body/frontdesk/layout/footer');
  }

  function updateReservation($id) {
    if ($this->session->userdata('connect') == true);
    # code...
    $sess = $this->session->userdata('username');
    if ($this->session->userdata('connect') == true);
    $ids = $this->session->userdata('user_id');


    $data = array(
      'result_rooms' => $this->get_model->frontdeskRooms(),
      'result_res_id' => $this->get_model->frontdeskGetReservationById($id),
      'result_room_type' => $this->get_model->frontdeskGetRoomTypeById($id),

      'get_user' => $this->get_model->frontdeskGetUserDatails($ids)


    );

    $this->load->view('body/frontdesk/layout/header', $data);
    $this->load->view('body/frontdesk/update_reservation', $data);
    $this->load->view('body/frontdesk/layout/footer');
  }

  function checkIn() {
    if ($this->session->userdata('connect') == true);
    # code...
    $sess = $this->session->userdata('username');
    if ($this->session->userdata('connect') == true);
    $id = $this->session->userdata('user_id');
    $data = array(
      'get_user' => $this->get_model->frontdeskGetUserDatails($id)
    );
    $this->load->view('body/frontdesk/layout/header', $data);
    $this->load->view('body/frontdesk/walkin_check_in_form');
    $this->load->view('body/frontdesk/layout/footer');
  }

  function checked($booking_number) {
    $id = 242;
    if ($this->session->userdata('connect') == true);
    $sess = $this->session->userdata('username');
    //$ids = $this->session->userdata('user_id');
    $reports = $this->db->query('select * from all_reports where if_frontdesk="' . $id . '" order by id_reports desc limit 1');
    $id_reports = "";
    $view = "";
    $give = "";
    $card = "";
    $acc  = "";

    if ($reports->num_rows() > 0) {
      $row = $reports->row();
      $id_reports = $row->id_reports;
      $view = $row->view_reciept;
      $give = $row->amount_give;
      $card = $row->card_number;
      $acc = $row->account_process;
    }

    if ($this->session->userdata('connect') == true);
    # code...
    $sess = $this->session->userdata('username');

    if ($this->session->userdata('connect') == true);
    $ids = $this->session->userdata('user_id');
    $prompt = $this->db->query('select * from check_form where id="' . $id . '"');
    $id_if_reserve = "";
    if ($prompt->num_rows() > 0) {
      $row = $prompt->row();
      $id_if_reserve = $row->id_if_reserve;
    }

    $data = array(
      'active' => 'bookings',
      // 'id_reports' => $id_reports,
      // 'account' => $sess,
      // 'amount_give' => $give,
      // 'card_number' => $card,
      // 'connect_book' => $this->get_model->frontdeskConnectBooking($id),
      'result_room_form' => $this->get_model->frontdeskListOfCheckedInbyId($id),
      // 'room_number' => $this->get_model->frondeskGetRoom(),
      // 'result_room_checked' => $this->get_model->frondeskGetRoomCheckedById($id),
      // 'result_room_type' => $this->get_model->getRoomTypes(),
      // 'result_deduction' => $this->get_model->frontdeskgetDeduction(),
      // 'result_total' => $this->get_model->frontdeskTOtalBalance($id),
      // 'result_reservation' => $this->get_model->frontdeskgetReservationDetails($id_if_reserve),

      // 'get_user' => $this->get_model->frontdeskGetUserDatails($ids),
      // 'total_amount' => $this->get_model->frontdeskCharge($id),
      // 'result_restaurant_charge' => $this->get_model->frontdeskgetChargeToRoom($id),
      // 'result_restaurant_charge_cof' => $this->get_model->frontdeskgetChargeToRoomcof($id),
      // 'lols' => $id,
      // /////updaate 2.0////
      // 'total_charge_resto' => $this->get_model->counttotalFOchargeresto($id),
      // 'total_charge_coffee' => $this->get_model->counttotalFOchargecoffee($id),
      // 'total_charge_amen' => $this->get_model->counttotalFOchargeAmenites($id),
      // 'get_charge_resto' => $this->get_model->selectChargeResto($id),
      // 'get_charge_coffee' => $this->get_model->selectChargeCoffee($id),
      // 'get_charge_amen' => $this->get_model->selectChargeAmen($id),
      // 'getFrontLogs' => [],
      // 'getFrontLogs' => $this->get_model->forntdesklogs_user($id),
      ////edn update 2.0//
    );

    $data['booking'] = $this->get_model->getBookingByBookingNumber($booking_number);

    $this->load->view('body/frontdesk/layout/header', $data);
    $this->load->view('body/frontdesk/update_checked');
    $this->load->view('body/frontdesk/layout/footer');
  }

  function refresh($id) {
    if ($this->session->userdata('connect') == true);
    $sess = $this->session->userdata('username');
    //$ids = $this->session->userdata('user_id');
    $reports = $this->db->query('select * from all_reports where if_frontdesk="' . $id . '" order by id_reports desc limit 1');
    $id_reports = "";
    $view = "";
    $give = "";
    $card = "";
    $acc  = "";


    if ($reports->num_rows() > 0) {
      $row = $reports->row();
      $id_reports = $row->id_reports;
      $view = $row->view_reciept;
      $give = $row->amount_give;
      $card = $row->card_number;
      $acc = $row->account_process;
    }

    if ($this->session->userdata('connect') == true);
    # code...
    $sess = $this->session->userdata('username');
    if ($this->session->userdata('connect') == true);
    $ids = $this->session->userdata('user_id');
    $prompt = $this->db->query('select * from check_form where id="' . $id . '"');
    $id_if_reserve = "";
    $ll = "";
    $ff = "";
    if ($prompt->num_rows() > 0) {
      $row = $prompt->row();
      $id_if_reserve = $row->id_if_reserve;
      $ll = $row->last_name;
      $ff = $row->first_name;
    }

    $data = array(
      'id_reports' => $id_reports,
      'account' => $sess,
      'amount_give' => $give,
      'card_number' => $card,
      'connect_book' => $this->get_model->frontdeskConnectBooking($id),
      'result_room_form' => $this->get_model->frontdeskListOfCheckedInbyId($id),
      'room_number' => $this->get_model->frondeskGetRoom(),
      'result_room_checked' => $this->get_model->frondeskGetRoomCheckedById($id),
      'result_room_type' => $this->get_model->getRoomTypes(),
      'result_deduction' => $this->get_model->frontdeskgetDeduction(),
      'result_total' => $this->get_model->frontdeskTOtalBalance($id),
      'result_reservation' => $this->get_model->frontdeskgetReservationDetails($id_if_reserve),

      'get_user' => $this->get_model->frontdeskGetUserDatails($ids),
      'total_amount' => $this->get_model->frontdeskCharge($id),
      'result_restaurant_charge' => $this->get_model->frontdeskgetChargeToRoom($id),
      'getFrontLogs' => $this->get_model->forntdesklogs_user($id),

    );

    $this->load->view('body/frontdesk/layout/header', $data);
    $this->load->view('body/frontdesk/update_checked', $data);
    $this->load->view('body/frontdesk/layout/footer');

    $this->session->set_flashdata('success', '$$');
    if ($this->session->userdata('connect') == true);

    $sess = $this->session->userdata('username');
    $data = array(
      'content' => '' . $sess . ' Access the booking ' . $ff . ' ' . $ll . ' ',
      'user' => $sess,
      'type' => 'Frontdesk',
      'redirection' => 'index.php/main/Frontdesk',
    );

    $this->insert_model->log($data);
    redirect('main/checked/' . $id);
  }

  function CheckForm($id) {
    if ($this->session->userdata('connect') == true);
    $ids = $this->session->userdata('user_id');
    $data = array(
      'result_room_by_id' => $this->get_model->frontdeskgetRoomById($id)

    );
    $this->load->view('body/frontdesk/layout/header');
    $this->load->view('body/frontdesk/checkin_form', $data);
    $this->load->view('body/frontdesk/layout/footer');
  }

  function CheckFormUpdate($id) {
    if ($this->session->userdata('connect') == true);
    # code...
    $sess = $this->session->userdata('username');
    if ($this->session->userdata('connect') == true);
    $ids = $this->session->userdata('user_id');
    $data = array(
      'result_room_form' => $this->get_model->frontdeskgetRoomAndCheck($id),
      'result_room_by_id' => $this->get_model->frontdeskgetRoomById($id),

      'get_user' => $this->get_model->frontdeskGetUserDatails($ids)
    );

    $this->load->view('body/frontdesk/layout/header', $data);
    $this->load->view('body/frontdesk/update_checkin_form', $data);
    $this->load->view('body/frontdesk/layout/footer');
  }

  function CoffeeshopDashboard() {
    if ($this->session->userdata('connect') == true);
    # code...
    $sess = $this->session->userdata('username');
    if ($this->session->userdata('connect') == true);
    $id = $this->session->userdata('user_id');
    $data = array(
      'notif' => $this->get_model->coffeeshopGetNotif(),
    );
    $this->load->view('body/coffeeshop/layout/header', $data);
    $this->load->view('body/coffeeshop/dashboard');
    $this->load->view('body/coffeeshop/layout/footer');
  }

  function CoffeeshopProfile() {
    if ($this->session->userdata('connect') == true);
    # code...
    $sess = $this->session->userdata('username');
    if ($this->session->userdata('connect') == true);
    # code...
    $id = $this->session->userdata('user_id');
    $data = array(
      'notif' => $this->get_model->coffeeshopGetNotif(),

    );
    $this->load->view('body/coffeeshop/layout/header', $data);
    $this->load->view('body/coffeeshop/userprofile', $data);
    $this->load->view('body/coffeeshop/layout/footer');
  }

  function CoffeeshopProcess() {
    if ($this->session->userdata('connect') == true);
    # code...
    $sess = $this->session->userdata('username');
    if ($this->session->userdata('connect') == true);
    $id = $this->session->userdata('user_id');
    $data = array(
      'result_product_name' => $this->get_model->coffeegetProductRes(),
      'product_cart' => $this->get_model->CoffeeshopgetDataCart(),
      'total_amount' => $this->get_model->coffeeshopTotalBalance(),
      'notif' => $this->get_model->coffeeshopGetNotif(),
      'get_user' => $this->get_model->frontdeskGetUserDatails($id)

    );
    $this->load->view('body/coffeeshop/layout/header', $data);
    $this->load->view('body/coffeeshop/process', $data);
    $this->load->view('body/coffeeshop/layout/footer');
  }

  function CoffeeshopPerTable() {
    if ($this->session->userdata('connect') == true);
    # code...
    $sess = $this->session->userdata('username');
    if ($this->session->userdata('connect') == true);
    $id = $this->session->userdata('user_id');
    $data = array(
      'result_table' => $this->get_model->coffeeshopgetTables(),
      'notif' => $this->get_model->coffeeshopGetNotif(),
      'get_user' => $this->get_model->frontdeskGetUserDatails($id)
    );
    $this->load->view('body/coffeeshop/layout/header', $data);
    $this->load->view('body/coffeeshop/pertable', $data);
    $this->load->view('body/coffeeshop/layout/footer');
  }

  function CoffeeshopPerTableProcess($id) {
    if ($this->session->userdata('connect') == true);
    # code...
    $sess = $this->session->userdata('username');
    if ($this->session->userdata('connect') == true);
    $ids = $this->session->userdata('user_id');
    $data = array(
      'id' => $id,
      'result_name' => $this->get_model->coffeeshopgetTablesbyId($id),
      'result_product_name' => $this->get_model->coffeegetProductRes(),
      'notif' => $this->get_model->coffeeshopGetNotif(),
      'product_cart' => $this->get_model->coffeeshopgetDataCartbyTable($id),
      'total_amount' => $this->get_model->coffeeshopTotalBalancePerTable($id),
      'get_user' => $this->get_model->frontdeskGetUserDatails($ids)

    );

    $this->load->view('body/coffeeshop/layout/header', $data);
    $this->load->view('body/coffeeshop/table_process', $data);
    $this->load->view('body/coffeeshop/layout/footer');
  }

  function RestaurantDashboard() {
    if ($this->session->userdata('connect') == true);
    # code...
    $sess = $this->session->userdata('username');
    if ($this->session->userdata('connect') == true);
    $id = $this->session->userdata('user_id');
    $data = array(

      'count_tables' => $this->get_model->countRoomTableRestaurant(),
      'count_product' => $this->get_model->countRoomRestaurantProduct(),
      'count_active' => $this->get_model->countRoomRestaurantProductActive(),
      'count_inactive' => $this->get_model->countRoomRestaurantProductINACTIVE()
    );
    $this->load->view('body/restaurant/layout/header', $data);
    $this->load->view('body/restaurant/dashboard');
    $this->load->view('body/restaurant/layout/footer');
  }

  function restaurantTransactions() {
    if ($this->session->userdata('connect') == true);
    # code...
    $sess = $this->session->userdata('username');
    if ($this->session->userdata('connect') == true);
    $id = $this->session->userdata('user_id');
    $res = $this->session->userdata('restaurant');
    $data = array(

      'result' => $this->get_model->reportTransactionsRestaurant($res),
    );
    $this->load->view('body/restaurant/layout/header', $data);
    $this->load->view('body/restaurant/transactions', $data);
    $this->load->view('body/restaurant/layout/footer');
  }

  function RestaurantProfile() {
    if ($this->session->userdata('connect') == true);
    # code...
    $id = $this->session->userdata('user_id');
    $data = array();
    $this->load->view('body/restaurant/layout/header', $data);
    $this->load->view('body/restaurant/userprofile', $data);
    $this->load->view('body/restaurant/layout/footer');
  }

  function PerTable() {
    if ($this->session->userdata('connect') == true);
    $id = $this->session->userdata('user_id');
    $data = array(
      'result_table' => $this->get_model->getTables(),

      'get_user' => $this->get_model->frontdeskGetUserDatails($id)
    );
    $this->load->view('body/restaurant/layout/header', $data);
    $this->load->view('body/restaurant/pertable', $data);
    $this->load->view('body/restaurant/layout/footer');
  }

  function PerTableProcess($id) {
    if ($this->session->userdata('connect') == true);
    $res = $this->session->userdata('restaurant');
    $ids = $this->session->userdata('user_id');

    $reports = $this->db->query('select * from all_reports where account_process="' . $ids . '" and type_process="' . $res . '" and view_reciept="0" and table_num="' . $id . '" order by id_reports desc limit 1');
    $id_reports = "";
    $view = "";
    $give = "";


    if ($reports->num_rows() > 0) {
      $row = $reports->row();
      $id_reports = $row->id_reports;
      $view = $row->view_reciept;
      $give = $row->amount_give;
    }
    $data = array(
      'amount_give' => $give,
      'id_reports' => $id_reports,
      'view' => $view,
      'id' => $id,
      'result_name' => $this->get_model->getTablesbyId($id),
      'result_product_name' => $this->get_model->getProductRes($res),
      'result_rooms_checked' => $this->get_model->frondeskGetRoomCheckedNoRestriction(),
      'product_cart' => $this->get_model->getDataCartbyTable($id, $res),
      'product_cart_deleted' => $this->get_model->getDataCartDeliveredPertable($id, $res),
      'result_deduction' => $this->get_model->frontdeskgetDeduction(),
      'total_amount' => $this->get_model->restaurantTotalBalancePerTable($id, $res),
      'get_user' => $this->get_model->frontdeskGetUserDatails($ids),
      'product_cart_receipt' => $this->get_model->getDataCartRecieptpertable($id_reports, $id, $res),
      'total_amount_receipt' => $this->get_model->restaurantTotalBalanceRecieptpertable($id_reports, $id, $res),

    );

    $this->load->view('body/restaurant/layout/header', $data);
    $this->load->view('body/restaurant/table_process', $data);
    $this->load->view('body/restaurant/layout/footer');
  }

  function process() {
    if ($this->session->userdata('connect') == true);
    $id = $this->session->userdata('user_id');
    $res = $this->session->userdata('restaurant');
    $reports = $this->db->query('select * from all_reports where account_process="' . $id . '" and type_process="' . $res . '" and view_reciept="0" order by id_reports desc limit 1');
    $id_reports = "";
    $view = "";
    $give = "";


    if ($reports->num_rows() > 0) {
      $row = $reports->row();
      $id_reports = $row->id_reports;
      $view = $row->view_reciept;
      $give = $row->amount_give;
    }

    $data = array(
      'amount_give' => $give,
      'id_reports' => $id_reports,
      'view' => $view,
      'result_product_name' => $this->get_model->getProductRes($res),
      'product_cart' => $this->get_model->getDataCart($res),
      'product_cart_deleted' => $this->get_model->getDataCartDelivered($res),
      'result_deduction' => $this->get_model->frontdeskgetDeduction(),
      'total_amount' => $this->get_model->restaurantTotalBalance(),

      'product_cart_receipt' => $this->get_model->getDataCartReciept($id_reports, $res),
      'total_amount_receipt' => $this->get_model->restaurantTotalBalanceReciept($id_reports, $res),

    );
    $this->load->view('body/restaurant/layout/header', $data);
    $this->load->view('body/restaurant/process', $data);
    $this->load->view('body/restaurant/layout/footer');
  }

  function restauarantReports() {
    if ($this->session->userdata('connect') == true);
    # code...
    $sess = $this->session->userdata('username');
    if ($this->session->userdata('connect') == true);
    $id = $this->session->userdata('user_id');
    $data = array(

      'get_user' => $this->get_model->frontdeskGetUserDatails($id)
    );
    $this->load->view('body/restaurant/layout/header', $data);
    $this->load->view('body/restaurant/reports');
    $this->load->view('body/restaurant/layout/footer');
  }

  function restaurantviewReports() {
    if ($this->session->userdata('connect') == true);
    $id = $this->session->userdata('user_id');
    $res = $this->session->userdata('restaurant');
    $from = $this->input->post('from');
    $to = $this->input->post('to');
    $type = $this->input->post('type');

    $data = array(
      'from' => $from,
      'to' => $to,
      'result' => $this->get_model->restaurantViewreports($from, $to, $id, $res, $type),
      'total_result' => $this->get_model->restaurantViewReportsTotal($from, $to, $id, $res, $type)
    );

    $this->load->view('body/admin/pdfReportsforRestaurant', $data);
  }

  function FrontdeskReports() {
    if ($this->session->userdata('connect') == true);
    $id = $this->session->userdata('user_id');
    $data = array(
      'active' => 'reports',

      'get_user' => $this->get_model->frontdeskGetUserDatails($id)
    );
    $this->load->view('body/frontdesk/layout/header', $data);
    $this->load->view('body/frontdesk/reports');
    $this->load->view('body/frontdesk/layout/footer');
  }

  function FrontdeskviewReports() {
    if ($this->session->userdata('connect') == true);
    $id = $this->session->userdata('user_id');

    $from = $this->input->post('from');
    $to = $this->input->post('to');
    $type = $this->input->post('type');

    $data = array(
      'from' => $from,
      'to' => $to,
      'result' => $this->get_model->MainViewreportsFrontdesk($from, $to, $id, $type),
      'total_result' => $this->get_model->MainViewReportsTotalFrontdesk($from, $to, $id, $type)
    );

    $this->load->view('body/admin/pdfReportsFrontdesk', $data);
  }

  function HouseKeeping() {
    if ($this->session->userdata('connect') == true);
    $id = $this->session->userdata('user_id');
    $data = array(
      'notif' => $this->get_model->housekeepingGetNotif(),

    );
    $data2 = array(
      'count_room_types' => $this->get_model->houseCount(4),
      'count_rooms' => $this->get_model->houseCount(1),
      'count_ar' => $this->get_model->houseCount(2),
      'count_ur' => $this->get_model->houseCount(3),
    );
    $this->load->view('body/housekeeping/layout/header', $data);
    $this->load->view('body/housekeeping/dashboard', $data2);
    $this->load->view('body/housekeeping/layout/footer');
  }

  function HousekeepingList() {
    if ($this->session->userdata('connect') == true);
    $id = $this->session->userdata('user_id');
    $data = array(
      'room_result' => $this->get_model->houseKeepinggetRoom(),
      'notif' => $this->get_model->housekeepingGetNotif(),
      'get_user' => $this->get_model->frontdeskGetUserDatails($id)
    );
    $this->load->view('body/housekeeping/layout/header', $data);
    $this->load->view('body/housekeeping/list_of_room', $data);
    $this->load->view('body/housekeeping/layout/footer');
  }

  function RTHousekeepingList() {
    if ($this->session->userdata('connect') == true);
    $id = $this->session->userdata('user_id');
    $data = array(
      'room_result' => $this->get_model->houseKeepinggetRoom(),
      'notif' => $this->get_model->housekeepingGetNotif(),
      'get_user' => $this->get_model->frontdeskGetUserDatails($id)
    );
    $this->load->view('body/housekeeping/layout/header', $data);
    //$this->load->view('body/housekeeping/realtime_list_of_room',$data);
    $this->load->view('body/housekeeping/list_of_room', $data);
    $this->load->view('body/housekeeping/layout/footer');
  }

  function HousekeepingReady() {
    if ($this->session->userdata('connect') == true);
    $id = $this->session->userdata('user_id');
    $data = array(
      'room_result' => $this->get_model->houseKeepinggetRoomReady(),
      'notif' => $this->get_model->housekeepingGetNotif(),
      'get_user' => $this->get_model->frontdeskGetUserDatails($id)
    );
    $this->load->view('body/housekeeping/layout/header', $data);
    $this->load->view('body/housekeeping/list_of_room_ready', $data);
    $this->load->view('body/housekeeping/layout/footer');
  }

  function RTHousekeepingReady() {
    if ($this->session->userdata('connect') == true);
    $id = $this->session->userdata('user_id');
    $data = array(
      'room_result' => $this->get_model->houseKeepinggetRoomReady(),
      'notif' => $this->get_model->housekeepingGetNotif(),
      'get_user' => $this->get_model->frontdeskGetUserDatails($id)
    );
    $this->load->view('body/housekeeping/layout/header', $data);
    $this->load->view('body/housekeeping/realtime_list_of_room_ready', $data);
    $this->load->view('body/housekeeping/layout/footer');
  }

  function HousekeepingUnderMaintenance() {
    if ($this->session->userdata('connect') == true);
    $id = $this->session->userdata('user_id');
    $data = array(
      'room_result' => $this->get_model->houseKeepinggetRoomUM(),
      'notif' => $this->get_model->housekeepingGetNotif(),
      'get_user' => $this->get_model->frontdeskGetUserDatails($id)
    );
    $this->load->view('body/housekeeping/layout/header', $data);
    $this->load->view('body/housekeeping/list_of_room_um', $data);
    $this->load->view('body/housekeeping/layout/footer');
  }

  function RTHousekeepingUnderMaintenance() {
    if ($this->session->userdata('connect') == true);
    $id = $this->session->userdata('user_id');
    $data = array(
      'room_result' => $this->get_model->houseKeepinggetRoomUM(),
      'notif' => $this->get_model->housekeepingGetNotif(),
      'get_user' => $this->get_model->frontdeskGetUserDatails($id)
    );
    $this->load->view('body/housekeeping/layout/header', $data);
    $this->load->view('body/housekeeping/realtime_list_room_um', $data);
    $this->load->view('body/housekeeping/layout/footer');
  }

  function HousekeepingCleaning() {
    if ($this->session->userdata('connect') == true);
    $id = $this->session->userdata('user_id');
    $data = array(
      'room_result' => $this->get_model->houseKeepinggetRoomUC(),
      'notif' => $this->get_model->housekeepingGetNotif(),
      'get_user' => $this->get_model->frontdeskGetUserDatails($id)
    );
    $this->load->view('body/housekeeping/layout/header', $data);
    $this->load->view('body/housekeeping/list_of_room_uc', $data);
    $this->load->view('body/housekeeping/layout/footer');
  }

  function RTHousekeepingCleaning() {
    if ($this->session->userdata('connect') == true);
    $id = $this->session->userdata('user_id');
    $data = array(
      'room_result' => $this->get_model->houseKeepinggetRoomUC(),
      'notif' => $this->get_model->housekeepingGetNotif(),
      'get_user' => $this->get_model->frontdeskGetUserDatails($id)
    );
    $this->load->view('body/housekeeping/layout/header', $data);
    $this->load->view('body/housekeeping/realtime_list_of_room_uc', $data);
    $this->load->view('body/housekeeping/layout/footer');
  }

  function HousekeepingBedRequest() {
    if ($this->session->userdata('connect') == true);
    $id = $this->session->userdata('user_id');
    $data = array(
      'room_result' => $this->get_model->houseKeepinggetRoomCheckin(),
      'notif' => $this->get_model->housekeepingGetNotif(),
      'get_user' => $this->get_model->frontdeskGetUserDatails($id)
    );
    $this->load->view('body/housekeeping/layout/header', $data);
    $this->load->view('body/housekeeping/list_of_request_bed', $data);
    $this->load->view('body/housekeeping/layout/footer');
  }

  function RTHousekeepingBedRequest() {
    if ($this->session->userdata('connect') == true);
    $id = $this->session->userdata('user_id');
    $data = array(
      'room_result' => $this->get_model->houseKeepinggetRoomCheckin(),
      'notif' => $this->get_model->housekeepingGetNotif(),
      'get_user' => $this->get_model->frontdeskGetUserDatails($id)
    );
    $this->load->view('body/housekeeping/layout/header', $data);
    $this->load->view('body/housekeeping/realtime_list_of_request_bed', $data);
    $this->load->view('body/housekeeping/layout/footer');
  }

  function HousekeepingProfile() {
    if ($this->session->userdata('connect') == true);
    # code...
    $sess = $this->session->userdata('username');
    if ($this->session->userdata('connect') == true);
    # code...
    $id = $this->session->userdata('user_id');
    $data = array();
    $this->load->view('body/housekeeping/layout/header', $data);
    $this->load->view('body/housekeeping/userprofile', $data);
    $this->load->view('body/housekeeping/layout/footer');
  }

  function printReciept($id) {
    if ($this->session->userdata('connect') == true);
    $sess = $this->session->userdata('username');
    //$ids = $this->session->userdata('user_id');
    $reports = $this->db->query('select * from all_reports where if_frontdesk="' . $id . '" order by id_reports desc limit 1');
    $id_reports = "";
    $view = "";
    $give = "";
    $card = "";
    $acc  = "";


    if ($reports->num_rows() > 0) {
      $row = $reports->row();
      $id_reports = $row->id_reports;
      $view = $row->view_reciept;
      $give = $row->amount_give;
      $card = $row->card_number;
      $acc = $row->account_process;
    }

    if ($this->session->userdata('connect') == true);
    # code...
    $sess = $this->session->userdata('username');
    $data = array(
      'content' => '' . $sess . ' printed a receipt',
      'user' => $sess,
      'type' => 'Frontdesk',

    );

    $this->insert_model->log($data);
    $data = array(
      'id_reports' => $id_reports,
      'account' => $sess,
      'amount_give' => $give,
      'card_number' => $card,
      'connect_book' => $this->get_model->frontdeskConnectBooking($id),
      'result_room_form' => $this->get_model->frontdeskListOfCheckedInbyId($id),
      'room_number' => $this->get_model->frondeskGetRoomNoRestriction(),
      'result_room_checked' => $this->get_model->frondeskGetRoomCheckedById($id),
      'result_room_type' => $this->get_model->getRoomTypes(),
      'result_deduction' => $this->get_model->frontdeskgetDeduction(),
      'result_total' => $this->get_model->frontdeskTOtalBalance($id),
      'total_amount' => $this->get_model->frontdeskCharge($id),
      'result_restaurant_charge' => $this->get_model->frontdeskgetChargeToRoom($id),
      /////updaate 2.0////
      'total_charge_resto' => $this->get_model->counttotalFOchargeresto($id),
      'total_charge_coffee' => $this->get_model->counttotalFOchargecoffee($id),
      'total_charge_amen' => $this->get_model->counttotalFOchargeAmenites($id),
      'get_charge_resto' => $this->get_model->selectChargeResto($id),
      'get_charge_coffee' => $this->get_model->selectChargeCoffee($id),
      'get_charge_amen' => $this->get_model->selectChargeAmen($id),

      ////edn update 2.0//
    );
    $this->load->view('body/frontdesk/print_reciept', $data);
  }

  function printForm($id) {
    if ($this->session->userdata('connect') == true);
    $sess = $this->session->userdata('username');
    //$ids = $this->session->userdata('user_id');
    $reports = $this->db->query('select * from all_reports where if_frontdesk="' . $id . '" order by id_reports desc limit 1');
    $id_reports = "";
    $view = "";
    $give = "";
    $card = "";
    $acc  = "";


    if ($reports->num_rows() > 0) {
      $row = $reports->row();
      $id_reports = $row->id_reports;
      $view = $row->view_reciept;
      $give = $row->amount_give;
      $card = $row->card_number;
      $acc = $row->account_process;
    }

    if ($this->session->userdata('connect') == true);
    # code...
    $sess = $this->session->userdata('username');
    if ($this->session->userdata('connect') == true);
    $ids = $this->session->userdata('user_id');
    $prompt = $this->db->query('select * from check_form where id="' . $id . '"');
    $id_if_reserve = "";
    if ($prompt->num_rows() > 0) {
      $row = $prompt->row();
      $id_if_reserve = $row->id_if_reserve;
    }



    $data = array(
      'id_reports' => $id_reports,
      'account' => $sess,
      'amount_give' => $give,
      'card_number' => $card,
      'connect_book' => $this->get_model->frontdeskConnectBooking($id),
      'result_room_form' => $this->get_model->frontdeskListOfCheckedInbyId($id),
      'room_number' => $this->get_model->frondeskGetRoom(),
      'result_room_checked' => $this->get_model->frondeskGetRoomCheckedById($id),
      'result_room_type' => $this->get_model->getRoomTypes(),
      'result_deduction' => $this->get_model->frontdeskgetDeduction(),
      'result_total' => $this->get_model->frontdeskTOtalBalance($id),
      'result_reservation' => $this->get_model->frontdeskgetReservationDetails($id_if_reserve),

      'get_user' => $this->get_model->frontdeskGetUserDatails($ids),
      'total_amount' => $this->get_model->frontdeskCharge($id),
      'result_restaurant_charge' => $this->get_model->frontdeskgetChargeToRoom($id),
      'result_restaurant_charge_cof' => $this->get_model->frontdeskgetChargeToRoomcof($id),
      'lols' => $id

    );
    $this->load->view('body/frontdesk/layoutHotel', $data);
  }

  function printRecieptRestaurant($id_reports) {
    if ($this->session->userdata('connect') == true);
    $sess = $this->session->userdata('username');
    $res = $this->session->userdata('restaurant');
    $id = $this->session->userdata('user_id');
    $reports = $this->db->query('select * from all_reports where id_reports="' . $id_reports . '" order by id_reports desc limit 1');
    $id_reports = "";
    $view = "";
    $give = "";
    $card = "";
    $acc  = "";


    if ($reports->num_rows() > 0) {
      $row = $reports->row();
      $id_reports = $row->id_reports;
      $view = $row->view_reciept;
      $give = $row->amount_give;
      $card = $row->card_number;
      $acc = $row->account_process;
    }


    $data = array(
      'content' => '' . $sess . ' printed a receipt',
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
      'product_cart_receipt' => $this->get_model->getDataCartReciept($id_reports, $res),
      'total_amount_receipt' => $this->get_model->restaurantTotalBalanceReciept($id_reports, $res),
    );
    $this->load->view('body/restaurant/print_process', $data);
  }

  function printRecieptRestaurantPerTable($str) {
    $string = explode('M', $str);

    $id_reports = $string[0];
    $id = $string[1];
    if ($this->session->userdata('connect') == true);
    $sess = $this->session->userdata('username');
    $res = $this->session->userdata('restaurant');
    // $id = $this->session->userdata('user_id');
    $reports = $this->db->query('select * from all_reports where id_reports="' . $id_reports . '" order by id_reports desc limit 1');
    $id_reports = "";
    $view = "";
    $give = "";
    $card = "";
    $acc  = "";


    if ($reports->num_rows() > 0) {
      $row = $reports->row();
      $id_reports = $row->id_reports;
      $view = $row->view_reciept;
      $give = $row->amount_give;
      $card = $row->card_number;
      $acc = $row->account_process;
    }


    $data = array(
      'content' => '' . $sess . ' printed a receipt',
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
      'product_cart_receipt' => $this->get_model->getDataCartRecieptpertable($id_reports, $id, $res),
      'total_amount_receipt' => $this->get_model->restaurantTotalBalanceRecieptpertable($id_reports, $id, $res),

    );
    $this->load->view('body/restaurant/print_per_table', $data);
  }

  function printRecieptCoffeeshop() {
    if ($this->session->userdata('connect') == true);
    # code...
    $sess = $this->session->userdata('username');
    $data = array(
      'content' => '' . $sess . ' printed a receipt',
      'user' => $sess,
      'type' => 'Housekeeping',

    );

    $this->insert_model->log($data);
    $data = array(
      'result_product_name' => $this->get_model->coffeegetProductRes(),
      'product_cart' => $this->get_model->CoffeeshopgetDataCart(),
      'total_amount' => $this->get_model->coffeeshopTotalBalance()
    );
    $this->load->view('body/coffeeshop/print_process', $data);
  }

  function printRecieptCoffeeshopPerTable($id) {
    if ($this->session->userdata('connect') == true);
    # code...
    $sess = $this->session->userdata('username');
    $data = array(
      'content' => '' . $sess . ' printed a receipt',
      'user' => $sess,
      'type' => 'Housekeeping',

    );

    $this->insert_model->log($data);
    $data = array(
      'id' => $id,
      'result_name' => $this->get_model->coffeeshopgetTablesbyId($id),
      'result_product_name' => $this->get_model->coffeegetProductRes(),
      'product_cart' => $this->get_model->coffeeshopgetDataCartbyTable($id),
      'total_amount' => $this->get_model->coffeeshopTotalBalancePerTable($id)
    );
    $this->load->view('body/coffeeshop/print_per_table', $data);
  }

  function HousekeepingReadylols() {
    $data = array(
      'room_result' => $this->get_model->houseKeepinggetRoomReady(),
      'notif' => $this->get_model->housekeepingGetNotif()
    );
    $this->load->view('body/housekeeping/layout/header', $data);
    $this->load->view('body/housekeeping/list_of_room_trial_dabs', $data);
    $this->load->view('body/housekeeping/layout/footer');
  }

  function HousekeepingReadylolss() {
    $this->load->view('body/housekeeping/sample');
  }

  function CountReserve() {
    if ($this->session->userdata('connect') == true);
    $ids = $this->session->userdata('user_id');

    $dates = $this->input->post('date');
    $newDate1 = date("m/d/Y", strtotime($dates));
    $data = array(
      'roomType1' => $this->get_model->roomTypeGet($newDate1, 'Executive Room / Family Room'),
      'roomType2' => $this->get_model->roomTypeGet($newDate1, 'Deluxe (Twin)'),
      'roomType3' => $this->get_model->roomTypeGet($newDate1, 'Executive Suite'),
      'roomType4' => $this->get_model->roomTypeGet($newDate1, 'Seaside Suite (King)'),
      'roomType5' => $this->get_model->roomTypeGet($newDate1, 'Deluxe (King)'),
      'roomType6' => $this->get_model->roomTypeGet($newDate1, 'Seaside Suite Twin'),
      'dates' => $dates,
    );
    $data2 = array(
      'get_user' => $this->get_model->frontdeskGetUserDatails($ids),

    );

    if ($ty == "admin") {
      $this->load->view('body/admin/layout/header', $data2);
    } else {
      $this->load->view('body/frontdesk/layout/header', $data2);
    }
    //$this->load->view('body/frontdesk/layout/header',$data2);
    $this->load->view('body/frontdesk/reportsOfReserve', $data);
    $this->load->view('body/frontdesk/layout/footer');
  }

  function guestTransactions($name) {

    $string = explode('-', $name);
    $fnames = $string[0];
    $lnames = $string[1];

    $fname = str_replace('%20', ' ', $fnames);
    $lname = str_replace('%20', ' ', $lnames);


    if ($this->session->userdata('connect') == true);
    # code...
    $sess = $this->session->userdata('username');
    $id = $this->session->userdata('user_id');
    $data = array(

      'result' => $this->get_model->guestTransactionbyId($fname, $lname),
      'firstname' => $fname,
      'lastname' => $lname,
    );
    //$this->load->view('body/frontdesk/layout/header',$data);


    $this->load->view('body/frontdesk/layout/header', $data);
    $this->load->view('body/frontdesk/guestTrans');
    //$this->load->view('body/frontdesk/layout/footer');
  }


  // ------------------------------------------------------------------------------------------------------- //
  // ------------------------------------------------ VIEWS ------------------------------------------------ //
  // ------------------------------------------------------------------------------------------------------- //

  function verifying() {
    $id = $this->input->post('ids');
    $data = array(
      'status' => 'Reserve',
    );
    $this->update_model->frontdeskUpdatingReservation($id, $data);
    $this->session->set_flashdata('success', '$$');
    redirect('main/ListOfVerify');
  }

  function insertReservationOnlineBooking() {
    $ids = $this->input->post('ids');
    $new_start_date = $this->input->post('date1');
    $new_end_date = $this->input->post('date2');
    $roomType = $this->input->post('roomType');
    $lname = $this->input->post('lname');
    $fname = $this->input->post('fname');
    $email = $this->input->post('email');
    $contact = $this->input->post('contact');
    $roomNumber = $this->input->post('roomNumber');

    $current_date = date("m/d/Y");


    $d1 = strtotime($current_date);
    $d2 = strtotime("-1 day", $d1);
    $dateSS = date('m/d/Y', $d2);


    if ($current_date == $new_start_date or $dateSS == $new_start_date) {
      // 		$new_start_date = "05/13/2022";
      // $new_end_date = "05/14/2022"; //label ='".$roomNumber."' and 


      // (start_date <= '".$new_start_date."' AND end_date >= '".$new_end_date."') OR
      // 							 (start_date <= '".$new_start_date."' AND end_date >= '".$new_start_date."') OR
      // 							 (start_date >= '".$new_end_date."' AND end_date <= '".$new_end_date."')
      // $query = $this->db->query("SELECT * FROM bookings inner join rooms_booking on bookings.room = rooms_booking.id where room_number_id ='".$roomNumber."' and ((start_date > '".$new_start_date."' AND start_date < '".$new_end_date."') OR
      // 			 (end_date > '".$new_start_date."' AND end_date <= '".$new_end_date."') OR
      // 			 (start_date < '".$new_start_date."' AND end_date >= '".$new_end_date."')) ");

      // $query = $this->db->query("SELECT * FROM bookings inner join rooms_booking on bookings.room = rooms_booking.id where $new_start_date <= 'end_date' AND $new_end_date >= 'start_date'");

      // if ($query->num_rows() > 0)
      //           {

      //              $this->session->set_flashdata('error', '$$'); 
      //             $this->redirect();
      //    			echo "conflict";
      //           } else {

      $get_id = $this->db->query('select * from rooms_booking where room_number_id="' . $roomNumber . '"');
      $id = "";
      if ($get_id->num_rows() > 0) {
        $row = $get_id->row();
        $id = $row->id;
      }


      $data = array(
        'start_date' => $new_start_date,
        'end_date' => $new_end_date,
        'text' => $lname . "," . $fname,
        'status' => "3",
        'room' => $id,
        'contact_no' => $contact,
        'email_add' => $email,
      );
      $this->insert_model->insertReserveUsingOnlineBooking($data);

      $updateData = array(
        'status' => 'Check In',
      );
      $this->update_model->UpdateDataforReserve($updateData, $ids);



      $this->session->set_flashdata('success', '$$');
      $this->redirect();
      //}

    } else {
      $this->session->set_flashdata('errors', '$$');
      $this->redirect();
    }
  }

  function updateReservationsDateToextend() {
    $red = $this->input->post("redi");
    echo $rm = $this->input->post("rm");
    echo $id = $this->input->post("id");
    echo $new_start_date = $this->input->post("ci");
    echo $new_end_date = $this->input->post("co");

    // $query = $this->db->query("SELECT * FROM bookings inner join rooms_booking on bookings.room = rooms_booking.id where bookings.id <> ".$id." and room ='".$rm."' and ((start_date > '".$new_start_date."' AND start_date < '".$new_end_date."') OR
    // 			 (end_date > '".$new_start_date."' AND end_date <= '".$new_end_date."') OR
    // 			 (start_date < '".$new_start_date."' AND end_date >= '".$new_end_date."')) ");

    // $query = $this->db->query("SELECT * FROM bookings inner join rooms_booking on bookings.room = rooms_booking.id where $new_start_date <= 'end_date' AND $new_end_date >= 'start_date'");

    // if ($query->num_rows() > 0)
    //           {

    //          $this->session->set_flashdata('error', '$$'); 
    //          if ($this->session->userdata('connect') == true);
    //    			$sess = $this->session->userdata('username');
    // 	$data = array(
    // 		'content' => ''.$sess.' Extending the dates but it is conflict ',
    // 		'user' => $sess,
    // 		'type' => 'Frontdesk',
    // 		'frontdesk_id' => $red,
    // 		'redirection' => 'index.php/main/',
    // 		);

    // $this->insert_model->log($data);
    //          $this->redirect();
    // 			echo "conflict";
    //        } else {



    $data = array(
      'start_date' => $new_start_date,
      'end_date' => $new_end_date,
    );
    $this->update_model->updateDateforBookingextend($id, $data);
    if ($this->session->userdata('connect') == true);
    $sess = $this->session->userdata('username');
    $data = array(
      'content' => '' . $sess . ' Successfully updated the dates ',
      'user' => $sess,
      'type' => 'Frontdesk',
      'frontdesk_id' => $red,
      'redirection' => 'index.php/main/',
    );

    $this->insert_model->log($data);
    $this->session->set_flashdata('success', '$$');
    $this->redirect();
  }


  function cancelOnlineBooking($ids) {
    $updateData = array(
      'status' => 'Cancel',
    );
    $this->update_model->UpdateDataforReserve($updateData, $ids);
    $this->session->set_flashdata('success', '$$');
    redirect('main/ListOfVerify');
  }

  function cancelWalkinBooking($ids) {
    $updateData = array(
      'status' => 'Walkin Cancel',
    );
    $this->update_model->UpdateDataforReserve($updateData, $ids);
    $this->session->set_flashdata('success', '$$');
    $this->redirect();
  }

  function deleteReservation($id) {
    if ($this->session->userdata('connect') == true);
    # code...
    $sess = $this->session->userdata('username');
    $data = array(
      'content' => '' . $sess . ' deleted a reservation',
      'user' => $sess,
      'type' => 'Frontdesk',

    );

    $this->insert_model->log($data);
    $this->delete_model->frontdeskDeleteReservation($id);
    $this->session->set_flashdata('success', '$$');
    redirect('main/listOfReservation');
  }

  function addDetailsChekedRoom() {
    if ($this->session->userdata('connect') == true);
    # code...
    $sess = $this->session->userdata('username');
    $room_id = $this->input->post('id');
    $redi = $this->input->post('check_id');
    $id_number = $this->input->post('idnum');
    $name = $this->input->post('namedis');
    $data = array(
      'details_discount_name' => $name,
      'details_discount_id' => $id_number
    );
    $this->update_model->frondeskUpdateRoomChecked($room_id, $data);

    $data = array(
      'content' => '' . $sess . ' updated the details on discount form ',
      'user' => $sess,
      'type' => 'Frontdesk',
      'frontdesk_id' => $redi,
      'redirection' => 'index.php/main/',
    );


    $this->insert_model->log($data);
    $this->session->set_flashdata('success', '$$');
    redirect('main/checked/' . $redi);
  }

  function addDetailsChekedPerRoom() {
    if ($this->session->userdata('connect') == true);
    # code...
    $sess = $this->session->userdata('username');
    $room_id = $this->input->post('id');
    $redi = $this->input->post('check_id');
    $name = $this->input->post('name');
    $contact = $this->input->post('contact');
    $email = $this->input->post('email');
    $data = array(
      'room_details_name' => $name,
      'room_details_contact' => $contact,
      'room_details_email' => $email
    );
    $this->update_model->frondeskUpdateRoomChecked($room_id, $data);

    if ($this->session->userdata('connect') == true);
    $sess = $this->session->userdata('username');
    $data = array(
      'content' => '' . $sess . ' updated the guest details ',
      'user' => $sess,
      'type' => 'Frontdesk',
      'frontdesk_id' => $redi,
      'redirection' => 'index.php/main/',
    );

    $this->insert_model->log($data);
    $this->session->set_flashdata('success', '$$');
    redirect('main/checked/' . $redi);
  }



  function updateReservationRoomType() {
    if ($this->session->userdata('connect') == true);
    # code...
    $sess = $this->session->userdata('username');
    $id = $this->input->post('id');
    $room_type = $this->input->post('room_type');
    $room_number = $this->input->post('room_number');
    $redi = $this->input->post('redi');

    $data = array(
      'room_type_id' => $room_type,
      'room_number_res' => $room_number
    );
    $this->update_model->frontdeskUpdateRoomTypeReserved($id, $data);

    $data = array(
      'content' => '' . $sess . ' updated Reservation Room Type',
      'user' => $sess,
      'type' => 'Frontdesk',

    );

    $this->insert_model->log($data);
    $this->session->set_flashdata('success', '$$');
    redirect('main/updateReservation/' . $redi);
  }

  function deleteReservationRoomType() {
    if ($this->session->userdata('connect') == true);
    # code...
    $sess = $this->session->userdata('username');
    $id = $this->input->post('id');
    $redi = $this->input->post('id_red');
    $this->delete_model->frontdeskDeleteRoomTypeReserved($id);

    $data = array(
      'content' => '' . $sess . ' deleted a Reservation Room Type',
      'user' => $sess,
      'type' => 'Frontdesk',

    );

    $this->insert_model->log($data);
    $this->session->set_flashdata('success', '$$');
    redirect('main/updateReservation/' . $redi);
  }

  function updatingReservation() {
    $id = $this->input->post('id');
    if ($this->session->userdata('connect') == true);
    # code...
    $sess = $this->session->userdata('username');
    $this->form_validation->set_rules('last_name', 'last_name', 'required');
    $this->form_validation->set_rules('first_name', 'first_name', 'required');
    $this->form_validation->set_rules('middle_name', 'middle_name', 'required');
    //$this->form_validation->set_rules('room_no', 'room_no', 'required');
    // $this->form_validation->set_rules('extra_person', 'extra_person', 'required');
    // $this->form_validation->set_rules('extra_bed', 'extra_bed', 'required');
    //$this->form_validation->set_rules('check_date', 'check_date', 'required');
    $this->form_validation->set_rules('contact', 'contact', 'required');
    $this->form_validation->set_rules('email', 'email', 'required');
    $this->form_validation->set_rules('address', 'address', 'required');

    if ($this->form_validation->run() != FALSE) {
      $id = $this->input->post('id');
      $last_name = $this->input->post('last_name');
      $first_name = $this->input->post('first_name');
      $middle_name = $this->input->post('middle_name');
      //$room_no = $this->input->post('room_no');
      //$extra_person = $this->input->post('extra_person');
      //$extra_bed = $this->input->post('extra_bed');
      //$check_date = $this->input->post('check_date');
      $email = $this->input->post('email');
      $address = $this->input->post('address');
      $contact = $this->input->post('contact');
      $advance = $this->input->post('advance');

      echo $str = $this->input->post('daterange');

      $string = explode(' - ', $str);
      $from = $string[0];
      $to = $string[1];


      // $date_1 = new DateTime($froms);
      // echo $from = $date_1->format('Y-m­-d');

      // $date_2 = new DateTime($tos);
      // echo $to = $date_2->format('Y-m­-d');


      $data = array(
        'last_name' => $last_name,
        'first_name' => $first_name,
        'middle_name' => $middle_name,
        'email' => $email,
        'address' => $address,
        'contact' => $contact,
        'advance_payment' => $advance,
        'check_id_date' => $from,
        'check_out_date' => $to,
      );

      $this->update_model->frontdeskUpdatingReservation($id, $data);


      // Set the success message
      $this->session->set_flashdata('success', '$$');
      redirect('main/updateReservation/' . $id);
    }
    redirect('main/updateReservation/' . $id);
  }

  //////////////////////////////////
  ////Checkin Status           /////
  /////////////////////////////////




  function insertCheckInForm() {
    if ($this->session->userdata('connect') == true);
    # code...
    $sess = $this->session->userdata('username');
    $last_name = $this->input->post('last_name');
    $first_name = $this->input->post('first_name');
    $middle_name = $this->input->post('middle_name');
    $contact = $this->input->post('contact');
    $email = $this->input->post('email');
    $address = $this->input->post('address');
    $advance = $this->input->post('advance');



    $data = array(
      'last_name' => $last_name,
      'first_name' => $first_name,
      'middle_name' => $middle_name,
      'contact' => $contact,
      'email' => $email,
      'address' => $address,
      'advance_payment' => $advance,
    );
    $this->insert_model->frontdeskCheckingIn($data);

    $get_id = $this->db->query('select * from check_form order by id desc limit 1');
    $id = "";
    if ($get_id->num_rows() > 0) {
      $row = $get_id->row();
      $id = $row->id;
    }

    $data = array(
      'content' => '' . $sess . ' added information to Checked',
      'user' => $sess,
      'type' => 'Frontdesk',

    );

    $this->insert_model->log($data);
    $this->session->set_flashdata('success', '$$');
    redirect('main/checked/' . $id);
  }

  function insertReserveCheckInForm() {
    if ($this->session->userdata('connect') == true);
    # code...
    $sess = $this->session->userdata('username');
    $idss = $this->session->userdata('user_id');
    $id = $this->input->post('id');
    $last_name = $this->input->post('last_name');
    $first_name = $this->input->post('first_name');
    $middle_name = $this->input->post('middle_name');
    $contact = $this->input->post('contact');
    $email = $this->input->post('email');
    $address = $this->input->post('address');
    $advance = $this->input->post('advance_payment');
    $checkindate = $this->input->post('check_id_date');
    $checkoutdate = $this->input->post('check_out_date');

    $data = array(
      'last_name' => $last_name,
      'first_name' => $first_name,
      'middle_name' => $middle_name,
      'contact' => $contact,
      'email' => $email,
      'address' => $address,
      'advance_payment' => $advance,
      'check_id_date' => $checkindate,
      'check_out_date' => $checkoutdate,
      'id_if_reserve' => $id,
      'id_for_fetch' => $idss
    );
    $this->insert_model->frontdeskCheckingIn($data);

    $get_id = $this->db->query('select * from check_form where id_for_fetch="' . $idss . '" order by id desc limit 1');
    $ids = "";
    if ($get_id->num_rows() > 0) {
      $row = $get_id->row();
      echo $ids = $row->id;
    }
    $data = array(
      'status' => 'Checkin'
    );
    $this->update_model->frontdeskUpdatingReservation($id, $data);

    $data = array(
      'content' => '' . $sess . ' transferred reservation to Checked',
      'user' => $sess,
      'type' => 'Frontdesk',

    );

    $this->insert_model->log($data);
    $this->session->set_flashdata('success', '$$');
    redirect('main/checked/' . $ids);
  }



  function deleteChecked() {
    $id = $this->input->post('id');
    $room_number = $this->input->post('room_number');
    $redi = $this->input->post('redi');


    $prompt = $this->db->query('select * from rooms_checked where id_rooms="' . $id . '"');
    $status = "";
    if ($prompt->num_rows() > 0) {
      $row = $prompt->row();
      $status = $row->room_status;
    }
    if ($status == 'Checkout') {

      $this->session->set_flashdata('error', '$$');
      redirect('main/checked/' . $redi);
    } else {

      $this->delete_model->frontdeskRoomChecked($id);

      $data = array(
        'status_by_room' => 'EMPTY'
      );
      $this->update_model->frontdeskupdateRoom($room_number, $data);

      $data = array(
        'content' => '' . $sess . ' canceled the Room to checked',
        'user' => $sess,
        'type' => 'Frontdesk',

      );

      $this->insert_model->log($data);

      $this->session->set_flashdata('success', '$$');
      redirect('main/checked/' . $redi);
    }
    $this->session->set_flashdata('error', '$$');
    redirect('main/checked/' . $redi);
  }

  function checkoutChecked() {
    if ($this->session->userdata('connect') == true);
    # code...
    $sess = $this->session->userdata('username');
    if ($this->session->userdata('connect') == true);
    $sess = $this->session->userdata('user_id');


    $id = $this->input->post('id');
    $room_number = $this->input->post('room_number');
    $redi = $this->input->post('redi');

    $data = array(
      'room_status' => 'Checkout'
    );
    $this->update_model->frontdeskUpdateCheckout($id, $data);
    $data = array(
      'status_by_room' => 'Checkout'
    );
    $this->update_model->frontdeskupdateRoom($room_number, $data);

    $data = array(
      'content' => 'Room ' . $room_number . ' is now Checked Out',
      'user' => $sess,
      'type' => 'Housekeeping',
      'redirection' => 'index.php/main/HousekeepingList',
    );
    $this->insert_model->housekeepingInsertNotif($data);

    $data = array(
      'content' => '' . $sess . ' Checked Out a Room',
      'user' => $sess,
      'type' => 'Frontdesk',

    );

    $this->insert_model->log($data);

    $this->session->set_flashdata('success', '$$');
    redirect('main/checked/' . $redi);
  }




  function frontdeskBlockRoom($id) {
    if ($this->session->userdata('connect') == true);
    # code...
    $sess = $this->session->userdata('username');
    if ($this->session->userdata('connect') == true);
    $ids = $this->session->userdata('user_id');

    $prompt = $this->db->query('select * from rooms where id="' . $id . '"');
    $rooms_status = "";
    if ($prompt->num_rows() > 0) {
      $row = $prompt->row();
      $rooms_status = $row->status_by_room;
    }
    if ($rooms_status == 'EMPTY') {
      $data = array(
        'status_by_room' => 'BLOCKED'
      );
      $this->update_model->frontdeskblockRoom($id, $data);

      $data = array(
        'content' => '' . $sess . ' Blocked a Room',
        'user' => $sess,
        'type' => 'Frontdesk',

      );

      $this->insert_model->log($data);
      $this->session->set_flashdata('success', '$$');
      redirect('main/rooms/');
    } else {

      $this->session->set_flashdata('error', '$$');
      redirect('main/rooms/');
    }

    $this->session->set_flashdata('error', '$$');
    redirect('main/rooms/');
  }

  function frontdeskUNBlockRoom($id) {
    if ($this->session->userdata('connect') == true);
    # code...
    $sess = $this->session->userdata('username');

    $prompt = $this->db->query('select * from rooms where id="' . $id . '"');
    $rooms_status = "";
    if ($prompt->num_rows() > 0) {
      $row = $prompt->row();
      $rooms_status = $row->status_by_room;
    }
    if ($rooms_status == 'BLOCKED') {
      $data = array(
        'status_by_room' => 'EMPTY'
      );
      $this->update_model->frontdeskblockRoom($id, $data);
      $data = array(
        'content' => '' . $sess . ' Unblocked a Room',
        'user' => $sess,
        'type' => 'Frontdesk',

      );

      $this->insert_model->log($data);
      $this->session->set_flashdata('success', '$$');
      redirect('main/rooms/');
    } else {

      $this->session->set_flashdata('error', '$$');
      redirect('main/rooms/');
    }

    $this->session->set_flashdata('error', '$$');
    redirect('main/rooms/');
  }
  function frontdeskUploadImage() {
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


      // Set the success message
      $data = array(
        'content' => '' . $sess . ' updated Profile Picture',
        'user' => $sess,
        'type' => 'Frontdesk',

      );

      $this->insert_model->log($data);
      $this->session->set_flashdata('success', '$$');
      redirect('main/profile/');
    }
    $this->session->set_flashdata('error', '$$');
    redirect('main/profile/');
  }


  function FrontdeskUpdateProfileDetails() {
    $this->update_model->updateUser();
    $this->session->set_flashdata('success', '$$');
    $this->redirect();
  }


  function updateChecked() {

    if ($this->session->userdata('connect') == true);
    # code...
    $sess = $this->session->userdata('user_id');


    $room_number = $this->input->post('room_number');
    $check_id = $this->input->post('check_id');
    $add_person = $this->input->post('add_person');
    $add_bed = $this->input->post('add_bed');
    $dedeuction = $this->input->post('deduction');
    $room_id = $this->input->post('room_id');
    echo $breakfast = $this->input->post('breakfast');
    //$room_type = $this->input->post('room_type');

    ///logs update 2.0
    $getLogsToUpdate = $this->db->query('select * from rooms_checked where id_rooms="' . $room_id . '"');
    $personAuth = "";
    $bedAuth = "";
    $deductionAuth = "";



    if ($getLogsToUpdate->num_rows() > 0) {
      $row = $getLogsToUpdate->row();
      $personAuth = $row->add_person;
      $bedAuth = $row->add_bed;
      $deductionAuth = $row->dedeuction;
    }

    // 	'add_person' => $add_person,
    // 'add_bed' => $add_bed,
    // 'dedeuction' => $dedeuction,
    if ($personAuth == $add_person) {
      # code...
    } else {
      if ($this->session->userdata('connect') == true);
      $sess = $this->session->userdata('username');
      $data = array(
        'content' => '' . $sess . ' updated the Extra Person to (' . $add_person . ')',
        'user' => $sess,
        'type' => 'Frontdesk',
        'frontdesk_id' => $check_id,
        'redirection' => 'index.php/main/',
      );

      $this->insert_model->log($data);
    }

    if ($bedAuth == $add_bed) {
      # code...
    } else {
      if ($this->session->userdata('connect') == true);
      $sess = $this->session->userdata('username');
      $data = array(
        'content' => '' . $sess . ' updated the Extra bed to (' . $add_bed . ')',
        'user' => $sess,
        'type' => 'Frontdesk',
        'frontdesk_id' => $check_id,
        'redirection' => 'index.php/main/',
      );

      $this->insert_model->log($data);
    }

    if ($deductionAuth == $dedeuction) {
      // echo $refund;
      // echo "<br>";
      // echo $refundAmount;
      // echo "refund";
    } else {

      if ($this->session->userdata('connect') == true);
      $sess = $this->session->userdata('username');
      $data = array(
        'content' => '' . $sess . ' updated the Dsicount',
        'user' => $sess,
        'type' => 'Frontdesk',
        'frontdesk_id' => $check_id,
        'redirection' => 'index.php/main/',
      );

      $this->insert_model->log($data);
    }
    //end logs 2.0



    $price_type = $this->db->query('select * from room_type inner join rooms on room_type.id=rooms.room_type_id where rooms.room_number="' . $room_number . '"');
    $pricing_room = "";
    if ($price_type->num_rows() > 0) {
      $row = $price_type->row();
      $pricing_room = $row->pricing_type;
    }

    $extrabed = $this->db->query('select * from room_bed');
    $pricing_bed = "";
    if ($extrabed->num_rows() > 0) {
      $row = $extrabed->row();
      $pricing_bed = $row->bed_pricing;
    }

    $extraperson = $this->db->query('select * from room_person');
    $pricing_person = "";
    if ($extraperson->num_rows() > 0) {
      $row = $extraperson->row();
      $pricing_person = $row->person_pricing;
    }
    $dedu = $this->db->query('select * from deduction where id_ded="' . $dedeuction . '"');
    $minus = "";
    if ($dedu->num_rows() > 0) {
      $row = $dedu->row();
      $minus = $row->deduction;
    }

    // $bf =$this->db->query('select * from room_type where id="'.$room_type.'"');
    // $bf_price="";
    // if ($bf->num_rows() > 0)
    // {
    //    $row = $bf->row(); 
    //    $bf_price=$row->pricing_breakfast; 

    // }
    $bf = $this->db->query('select * from rooms inner join room_type on rooms.room_type_id = room_type.id where room_number="' . $room_number . '"');
    $bf_price = "";
    if ($bf->num_rows() > 0) {
      $row = $bf->row();
      echo $bf_price = $row->pricing_breakfast;
    }

    if ($breakfast == '200') {
      $price_bf = $bf_price;
    } else {
      $price_bf = '0';
    }


    //     		$str =$this->input->post('daterange');

    //     		$string = explode(' - ', $str);
    // echo $from = $string[0];
    // echo $to = $string[1];






    $prompt = $this->db->query('select * from rooms_checked where id_rooms="' . $room_id . '"');
    $status = "";
    if ($prompt->num_rows() > 0) {
      $row = $prompt->row();
      $status = $row->room_status;
    }
    if ($status == 'Checkout') {

      $this->session->set_flashdata('error', '$$');
      redirect('main/checked/' . $check_id);
    } else {
      //'room_number' => $room_number,
      //'room_type_id' =>$room_type,
      // 'check_in_date' => $from,
      // 'check_out_date' => $to,
      $data = array(

        'add_person' => $add_person,
        'add_bed' => $add_bed,
        'dedeuction' => $dedeuction,
        'breakfast' => $breakfast,

        'price_room' => $pricing_room,
        'price_bed' => $pricing_bed,
        'price_person' => $pricing_person,
        'price_deduct' => $minus,
        'breakfast_id' => $price_bf,
        'type_process' => $sess
      );

      $this->update_model->frondeskUpdateRoomChecked($room_id, $data);

      $data = array(
        'status_by_room' => 'CHECK'
      );
      $this->update_model->frontdeskupdateRoom($room_number, $data);


      if ($add_bed == '0') {
        # code...
      } else {
        $data = array(
          'content' => 'Room ' . $room_number . ' is requesting (' . $add_bed . ') extra bed',
          'user' => $sess,
          'type' => 'Housekeeping',
          'redirection' => 'index.php/main/HousekeepingBedRequest',
        );
        $this->insert_model->housekeepingInsertNotif($data);
      }
      if ($this->session->userdata('connect') == true);
      # code...
      $sess = $this->session->userdata('username');
      $data = array(
        'content' => '' . $sess . ' updated details',
        'user' => $sess,
        'type' => 'Frontdesk',

      );

      $this->insert_model->log($data);

      $this->session->set_flashdata('success', '$$');
      redirect('main/refresh/' . $check_id);
    }

    $this->session->set_flashdata('error', '$$');
    redirect('main/refresh/' . $check_id);
  }

  function insertRoomForCheckIn() {
    if ($this->session->userdata('connect') == true);
    # code...
    $sess = $this->session->userdata('user_id');
    $room_number = $this->input->post('room_number');
    $check_id = $this->input->post('check_id');
    $add_person = $this->input->post('add_person');
    $add_bed = $this->input->post('add_bed');
    $breakfast = $this->input->post('breakfast');
    $dedeuction = $this->input->post('deduction');
    $room_type = $this->input->post('room_type');


    $room_number_res = $this->db->query('select * from rooms_checked where room_number="' . $room_number . '"');
    $res_number = "";
    if ($room_number_res->num_rows() > 0) {
      $row = $room_number_res->row();
      $res_number = $row->room_number;
    }

    $price_type = $this->db->query('select * from room_type inner join rooms on room_type.id=rooms.room_type_id where rooms.room_number="' . $room_number . '"');
    $pricing_room = "";
    $room_number_id = "";
    if ($price_type->num_rows() > 0) {
      $row = $price_type->row();
      $pricing_room = $row->pricing_type;
      $room_number_id = $row->id;
    }

    $extrabed = $this->db->query('select * from room_bed');
    $pricing_bed = "";
    if ($extrabed->num_rows() > 0) {
      $row = $extrabed->row();
      $pricing_bed = $row->bed_pricing;
    }

    $extraperson = $this->db->query('select * from room_person');
    $pricing_person = "";
    if ($extraperson->num_rows() > 0) {
      $row = $extraperson->row();
      $pricing_person = $row->person_pricing;
    }
    $dedu = $this->db->query('select * from deduction where id_ded="' . $dedeuction . '"');
    $minus = "";
    if ($dedu->num_rows() > 0) {
      $row = $dedu->row();
      $minus = $row->deduction;
    }

    // $bf =$this->db->query('select * from room_type where id="'.$room_type.'"');
    // $bf_price="";
    // if ($bf->num_rows() > 0)
    // {
    //    $row = $bf->row(); 
    //    $bf_price=$row->pricing_breakfast; 

    // }


    $bf = $this->db->query('select * from rooms inner join room_type on rooms.room_type_id = room_type.id where room_number="' . $room_number . '"');
    $bf_price = "";
    if ($bf->num_rows() > 0) {
      $row = $bf->row();
      echo $bf_price = $row->pricing_breakfast;
    }

    if ($breakfast == '200') {
      $price_bf = $bf_price;
    } else {
      $price_bf = '0';
    }


    $str = $this->input->post('daterange');

    $string = explode(' - ', $str);
    echo $from = $string[0];
    echo $to = $string[1];

    $data = array(
      'room_number' => $room_number,
      'room_number_id' => $room_number_id,
      'check_id' => $check_id,
      'add_person' => $add_person,
      'add_bed' => $add_bed,
      'dedeuction' => $dedeuction,
      'breakfast' => $breakfast,
      'room_type_id' => $room_type,
      'price_room' => $pricing_room,
      'price_bed' => $pricing_bed,
      'price_person' => $pricing_person,
      'price_deduct' => $minus,
      'check_in_date' => $from,
      'check_out_date' => $to,
      'breakfast_id' => $price_bf,
      'type_process' => $sess
    );
    $this->insert_model->insertEvent($data);

    if ($add_bed == '0') {
      # code...
    } else {
      $data = array(
        'content' => 'Room ' . $room_number . ' is requesting (' . $add_bed . ') extra bed',
        'user' => $sess,
        'type' => 'Housekeeping',
        'redirection' => 'index.php/main/HousekeepingBedRequest',
      );
      $this->insert_model->housekeepingInsertNotif($data);
    }

    $data = array(
      'status_by_room' => 'CHECK'
    );
    $this->update_model->frontdeskupdateRoom($room_number, $data);
    $data = array(
      'title' => 'Rm. ' . $room_number . '(Check In)',
      'start' => $from,
      'end' => $to,
      'className' => 'event-blue',
    );
    $this->insert_model->insertEvent($data);

    $data = array(
      'content' => '' . $sess . ' updated details',
      'user' => $sess,
      'type' => 'Frontdesk',

    );

    $this->insert_model->log($data);
    $this->session->set_flashdata('success', '$$');
    redirect('main/refresh/' . $check_id);
  }

  function checkingIN() {
    if ($this->session->userdata('connect') == true);
    # code...
    $sess = $this->session->userdata('username');
    $this->form_validation->set_rules('last_name', 'last_name', 'required');
    $this->form_validation->set_rules('first_name', 'first_name', 'required');
    $this->form_validation->set_rules('middle_name', 'middle_name', 'required');
    $this->form_validation->set_rules('extra_person', 'extra_person', 'required');
    $this->form_validation->set_rules('extra_bed', 'extra_bed', 'required');
    $this->form_validation->set_rules('contact', 'contact', 'required');
    $this->form_validation->set_rules('email', 'email', 'required');
    $this->form_validation->set_rules('address', 'address', 'required');
    $this->form_validation->set_rules('advance', 'advance', 'required');
    $this->form_validation->set_rules('deduction', 'deduction', 'required');

    if ($this->form_validation->run() != FALSE) {


      $last_name = $this->input->post('last_name');
      $first_name = $this->input->post('first_name');
      $middle_name = $this->input->post('middle_name');
      $extra_person = $this->input->post('extra_person');
      $extra_bed = $this->input->post('extra_bed');
      $contact = $this->input->post('contact');
      $email = $this->input->post('email');
      $address = $this->input->post('address');
      $advance = $this->input->post('advance');
      $deduction = $this->input->post('deduction');
      $days_ren = $this->input->post('days_ren');
      $id = $this->input->post('room_id');
      $room_id = $this->input->post('id');
      //$price_type =$this->get_model->frontdeskaddPricingTable($id);
      $price_type = $this->db->query('select * from room_type inner join rooms on room_type.id=rooms.room_type_id where rooms.id="' . $room_id . '"');
      $pricing_room = "";
      if ($price_type->num_rows() > 0) {
        $row = $price_type->row();
        $pricing_room = $row->pricing_type;
      }

      $extrabed = $this->db->query('select * from room_bed');
      $pricing_bed = "";
      if ($extrabed->num_rows() > 0) {
        $row = $extrabed->row();
        $pricing_bed = $row->bed_pricing;
      }

      $extraperson = $this->db->query('select * from room_person');
      $pricing_person = "";
      if ($extraperson->num_rows() > 0) {
        $row = $extraperson->row();
        $pricing_person = $row->person_pricing;
      }

      $data = array(
        'last_name' => $last_name,
        'first_name' => $first_name,
        'middle_name' => $middle_name,
        'add_person' => $extra_person,
        'add_bed' => $extra_bed,
        'contact' => $contact,
        'email' => $email,
        'address' => $address,
        'advance_payment' => $advance,
        'deduction' => $deduction,
        'room_id' => $id,
        'price_room' => $pricing_room,
        'price_person' => $pricing_person,
        'price_bed' => $pricing_bed,
        'days_ren' => $days_ren,
        'status' => "IN"

      );
      $this->insert_model->frontdeskCheckingIn($data);


      $id_direct = $this->input->post('id');
      $data = array(
        'status_by_room' => 'CHECK'
      );
      $this->update_model->frontdeskUpdateCheckRoom($id, $data);


      // Set the success message
      $this->session->set_flashdata('success', '$$');
      redirect('main/CheckFormUpdate/' . $id_direct);
    }
    redirect('main/CheckFormUpdate/' . $id_direct);
  }


  function checkingInUpdate() {
    if ($this->session->userdata('connect') == true);
    # code...
    $sess = $this->session->userdata('username');
    $last_name = $this->input->post('last_name');
    $first_name = $this->input->post('first_name');
    $middle_name = $this->input->post('middle_name');
    $contact = $this->input->post('contact');
    $email = $this->input->post('email');
    $address = $this->input->post('address');
    $advance = $this->input->post('advance');
    $check_in_id = $this->input->post('check_in_id');
    $connect = $this->input->post('connect');
    $amenName = $this->input->post('amen_name');
    $amenAmount = $this->input->post('amen_amount');
    $refundAmount = $this->input->post('ref_amount');
    $coffee_charge = $this->input->post('coffee_charge');
    $resto_charge = $this->input->post('resto_charge');
    $card_advance = $this->input->post('card_advance');
    $card_name = $this->input->post('card_name');
    $card_number = $this->input->post('card_number');


    ///logs update 2.0
    $getLogsToUpdate = $this->db->query('select * from check_form where id="' . $check_in_id . '"');
    $advance_cash = "";
    $advance_card = "";
    $refund = "";
    $lname = "";
    $fname = "";
    $mname = "";
    $con = "";
    $em = "";
    $c_name = "";
    $c_number = "";


    if ($getLogsToUpdate->num_rows() > 0) {
      $row = $getLogsToUpdate->row();
      $advance_cash = $row->advance_payment;
      $advance_card = $row->card_advance;
      $refund = $row->refund_amount;
      $lname = $row->last_name;
      $fname = $row->first_name;
      $mname = $row->middle_name;
      $con = $row->contact;
      $em = $row->email;
      $c_name = $row->card_name;
      $c_number = $row->card_number;
    }

    if ($lname == $last_name) {
      # code...
    } else {
      if ($this->session->userdata('connect') == true);
      $sess = $this->session->userdata('username');
      $data = array(
        'content' => '' . $sess . ' updated the Information Lastname (' . $last_name . ')',
        'user' => $sess,
        'type' => 'Frontdesk',
        'frontdesk_id' => $check_in_id,
        'redirection' => 'index.php/main/',
      );

      $this->insert_model->log($data);
    }

    if ($fname == $first_name) {
      # code...
    } else {
      if ($this->session->userdata('connect') == true);
      $sess = $this->session->userdata('username');
      $data = array(
        'content' => '' . $sess . ' updated the Information firstname (' . $first_name . ')',
        'user' => $sess,
        'type' => 'Frontdesk',
        'frontdesk_id' => $check_in_id,
        'redirection' => 'index.php/main/',
      );

      $this->insert_model->log($data);
    }

    if ($mname == $middle_name) {
      # code...
    } else {
      if ($this->session->userdata('connect') == true);
      $sess = $this->session->userdata('username');
      $data = array(
        'content' => '' . $sess . ' updated the Information Middle Name (' . $middle_name . ')',
        'user' => $sess,
        'type' => 'Frontdesk',
        'frontdesk_id' => $check_in_id,
        'redirection' => 'index.php/main/',
      );

      $this->insert_model->log($data);
    }

    if ($con == $contact) {
      # code...
    } else {
      if ($this->session->userdata('connect') == true);
      $sess = $this->session->userdata('username');
      $data = array(
        'content' => '' . $sess . ' updated the Information Contact Number (' . $contact . ')',
        'user' => $sess,
        'type' => 'Frontdesk',
        'frontdesk_id' => $check_in_id,
        'redirection' => 'index.php/main/',
      );

      $this->insert_model->log($data);
    }

    if ($em == $email) {
      # code...
    } else {
      if ($this->session->userdata('connect') == true);
      $sess = $this->session->userdata('username');
      $data = array(
        'content' => '' . $sess . ' updated the Information Email Address (' . $email . ')',
        'user' => $sess,
        'type' => 'Frontdesk',
        'frontdesk_id' => $check_in_id,
        'redirection' => 'index.php/main/',
      );

      $this->insert_model->log($data);
    }

    if ($c_name == $card_name) {
      # code...
    } else {
      if ($this->session->userdata('connect') == true);
      $sess = $this->session->userdata('username');
      $data = array(
        'content' => '' . $sess . ' updated the Information Card Name (' . $card_name . ')',
        'user' => $sess,
        'type' => 'Frontdesk',
        'frontdesk_id' => $check_in_id,
        'redirection' => 'index.php/main/',
      );

      $this->insert_model->log($data);
    }

    if ($c_number == $card_number) {
      # code...
    } else {
      if ($this->session->userdata('connect') == true);
      $sess = $this->session->userdata('username');
      $data = array(
        'content' => '' . $sess . ' updated the Information Card Number (' . $card_number . ')',
        'user' => $sess,
        'type' => 'Frontdesk',
        'frontdesk_id' => $check_in_id,
        'redirection' => 'index.php/main/',
      );

      $this->insert_model->log($data);
    }

    if ($advance_cash == $advance) {
      # code...
    } else {
      if ($this->session->userdata('connect') == true);
      $sess = $this->session->userdata('username');
      $data = array(
        'content' => '' . $sess . ' updated the advance payment amount (' . number_format($advance, 2) . ') (CASH)',
        'user' => $sess,
        'type' => 'Frontdesk',
        'frontdesk_id' => $check_in_id,
        'redirection' => 'index.php/main/',
      );

      $this->insert_model->log($data);
    }

    if ($advance_card == $card_advance) {
      # code...
    } else {
      if ($this->session->userdata('connect') == true);
      $sess = $this->session->userdata('username');
      $data = array(
        'content' => '' . $sess . ' updated the advance payment amount (' . number_format($card_advance, 2) . ')(CARD) ',
        'user' => $sess,
        'type' => 'Frontdesk',
        'frontdesk_id' => $check_in_id,
        'redirection' => 'index.php/main/',
      );

      $this->insert_model->log($data);
    }

    if ($refund == $refundAmount) {
      echo $refund;
      echo "<br>";
      echo $refundAmount;
      echo "refund";
    } else {

      if ($this->session->userdata('connect') == true);
      $sess = $this->session->userdata('username');
      $data = array(
        'content' => '' . $sess . ' updated the Refund Amount payment amount (' . number_format($refundAmount, 2) . ')',
        'user' => $sess,
        'type' => 'Frontdesk',
        'frontdesk_id' => $check_in_id,
        'redirection' => 'index.php/main/',
      );

      $this->insert_model->log($data);
    }
    //end logs 2.0


    $NAME = $last_name . " " . $first_name;

    $data = array(
      'last_name' => $last_name,
      'first_name' => $first_name,
      'middle_name' => $middle_name,
      //'room_id' => $room_no,
      'contact' => $contact,
      'email' => $email,
      'address' => $address,
      'advance_payment' => $advance,
      'amenities_amount' => $amenAmount,
      'amenities_name' => $amenName,
      'refund_amount' => $refundAmount,
      'coffee_charge' => $coffee_charge,
      'res_charge' => $resto_charge,
      'card_advance' => $card_advance,
      'card_number' => $card_number,
      'card_name' => $card_name,

    );
    $this->update_model->frontdeskUpdateCheckIn($check_in_id, $data);
    // $sess = $this->session->userdata('username');
    // 		$data = array(
    //  		'content' => ''.$sess.' updated the Refund Amount payment amount ('.number_format($refundAmount,2).')',
    //  		'user' => $sess,
    //  		'type' => 'Frontdesk',
    //  		'frontdesk_id' => $check_in_id,
    //  		'redirection' => 'index.php/main/',
    //  		);

    //  	$this->insert_model->log($data);

    $data = array(
      'text' => $NAME,
    );
    $this->update_model->frontdeskUpdateCheckInBooking($connect, $data);

    $this->db->query('update all_reports set refund_am="' . $refundAmount . '" where if_frontdesk="' . $check_in_id . '"');

    // Set the success message
    $this->session->set_flashdata('success', '$$');
    redirect('main/checked/' . $check_in_id);
  }

  function resToCheck() {
    if ($this->session->userdata('connect') == true);
    # code...
    $sess = $this->session->userdata('username');
    $room_number = $this->input->post('room_number');
    $id = $this->input->post('id');

    $room = $this->db->query('select * from rooms where room_number = "' . $room_number . '"');
    $room_status = "";
    if ($room->num_rows() > 0) {
      $row = $room->row();
      $room_status = $row->status_by_room;
    }

    if ($room_status == 'CHECK') {
      $this->session->set_flashdata('error', '$$');
      redirect('main/updateReservation/' . $id);
    } else {
      $last_name = $this->input->post('last_name');
      $first_name = $this->input->post('first_name');
      $middle_name = $this->input->post('middle_name');
      $extra_person = $this->input->post('extra_person');
      $extra_bed = $this->input->post('extra_bed');
      $contact = $this->input->post('contact');
      $email = $this->input->post('email');
      $address = $this->input->post('address');
      echo $advance = $this->input->post('advance');
      //$deduction = $this->input->post('deduction');
      //$id = $this->input->post('room_id');
      $room_number = $this->input->post('room_number');
      //$room_id= $this->input->post('id');
      //$price_type =$this->get_model->frontdeskaddPricingTable($id);

      $price_type = $this->db->query('select * from room_type inner join rooms on room_type.id=rooms.room_type_id where rooms.room_number="' . $room_number . '"');
      $pricing_room = "";
      $id = "";
      if ($price_type->num_rows() > 0) {
        $row = $price_type->row();
        $pricing_room = $row->pricing_type;
        $id = $row->id;
      }

      $extrabed = $this->db->query('select * from room_bed');
      $pricing_bed = "";
      if ($extrabed->num_rows() > 0) {
        $row = $extrabed->row();
        $pricing_bed = $row->bed_pricing;
      }

      $extraperson = $this->db->query('select * from room_person');
      $pricing_person = "";
      if ($extraperson->num_rows() > 0) {
        $row = $extraperson->row();
        $pricing_person = $row->person_pricing;
      }

      $data = array(
        'last_name' => $last_name,
        'first_name' => $first_name,
        'middle_name' => $middle_name,
        'add_person' => $extra_person,
        'add_bed' => $extra_bed,
        'contact' => $contact,
        'email' => $email,
        'address' => $address,
        'advance_payment' => $advance,
        'room_id' => $room_number,
        'price_room' => $pricing_room,
        'price_person' => $pricing_person,
        'price_bed' => $pricing_bed,
        'status' => "IN",
        'deduction' => '0'

      );
      $this->insert_model->frontdeskCheckingIn($data);

      //$id_direct = $this->input->post('id');
      $data = array(
        'status_by_room' => 'CHECK'
      );
      $this->update_model->frontdeskUpdateCheckRoom($room_number, $data);



      $this->session->set_flashdata('success', '$$');
      redirect('main/CheckFormUpdate/' . $id);
    }
  }



  function CoffeeshopUploadImage() {
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
        'content' => '' . $sess . ' updated Profile Picture',
        'user' => $sess,
        'type' => 'Coffee Shop',

      );

      $this->insert_model->log($data);
      // Set the success message
      $this->session->set_flashdata('success', '$$');
      redirect('main/RestaurantProfile/');
    }
    $this->session->set_flashdata('error', '$$');
    redirect('main/HousekeepingProfile/');
  }


  function CoffeeshopProfileDetails() {
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
      'content' => '' . $sess . ' updated details',
      'user' => $sess,
      'type' => 'Coffee Shop',

    );

    $this->insert_model->log($data);
    // Set the success message
    $this->session->set_flashdata('success', '$$');
    redirect('main/CoffeeshopProfile/' . $id);
  }



  function addCartcoffeeshop() {
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


    $data = array(
      'product_id' => $product_id,
      'product_cost' => $cost_res,
      'product_qty' => $product_qty,
      'id_of_user' => $sess,
      'account_process' => $id_sess,
      'type_process' => 'Coffee Shop',
      'total_cart_amount' => $total_amount
    );
    $this->insert_model->addingCartCoffeeshop($data);

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
      'type_process' => 'Coffee Shop',
      'total_amount_process' => $total_amount,
      'cart_id' => $result_id
    );
    $this->insert_model->reports($data);

    $data = array(
      'content' => '' . $sess . ' added order(s) in Order Details',
      'user' => $sess,
      'type' => 'Coffee Shop',

    );

    $this->insert_model->log($data);

    $this->session->set_flashdata('success', '$$');
    redirect('main/coffeeshopProcess');
  }

  function deleteCoffeeshopCart($id) {
    if ($this->session->userdata('connect') == true);
    # code...
    $sess = $this->session->userdata('username');
    $data = array(
      'content' => '' . $sess . ' canceled order(s) in Order Details',
      'user' => $sess,
      'type' => 'Coffee Shop',

    );

    $this->insert_model->log($data);
    $this->delete_model->coffeeshopdeletecart($id);
    $this->delete_model->deleteReportscoffeeshop($id);
    $this->session->set_flashdata('success', '$$');
    redirect('main/CoffeeshopProcess');
  }

  function updateCoffeeshopCart() {
    if ($this->session->userdata('connect') == true);
    # code...
    $sess = $this->session->userdata('username');
    $data = array(
      'content' => '' . $sess . ' updated order(s) in Order Details',
      'user' => $sess,
      'type' => 'Coffee Shop',

    );

    $this->insert_model->log($data);
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
      'type_process' => 'Coffee Shop',
      'total_cart_amount' => $total_amount,
    );
    $this->update_model->coffeeshopupdatecart($product_cart_id, $data);



    $data = array(
      'qty' => $product_qty,
      'account_process' => $id_sess,
      'type_process' => 'Coffee Shop',
      'total_amount_process' => $total_amount,
    );
    $this->update_model->updateReportsRestaurant($product_cart_id, $data);

    $this->session->set_flashdata('success', '$$');
    redirect('main/CoffeeshopProcess');
  }

  function coffeeshopclearCart() {
    if ($this->session->userdata('connect') == true);
    # code...
    $sess = $this->session->userdata('username');
    $data = array(
      'content' => '' . $sess . ' cleared order(s) in Order Details',
      'user' => $sess,
      'type' => 'Coffee Shop',

    );

    $this->insert_model->log($data);
    $this->delete_model->CoffeeshopclearCart();
    $this->session->set_flashdata('success', '$$');
    redirect('main/CoffeeshopProcess');
  }

  function addCartCoffeeshopPerTable() {
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
      'type_process' => 'Coffee Shop',
      'total_cart_amount' => $total_amount,
      'table_num' => $table_number
    );
    $this->insert_model->addingCartCoffeeshop($data);

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
      'type_process' => 'Coffee Shop',
      'total_amount_process' => $total_amount,
      'cart_id' => $result_id
    );
    $this->insert_model->reports($data);

    $data = array(
      'content' => '' . $sess . ' added order(s) in Order Details',
      'user' => $sess,
      'type' => 'Coffee Shop',

    );

    $this->insert_model->log($data);

    $this->session->set_flashdata('success', '$$');
    redirect('main/CoffeeshopPerTableProcess/' . $table_number);
  }

  function deleteCoffeeshopPerTable($str) {
    if ($this->session->userdata('connect') == true);
    # code...
    $sess = $this->session->userdata('username');
    $data = array(
      'content' => '' . $sess . ' canceled order(s)',
      'user' => $sess,
      'type' => 'Coffee Shop',

    );

    $this->insert_model->log($data);
    $string = explode('H', $str);
    $id = $string[0];
    $redirect = $string[1];
    $this->delete_model->deletecart($id);
    $this->delete_model->deleteReportsRestaurant($id);
    $this->session->set_flashdata('success', '$$');
    redirect('main/CoffeeshopPerTableProcess/' . $redirect);
  }

  function updateCoffeeshopCartPerTable() {
    if ($this->session->userdata('connect') == true);
    # code...
    $sess = $this->session->userdata('username');
    $data = array(
      'content' => '' . $sess . ' updated order(s) in Order Details',
      'user' => $sess,
      'type' => 'Coffee Shop',

    );

    $this->insert_model->log($data);
    $redirect = $this->input->post('redirect');
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
      'type_process' => 'Coffee Shop',
      'total_cart_amount' => $total_amount,
    );
    $this->update_model->coffeeshopupdatecart($product_cart_id, $data);



    $data = array(
      'qty' => $product_qty,
      'account_process' => $id_sess,
      'type_process' => 'Coffee Shop',
      'total_amount_process' => $total_amount,
    );
    $this->update_model->updateReportsRestaurant($product_cart_id, $data);

    $this->session->set_flashdata('success', '$$');
    redirect('main/CoffeeshopPerTableProcess/' . $redirect);
  }

  function CoffeeshopclearCartPerTable($id) {
    if ($this->session->userdata('connect') == true);
    # code...
    $sess = $this->session->userdata('username');
    $data = array(
      'content' => '' . $sess . ' cleared order(s) in Order Details',
      'user' => $sess,
      'type' => 'Coffee Shop',

    );

    $this->insert_model->log($data);

    $this->delete_model->coffeeshopclearCartPerTable($id);
    $this->session->set_flashdata('success', '$$');
    redirect('main/CoffeeshopPerTableProcess/' . $id);
  }

  function RestaurantUploadImage() {
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
        'content' => '' . $sess . ' updated Profile Picture',
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


  function restaurantUpdateProfileDetails() {
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
      'content' => '' . $sess . ' updated details',
      'user' => $sess,
      'type' => 'Restaurant',

    );

    $this->insert_model->log($data);


    // Set the success message
    $this->session->set_flashdata('success', '$$');
    redirect('main/RestaurantProfile/' . $id);
  }

  function PerTableadddeductionRestaurant() {
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
      'content' => '' . $sess . ' added a Discount',
      'user' => $sess,
      'type' => 'Restaurant',

    );

    $this->insert_model->log($data);
    $this->session->set_flashdata('success', '$$');
    redirect('main/PerTableProcess/' . $redirect);
  }

  function PerTableChargetoRoomRestaurant() {
    if ($this->session->userdata('connect') == true);
    # code...
    $user = $this->session->userdata('username');
    $res = $this->session->userdata('restaurant');
    $redirect = $this->input->post('redirect');
    $charge_id = $this->input->post('charge_id');
    $charge_name = $this->input->post('charge_name');
    $amount = $this->input->post('amount');




    $data = array(
      'charge_id' => $charge_id,
      'charge_name' => $charge_name,

    );
    $this->update_model->pertableupdatecartforDeduction($user, $data, $redirect);

    //$this->update_model->updateChargetoRoomamount($amount,$charge_id,$res);
    if ($res == 'Restaurant') {
      $this->update_model->updateChargetoRoomamount($amount, $charge_id, $res);
    } else {
      $this->update_model->updateChargetoRoomamountcoff($amount, $charge_id, $res);
    }
    $data = array(
      'content' => '' . $user . ' added to Room Charge',
      'user' => $user,
      'type' => $res,

    );

    $this->insert_model->log($data);
    $this->session->set_flashdata('success', '$$');
    redirect('main/PerTableProcess/' . $redirect);
  }



  function frontdeskCompleteOrder() {
    if ($this->session->userdata('connect') == true);
    $sess = $this->session->userdata('username');
    $id_sess = $this->session->userdata('user_id');

    $check_id = $this->input->post('check_id');
    $type = $this->input->post('type');
    $tamount = $this->input->post('tamount');
    $card = $this->input->post('card');
    $code = $this->input->post('appcode');
    $amountEN = $this->input->post('amount');

    $ad_card = $this->input->post('ad_card');
    $ad_cash = $this->input->post('ad_cash');

    $date1 = $this->input->post('date1');
    $date2 = $this->input->post('date2');
    $daysRed = $this->input->post('days_ren');

    if ($tamount > $amountEN) {
      # code...

      $this->session->set_flashdata('error', '$$');
    } else {
      if ($type == 'card') {

        $data = array(
          'account_process' => $id_sess,
          'type_process' => 'Frontdesk',
          'total_amount_process' => $tamount,
          'card_number' => $card,
          'type_payment' => 'Card',
          'amount_give' => $amountEN,
          'if_frontdesk' => $check_id,
          'app_code' => $code,
          'checkin' => $date1,
          'checkout' => $date2,
          'days_ren' => $daysRed,
          'ad_cash' => $ad_cash,
          'ad_card' => $ad_card,


        );
        $this->insert_model->reports($data);

        $reports = $this->db->query('select * from all_reports where account_process="' . $id_sess . '" and type_process="Frontdesk" order by id_reports desc');
        $id_reports = "";

        if ($reports->num_rows() > 0) {
          $row = $reports->row();
          $id_reports = $row->id_reports;
        }

        $this->update_model->frontdeskclearCart($id_reports, $id_sess, $check_id);
        $this->update_model->frontdeskChangeStatusPaid($check_id);

        $this->session->set_flashdata('success', '$$');

        if ($this->session->userdata('connect') == true);

        $sess = $this->session->userdata('username');
        $data = array(
          'content' => '' . $sess . ' Complete the order of amount of  ' . $tamount . '(Card)',
          'user' => $sess,
          'type' => 'Frontdesk',
          'frontdesk_id' => $check_id,
          'redirection' => 'index.php/main/Frontdesk',
        );

        $this->insert_model->log($data);
        redirect('main/checked/' . $check_id);
      } else {
        $data = array(
          'account_process' => $id_sess,
          'type_process' => 'Frontdesk',
          'total_amount_process' => $tamount,
          'type_payment' => 'Cash',
          'amount_give' => $amountEN,
          'if_frontdesk' => $check_id,
          'checkin' => $date1,
          'checkout' => $date2,
          'days_ren' => $daysRed,
          'ad_cash' => $ad_cash,
          'ad_card' => $ad_card,

        );
        $this->insert_model->reports($data);

        $reports = $this->db->query('select * from all_reports where account_process="' . $id_sess . '" and type_process="Frontdesk" order by id_reports desc');
        $id_reports = "";

        if ($reports->num_rows() > 0) {
          $row = $reports->row();
          $id_reports = $row->id_reports;
        }

        $this->update_model->frontdeskclearCart($id_reports, $id_sess, $check_id);
        $this->update_model->frontdeskChangeStatusPaid($check_id);

        if ($this->session->userdata('connect') == true);

        $sess = $this->session->userdata('username');
        $data = array(
          'content' => '' . $sess . ' Complete the order of amount of  ' . $tamount . '(Cash)',
          'user' => $sess,
          'type' => 'Frontdesk',
          'frontdesk_id' => $check_id,
          'redirection' => 'index.php/main/Frontdesk',
        );

        $this->insert_model->log($data);
        $this->session->set_flashdata('success', '$$');
        redirect('main/checked/' . $check_id);
      }

      //end else 
    }


    $this->session->set_flashdata('error', '$$');
    redirect('main/checked/' . $check_id);
  }
  function restaurantCompleteOrder() {
    if ($this->session->userdata('connect') == true);
    $sess = $this->session->userdata('username');
    $res = $this->session->userdata('restaurant');
    $id_sess = $this->session->userdata('user_id');

    $type = $this->input->post('type');
    $tamount = $this->input->post('tamount');
    $card = $this->input->post('card');
    $code = $this->input->post('appcode');
    $amountEN = $this->input->post('amount');

    if ($tamount > $amountEN) {

      $this->session->set_flashdata('error', '$$');
    } else {
      if ($type == 'card') {

        $data = array(
          'account_process' => $id_sess,
          'type_process' => $res,
          'total_amount_process' => $tamount,
          'card_number' => $card,
          'type_payment' => 'Card',
          'amount_give' => $amountEN,
          'app_code' => $code,

        );
        $this->insert_model->reports($data);

        $reports = $this->db->query('select * from all_reports where account_process="' . $id_sess . '" and type_process="' . $res . '" order by id_reports desc');
        $id_reports = "";

        if ($reports->num_rows() > 0) {
          $row = $reports->row();
          $id_reports = $row->id_reports;
        }

        $this->update_model->clearCart($id_reports, $res);

        $this->session->set_flashdata('success', '$$');
        redirect('main/process/');
      } else {
        $data = array(
          'account_process' => $id_sess,
          'type_process' => $res,
          'total_amount_process' => $tamount,
          'type_payment' => 'Cash',
          'amount_give' => $amountEN

        );
        $this->insert_model->reports($data);

        $reports = $this->db->query('select * from all_reports where account_process="' . $id_sess . '" and type_process="' . $res . '" order by id_reports desc');
        $id_reports = "";

        if ($reports->num_rows() > 0) {
          $row = $reports->row();
          $id_reports = $row->id_reports;
        }

        $this->update_model->clearCart($id_reports, $res);

        $this->session->set_flashdata('success', '$$');
        redirect('main/process/');
      }

      ///end else
    }

    $this->session->set_flashdata('error', '$$');
    redirect('main/process/');
  }


  function perTablerestaurantCompleteOrder() {
    if ($this->session->userdata('connect') == true);
    $sess = $this->session->userdata('username');
    $res = $this->session->userdata('restaurant');
    $id_sess = $this->session->userdata('user_id');

    $redi = $this->input->post('redirect');
    $type = $this->input->post('type');
    $tamount = $this->input->post('tamount');
    $card = $this->input->post('card');
    $code = $this->input->post('appcode');
    $amountEN = $this->input->post('amount');

    if ($tamount > $amountEN) {
      $this->session->set_flashdata('error', '$$');
    } else {
      if ($type == 'card') {

        $data = array(
          'account_process' => $id_sess,
          'type_process' => $res,
          'total_amount_process' => $tamount,
          'card_number' => $card,
          'type_payment' => 'Card',
          'amount_give' => $amountEN,
          'table_num' => $redi,
          'app_code' => $code,

        );
        $this->insert_model->reports($data);

        $reports = $this->db->query('select * from all_reports where account_process="' . $id_sess . '"  and type_process="' . $res . '" and table_num="' . $redi . '" order by id_reports desc');
        $id_reports = "";

        if ($reports->num_rows() > 0) {
          $row = $reports->row();
          $id_reports = $row->id_reports;
        }

        $this->update_model->clearCartPerTable($id_reports, $redi, $id_sess, $res);

        $this->session->set_flashdata('success', '$$');
        redirect('main/PerTableProcess/' . $redi);
      } elseif ($type == 'cash') {
        $data = array(
          'account_process' => $id_sess,
          'type_process' => $res,
          'total_amount_process' => $tamount,
          'type_payment' => 'Cash',
          'amount_give' => $amountEN,
          'table_num' => $redi

        );
        $this->insert_model->reports($data);

        $reports = $this->db->query('select * from all_reports where account_process="' . $id_sess . '" and type_process="' . $res . '" and table_num="' . $redi . '" order by id_reports desc');
        $id_reports = "";

        if ($reports->num_rows() > 0) {
          $row = $reports->row();
          $id_reports = $row->id_reports;
        }

        $this->update_model->clearCartPerTable($id_reports, $redi, $id_sess, $res);

        $this->session->set_flashdata('success', '$$');
        redirect('main/PerTableProcess/' . $redi);
      } else {
        $data = array(
          'account_process' => $id_sess,
          'type_process' => $res,
          'total_amount_process' => $tamount,
          'type_payment' => 'Charge to',
          'amount_give' => $amountEN,
          'table_num' => $redi

        );
        $this->insert_model->reports($data);

        $reports = $this->db->query('select * from all_reports where account_process="' . $id_sess . '" and type_process="' . $res . '" and table_num="' . $redi . '" order by id_reports desc');
        $id_reports = "";

        if ($reports->num_rows() > 0) {
          $row = $reports->row();
          $id_reports = $row->id_reports;
        }

        $this->update_model->clearCartPerTable($id_reports, $redi, $id_sess, $res);

        $this->session->set_flashdata('success', '$$');
        redirect('main/PerTableProcess/' . $redi);
      }
      //end else
    }
    $this->session->set_flashdata('error', '$$');
    redirect('main/PerTableProcess/' . $redi);
  }

  function adddeductionRestaurant() {
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
      'content' => '' . $sess . ' added a Discount',
      'user' => $sess,
      'type' => 'Restaurant',

    );

    $this->insert_model->log($data);
    $this->session->set_flashdata('success', '$$');
    redirect('main/process');
  }

  function addCartRestaurant() {
    if ($this->session->userdata('connect') == true);
    # code...
    $res = $this->session->userdata('restaurant');
    $sess = $this->session->userdata('username');
    $product_id = $this->input->post('product_name');
    $product_qty = $this->input->post('product_qty');

    if ($res == 'Restaurant') {
      $cost = $this->db->query('select * from product_restaurant where id="' . $product_id . '"');
    } else {
      $cost = $this->db->query('select * from product_coffeeshop where id="' . $product_id . '"');
    }

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
      $res = $this->session->userdata('restaurant');
    }
    $get_id = $this->db->query('select * from restaurant_cart where account_process="' . $id_sess . '" and type_process ="' . $res . '" order by id_cart desc limit 1');
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
      'type_process' => $res,
      'total_cart_amount' => $total_amount,

    );
    $this->insert_model->addingCartRestaurant($data);



    // $data = array(
    // 	'name' => $name_prod,
    // 	'qty' => $product_qty,
    // 	'account_process' => $id_sess,
    // 	'type_process' => 'Restaurant',
    // 	'total_amount_process' =>$total_amount,
    // 	'cart_id' => $result_id,
    // 	'unit_cost' => $cost_res
    // 	);
    // $this->insert_model->reports($data);
    $data = array(
      'content' => '' . $sess . ' added order(s) to order details',
      'user' => $sess,
      'type' => $res,

    );

    $this->insert_model->log($data);

    $this->session->set_flashdata('success', '$$');
    redirect('main/process');
  }

  function addCartRestaurantPerTable() {
    if ($this->session->userdata('connect') == true);
    # code...
    $res = $this->session->userdata('restaurant');
    $sess = $this->session->userdata('username');
    $table_number = $this->input->post('table_number');
    $product_id = $this->input->post('product_name');
    $product_qty = $this->input->post('product_qty');

    if ($res == 'Restaurant') {
      $cost = $this->db->query('select * from product_restaurant where id="' . $product_id . '"');
    } else {
      $cost = $this->db->query('select * from product_coffeeshop where id="' . $product_id . '"');
    }

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
      'type_process' => $res,
      'total_cart_amount' => $total_amount,
      'table_num' => $table_number
    );
    $this->insert_model->addingCartRestaurant($data);

    $get_id = $this->db->query('select * from restaurant_cart where account_process="' . $id_sess . '" and type_process ="' . $res . '" order by id_cart desc limit 1');
    $result_id = "";
    if ($get_id->num_rows() > 0) {
      $row = $get_id->row();
      $result_id = $row->id_cart;
    }

    // $data = array(
    // 	'name' => $name_prod,
    // 	'qty' => $product_qty,
    // 	'account_process' => $id_sess,
    // 	'type_process' => 'Restaurant',
    // 	'total_amount_process' =>$total_amount,
    // 	'cart_id' => $result_id,
    // 	'unit_cost' => $cost_res
    // 	);
    // $this->insert_model->reports($data);

    $data = array(
      'content' => '' . $sess . ' added order(s) to order details',
      'user' => $sess,
      'type' => $res,

    );

    $this->insert_model->log($data);

    $this->session->set_flashdata('success', '$$');
    redirect('main/PerTableProcess/' . $table_number);
  }

  function deleteRestauranCart($id) {
    if ($this->session->userdata('connect') == true);
    # code...
    $sess = $this->session->userdata('username');
    $data = array(
      'content' => '' . $sess . ' canceled order(s) in order details',
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
  function restaunratChangeToDelivered($product_cart_id) {
    if ($this->session->userdata('connect') == true);
    # code...
    $sess = $this->session->userdata('username');
    $res = $this->session->userdata('restaurant');
    $data = array(
      'content' => '' . $sess . ' released order(s)',
      'user' => $sess,
      'type' => $res,

    );

    $this->insert_model->log($data);
    $data = array(
      'deliver_status' => 'Delivered'
    );
    $this->update_model->updatecart($product_cart_id, $data);
    $this->session->set_flashdata('success', '$$');
    redirect('main/process');
  }

  function restaunratChangeToDeliveredPertable($str) {
    if ($this->session->userdata('connect') == true);
    # code...
    $res = $this->session->userdata('restaurant');
    $sess = $this->session->userdata('username');
    $data = array(
      'content' => '' . $sess . ' released order(s)',
      'user' => $sess,
      'type' => $res,

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

  function deleteRestauranCartPerTable($str) {
    if ($this->session->userdata('connect') == true);
    # code...
    $res = $this->session->userdata('restaurant');
    $sess = $this->session->userdata('username');
    $data = array(
      'content' => '' . $sess . ' canceled order(s) in Order Details',
      'user' => $sess,
      'type' => $res,

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

  function clearCart($forcart) {
    if ($this->session->userdata('connect') == true);
    # code...
    $sess = $this->session->userdata('username');
    $id_sess = $this->session->userdata('user_id');
    $res = $this->session->userdata('restaurant');


    $data = array(
      'account_process' => $id_sess,
      'type_process' => $res,
      'total_amount_process' => $forcart,

    );
    $this->insert_model->reports($data);
    $data = array(
      'content' => '' . $sess . ' cleared order(s) in Order Details',
      'user' => $sess,
      'type' => $res,

    );

    $this->insert_model->log($data);
    $this->update_model->clearCart();
    $this->session->set_flashdata('success', '$$');
    redirect('main/process');
  }

  function clearCartPerTable($str) {
    if ($this->session->userdata('connect') == true);
    # code...
    $sess = $this->session->userdata('username');
    $res = $this->session->userdata('restaurant');
    $id_sess = $this->session->userdata('user_id');

    $string = explode('M', $str);
    echo $id = $string[0];
    echo $forcart = $string[1];

    $data = array(
      'account_process' => $id_sess,
      'type_process' => $res,
      'total_amount_process' => $forcart,

    );
    $this->insert_model->reports($data);

    $data = array(
      'content' => '' . $sess . ' cleared order(s) in Order Details',
      'user' => $sess,
      'type' => $res,

    );

    $this->insert_model->log($data);
    $this->update_model->clearCartPerTable($id);
    $this->session->set_flashdata('success', '$$');
    redirect('main/PerTableProcess/' . $id);
  }

  function updateRestaurantCart() {
    if ($this->session->userdata('connect') == true);
    # code...
    $res = $this->session->userdata('restaurant');
    $sess = $this->session->userdata('username');
    $product_cart_id = $this->input->post('id');
    $product_id = $this->input->post('prodid');
    $product_qty = $this->input->post('qty');
    if ($res == 'Restaurant') {
      $cost = $this->db->query('select * from product_restaurant where id="' . $product_id . '"');
    } else {
      $cost = $this->db->query('select * from product_coffeeshop where id="' . $product_id . '"');
    }

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
      'type_process' => $res,
      'total_cart_amount' => $total_amount
    );
    $this->update_model->updatecart($product_cart_id, $data);



    // $data = array(
    // 	'qty' => $product_qty,
    // 	'account_process' => $id_sess,
    // 	'type_process' => 'Restaurant',
    // 	'total_amount_process' =>$total_amount,
    // 	);
    // $this->update_model->updateReportsRestaurant($product_cart_id,$data);

    $data = array(
      'content' => '' . $sess . ' updated order(s) in Order Details',
      'user' => $sess,
      'type' => $res,

    );

    $this->insert_model->log($data);

    $this->session->set_flashdata('success', '$$');
    redirect('main/process');
  }

  function updateRestaurantCartPerTable() {
    if ($this->session->userdata('connect') == true);
    # code...
    $res = $this->session->userdata('restaurant');
    $sess = $this->session->userdata('username');
    $redirect = $this->input->post('redirect');
    $product_cart_id = $this->input->post('id');
    $product_id = $this->input->post('prodid');
    $product_qty = $this->input->post('qty');

    if ($res == 'Restaurant') {
      $cost = $this->db->query('select * from product_restaurant where id="' . $product_id . '"');
    } else {
      $cost = $this->db->query('select * from product_coffeeshop where id="' . $product_id . '"');
    }

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
      'type_process' => $res,
      'total_cart_amount' => $total_amount
    );
    $this->update_model->updatecart($product_cart_id, $data);



    // $data = array(
    // 	'qty' => $product_qty,
    // 	'account_process' => $id_sess,
    // 	'type_process' => 'Restaurant',
    // 	'total_amount_process' =>$total_amount,
    // 	);
    // $this->update_model->updateReportsRestaurant($product_cart_id,$data);

    $data = array(
      'content' => '' . $sess . ' updated order(s) in Order Details',
      'user' => $sess,
      'type' => $res,

    );

    $this->insert_model->log($data);

    $this->session->set_flashdata('success', '$$');
    redirect('main/PerTableProcess/' . $redirect);
  }


  ///////
  ///Lock//
  //////

  function frontdeskLock($id) {
    $this->update_model->frontdeskLock($id);
    $this->session->set_flashdata('success', '$$');
    redirect('main/ListOfCheckedIn/');
  }










  /////////////////////////////
  //// House keeping /////////
  //////////////////////////////



  function updateStatusOfRoom() {
    $id = $this->input->post('id');
    $room = $this->input->post('room');
    $status = $this->input->post('type');
    if ($status == '1') {
      $roomStatus = "Vacant Clean";
    } elseif ($status == '2') {
      $roomStatus = "Room Check";
      // $status ="<b style='color:red'>For Cleaning</b>";
    } elseif ($status == '3') {
      $roomStatus = "Vacant Dirty";
      // $status ="<b style='color:orange'>For Maintenance</b>";
    } elseif ($status == '4') {
      $roomStatus = "Vacant Clean Inspected";
      // $status ="<b style='color:gray'>Block</b>";
    } elseif ($status == '5') {
      $roomStatus = "Make Up Room";
      // $status ="<b style='color:gray'>Block</b>";
    } elseif ($status == '6') {
      $roomStatus = "Out Of Service";
      // $status ="<b style='color:gray'>Block</b>";
    } elseif ($status == '7') {
      $roomStatus = "Out of Order";
      // $status ="<b style='color:gray'>Block</b>";
    } else {
      $roomStatus = "";
    }
    $data = array(
      'status' => $status,
    );
    $this->update_model->updatedStatusOfRoom($id, $data);

    if ($this->session->userdata('connect') == true);
    $sess = $this->session->userdata('username');
    $data = array(
      'content' => '' . $sess . ' updated the status of room ' . $room . ' to ' . $roomStatus . ' ',
      'user' => $sess,
      'type' => 'Housekeeping',
      'redirection' => 'index.php/main/HousekeepingList',
    );

    $this->insert_model->log($data);


    // $data = array(
    // 	 		'content' => ''.$sess.' Change room to Under Cleaning',
    // 	 		'user' => $sess,
    // 	 		'type' => 'Housekeeping',
    // 	 		
    // 	 		);

    // 	 	$this->insert_model->log($data);



    $this->session->set_flashdata('success', '$$');
    redirect('main/HousekeepingList');
  }



  function HousekechangeStatusUC($id) {
    if ($this->session->userdata('connect') == true);
    # code...
    $sess = $this->session->userdata('username');
    if ($this->session->userdata('connect') == true);
    # code...
    $sess = $this->session->userdata('username');
    $room = $this->db->query('select * from rooms where id="' . $id . '"');
    $room_number = "";
    if ($room->num_rows() > 0) {
      $row = $room->row();
      $room_number = $row->room_number;
    }


    $data = array(
      'content' => 'Room ' . $room_number . ' is now For Cleaning',
      'user' => $sess,
      'type' => 'Frontdesk',
      'redirection' => 'index.php/main/',
    );

    $this->insert_model->housekeepingInsertNotif($data);

    $data = array(
      'content' => 'Room ' . $room_number . ' is now For Cleaning',
      'user' => $sess,
      'type' => 'Admin',
    );

    $this->insert_model->housekeepingInsertNotif($data);

    $data = array(
      'content' => '' . $sess . ' changed room status to For Cleaning',
      'user' => $sess,
      'type' => 'Housekeeping',

    );

    $this->insert_model->log($data);




    $data = array(
      'status_by_room' => 'For Cleaning'
    );
    $this->update_model->housekeepingChangeStatus($id, $data);

    $this->session->set_flashdata('success', '$$');
    redirect('main/HousekeepingList');
  }

  function HousekechangeStatusReady($id) {
    if ($this->session->userdata('connect') == true);
    # code...
    $sess = $this->session->userdata('username');
    if ($this->session->userdata('connect') == true);
    # code...
    $sess = $this->session->userdata('username');
    $room = $this->db->query('select * from rooms where id="' . $id . '"');
    $room_number = "";
    if ($room->num_rows() > 0) {
      $row = $room->row();
      $room_number = $row->room_number;
    }


    $data = array(
      'content' => 'Room ' . $room_number . ' is now Ready',
      'user' => $sess,
      'type' => 'Frontdesk',
      'redirection' => 'index.php/main/',
    );

    $this->insert_model->housekeepingInsertNotif($data);

    $data = array(
      'content' => 'Room ' . $room_number . ' is now Ready',
      'user' => $sess,
      'type' => 'Admin',
    );

    $this->insert_model->housekeepingInsertNotif($data);

    $data = array(
      'content' => '' . $sess . ' changed the room status to Ready',
      'user' => $sess,
      'type' => 'Housekeeping',

    );

    $this->insert_model->log($data);
    $data = array(
      'status_by_room' => 'EMPTY'
    );
    $this->update_model->housekeepingChangeStatus($id, $data);
    $this->session->set_flashdata('success', '$$');
    redirect('main/HousekeepingCleaning');
  }

  function HousekechangeStatusReadyUM($id) {
    if ($this->session->userdata('connect') == true);
    # code...
    $sess = $this->session->userdata('username');
    if ($this->session->userdata('connect') == true);
    # code...
    $sess = $this->session->userdata('username');
    $room = $this->db->query('select * from rooms where id="' . $id . '"');
    $room_number = "";
    if ($room->num_rows() > 0) {
      $row = $room->row();
      $room_number = $row->room_number;
    }


    $data = array(
      'content' => 'Room ' . $room_number . ' is now Ready',
      'user' => $sess,
      'type' => 'Frontdesk',
      'redirection' => 'index.php/main/',
    );

    $this->insert_model->housekeepingInsertNotif($data);

    $data = array(
      'content' => 'Room ' . $room_number . ' is now Ready',
      'user' => $sess,
      'type' => 'Admin',
    );

    $this->insert_model->housekeepingInsertNotif($data);
    $data = array(
      'status_by_room' => 'EMPTY'
    );
    $this->update_model->housekeepingChangeStatus($id, $data);
    $data = array(
      'content' => '' . $sess . ' changed the room status to Under Maintenance',
      'user' => $sess,
      'type' => 'Housekeeping',

    );

    $this->insert_model->log($data);
    $this->session->set_flashdata('success', '$$');
    redirect('main/HousekeepingUnderMaintenance');
  }

  function HousekechangeStatusUMC($id) {
    if ($this->session->userdata('connect') == true);
    # code...
    $sess = $this->session->userdata('username');
    if ($this->session->userdata('connect') == true);
    # code...
    $sess = $this->session->userdata('username');
    $room = $this->db->query('select * from rooms where id="' . $id . '"');
    $room_number = "";
    if ($room->num_rows() > 0) {
      $row = $room->row();
      $room_number = $row->room_number;
    }


    $data = array(
      'content' => 'Room ' . $room_number . ' is now Ready',
      'user' => $sess,
      'type' => 'Frontdesk',
      'redirection' => 'index.php/main/',
    );

    $this->insert_model->housekeepingInsertNotif($data);

    $data = array(
      'content' => 'Room ' . $room_number . ' is now Ready',
      'user' => $sess,
      'type' => 'Admin',
    );

    $this->insert_model->housekeepingInsertNotif($data);
    $data = array(
      'status_by_room' => 'EMPTY'
    );
    $this->update_model->housekeepingChangeStatus($id, $data);

    $data = array(
      'content' => '' . $sess . ' changed the room status to Ready',
      'user' => $sess,
      'type' => 'Housekeeping',

    );

    $this->insert_model->log($data);
    $this->session->set_flashdata('success', '$$');
    redirect('main/HousekeepingUnderMaintenance');
  }

  function HousekechangeStatusUM($id) {
    if ($this->session->userdata('connect') == true);
    # code...
    $sess = $this->session->userdata('username');
    if ($this->session->userdata('connect') == true);
    # code...
    $sess = $this->session->userdata('username');
    $room = $this->db->query('select * from rooms where id="' . $id . '"');
    $room_number = "";
    if ($room->num_rows() > 0) {
      $row = $room->row();
      $room_number = $row->room_number;
    }


    $data = array(
      'content' => 'Room ' . $room_number . ' is now Under Maintenance',
      'user' => $sess,
      'type' => 'Frontdesk',
      'redirection' => 'index.php/main/',
    );

    $this->insert_model->housekeepingInsertNotif($data);

    $data = array(
      'content' => 'Room ' . $room_number . ' is now Under Maintenance',
      'user' => $sess,
      'type' => 'Admin',
    );

    $this->insert_model->housekeepingInsertNotif($data);
    $data = array(
      'status_by_room' => 'Under Maintenance'
    );
    $this->update_model->housekeepingChangeStatus($id, $data);

    $data = array(
      'content' => '' . $sess . ' changed the room status to Under Maintenance',
      'user' => $sess,
      'type' => 'Housekeeping',

    );

    $this->insert_model->log($data);
    $this->session->set_flashdata('success', '$$');
    redirect('main/HousekeepingUnderMaintenance');
  }

  function HousekechangeStatusUMReady($id) {
    if ($this->session->userdata('connect') == true);
    # code...
    $sess = $this->session->userdata('username');
    if ($this->session->userdata('connect') == true);
    # code...
    $sess = $this->session->userdata('username');
    $room = $this->db->query('select * from rooms where id="' . $id . '"');
    $room_number = "";
    if ($room->num_rows() > 0) {
      $row = $room->row();
      $room_number = $row->room_number;
    }


    $data = array(
      'content' => 'Room ' . $room_number . ' is now Under Maintenance',
      'user' => $sess,
      'type' => 'Frontdesk',
      'redirection' => 'index.php/main/',
    );

    $this->insert_model->housekeepingInsertNotif($data);

    $data = array(
      'content' => 'Room ' . $room_number . ' is now Under Maintenance',
      'user' => $sess,
      'type' => 'Admin',
    );

    $this->insert_model->housekeepingInsertNotif($data);
    $data = array(
      'status_by_room' => 'Under Maintenance'
    );
    $this->update_model->housekeepingChangeStatus($id, $data);

    $data = array(
      'content' => '' . $sess . ' changed the room status to Under Maintenance',
      'user' => $sess,
      'type' => 'Housekeeping',

    );

    $this->insert_model->log($data);
    $this->session->set_flashdata('success', '$$');
    redirect('main/HousekeepingReady');
  }



  function HousekechangeStatusDelivered($id) {
    if ($this->session->userdata('connect') == true);
    # code...
    $sess = $this->session->userdata('username');
    if ($this->session->userdata('connect') == true);
    # code...
    $sess = $this->session->userdata('username');
    $room = $this->db->query('select * from rooms where id="' . $id . '"');
    $room_number = "";
    if ($room->num_rows() > 0) {
      $row = $room->row();
      $room_number = $row->room_number;
    }


    $data = array(
      'content' => 'Delivered extra bed(s) to Room ' . $room_number . ' ',
      'user' => $sess,
      'type' => 'Frontdesk',
      'redirection' => 'index.php/main/',
    );

    $this->insert_model->housekeepingInsertNotif($data);

    $data = array(
      'content' => 'Delivered extra bed(s) to Room ' . $room_number . ' ',
      'user' => $sess,
      'type' => 'Admin',
    );

    $this->insert_model->housekeepingInsertNotif($data);
    $data = array(
      'bed_status' => 'Delivered'
    );
    $this->update_model->housekeepingChangeStatusDelivered($id, $data);

    $data = array(
      'content' => '' . $sess . ' delivered extra(s) bed',
      'user' => $sess,
      'type' => 'Housekeeping',

    );

    $this->insert_model->log($data);
    $this->session->set_flashdata('success', '$$');
    redirect('main/HousekeepingBedRequest');
  }



  function HousekeepingUploadImage() {
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
        'content' => '' . $sess . ' updated image',
        'user' => $sess,
        'type' => 'Housekeeping',

      );

      $this->insert_model->log($data);


      // Set the success message
      $this->session->set_flashdata('success', '$$');
      redirect('main/HousekeepingProfile/');
    }
    $this->session->set_flashdata('error', '$$');
    redirect('main/HousekeepingProfile/');
  }


  function HousekeepingUpdateProfileDetails() {
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
      'content' => '' . $sess . ' updated details',
      'user' => $sess,
      'type' => 'Housekeeping',

    );

    $this->insert_model->log($data);


    // Set the success message
    $this->session->set_flashdata('success', '$$');
    redirect('main/HousekeepingProfile/' . $id);
  }

  //////////////////////////
  ///   PRINT Reciept //////
  ////////////////////////




  ///////////
  ///Update for status
  ///////////////

  function updateStatuschecked() {
    $id = $this->input->post('id');
    $red = $this->input->post('red_id');
    $status = $this->input->post('status');
    $room_label = $this->input->post('room_label');

    $data = array(
      'status' => $status
    );

    $this->update_model->updateStatusChecked($id, $data);

    if ($status == '4') {
      $check = array(
        'status' => '3'
      );
      $this->update_model->updateStatusRoomstohousekeeping($check, $room_label);
    } elseif ($status == '3') {
      $check = array(
        'status' => '5'
      );
      $this->update_model->updateStatusRoomstohousekeeping($check, $room_label);
    } else {
    }
    if ($this->session->userdata('connect') == true);
    $sess = $this->session->userdata('username');
    $data = array(
      'content' => '' . $sess . ' updated the status of room to Check out ',
      'user' => $sess,
      'type' => 'Frontdesk',
      'frontdesk_id' => $red,
      'redirection' => 'index.php/main/',
    );

    $this->insert_model->log($data);

    redirect('main/checked/' . $red);
  }

  function getRoomsByType($room) {
    $room = str_replace('-', '/', $room);
    $type = $this->get_model->getRoomByType(urldecode($room));
    $rooms = $this->get_model->getRoomsById($type->id);
    echo json_encode($rooms);
  }

  ////////////////////////
  ////updates 2.1///////////
  ///////////////////

  function insertChargestoFO() {
    if ($this->session->userdata('connect') == true);
    $sess = $this->session->userdata('username');
    $type = $this->input->post('charge_type');
    $ref = $this->input->post('charge_ref');
    $amount = $this->input->post('charge_amount');
    $name = $this->input->post('charge_name');
    $id   = $this->input->post('id');

    $data = array(
      'charge_type' => $type,
      'charge_ref' => $ref,
      'charge_amount' => $amount,
      'charge_to' => $id,
      'charge_process' => $sess,
      'charge_name' => $name,

    );
    $this->insert_model->insertChargetoFO($data);

    if ($this->session->userdata('connect') == true);
    $sess = $this->session->userdata('username');
    $data = array(
      'content' => '' . $sess . ' added ' . $type . ' charges(' . $name . ')',
      'user' => $sess,
      'type' => 'Frontdesk',
      'frontdesk_id' => $id,
      'redirection' => 'index.php/main/',
    );

    $this->insert_model->log($data);
    $this->session->set_flashdata('success', '$$');
    $this->redirect();
  }

  function insertChargestoAmenities() {
    echo $type = $this->input->post('type');

    if ($type == "1") {
      echo $charge = $this->input->post('B');
      if ($charge == 'B1') {
        $name = 'Broken Glass (Dental Glass)';
        $amount = '70';
      } elseif ($charge == 'B2') {
        $name = 'Cup';
        $amount = '70';
      } elseif ($charge == 'B3') {
        $name = 'Lamp Shade';
        $amount = '1500';
      } elseif ($charge == 'B4') {
        $name = 'Curtain';
        $amount = '2000';
      } elseif ($charge == 'B5') {
        $name = 'Wall Decor';
        $amount = '350';
      } elseif ($charge == 'B6') {
        $name = 'Damage Chair';
        $amount = '350';
      } elseif ($charge == 'B7') {
        $name = 'Damaged Wall (Stickers from parties)';
        $amount = '800';
      } else {
        $name = 'None';
        $amount = '0';
      }
    } elseif ($type == "2") {
      echo $charge = $this->input->post('A');

      if ($charge == 'A1') {
        $name = 'Towel';
        $amount = '75';
      } elseif ($charge == 'A2') {
        $name = 'Pillow';
        $amount = '35';
      } elseif ($charge == 'A3') {
        $name = 'Dental Kit';
        $amount = '20';
      } elseif ($charge == 'A4') {
        $name = 'Bottled Water (500 ml)';
        $amount = '25';
      } elseif ($charge == 'A5') {
        $name = 'Bottled Water (250 ml)';
        $amount = '15';
      } elseif ($charge == 'A6') {
        $name = 'Soap';
        $amount = '10';
      } elseif ($charge == 'A7') {
        $name = 'Shampoo & Conditioner';
        $amount = '35';
      } elseif ($charge == 'A8') {
        $name = 'Lotion';
        $amount = '35';
      } elseif ($charge == 'A9') {
        $name = 'Shower Gel';
        $amount = '35';
      } elseif ($charge == 'A10') {
        $name = 'Vanity Kit';
        $amount = '20';
      } elseif ($charge == 'A11') {
        $name = 'Linen/Sheet';
        $amount = '100';
      } elseif ($charge == 'A12') {
        $name = 'Comforter';
        $amount = '100';
      } elseif ($charge == 'A13') {
        $name = 'Slippers';
        $amount = '15';
      } else {
        $name = 'NOne';
        $amount = '0';
      }
    } elseif ($type == "3") {
      echo $charge = $this->input->post('L');

      if ($charge == 'L1') {
        $name = 'Keycard';
        $amount = '350';
      } elseif ($charge == 'L2') {
        $name = 'Towel';
        $amount = '300';
      } elseif ($charge == 'L3') {
        $name = 'Bathmat';
        $amount = '100';
      } elseif ($charge == 'L4') {
        $name = 'Hanger';
        $amount = '80';
      } elseif ($charge == 'L5') {
        $name = 'Flashlight';
        $amount = '100';
      } elseif ($charge == 'L6') {
        $name = 'Remote';
        $amount = '500';
      } elseif ($charge == 'L7') {
        $name = 'Linen';
        $amount = '1000';
      } elseif ($charge == 'L8') {
        $name = 'Comforter';
        $amount = '2500';
      } else {
        $name = 'None';
        $amount = '0';
      }
    } elseif ($type == "4") {
      echo $charge = $this->input->post('S');
      if ($charge == 'S1') {
        $name = 'Linens';
        $amount = '250';
      } elseif ($charge == 'S2') {
        $name = 'Towel';
        $amount = '200';
      } elseif ($charge == 'S3') {
        $name = 'Bathmat';
        $amount = '100';
      } elseif ($charge == 'S4') {
        $name = 'Smoking inside the room';
        $amount = '2500';
      } else {
        $name = 'None';
        $amount = '0';
      }
    } elseif ($type == "5") {
      echo $charge = $this->input->post('E');
      if ($charge == 'E1') {
        $name = 'Early Check In';
        $amount = '560';
      } elseif ($charge == 'E2') {
        $name = 'Late Check Out';
        $amount = '560';
      } else {
        $name = 'None';
        $amount = '0';
      }
    } else {
    }
    $qty = $this->input->post('qty');
    $id = $this->input->post('id');
    $data = array(
      'amen_name' => $name,
      'amen_amount' => $amount,
      'amen_qty' => $qty,
      'amen_to_charge' => $id,
    );
    $this->insert_model->addAmenchargestoFO($data);

    if ($this->session->userdata('connect') == true);
    $sess = $this->session->userdata('username');
    $data = array(
      'content' => '' . $sess . ' Added a charges (' . $name . ') ',
      'user' => $sess,
      'type' => 'Frontdesk',
      'frontdesk_id' => $id,
      'redirection' => 'index.php/main/',
    );

    $this->insert_model->log($data);
    $this->session->set_flashdata('success', '$$');
    $this->redirect();
  }

  function cancelChargeFoResCof($str) {
    $string = explode('H', $str);
    echo $id = $string[0];
    echo $red = $string[1];
    if ($this->session->userdata('connect') == true);
    $sess = $this->session->userdata('username');
    $data = array(
      'content' => '' . $sess . ' deleted a charge for Resto/Coffee ',
      'user' => $sess,
      'type' => 'Frontdesk',
      'frontdesk_id' => $red,
      'redirection' => 'index.php/main/',
    );

    $this->insert_model->log($data);
    $this->delete_model->chargeRestoCoffDelete($id);
    $this->session->set_flashdata('success', '$$');
    $this->redirect();
  }

  function cancelChargeAmen($str) {
    $string = explode('Z', $str);
    echo $id = $string[0];
    echo $red = $string[1];
    $name = $string[2];
    if ($this->session->userdata('connect') == true);
    $sess = $this->session->userdata('username');
    $data = array(
      'content' => '' . $sess . ' deleted a charge (' . $name . ') ',
      'user' => $sess,
      'type' => 'Frontdesk',
      'frontdesk_id' => $red,
      'redirection' => 'index.php/main/',
    );

    $this->insert_model->log($data);
    $this->delete_model->chargeAmenDelete($id);
    $this->session->set_flashdata('success', '$$');
    $this->redirect();
  }

  function insertReservationswalkin() {
    $date1 = $this->input->post('date1');
    $date2 = $this->input->post('date2');
    $datecon1 = $date1;
    $datecon2 = $date2;
    $newDate1 = date("m/d/Y", strtotime($datecon1));
    $newDate2 = date("m/d/Y", strtotime($datecon2));
    $roomType = $this->input->post('roomType');
    $lname = $this->input->post('lname');
    $fname = $this->input->post('fname');
    $email = $this->input->post('email');
    $contact = $this->input->post('contact');

    $data = array(
      'check_in_date' => $newDate1,
      'check_id_date' => $newDate1,
      'check_out_date' => $newDate2,
      'room_id' => $roomType,
      'last_name' => $lname,
      'first_name' => $fname,
      'email' => $email,
      'contact' => $contact,
      'status' => 'Reserve',
    );
    $this->insert_model->frontdeskInsert($data);
    $this->session->set_flashdata('success', '$$');
    $this->redirect();
  }

  function updateNotes() {
    $check_in_id = $this->input->post('check_in_id');
    $notes = $this->input->post('notes');
    $data = array(
      'notes' => $notes,
    );
    $this->update_model->frontdeskUpdateCheckIn($check_in_id, $data);
    $this->session->set_flashdata('success', '$$');
    $this->redirect();
  }

  function deleteBookingCancel($id) {
    //id and check id
    //connect_check

    $bookIdDelete = $this->db->query('select * from rooms_checked where check_id="' . $id . '"');
    $idDelete = "";
    if ($bookIdDelete->num_rows() > 0) {
      $row = $bookIdDelete->row();
      $idDelete = $row->connect_check;
    }
    $this->db->query('delete from bookings where id="' . $idDelete . '"');
    $this->db->query('delete from check_form where id="' . $id . '"');
    $this->db->query('delete from rooms_checked where check_id="' . $id . '"');

    if ($this->session->userdata('connect') == true);
    $sess = $this->session->userdata('username');
    $data = array(
      'content' => '' . $sess . ' Deleted a booking ',
      'user' => $sess,
      'type' => 'Frontdesk',
      'redirection' => 'index.php/main/',
    );

    $this->insert_model->log($data);

    $this->session->set_flashdata('success', '$$');
    $this->redirect();
  }

  // ------------------------------------------------------------------------------------------------------- //
  // ------------------------------------------------ VIEWS ------------------------------------------------ //
  // ------------------------------------------------------------------------------------------------------- //

  function index() {
    $data = array(
      'result_room' => $this->get_model->frontdeskRooms(),
      'result_av' => $this->get_model->getFrontDeskRooms(),
      'result_un' => $this->get_model->getFrontDeskRooms(0),
      'room_types' => $this->get_model->getRoomTypes(),
      'rooms' => $this->get_model->getRooms(),
      'guests' => $this->get_model->getGuests(),
      'active' => 'dashboard'
    );

    $this->load->view('body/frontdesk/layout/header', $data);
    $this->load->view('body/frontdesk/dashboard');
    $this->load->view('body/frontdesk/components/modal-reservation');
    $this->load->view('body/frontdesk/layout/footer');
  }

  function calendar($year, $month) {
    $this->load->library('calendar');

    $data = [
      'active' => 'calendar',
      'rooms' => $this->get_model->getRoomsWithRoomType(),
      'bookings' => $this->get_model->getBookings(),
      'days' => $this->calendar->get_total_days($month, $year),
      'month' => $this->calendar->get_month_name($month),
      'guests' => $this->get_model->getGuests(),
      'm' => str_pad($month, 2, '0', STR_PAD_LEFT),
      'y' => $year,
    ];

    $this->load->view('body/frontdesk/layout/header', $data);
    $this->load->view('body/frontdesk/calendar');
    $this->load->view('body/frontdesk/components/modal-reservation');
    $this->load->view('body/frontdesk/layout/footer');
  }

  function rooms() {
    $data = [
      'active' => 'rooms',
      'rooms' => $this->get_model->getRoomsWithRoomType(),
      'guests' => $this->get_model->getGuests(),
    ];

    $this->load->view('body/frontdesk/layout/header', $data);
    $this->load->view('body/frontdesk/rooms');
    $this->load->view('body/frontdesk/components/modal-reservation');
    $this->load->view('body/frontdesk/layout/footer');
  }

  function guests() {
    $data = array(
      'active' => 'guests',
      'guests_active' => $this->get_model->getGuests(),
      'guests_inactive' => $this->get_model->getGuests(1),
      'getRoomType' => $this->get_model->getRoomTypes(),
      'getRoom' => $this->get_model->getRoom()
    );
    $this->load->view('body/frontdesk/layout/header', $data);
    $this->load->view('body/frontdesk/guests');
    $this->load->view('body/frontdesk/layout/footer');
  }

  function profile() {
    $data = array(
      'active' => 'account',
      'profile' => $this->get_model->getProfile()
    );
    $this->load->view('body/frontdesk/layout/header', $data);
    $this->load->view('body/frontdesk/profile');
    $this->load->view('body/frontdesk/layout/footer');
  }

  function reservations($reservation_type) {
    $data = array(
      'active' => $reservation_type,
      'getRoomType' => $this->get_model->getRoomTypes(),
      'getRoom' => $this->get_model->getRoom(),
      'guests' => $this->get_model->getGuests(),
    );
    $data['reservations'] = $this->get_model->getReservations($reservation_type == 'walkin' ? ['Arrival/Tentative', 'Confirmed'] : ['Online']);
    $this->load->view('body/frontdesk/layout/header', $data);
    $this->load->view('body/frontdesk/reservations-' . $reservation_type, $data);
    $this->load->view('body/frontdesk/components/modal-reservation');
    $this->load->view('body/frontdesk/layout/footer');
  }

  function bookings() {
    $data = [
      'active' => 'bookings',
      'bookings' => $this->get_model->getBookingsByStatus(),
    ];

    $this->load->view('body/frontdesk/layout/header', $data);
    $this->load->view('body/frontdesk/booking');
    $this->load->view('body/frontdesk/layout/footer');
  }

  // ------------------------------------------------------------------------------------------------------- //
  // ------------------------------------------------ FRANZ ------------------------------------------------ //
  // ------------------------------------------------------------------------------------------------------- //

  function book() {
    if (!$_POST['guest_id']) {
      $_POST['guest_id'] = $this->insert_model->addGuest($_POST, TRUE);
    }
    $room = $this->get_model->getRoomById($_POST['room_id']);
    $name = $_POST['first_name'] . ' ' . $_POST['last_name'];
    $this->insert_model->book();
    $this->session->set_flashdata('success', 'Successfully booked ' . $name . ' in room ' . $room->room_number);
    $this->redirect();
  }

  function addGuest() {
    $guest = $this->get_model->checkGuest();

    if ($guest) {
      $name = $guest->first_name . ' ' . $guest->middle_name . ' ' . $guest->last_name;
      $this->session->set_flashdata('error', $name . ' already exist on the guest list.');
      $this->redirect();
      die;
    }

    $name = $_POST['first_name'] . ' ' . $_POST['middle_name'] . ' ' . $_POST['last_name'];
    $this->insert_model->addGuest(NULL);
    $this->session->set_flashdata('success', 'Successfully added ' . $name . ' to the guest list.');
    $this->redirect();
  }

  function updateGuest() {
    $this->update_model->updateGuest();
    $name = $_POST['first_name'] . ' ' . $_POST['middle_name'] . ' ' . $_POST['last_name'];
    $this->session->set_flashdata('success', 'Successfully updated ' . $name);
    $this->redirect();
  }

  function statusGuest($disabled, $guest_id) {
    $guest = $this->get_model->getGuest($guest_id);
    $name = $guest->first_name . ' ' . $guest->middle_name . ' ' . $guest->last_name;
    $this->update_model->statusGuest($disabled, $guest_id);
    $this->session->set_flashdata('success', 'Successfully updated status of ' . $name);
    $this->redirect();
  }

  function changePassword() {
    $user = $this->get_model->getProfile();

    if (!password_verify($_POST['old_password'], $user->password)) {
      $this->session->set_flashdata('error', 'Incorrect old password!');
      $this->redirect();
      die;
    }

    if ($_POST['password'] != $_POST['confirm_password']) {
      $this->session->set_flashdata('error', 'New password and confirm password does not match!');
      $this->redirect();
      die;
    }

    $this->session->set_flashdata('success', 'Password successfully changed.');
    $this->update_model->changePassword();
    $this->redirect();
  }

  function updateReservationStatus($reservation_status, $booking_id) {
    $this->update_model->updateReservationStatus($reservation_status, $booking_id);
    $this->session->set_flashdata('success', 'Reservation status successfully cancelled.');
    $this->redirect();
  }

  function confirm() {
    $this->update_model->updateReservationStatus(5, $_POST['booking_id']);
    $this->update_model->confirm();
    $this->session->set_flashdata('success', 'Reservation successfully verified!');
    $this->redirect();
  }
}
