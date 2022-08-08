<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Get_model extends CI_Model {

  function dd($data) {
    echo "<pre>";
    print_r(var_dump($data));
    die;
  }

  function getRooms() {
    return $this->db->order_by('rank', "asc")->get('room_type')->result_array();
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

  function getRoom() {
    return $this->db->query('select * from room_type inner join rooms on room_type.id=rooms.room_type_id')->result_array();
  }

  function getUsers() {
    return $this->db->get('users')->result_array();
  }

  function updateUserId($id) {
    return $this->db->where('id', $id)->get('users')->result_array();
  }

  function frontdeskRooms() {
    return $this->db->order_by('label')->get('rooms_booking')->result_array();
    // return $this->db->query('select * from rooms order by id')->result_array();
  }

  function frontdeskgetReservationDetails($id_if_reserve) {
    return $this->db->query('select * from reserve_room_type where form_id="' . $id_if_reserve . '"')->result_array();
  }

  function frontdeskgetRoomById($id) {
    return $this->db->query('select * from room_type inner join rooms on room_type.id=rooms.room_type_id where rooms.id="' . $id . '"')->result_array();
  }

  function frontdeskgetRoom() {
    //return $this->db->query('select * from room_type inner join rooms on room_type.id=rooms.room_type_id where status_by_room <> "CHECK"')->result_array();
    return $this->db->query('select * ,room_types_booking.name as room_type from rooms_booking inner join room_types_booking on rooms_booking.type= room_types_booking.id inner join room_statuses on rooms_booking.status = room_statuses.id')->result_array();
  }

  function frontdeskgetRoomAndCheck($id) {
    return $this->db->query('select * from rooms inner join check_form on rooms.room_number = check_form.room_id where rooms.id="' . $id . '" and check_form.status="IN"')->result_array();
  }

  function frontdeskaddPricingTable($id) {
    $this->db->query('select * from room_type inner join rooms on room_type.id=rooms.room_type_id where rooms.id="' . $id . '"');
  }

  function getDataCart($res) {
    if ($this->session->userdata('connect') == true) {
      # code...
      $sess = $this->session->userdata('username');
    }

    if ($res == 'Restaurant') {
      return $this->db->query('select * from product_restaurant inner join restaurant_cart on product_restaurant.id=restaurant_cart.product_id where restaurant_cart.id_of_user="' . $sess . '" and table_num="walkin" and status_cart="Not Deleted" order by id desc')->result_array();
    } else {
      return $this->db->query('select * from product_coffeeshop inner join restaurant_cart on product_coffeeshop.id=restaurant_cart.product_id where restaurant_cart.id_of_user="' . $sess . '" and table_num="walkin" and status_cart="Not Deleted" order by id desc')->result_array();
    }
  }

  function getDataCartReciept($id_reports, $res) {
    if ($this->session->userdata('connect') == true) {
      # code...
      $sess = $this->session->userdata('username');
    }

    if ($res == 'Restaurant') {
      return $this->db->query('select * from product_restaurant inner join restaurant_cart on product_restaurant.id=restaurant_cart.product_id where restaurant_cart.id_of_user="' . $sess . '" and table_num="walkin" and status_cart="Deleted" and id_for_reports="' . $id_reports . '" order by id desc')->result_array();
    } else {
      return $this->db->query('select * from product_coffeeshop inner join restaurant_cart on product_coffeeshop.id=restaurant_cart.product_id where restaurant_cart.id_of_user="' . $sess . '" and table_num="walkin" and status_cart="Deleted" and id_for_reports="' . $id_reports . '" order by id desc')->result_array();
    }
  }

  function AdmingetDataCartReciept($id_reports, $res) {
    if ($res == 'Restaurant') {
      return $this->db->query('select * from product_restaurant inner join restaurant_cart on 
                          product_restaurant.id=restaurant_cart.product_id 
                where table_num="walkin" and status_cart="Deleted" and id_for_reports="' . $id_reports . '" order by id desc')->result_array();
    } else {
      return $this->db->query('select * from product_coffeeshop inner join restaurant_cart on 
                          product_coffeeshop.id=restaurant_cart.product_id 
                where table_num="walkin" and status_cart="Deleted" and id_for_reports="' . $id_reports . '" order by id desc')->result_array();
    }
  }

  function getDataCartRecieptpertable($id_reports, $id, $res) {
    if ($this->session->userdata('connect') == true) {
      # code...
      $sess = $this->session->userdata('username');
    }

    if ($res == 'Restaurant') {
      return $this->db->query('select * from product_restaurant inner join restaurant_cart on product_restaurant.id=restaurant_cart.product_id where restaurant_cart.id_of_user="' . $sess . '" and table_num="' . $id . '" and status_cart="Deleted" and id_for_reports="' . $id_reports . '" order by id desc')->result_array();
    } else {
      return $this->db->query('select * from product_coffeeshop inner join restaurant_cart on product_coffeeshop.id=restaurant_cart.product_id where restaurant_cart.id_of_user="' . $sess . '" and table_num="' . $id . '" and status_cart="Deleted" and id_for_reports="' . $id_reports . '" order by id desc')->result_array();
    }
  }

  function AdmingetDataCartRecieptpertable($id_reports, $id) {
    return $this->db->query('select * from product_restaurant inner join restaurant_cart on product_restaurant.id=restaurant_cart.product_id where table_num="' . $id . '" and status_cart="Deleted" and id_for_reports="' . $id_reports . '" order by id desc')->result_array();
  }

  function getDataCartDelivered($res) {
    if ($this->session->userdata('connect') == true) {
      # code...
      $sess = $this->session->userdata('username');
    }
    if ($res == 'Restaurant') {
      return $this->db->query('select * from product_restaurant inner join restaurant_cart on product_restaurant.id=restaurant_cart.product_id where restaurant_cart.id_of_user="' . $sess . '" and table_num="walkin" and status_cart="Deleted" order by id desc')->result_array();
    } else {
      return $this->db->query('select * from product_coffeeshop inner join restaurant_cart on product_coffeeshop.id=restaurant_cart.product_id where restaurant_cart.id_of_user="' . $sess . '" and table_num="walkin" and status_cart="Deleted" order by id desc')->result_array();
    }
  }

  function CoffeeshopgetDataCart() {
    if ($this->session->userdata('connect') == true) {
      # code...
      $sess = $this->session->userdata('username');
    }

    return $this->db->query('select * from product_coffeeshop inner join coffeeshop_cart on product_coffeeshop.id=coffeeshop_cart.product_id where coffeeshop_cart.id_of_user="' . $sess . '" and table_num="walkin"')->result_array();
  }

  function getDataCartbyTable($id, $res) {
    if ($this->session->userdata('connect') == true) {
      # code...
      $sess = $this->session->userdata('username');
    }

    if ($res == 'Restaurant') {
      return $this->db->query('select * from product_restaurant inner join restaurant_cart on product_restaurant.id=restaurant_cart.product_id where restaurant_cart.id_of_user="' . $sess . '" and table_num="' . $id . '" and status_cart="Not Deleted" order by id_cart desc')->result_array();
    } else {
      return $this->db->query('select * from product_coffeeshop inner join restaurant_cart on product_coffeeshop.id=restaurant_cart.product_id where restaurant_cart.id_of_user="' . $sess . '" and table_num="' . $id . '" and status_cart="Not Deleted" order by id_cart desc')->result_array();
    }
  }

  function getDataCartDeliveredPertable($id, $res) {
    if ($this->session->userdata('connect') == true) {
      # code...
      $sess = $this->session->userdata('username');
    }

    if ($res == 'Restaurant') {
      return $this->db->query('select * from product_restaurant inner join restaurant_cart on product_restaurant.id=restaurant_cart.product_id where restaurant_cart.id_of_user="' . $sess . '" and table_num="' . $id . '" and status_cart="Not Deleted" order by id desc')->result_array();
    } else {
      return $this->db->query('select * from product_coffeeshop inner join restaurant_cart on product_coffeeshop.id=restaurant_cart.product_id where restaurant_cart.id_of_user="' . $sess . '" and table_num="' . $id . '" and status_cart="Not Deleted" order by id desc')->result_array();
    }
  }

  function coffeeshopgetDataCartbyTable($id) {
    if ($this->session->userdata('connect') == true) {
      # code...
      $sess = $this->session->userdata('username');
    }
    return $this->db->query('select * from product_coffeeshop inner join coffeeshop_cart on product_coffeeshop.id=coffeeshop_cart.product_id where coffeeshop_cart.id_of_user="' . $sess . '" and table_num="' . $id . '"')->result_array();
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
    return $this->db->query('select * from check_form inner join rooms_checked on check_form.id = rooms_checked.check_id where status_payment="Unpaid"')->result_array();
  }

  function frondeskGetRoomCheckedById($id) {
    //return $this->db->where('check_id',$id)->get('rooms_checked')->result_array();
    return $this->db->query('select * from deduction inner join rooms_checked on deduction.id_ded=rooms_checked.dedeuction where check_id = "' . $id . '" ')->result_array();
    //return $this->db->query('select * from rooms_checked inner join restaurant_cart on rooms_checked.id_rooms = restaurant_cart.charge_id inner join product_restaurant on restaurant_cart.product_id = product_restaurant.id inner join deduction on deduction.id_ded=rooms_checked.dedeuctionwhere rooms_checked.check_id = "'.$id.'"')->result_array();

  }
  function frontdeskConnectBooking($id) {
    return $this->db->query('select *,bookings.booking_id as book_id ,rooms_booking.id as rooms_id from bookings inner join rooms_checked on bookings.booking_id = rooms_checked.connect_check inner join rooms_booking on rooms_booking.id = bookings.room_id inner join booking_statuses on bookings.status = booking_statuses.id  where rooms_checked.check_id="' . $id . '" ')->result_array();
  }

  // check if still used
  function frontdeskRommAv() {
    return $this->db->where('status', '1')->get('rooms_booking')->result_array();
  }

  // check if still used
  function frontdeskRommUn() {
    return $this->db->query('select * from rooms_booking where status<> "1"')->result_array();
  }

  function frontdeskgetDeduction() {
    return $this->db->get('deduction')->result_array();
  }

  function houseKeepinggetRoom() {
    //return $this->db->query('select * from room_type inner join rooms on room_type.id=rooms.room_type_id where status_by_room ="Checkout"')->result_array();
    return $this->db->query('select * ,room_types_booking.name as room_type, rooms_booking.id as room_id from rooms_booking inner join room_types_booking on rooms_booking.type= room_types_booking.id inner join room_statuses on rooms_booking.status = room_statuses.id')->result_array();
  }

  function houseKeepinggetRoomReady() {
    return $this->db->query('select * from room_type inner join rooms on room_type.id=rooms.room_type_id where status_by_room ="EMPTY"')->result_array();
  }

  function houseKeepinggetRoomUM() {
    return $this->db->query('select * from room_type inner join rooms on room_type.id=rooms.room_type_id where status_by_room ="Under Maintenance"')->result_array();
  }

  function houseKeepinggetRoomUC() {
    return $this->db->query('select * from room_type inner join rooms on room_type.id=rooms.room_type_id where status_by_room ="Under Cleaning"')->result_array();
  }

  function houseKeepinggetRoomCheckin() {
    return $this->db->query('select * from rooms_checked where room_status ="Checked In" and add_bed <> 0 order by bed_status desc limit 100')->result_array();
  }

  function frontdeskTOtalBalance($id) {
    return $this->db->query('select *,sum(total_balance) as total from rooms_checked where check_id="' . $id . '"')->result_array();
  }
  function coffeeshopTotalBalance() {
    return $this->db->query('select *,sum(total_cart_amount) as total from coffeeshop_cart where table_num="walkin"')->result_array();
  }

  function restaurantTotalBalance() {
    if ($this->session->userdata('connect') == true);
    $sess = $this->session->userdata('user_id');
    return $this->db->query('select *,sum(total_cart_amount) as total from restaurant_cart where table_num="walkin" and status_cart="Not Deleted" and account_process="' . $sess . '"')->result_array();
  }

  function restaurantTotalBalanceReciept($id_reports, $res) {
    if ($this->session->userdata('connect') == true);
    $sess = $this->session->userdata('user_id');
    return $this->db->query('select *,sum(total_cart_amount) as total from restaurant_cart where type_process="' . $res . '" and status_cart="Deleted" and account_process="' . $sess . '" and id_for_reports="' . $id_reports . '"')->result_array();
  }

  function ADminrestaurantTotalBalanceReciept($id_reports) {
    return $this->db->query('select *,sum(total_cart_amount) as total from restaurant_cart where table_num="walkin" and status_cart="Deleted" and id_for_reports="' . $id_reports . '"')->result_array();
  }

  function restaurantTotalBalanceRecieptpertable($id_reports, $id, $res) {
    if ($this->session->userdata('connect') == true);
    $sess = $this->session->userdata('user_id');
    return $this->db->query('select *,sum(total_cart_amount) as total from restaurant_cart where type_process="' . $res . '" and table_num="' . $id . '" and status_cart="Deleted" and account_process="' . $sess . '" and id_for_reports="' . $id_reports . '"')->result_array();
  }

  function AdminrestaurantTotalBalanceRecieptpertable($id_reports, $id) {
    return $this->db->query('select *,sum(total_cart_amount) as total from restaurant_cart where table_num="' . $id . '" and status_cart="Deleted" and id_for_reports="' . $id_reports . '"')->result_array();
  }

  function restaurantTotalBalancePerTable($id, $res) {
    return $this->db->query('select *,sum(total_cart_amount) as total from restaurant_cart where type_process="' . $res . '" and table_num="' . $id . '" and status_cart="Not Deleted"')->result_array();
  }

  function coffeeshopTotalBalancePerTable($id) {
    return $this->db->query('select *,sum(total_cart_amount) as total from coffeeshop_cart where table_num="' . $id . '"')->result_array();
  }

  function frontdeskCharge($id) {
    return $this->db->query('select *,sum(total_cart_amount) as total from rooms_checked inner join restaurant_cart on rooms_checked.id_rooms = restaurant_cart.charge_id inner join product_restaurant on restaurant_cart.product_id = product_restaurant.id where rooms_checked.check_id="' . $id . '" and status_cart="Deleted"')->result_array();
  }

  function frontdeskgetChargeToRoom($id) {
    return $this->db->query('select * from rooms_checked inner join restaurant_cart on rooms_checked.id_rooms = restaurant_cart.charge_id inner join product_restaurant on restaurant_cart.product_id = product_restaurant.id where rooms_checked.check_id="' . $id . '" and restaurant_cart.type_process="Restaurant"')->result_array();
  }

  function frontdeskgetChargeToRoomcof($id) {
    return $this->db->query('select * from rooms_checked inner join restaurant_cart on rooms_checked.id_rooms = restaurant_cart.charge_id inner join product_restaurant on restaurant_cart.product_id = product_restaurant.id where rooms_checked.check_id="' . $id . '" and restaurant_cart.type_process="Coffee Shop"')->result_array();
  }

  function getTables() {
    return $this->db->query('select * from num_tables')->result_array();
  }

  function getTablesbyId($id) {
    return $this->db->query('select * from num_tables where id_table="' . $id . '"')->result_array();
  }

  function updategetTables($id) {
    return $this->db->query('select * from num_tables where id_table="' . $id . '"')->result_array();
  }

  function coffeeshopgetTables() {
    return $this->db->query('select * from coffee_tables')->result_array();
  }

  function coffeeshopgetTablesbyId($id) {
    return $this->db->query('select * from coffee_tables where id_table="' . $id . '"')->result_array();
  }

  function coffeeshopupdategetTables($id) {
    return $this->db->query('select * from coffee_tables where id_table="' . $id . '"')->result_array();
  }

  function logs_activity() {
    return $this->db->query('select * from user_logs where logs_type <> "user"')->result_array();
  }

  function logs_user() {
    return $this->db->query('select * from user_logs where logs_type="user" ')->result_array();
  }

  function forntdesklogs_user($id) {
    return $this->db->query('select * from user_logs where frontdesk_id="' . $id . '" order by date_entered desc')->result_array();
  }

  function adminGetNotif() {
    return $this->db->query('select * from notification where type="Admin" order by id desc limit 10')->result_array();
  }

  function housekeepingGetNotif() {
    return $this->db->query('select * from notification where type="Housekeeping" order by id desc limit 10')->result_array();
  }

  function restaurantGetNotif() {
    return $this->db->query('select * from notification where type="Restaurant" order by id desc limit 10')->result_array();
  }
  function frontdeskGetNotif() {
    return $this->db->query('select * from notification where type="Front Desk" order by id desc limit 10')->result_array();
  }

  function coffeeshopGetNotif() {
    return $this->db->query('select * from notification where type="Coffee Shop" order by id desc limit 10')->result_array();
  }

  function Viewreports($from, $to, $user_type) {
    return $this->db->query('select * from all_reports WHERE type_process="' . $user_type . '" and date_process between "' . $from . '" AND "' . $to . '"')->result_array();
  }

  function ViewReportsTotal($from, $to, $user_type) {
    return $this->db->query('select sum(total_amount_process) as total from all_reports WHERE type_process="' . $user_type . '" and date_process between "' . $from . '" AND "' . $to . '"')->result_array();
  }

  function ViewreportsFrontdesk($from, $to) {
    return $this->db->query('select * from all_reports WHERE  type_process="Frontdesk" and date_process between "' . $from . '" AND "' . $to . '"')->result_array();
  }

  function ViewReportsTotalFrontdesk($from, $to) {
    return $this->db->query('select sum(total_amount_process) as total from all_reports WHERE type_process="Frontdesk"  and date_process between "' . $from . '" AND "' . $to . '"')->result_array();
  }

  function restaurantViewreports($from, $to, $id, $res, $type) {
    return $this->db->query('select * from all_reports WHERE type_payment="' . $type . '" and type_process="' . $res . '" and account_process="' . $id . '" and date_process between "' . $from . '" AND "' . $to . '"')->result_array();
  }

  function restaurantViewReportsTotal($from, $to, $id, $res) {
    return $this->db->query('select sum(total_amount_process) as total from all_reports WHERE type_payment="' . $type . '" and type_process="' . $res . '" and account_process="' . $id . '" and date_process between "' . $from . '" AND "' . $to . '"')->result_array();
  }

  function MainViewreportsFrontdesk($from, $to, $id, $type) {
    return $this->db->query('select * from all_reports WHERE account_process="' . $id . '" and type_payment="' . $type . '" and type_process="Frontdesk" and date_process between "' . $from . '" AND "' . $to . '"')->result_array();
  }

  function MainViewReportsTotalFrontdesk($from, $to, $id, $type) {
    return $this->db->query('select sum(total_amount_process) as total from all_reports WHERE account_process="' . $id . '" and type_payment="' . $type . '" and type_process="Frontdesk"  and date_process between "' . $from . '" AND "' . $to . '"')->result_array();
  }

  function reportTransactionsRestaurant($res) {
    if ($this->session->userdata('connect') == true);
    $sess = $this->session->userdata('user_id');
    return $this->db->query('select * from all_reports where account_process="' . $sess . '" and type_process="' . $res . '"')->result_array();
  }

  function reportTransactionsfrontdesk() {
    if ($this->session->userdata('connect') == true);
    $sess = $this->session->userdata('user_id');
    //return $this->db->query('select * from all_reports where account_process="'.$sess.'" and type_process="Frontdesk"')->result_array();
    return $this->db->query('select * from all_reports where type_process="Frontdesk"')->result_array();
  }

  function reportTransactionsAdmin() {
    return $this->db->query('select * from all_reports')->result_array();
  }

  function houseCount($status) {
    return $this->db->query('select count(*) as total from rooms_booking where status="' . $status . '"')->result_array();
  }

  function countRoom() {
    return $this->db->query('select count(*) as total from rooms_booking')->result_array();
  }

  function countRoomTableRestaurant() {
    return $this->db->query('select count(*) as total from num_tables')->result_array();
  }

  function countRoomRestaurantProduct() {
    return $this->db->query('select count(*) as total from product_restaurant')->result_array();
  }

  function countRoomRestaurantProductActive() {
    return $this->db->query('select count(*) as total from product_restaurant where product_status="ACTIVE"')->result_array();
  }

  function countRoomRestaurantProductINACTIVE() {
    return $this->db->query('select count(*) as total from product_restaurant where product_status <> "ACTIVE"')->result_array();
  }

  function viewAllBookings() {
    return $this->db->query('select *,room_types_booking.name as room_type,bookings.booking_id as book_id from bookings inner join rooms_booking on bookings.room_id = rooms_booking.id inner join room_types_booking on rooms_booking.type = room_types_booking.id ')->result_array();
  }

  function counttotalFOchargeresto($id) {
    return $this->db->query('select sum(charge_amount) as restoTotal from charges_fo where charge_type="Resto" and charge_to="' . $id . '"')->row_array();
  }

  function counttotalFOchargecoffee($id) {
    return $this->db->query('select sum(charge_amount) as cofTotal from charges_fo where charge_type="Coffee Shop" and charge_to="' . $id . '"')->row_array();
  }

  function counttotalFOchargeAmenites($id) {
    return $this->db->query('select sum(amen_amount) as AmTotal from charges_amen where amen_to_charge="' . $id . '"')->row_array();
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
    //return $this->db->query('select *,check_form.id as che_id from check_form inner join bookings on check_form.connect_booking = bookings.booking_id inner join rooms_booking on bookings.room_id = rooms_booking.id inner join room_type on rooms_booking.type = room_type.id inner join all_reports on check_form.id=all_reports.if_frontdesk where check_form.last_name="Villarosa" and check_form.first_name="Elpidio"')->result_array();
    return $this->db->query('select *,check_form.id as che_id from check_form inner join bookings on check_form.connect_booking = bookings.booking_id inner join rooms_booking on bookings.room_id = rooms_booking.id inner join room_type on rooms_booking.type = room_type.id inner join all_reports on check_form.id=all_reports.if_frontdesk where check_form.last_name="' . $fname . '" and check_form.first_name="' . $lname . '" or check_form.last_name="' . $fname . ',' . $lname . '"')->result_array();
  }

  // ------------------------------------------------------------------------------------------------------- //
  // ------------------------------------------------ FRANZ ------------------------------------------------ //
  // ------------------------------------------------------------------------------------------------------- //

  function getFrontDeskRooms($status = 1) {
    $status = $status ? 'room_status_id' : 'room_status_id!=';
    return $this->db->select('*, rooms.id as room_id')
      ->join('room_type', 'room_type.id=rooms.room_type_id')
      ->join('room_statuses', 'room_statuses.id=rooms.room_status_id')
      ->where($status, 4)
      ->order_by('room_number')
      ->get('rooms')->result_array();
  }

  function getRoomsWithRoomType() {
    $this->db->select('*, rooms.id as room_id');
    $this->db->join('room_type', 'room_type.id=rooms.room_type_id');
    $this->db->join('room_statuses', 'room_statuses.id=rooms.room_status_id');
    $this->db->order_by('room_number');
    return $this->db->get('rooms')->result_array();
  }

  function getRoomIdsByRoomType($room_type_id) {
    $this->db->select('rooms.id as room_id');
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
    return $this->db->join('rooms', 'rooms.id=bookings.room_id')
      ->join('guests', 'guests.guest_id=bookings.guest_id')
      ->get('bookings')->result_array();
  }

  function getBookingByBookingNumber($booking_number) {
    return $this->db->join('rooms', 'rooms.id=bookings.room_id')
      ->join('room_type', 'room_type.id=rooms.room_type_id')
      ->join('guests', 'guests.guest_id=bookings.guest_id')
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
    return $this->db->where('id', $this->session->userdata('user_id'))->get('users')->row();
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
      ->join('rooms', 'rooms.id=bookings.room_id')
      ->join('room_type', 'room_type.id=rooms.room_type_id')
      ->where_in('reservation_type', $type)
      ->get('bookings')->result_array();
  }

  function getBookingsByStatus($status = 0) {
    return $this->db->join('guests', 'guests.guest_id=bookings.guest_id')
      ->join('rooms', 'rooms.id=bookings.room_id')
      ->join('room_type', 'room_type.id=rooms.room_type_id')
      ->where('reservation_status', $status)
      ->get('bookings')->result_array();
  }

  function getRoomTypes() {
    return $this->db->order_by('rank')->get('room_type')->result_array();
  }

  function getBookingsByRoomType($room_type_id) {
    return $this->db->select('check_in, check_out, room_number, room_type, rooms.id as room_id')
      ->join('rooms', 'rooms.id=bookings.room_id')
      ->join('room_type', 'room_type.id=rooms.room_type_id')
      ->where('room_type_id', $room_type_id)
      ->get('bookings')->result_array();
  }

  function getRoomCountByRoomType($room_type_id) {
    return $this->db->where('room_type_id', $room_type_id)->count_all_results('rooms');
  }
}
