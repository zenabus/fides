<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Get_model extends CI_Model {

  function dd($data) {
    echo "<pre>";
    print_r(var_dump($data));
    die;
  }

  function getRooms() {
    return $this->db->query('SELECT * FROM room_type INNER JOIN rooms ON room_type.id=rooms.room_type_id')->result_array();
  }

  function getRoom($room_id) {
    return $this->db->join('room_type', 'room_type.id=rooms.room_type_id')->where('rooms.id', $room_id)->get('rooms')->row();
  }

  function getUpdateRoomType($id) {
    return $this->db->where('id', $id)->get('room_type')->result_array();
  }

  function getBed() {
    return $this->db->get('room_bed')->result_array();
  }

  function getPerson() {
    return $this->db->get('room_person')->result_array();
  }

  function getDeduction() {
    return $this->db->get('deduction')->result_array();
  }
  function getDeductionById($id) {
    return $this->db->where('id_ded', $id)->get('deduction')->row_array();
  }

  function coffeegetProductRes() {
    return $this->db->get('product_coffeeshop')->result_array();
  }

  function getProductRes($res) {
    if ($res == 'Restaurant') {
      return $this->db->get('product_restaurant')->result_array();
    } else {
      return $this->db->get('product_coffeeshop')->result_array();
    }
  }

  function getUsers() {
    return $this->db->order_by('status')->order_by('user_type')->order_by('name')->get('users')->result_array();
  }

  function getUser($user_id) {
    return $this->db->where('id', $user_id)->get('users')->row();
  }

  function frontdeskgetReservationDetails($id_if_reserve) {
    return $this->db->query('SELECT * FROM reserve_room_type WHERE form_id="' . $id_if_reserve . '"')->result_array();
  }

  function frontdeskgetRoomById($id) {
    return $this->db->query('SELECT * FROM room_type INNER JOIN rooms ON room_type.id=rooms.room_type_id WHERE rooms.id="' . $id . '"')->result_array();
  }

  function frontdeskgetRoom() {
    //return $this->db->query('SELECT * FROM room_type INNER JOIN rooms ON room_type.id=rooms.room_type_id WHERE status_by_room <> "CHECK"')->result_array();
    return $this->db->query('SELECT * ,room_types_booking.name AS room_type FROM rooms_booking INNER JOIN room_types_booking ON rooms_booking.type= room_types_booking.id INNER JOIN room_statuses ON rooms_booking.status = room_statuses.id')->result_array();
  }

  function frontdeskgetRoomAndCheck($id) {
    return $this->db->query('SELECT * FROM rooms INNER JOIN check_form ON rooms.room_number = check_form.room_id WHERE rooms.id="' . $id . '" and check_form.status="IN"')->result_array();
  }

  function frontdeskaddPricingTable($id) {
    $this->db->query('SELECT * FROM room_type INNER JOIN rooms ON room_type.id=rooms.room_type_id WHERE rooms.id="' . $id . '"');
  }

  function getDataCart($res) {
    if ($this->session->userdata('connect') == true) {
      # code...
      $sess = $this->session->userdata('username');
    }

    if ($res == 'Restaurant') {
      return $this->db->query('SELECT * FROM product_restaurant INNER JOIN restaurant_cart ON product_restaurant.id=restaurant_cart.product_id WHERE restaurant_cart.id_of_user="' . $sess . '" and table_num="walkin" and status_cart="Not Deleted" order by id desc')->result_array();
    } else {
      return $this->db->query('SELECT * FROM product_coffeeshop INNER JOIN restaurant_cart ON product_coffeeshop.id=restaurant_cart.product_id WHERE restaurant_cart.id_of_user="' . $sess . '" and table_num="walkin" and status_cart="Not Deleted" order by id desc')->result_array();
    }
  }

  function getDataCartReciept($id_reports, $res) {
    if ($this->session->userdata('connect') == true) {
      # code...
      $sess = $this->session->userdata('username');
    }

    if ($res == 'Restaurant') {
      return $this->db->query('SELECT * FROM product_restaurant INNER JOIN restaurant_cart ON product_restaurant.id=restaurant_cart.product_id WHERE restaurant_cart.id_of_user="' . $sess . '" and table_num="walkin" and status_cart="Deleted" and id_for_reports="' . $id_reports . '" order by id desc')->result_array();
    } else {
      return $this->db->query('SELECT * FROM product_coffeeshop INNER JOIN restaurant_cart ON product_coffeeshop.id=restaurant_cart.product_id WHERE restaurant_cart.id_of_user="' . $sess . '" and table_num="walkin" and status_cart="Deleted" and id_for_reports="' . $id_reports . '" order by id desc')->result_array();
    }
  }

  function AdmingetDataCartReciept($id_reports, $res) {
    if ($res == 'Restaurant') {
      return $this->db->query('SELECT * FROM product_restaurant INNER JOIN restaurant_cart ON 
                          product_restaurant.id=restaurant_cart.product_id 
                WHERE table_num="walkin" and status_cart="Deleted" and id_for_reports="' . $id_reports . '" order by id desc')->result_array();
    } else {
      return $this->db->query('SELECT * FROM product_coffeeshop INNER JOIN restaurant_cart ON 
                          product_coffeeshop.id=restaurant_cart.product_id 
                WHERE table_num="walkin" and status_cart="Deleted" and id_for_reports="' . $id_reports . '" order by id desc')->result_array();
    }
  }

  function getDataCartRecieptpertable($id_reports, $id, $res) {
    if ($this->session->userdata('connect') == true) {
      # code...
      $sess = $this->session->userdata('username');
    }

    if ($res == 'Restaurant') {
      return $this->db->query('SELECT * FROM product_restaurant INNER JOIN restaurant_cart ON product_restaurant.id=restaurant_cart.product_id WHERE restaurant_cart.id_of_user="' . $sess . '" and table_num="' . $id . '" and status_cart="Deleted" and id_for_reports="' . $id_reports . '" order by id desc')->result_array();
    } else {
      return $this->db->query('SELECT * FROM product_coffeeshop INNER JOIN restaurant_cart ON product_coffeeshop.id=restaurant_cart.product_id WHERE restaurant_cart.id_of_user="' . $sess . '" and table_num="' . $id . '" and status_cart="Deleted" and id_for_reports="' . $id_reports . '" order by id desc')->result_array();
    }
  }

  function AdmingetDataCartRecieptpertable($id_reports, $id) {
    return $this->db->query('SELECT * FROM product_restaurant INNER JOIN restaurant_cart ON product_restaurant.id=restaurant_cart.product_id WHERE table_num="' . $id . '" and status_cart="Deleted" and id_for_reports="' . $id_reports . '" order by id desc')->result_array();
  }

  function getDataCartDelivered($res) {
    if ($this->session->userdata('connect') == true) {
      # code...
      $sess = $this->session->userdata('username');
    }
    if ($res == 'Restaurant') {
      return $this->db->query('SELECT * FROM product_restaurant INNER JOIN restaurant_cart ON product_restaurant.id=restaurant_cart.product_id WHERE restaurant_cart.id_of_user="' . $sess . '" and table_num="walkin" and status_cart="Deleted" order by id desc')->result_array();
    } else {
      return $this->db->query('SELECT * FROM product_coffeeshop INNER JOIN restaurant_cart ON product_coffeeshop.id=restaurant_cart.product_id WHERE restaurant_cart.id_of_user="' . $sess . '" and table_num="walkin" and status_cart="Deleted" order by id desc')->result_array();
    }
  }

  function CoffeeshopgetDataCart() {
    if ($this->session->userdata('connect') == true) {
      # code...
      $sess = $this->session->userdata('username');
    }

    return $this->db->query('SELECT * FROM product_coffeeshop INNER JOIN coffeeshop_cart ON product_coffeeshop.id=coffeeshop_cart.product_id WHERE coffeeshop_cart.id_of_user="' . $sess . '" and table_num="walkin"')->result_array();
  }

  function getDataCartbyTable($id, $res) {
    if ($this->session->userdata('connect') == true) {
      # code...
      $sess = $this->session->userdata('username');
    }

    if ($res == 'Restaurant') {
      return $this->db->query('SELECT * FROM product_restaurant INNER JOIN restaurant_cart ON product_restaurant.id=restaurant_cart.product_id WHERE restaurant_cart.id_of_user="' . $sess . '" and table_num="' . $id . '" and status_cart="Not Deleted" order by id_cart desc')->result_array();
    } else {
      return $this->db->query('SELECT * FROM product_coffeeshop INNER JOIN restaurant_cart ON product_coffeeshop.id=restaurant_cart.product_id WHERE restaurant_cart.id_of_user="' . $sess . '" and table_num="' . $id . '" and status_cart="Not Deleted" order by id_cart desc')->result_array();
    }
  }

  function getDataCartDeliveredPertable($id, $res) {
    if ($this->session->userdata('connect') == true) {
      # code...
      $sess = $this->session->userdata('username');
    }

    if ($res == 'Restaurant') {
      return $this->db->query('SELECT * FROM product_restaurant INNER JOIN restaurant_cart ON product_restaurant.id=restaurant_cart.product_id WHERE restaurant_cart.id_of_user="' . $sess . '" and table_num="' . $id . '" and status_cart="Not Deleted" order by id desc')->result_array();
    } else {
      return $this->db->query('SELECT * FROM product_coffeeshop INNER JOIN restaurant_cart ON product_coffeeshop.id=restaurant_cart.product_id WHERE restaurant_cart.id_of_user="' . $sess . '" and table_num="' . $id . '" and status_cart="Not Deleted" order by id desc')->result_array();
    }
  }

  function coffeeshopgetDataCartbyTable($id) {
    if ($this->session->userdata('connect') == true) {
      # code...
      $sess = $this->session->userdata('username');
    }
    return $this->db->query('SELECT * FROM product_coffeeshop INNER JOIN coffeeshop_cart ON product_coffeeshop.id=coffeeshop_cart.product_id WHERE coffeeshop_cart.id_of_user="' . $sess . '" and table_num="' . $id . '"')->result_array();
  }

  function frontdeskGetRoomTypeById($id) {
    return $this->db->where('form_id', $id)->get('reserve_room_type')->result_array();
  }

  function frontdeskListOfCheckedInbyId($id) {
    return $this->db->where('id', $id)->get('check_form')->result_array();
  }

  function frondeskGetRoom() {
    return $this->db->where('status_by_room', 'EMPTY')->get('rooms')->result_array();
  }

  function frondeskGetRoomNoRestriction() {
    return $this->db->get('rooms')->result_array();
  }

  function frondeskGetRoomCheckedNoRestriction() {
    //return $this->db->where('room_status','Checked In')->get('rooms_checked')->result_array();
    return $this->db->query('SELECT * FROM check_form INNER JOIN rooms_checked ON check_form.id = rooms_checked.check_id WHERE status_payment="Unpaid"')->result_array();
  }

  function frondeskGetRoomCheckedById($id) {
    //return $this->db->where('check_id',$id)->get('rooms_checked')->result_array();
    return $this->db->query('SELECT * FROM deduction INNER JOIN rooms_checked ON deduction.id_ded=rooms_checked.dedeuction WHERE check_id = "' . $id . '" ')->result_array();
    //return $this->db->query('SELECT * FROM rooms_checked INNER JOIN restaurant_cart ON rooms_checked.id_rooms = restaurant_cart.charge_id INNER JOIN product_restaurant ON restaurant_cart.product_id = product_restaurant.id INNER JOIN deduction ON deduction.id_ded=rooms_checked.dedeuctionwhere rooms_checked.check_id = "'.$id.'"')->result_array();

  }

  // check if still used
  function frontdeskRommAv() {
    return $this->db->where('status', '1')->get('rooms_booking')->result_array();
  }

  // check if still used
  function frontdeskRommUn() {
    return $this->db->query('SELECT * FROM rooms_booking WHERE status<> "1"')->result_array();
  }

  function frontdeskgetDeduction() {
    return $this->db->get('deduction')->result_array();
  }

  function houseKeepinggetRoom() {
    //return $this->db->query('SELECT * FROM room_type INNER JOIN rooms ON room_type.id=rooms.room_type_id WHERE status_by_room ="Checkout"')->result_array();
    return $this->db->query('SELECT * ,room_types_booking.name AS room_type, rooms_booking.id AS room_id FROM rooms_booking INNER JOIN room_types_booking ON rooms_booking.type= room_types_booking.id INNER JOIN room_statuses ON rooms_booking.status = room_statuses.id')->result_array();
  }

  function houseKeepinggetRoomReady() {
    return $this->db->query('SELECT * FROM room_type INNER JOIN rooms ON room_type.id=rooms.room_type_id WHERE status_by_room ="EMPTY"')->result_array();
  }

  function houseKeepinggetRoomUM() {
    return $this->db->query('SELECT * FROM room_type INNER JOIN rooms ON room_type.id=rooms.room_type_id WHERE status_by_room ="Under Maintenance"')->result_array();
  }

  function houseKeepinggetRoomUC() {
    return $this->db->query('SELECT * FROM room_type INNER JOIN rooms ON room_type.id=rooms.room_type_id WHERE status_by_room ="Under Cleaning"')->result_array();
  }

  function houseKeepinggetRoomCheckin() {
    return $this->db->query('SELECT * FROM rooms_checked WHERE room_status ="Checked In" and add_bed <> 0 order by bed_status desc limit 100')->result_array();
  }

  function frontdeskTOtalBalance($id) {
    return $this->db->query('SELECT *,sum(total_balance) AS total FROM rooms_checked WHERE check_id="' . $id . '"')->result_array();
  }
  function coffeeshopTotalBalance() {
    return $this->db->query('SELECT *,sum(total_cart_amount) AS total FROM coffeeshop_cart WHERE table_num="walkin"')->result_array();
  }

  function restaurantTotalBalance() {
    if ($this->session->userdata('connect') == true);
    $sess = $_SESSION['user_id'];
    return $this->db->query('SELECT *,sum(total_cart_amount) AS total FROM restaurant_cart WHERE table_num="walkin" and status_cart="Not Deleted" and account_process="' . $sess . '"')->result_array();
  }

  function restaurantTotalBalanceReciept($id_reports, $res) {
    if ($this->session->userdata('connect') == true);
    $sess = $_SESSION['user_id'];
    return $this->db->query('SELECT *,sum(total_cart_amount) AS total FROM restaurant_cart WHERE type_process="' . $res . '" and status_cart="Deleted" and account_process="' . $sess . '" and id_for_reports="' . $id_reports . '"')->result_array();
  }

  function ADminrestaurantTotalBalanceReciept($id_reports) {
    return $this->db->query('SELECT *,sum(total_cart_amount) AS total FROM restaurant_cart WHERE table_num="walkin" and status_cart="Deleted" and id_for_reports="' . $id_reports . '"')->result_array();
  }

  function restaurantTotalBalanceRecieptpertable($id_reports, $id, $res) {
    if ($this->session->userdata('connect') == true);
    $sess = $_SESSION['user_id'];
    return $this->db->query('SELECT *,sum(total_cart_amount) AS total FROM restaurant_cart WHERE type_process="' . $res . '" and table_num="' . $id . '" and status_cart="Deleted" and account_process="' . $sess . '" and id_for_reports="' . $id_reports . '"')->result_array();
  }

  function AdminrestaurantTotalBalanceRecieptpertable($id_reports, $id) {
    return $this->db->query('SELECT *,sum(total_cart_amount) AS total FROM restaurant_cart WHERE table_num="' . $id . '" and status_cart="Deleted" and id_for_reports="' . $id_reports . '"')->result_array();
  }

  function restaurantTotalBalancePerTable($id, $res) {
    return $this->db->query('SELECT *,sum(total_cart_amount) AS total FROM restaurant_cart WHERE type_process="' . $res . '" and table_num="' . $id . '" and status_cart="Not Deleted"')->result_array();
  }

  function coffeeshopTotalBalancePerTable($id) {
    return $this->db->query('SELECT *,sum(total_cart_amount) AS total FROM coffeeshop_cart WHERE table_num="' . $id . '"')->result_array();
  }

  function frontdeskCharge($id) {
    return $this->db->query('SELECT *,sum(total_cart_amount) AS total FROM rooms_checked INNER JOIN restaurant_cart ON rooms_checked.id_rooms = restaurant_cart.charge_id INNER JOIN product_restaurant ON restaurant_cart.product_id = product_restaurant.id WHERE rooms_checked.check_id="' . $id . '" and status_cart="Deleted"')->result_array();
  }

  function frontdeskgetChargeToRoom($id) {
    return $this->db->query('SELECT * FROM rooms_checked INNER JOIN restaurant_cart ON rooms_checked.id_rooms = restaurant_cart.charge_id INNER JOIN product_restaurant ON restaurant_cart.product_id = product_restaurant.id WHERE rooms_checked.check_id="' . $id . '" and restaurant_cart.type_process="Restaurant"')->result_array();
  }

  function frontdeskgetChargeToRoomcof($id) {
    return $this->db->query('SELECT * FROM rooms_checked INNER JOIN restaurant_cart ON rooms_checked.id_rooms = restaurant_cart.charge_id INNER JOIN product_restaurant ON restaurant_cart.product_id = product_restaurant.id WHERE rooms_checked.check_id="' . $id . '" and restaurant_cart.type_process="Coffee Shop"')->result_array();
  }

  function getTables() {
    return $this->db->query('SELECT * FROM num_tables')->result_array();
  }

  function getTablesbyId($id) {
    return $this->db->query('SELECT * FROM num_tables WHERE id_table="' . $id . '"')->result_array();
  }

  function updategetTables($id) {
    return $this->db->query('SELECT * FROM num_tables WHERE id_table="' . $id . '"')->result_array();
  }

  function coffeeshopgetTables() {
    return $this->db->query('SELECT * FROM coffee_tables')->result_array();
  }

  function coffeeshopgetTablesbyId($id) {
    return $this->db->query('SELECT * FROM coffee_tables WHERE id_table="' . $id . '"')->result_array();
  }

  function coffeeshopupdategetTables($id) {
    return $this->db->query('SELECT * FROM coffee_tables WHERE id_table="' . $id . '"')->result_array();
  }

  function logs_activity() {
    return $this->db->query('SELECT * FROM user_logs WHERE logs_type <> "user"')->result_array();
  }

  function logs_user() {
    return $this->db->query('SELECT * FROM user_logs WHERE logs_type="user" ')->result_array();
  }

  function forntdesklogs_user($id) {
    return $this->db->query('SELECT * FROM user_logs WHERE frontdesk_id="' . $id . '" order by date_entered desc')->result_array();
  }

  function adminGetNotif() {
    return $this->db->query('SELECT * FROM notification WHERE type="Admin" order by id desc limit 10')->result_array();
  }

  function housekeepingGetNotif() {
    return $this->db->query('SELECT * FROM notification WHERE type="Housekeeping" order by id desc limit 10')->result_array();
  }

  function restaurantGetNotif() {
    return $this->db->query('SELECT * FROM notification WHERE type="Restaurant" order by id desc limit 10')->result_array();
  }
  function frontdeskGetNotif() {
    return $this->db->query('SELECT * FROM notification WHERE type="Front Desk" order by id desc limit 10')->result_array();
  }

  function coffeeshopGetNotif() {
    return $this->db->query('SELECT * FROM notification WHERE type="Coffee Shop" order by id desc limit 10')->result_array();
  }

  function Viewreports($from, $to, $user_type) {
    return $this->db->query('SELECT * FROM all_reports WHERE type_process="' . $user_type . '" and date_process between "' . $from . '" AND "' . $to . '"')->result_array();
  }

  function ViewReportsTotal($from, $to, $user_type) {
    return $this->db->query('select sum(total_amount_process) AS total FROM all_reports WHERE type_process="' . $user_type . '" and date_process between "' . $from . '" AND "' . $to . '"')->result_array();
  }

  function ViewreportsFrontdesk($from, $to) {
    return $this->db->query('SELECT * FROM all_reports WHERE  type_process="Frontdesk" and date_process between "' . $from . '" AND "' . $to . '"')->result_array();
  }

  function ViewReportsTotalFrontdesk($from, $to) {
    return $this->db->query('select sum(total_amount_process) AS total FROM all_reports WHERE type_process="Frontdesk"  and date_process between "' . $from . '" AND "' . $to . '"')->result_array();
  }

  function restaurantViewreports($from, $to, $id, $res, $type) {
    return $this->db->query('SELECT * FROM all_reports WHERE type_payment="' . $type . '" and type_process="' . $res . '" and account_process="' . $id . '" and date_process between "' . $from . '" AND "' . $to . '"')->result_array();
  }

  function restaurantViewReportsTotal($from, $to, $id, $res) {
    return $this->db->query('select sum(total_amount_process) AS total FROM all_reports WHERE type_payment="' . $type . '" and type_process="' . $res . '" and account_process="' . $id . '" and date_process between "' . $from . '" AND "' . $to . '"')->result_array();
  }

  function MainViewreportsFrontdesk($from, $to, $id, $type) {
    return $this->db->query('SELECT * FROM all_reports WHERE account_process="' . $id . '" and type_payment="' . $type . '" and type_process="Frontdesk" and date_process between "' . $from . '" AND "' . $to . '"')->result_array();
  }

  function MainViewReportsTotalFrontdesk($from, $to, $id, $type) {
    return $this->db->query('select sum(total_amount_process) AS total FROM all_reports WHERE account_process="' . $id . '" and type_payment="' . $type . '" and type_process="Frontdesk"  and date_process between "' . $from . '" AND "' . $to . '"')->result_array();
  }

  function reportTransactionsRestaurant($res) {
    if ($this->session->userdata('connect') == true);
    $sess = $_SESSION['user_id'];
    return $this->db->query('SELECT * FROM all_reports WHERE account_process="' . $sess . '" and type_process="' . $res . '"')->result_array();
  }

  function reportTransactionsfrontdesk() {
    if ($this->session->userdata('connect') == true);
    $sess = $_SESSION['user_id'];
    //return $this->db->query('SELECT * FROM all_reports WHERE account_process="'.$sess.'" and type_process="Frontdesk"')->result_array();
    return $this->db->query('SELECT * FROM all_reports WHERE type_process="Frontdesk"')->result_array();
  }

  function reportTransactionsAdmin() {
    return $this->db->query('SELECT * FROM all_reports')->result_array();
  }

  function houseCount($status) {
    return $this->db->query('select count(*) AS total FROM rooms_booking WHERE status="' . $status . '"')->result_array();
  }

  function countRoom() {
    return $this->db->query('select count(*) AS total FROM rooms_booking')->result_array();
  }

  function countRoomTableRestaurant() {
    return $this->db->query('select count(*) AS total FROM num_tables')->result_array();
  }

  function countRoomRestaurantProduct() {
    return $this->db->query('select count(*) AS total FROM product_restaurant')->result_array();
  }

  function countRoomRestaurantProductActive() {
    return $this->db->query('select count(*) AS total FROM product_restaurant WHERE product_status="ACTIVE"')->result_array();
  }

  function countRoomRestaurantProductINACTIVE() {
    return $this->db->query('select count(*) AS total FROM product_restaurant WHERE product_status <> "ACTIVE"')->result_array();
  }

  function viewAllBookings() {
    return $this->db->query('SELECT *,room_types_booking.name AS room_type,bookings.booking_id AS book_id FROM bookings INNER JOIN rooms_booking ON bookings.room_id = rooms_booking.id INNER JOIN room_types_booking ON rooms_booking.type = room_types_booking.id ')->result_array();
  }

  function counttotalFOchargeresto($id) {
    return $this->db->query('select sum(charge_amount) AS restoTotal FROM charges_fo WHERE charge_type="Resto" and charge_to="' . $id . '"')->row_array();
  }

  function counttotalFOchargecoffee($id) {
    return $this->db->query('select sum(charge_amount) AS cofTotal FROM charges_fo WHERE charge_type="Coffee Shop" and charge_to="' . $id . '"')->row_array();
  }

  function counttotalFOchargeAmenites($id) {
    return $this->db->query('select sum(amen_amount) AS AmTotal FROM charges_amen WHERE amen_to_charge="' . $id . '"')->row_array();
  }

  function selectChargeResto($id) {
    return $this->db->where('charge_type', 'Resto')->where('charge_to', $id)->get('charges_fo')->result_array();
  }

  function selectChargeCoffee($id) {
    return $this->db->where('charge_type', 'Coffee Shop')->where('charge_to', $id)->get('charges_fo')->result_array();
  }

  function selectChargeAmen($id) {
    return $this->db->where('amen_to_charge', $id)->get('charges_amen')->result_array();
  }

  function guestTransactionbyId($fname, $lname) {
    // 	echo $fname;
    // 	echo $lname;
    //return $this->db->query('SELECT *,check_form.id AS che_id FROM check_form INNER JOIN bookings ON check_form.connect_booking = bookings.booking_id INNER JOIN rooms_booking ON bookings.room_id = rooms_booking.id INNER JOIN room_type ON rooms_booking.type = room_type.id INNER JOIN all_reports ON check_form.id=all_reports.if_frontdesk WHERE check_form.last_name="Villarosa" and check_form.first_name="Elpidio"')->result_array();
    return $this->db->query('SELECT *,check_form.id AS che_id FROM check_form INNER JOIN bookings ON check_form.connect_booking = bookings.booking_id INNER JOIN rooms_booking ON bookings.room_id = rooms_booking.id INNER JOIN room_type ON rooms_booking.type = room_type.id INNER JOIN all_reports ON check_form.id=all_reports.if_frontdesk WHERE check_form.last_name="' . $fname . '" and check_form.first_name="' . $lname . '" or check_form.last_name="' . $fname . ',' . $lname . '"')->result_array();
  }

  // ------------------------------------------------------------------------------------------------------- //
  // ------------------------------------------------ FRANZ ------------------------------------------------ //
  // ------------------------------------------------------------------------------------------------------- //

  function getFrontDeskRooms($status = 1) {
    $status = $status ? 'room_status_id' : 'room_status_id!=';
    return $this->db->select('*, rooms.id AS room_id')
      ->join('room_type', 'room_type.id=rooms.room_type_id')
      ->join('room_statuses', 'room_statuses.id=rooms.room_status_id')
      ->where($status, 4)
      ->order_by('room_number')
      ->get('rooms')->result_array();
  }

  function getRoomsWithRoomType() {
    $this->db->select('*, rooms.id AS room_id');
    $this->db->join('room_type', 'room_type.id=rooms.room_type_id');
    $this->db->join('room_statuses', 'room_statuses.id=rooms.room_status_id');
    $this->db->order_by('room_number');
    return $this->db->get('rooms')->result_array();
  }

  function getRoomIdsByRoomType($room_type_id) {
    $this->db->select('rooms.id AS room_id');
    $this->db->join('room_type', 'room_type.id=rooms.room_type_id');
    $this->db->join('room_statuses', 'room_statuses.id=rooms.room_status_id');
    $this->db->where('room_type.id', $room_type_id);
    $this->db->order_by('room_number');
    return $this->db->get('rooms')->result_array();
  }

  function getGuests($guest_disabled = 0) {
    return $this->db->where('guest_disabled', $guest_disabled)->get('guests')->result_array();
  }

  function getGuest($guest_id) {
    return $this->db->where('guest_id', $guest_id)->get('guests')->row();
  }

  function checkGuest() {
    return $this->db->where('first_name', $_POST['first_name'])
      ->where('middle_name', $_POST['middle_name'])
      ->where('last_name', $_POST['last_name'])
      ->get('guests')->row();
  }

  function getBookings() {
    return $this->db->join('booked_rooms', 'booked_rooms.booking_id=bookings.booking_id')
      ->join('rooms', 'rooms.id=booked_rooms.room_id')
      ->join('guests', 'guests.guest_id=bookings.guest_id')
      ->get('bookings')->result_array();
  }

  function getBooking($booking_id) {
    return $this->db->join('booked_rooms', 'booked_rooms.booking_id=bookings.booking_id')
      ->join('rooms', 'rooms.id=booked_rooms.room_id')
      ->join('guests', 'guests.guest_id=bookings.guest_id')
      ->where('bookings.booking_id', $booking_id)
      ->get('bookings')->row();
  }

  function getBookingByBookingNumber($booking_number) {
    return $this->db->join('guests', 'guests.guest_id=bookings.guest_id')
      ->where('booking_number', $booking_number)
      ->get('bookings')->row();
  }

  function authenticate() {
    $data = $this->db->where('username', $_POST['username'])->get('users')->row();

    if ($data) {
      if (password_verify($_POST['password'], $data->password)) {
        return $data;
      }
    }

    return FALSE;
  }

  function getProfile() {
    return $this->db->where('id', $_SESSION['user_id'])->get('users')->row();
  }

  function getRoomById($id) {
    return $this->db->join('room_type', 'room_type.id=rooms.room_type_id')->where('rooms.id', $id)->get('rooms')->row();
  }

  function getRoomsById($room_id) {
    return $this->db->where('room_type_id', $room_id)->order_by('room_number', 'asc')->get('rooms')->result_array();
  }

  function getRoomByRoomNumber($room_number) {
    return $this->db->where('room_number', $room_number)->get('rooms')->row();
  }

  function getRoomByType($room) {
    return $this->db->where('room_type', $room)->get('room_type')->row();
  }

  function getReservations($type) {
    return $this->db->join('guests', 'guests.guest_id=bookings.guest_id')
      ->join('booked_rooms', 'booked_rooms.booking_id=bookings.booking_id')
      ->join('rooms', 'rooms.id=booked_rooms.room_id')
      ->join('room_type', 'room_type.id=rooms.room_type_id')
      ->where_in('reservation_type', $type)
      ->get('bookings')->result_array();
  }

  function getBookingsByStatus($status = [0, -1]) {
    return $this->db->join('guests', 'guests.guest_id=bookings.guest_id')
      ->where_in('reservation_status', $status)
      ->get('bookings')->result_array();
  }

  function getRoomTypes() {
    return $this->db->order_by('rank')->get('room_type')->result_array();
  }

  function getBookingsByRoomType($room_type_id) {
    return $this->db->select('check_in, check_out, room_number, room_type, rooms.id AS room_id')
      ->join('rooms', 'rooms.id=booked_rooms.room_id')
      ->join('room_type', 'room_type.id=rooms.room_type_id')
      ->where('room_type_id', $room_type_id)
      ->get('booked_rooms')->result_array();
  }

  function getRoomCountByRoomType($room_type_id) {
    return $this->db->where('room_type_id', $room_type_id)->count_all_results('rooms');
  }

  function getBookedRooms($booking_id) {
    return $this->db->where('booking_id', $booking_id)
      ->join('rooms', 'rooms.id=booked_rooms.room_id')
      ->join('room_type', 'room_type.id=rooms.room_type_id')
      ->join('discounts', 'discounts.discount_id=booked_rooms.discount_id')
      ->get('booked_rooms')->result_array();
  }

  function getBookedRoom($booked_room_id) {
    return $this->db->where('booked_room_id', $booked_room_id)
      ->join('rooms', 'rooms.id=booked_rooms.room_id')
      ->join('room_type', 'room_type.id=rooms.room_type_id')
      ->get('booked_rooms')->row();
  }

  function getPrice($description) {
    return $this->db->where('description', $description)->get('prices')->row();
  }

  function getDiscounts() {
    return $this->db->get('discounts')->result_array();
  }

  function getDiscount($discount_id) {
    return $this->db->where('discount_id', $discount_id)->get('discounts')->row();
  }

  function getCategories() {
    return $this->db->order_by('category')->get('categories')->result_array();
  }

  function getCategory($category_id) {
    return $this->db->where('category_id', $category_id)->get('categories')->result_array();
  }

  function getCharges() {
    return $this->db->join('categories', 'categories.category_id=charges.category_id')->order_by('category')->get('charges')->result_array();
  }

  function getCharge($charge_id) {
    return $this->db->where('charge_id', $charge_id)->join('categories', 'categories.category_id=charges.category_id')->get('charges')->row();
  }

  function getPayment($booking_id) {
    return $this->db->where('booking_id', $booking_id)->order_by('booking_payment_added', 'DESC')->get('booking_payment')->result_array();
  }

  function getPaymentTotal($booking_id) {
    return $this->db->select_sum('amount')->where('booking_id', $booking_id)->get('booking_payment')->row();
  }

  function getRoomCharges($booked_room_id, $charge_type) {
    return $this->db->where('booked_room_id', $booked_room_id)->where('charge_type', $charge_type)->get('charges_food')->result_array();
  }

  function getRoomAmenities($booked_room_id) {
    return $this->db->join('charges', 'charges.charge_id=charges_other.charge_id')
      ->join('categories', 'categories.category_id=charges.category_id')
      ->where('booked_room_id', $booked_room_id)
      ->order_by('category')
      ->get('charges_other')->result_array();
  }

  function getRoomChargesTotal($booking_id) {
    return $this->db->select_sum('(charges_food_quantity * charges_food_amount)', 'total')
      ->join('booked_rooms', 'booked_rooms.booked_room_id=charges_food.booked_room_id')
      ->join('bookings', 'bookings.booking_id=booked_rooms.booking_id')
      ->where('bookings.booking_id', $booking_id)
      ->get('charges_food')->row();
  }

  function getRoomAmenitiesTotal($booking_id) {
    return $this->db->select_sum('(charge_quantity * charge_amount)', 'total')
      ->join('charges', 'charges.charge_id=charges_other.charge_id')
      ->join('booked_rooms', 'booked_rooms.booked_room_id=charges_other.booked_room_id')
      ->join('bookings', 'bookings.booking_id=booked_rooms.booking_id')
      ->where('bookings.booking_id', $booking_id)
      ->get('charges_other')->row();
  }

  function getBookingLogs($booking_id) {
    return $this->db->join('users', 'users.id=booking_logs.user_id')->order_by('booking_log_added', 'DESC')->where('booking_id', $booking_id)->get('booking_logs')->result_array();
  }

  function getChargeByTable($charge_id, $table) {
    if ($table == 'charges_other') {
      $this->db->join('charges', 'charges.charge_id=charges_other.charge_id');
      $this->db->join('categories', 'categories.category_id=charges.category_id');
    }
    $this->db->where($table . '_id', $charge_id);
    return $this->db->get($table)->row();
  }

  function getPaymentById($booking_payment_id) {
    return $this->db->where('booking_payment_id', $booking_payment_id)->get('booking_payment')->row();
  }

  function getRoomType($room_type_id) {
    return $this->db->where('id', $room_type_id)->get('room_type')->row();
  }

  function getLogs() {
    $this->db->order_by('user_logs.id', 'DESC');
    $this->db->join('users', 'users.id=user_logs.user_id');
    if ($_SESSION['user_type'] != 'Admin' && $_SESSION['user_type'] != 'Superadmin') {
      $this->db->where('user_id', $_SESSION['user_id']);
    }
    return $this->db->get('user_logs')->result_array();
  }

  function getDates($booking_id) {
    return $this->db->select('check_in, check_out')->where('booking_id', $booking_id)->get('booked_rooms')->result_array();
  }
}
