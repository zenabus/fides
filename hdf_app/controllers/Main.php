<?php
defined('BASEPATH') or exit('No direct script access allowed');

require 'vendor/autoload.php';

use Dompdf\Dompdf;
use Dompdf\Options;

class Main extends MY_Controller {

  function __construct() {
    parent::__construct();

    $this->load->vars([
      'cash' => $this->get_model->getCurrentCash(),
      'remitted' => $this->get_model->getRemitted(date_create()->modify('-1 days')->format('Y-m-d'), NULL)
    ]);
  }

  // ------------------------------------------------------------------------------------------------------- //
  // ------------------------------------------------ VIEWS ------------------------------------------------ //
  // ------------------------------------------------------------------------------------------------------- //

  function index() {
    $data['rooms'] = $this->get_model->getRoomsWithRoomType();
    $data['available'] = $this->get_model->getFrontDeskRooms();
    $data['unavailable'] = $this->get_model->getFrontDeskRooms(0);
    $data['room_types'] = $this->get_model->getRoomTypes();
    $data['guests'] = $this->get_model->getGuests();
    $data['active'] = 'dashboard';

    $this->load->view('layout/header', $data);
    $this->load->view('body/frontdesk/dashboard');
    $this->load->view('body/frontdesk/components/modal_reservation');
    $this->load->view('layout/footer');
  }

  function calendarData($year, $month) {
    $this->load->library('calendar');

    $data['active'] = 'calendar';
    $data['rooms'] = $this->get_model->getRoomsWithRoomType();
    $data['bookings'] = $this->get_model->getBookings();
    $data['days'] = $this->calendar->get_total_days($month, $year);
    $data['month'] = $this->calendar->get_month_name($month);
    if ($month + 1 == 13) {
      $next_month = str_pad(1, 2, '0', STR_PAD_LEFT);
    } else {
      $next_month = str_pad($month + 1, 2, '0', STR_PAD_LEFT);
    }
    $data['next_month'] = $this->calendar->get_month_name($next_month);
    $data['m'] = str_pad($month, 2, '0', STR_PAD_LEFT);
    $data['y'] = $year;
    $data['guests'] = $this->get_model->getGuests();
    foreach ($data['bookings'] as $i => $booking) {
      $check_out = $booking['early_check_out'] != NULL ? $booking['early_check_out'] : $booking['check_out'];
      $data['bookings'][$i]['dates_between'] = $this->datesBetween($booking['check_in'], $check_out);
      $data['bookings'][$i]['payments'] = $this->get_model->getAdvanceByBookedRoom($booking['booked_room_id']);
      $advanced_total = $this->get_model->getAdvancedPaymentTotal($booking['booked_room_id']);
      $data['bookings'][$i]['advanced_total'] = $advanced_total->amount;
    }
    return $data;
  }

  function calendar($year, $month, $window = FALSE) {
    $this->load->helper('text');
    $data = $this->calendarData($year, $month);
    $data['checkout'] = FALSE;
    if ($window) {
      $this->load->view('body/frontdesk/calendar-window', $data);
    } else {
      $this->load->view('layout/header', $data);
      $this->load->view('body/frontdesk/calendar');
      $this->load->view('body/frontdesk/components/modal_reservation');
      $this->load->view('body/frontdesk/components/modal_mass');
      $this->load->view('layout/footer');
    }
  }

  function rooms() {
    $data['active'] = 'rooms';
    $data['rooms'] = $this->get_model->getRoomsWithRoomType();
    $data['room_types'] = $this->get_model->getRoomTypes();
    $data['guests'] = $this->get_model->getGuests();
    $data['statuses'] = $this->get_model->getRoomStatuses();

    $this->load->view('layout/header', $data);
    $this->load->view('body/frontdesk/rooms');
    $this->load->view('body/frontdesk/components/modal_reservation');
    $this->load->view('layout/footer');
  }

  function guests() {
    $data['active'] = 'guests';
    $data['guests_active'] = $this->get_model->getGuests();
    $data['guests_inactive'] = $this->get_model->getGuests(1);
    $data['getRoomType'] = $this->get_model->getRoomTypes();
    $data['getRoom'] = $this->get_model->getRooms();

    foreach ($data['guests_active'] as $i => $guest) {
      $data['guests_active'][$i]['last_checkin_ago'] = $this->timeAgo($guest['last_checkin']);
    }

    foreach ($data['guests_inactive'] as $i => $guest) {
      $data['guests_inactive'][$i]['last_checkin_ago'] = $this->timeAgo($guest['last_checkin']);
    }

    $this->load->view('layout/header', $data);
    $this->load->view('body/frontdesk/guests');
    $this->load->view('layout/footer');
  }

  function guest($guest_id) {
    $data['active'] = 'guests';
    $data['guest'] = $this->get_model->getGuest($guest_id);
    $data['bookings'] = $this->get_model->getBookingsByGuest($guest_id, [0, -1, 6]);
    $data['reservations'] = $this->get_model->getBookingsByGuest($guest_id, [1, 2, 3]);
    $data['charged'] = $this->get_model->getChargedBookings($guest_id);
    $total_collectable = 0;

    foreach ($data['bookings'] as $i => $booking) {
      $data['bookings'][$i]['rooms'] = $this->get_model->getBookedRooms($booking['booking_id']);
      $data['bookings'][$i]['payment'] = $this->get_model->getPaymentTotal($booking['booking_id']);
      $data['bookings'][$i]['payments'] = $this->get_model->getPayments($booking['booking_id']);
      $data['bookings'][$i]['refund'] = $this->get_model->getRefundTotal($booking['booking_id']);
      $data['bookings'][$i]['refunds'] = $this->get_model->getRefunds($booking['booking_id']);
    }
    foreach ($data['charged'] as $i => $booking) {
      $data['charged'][$i]['rooms'] = $this->get_model->getBookedRooms($booking['booking_id']);
      $data['charged'][$i]['payment'] = $this->get_model->getPaymentTotal($booking['booking_id']);
      $data['charged'][$i]['payments'] = $this->get_model->getPayments($booking['booking_id']);
      $data['charged'][$i]['refund'] = $this->get_model->getRefundTotal($booking['booking_id']);
      $data['charged'][$i]['refunds'] = $this->get_model->getRefunds($booking['booking_id']);
      $booking_collectable = $this->getCharges($booking['booking_id']);
      $data['charged'][$i]['collectable'] = $booking_collectable - $data['charged'][$i]['payment']->amount;
      $total_collectable += $data['charged'][$i]['collectable'];
    }
    foreach ($data['reservations'] as $i => $booking) {
      $data['reservations'][$i]['rooms'] = $this->get_model->getBookedRooms($booking['booking_id']);
      $data['reservations'][$i]['payment'] = $this->get_model->getPaymentTotal($booking['booking_id']);
      $data['reservations'][$i]['payments'] = $this->get_model->getPayments($booking['booking_id']);
      $data['reservations'][$i]['refund'] = $this->get_model->getRefundTotal($booking['booking_id']);
      $data['reservations'][$i]['refunds'] = $this->get_model->getRefunds($booking['booking_id']);
    }

    $data['total_collectable'] = $total_collectable;
    $this->load->view('layout/header', $data);
    $this->load->view('body/frontdesk/guest');
    $this->load->view('layout/footer');
  }

  function profile() {
    $data = [
      'active' => 'account',
      'profile' => $this->get_model->getProfile()
    ];
    $this->load->view('layout/header', $data);
    $this->load->view('body/frontdesk/profile');
    $this->load->view('layout/footer');
  }

  function checkout() {
    $data['active'] = 'checkout';
    $data['checkouts'] = $this->get_model->getCheckouts();
    $data['bed'] = $this->get_model->getPrice('Bed');
    $data['person'] = $this->get_model->getPrice('Person');
    $data['statuses'] = $this->get_model->getRoomStatuses();

    foreach ($data['checkouts'] as $i => $row) {
      $data['checkouts'][$i]['restaurant'] = $this->get_model->getRoomCharges($row['booked_room_id'], 'Restaurant');
      $data['checkouts'][$i]['coffeeshop'] = $this->get_model->getRoomCharges($row['booked_room_id'], 'Coffeeshop');
      $data['checkouts'][$i]['amenities'] = $this->get_model->getRoomAmenities($row['booked_room_id']);
    }

    $this->load->view('layout/header', $data);
    $this->load->view('body/frontdesk/checkout');
    $this->load->view('layout/footer');
  }

  function reservations($reservation_type) {
    $data = [
      'active' => $reservation_type,
      'getRoomType' => $this->get_model->getRoomTypes(),
      'getRoom' => $this->get_model->getRooms(),
      'guests' => $this->get_model->getGuests(),
    ];
    $data['reservations'] = $this->get_model->getReservations($reservation_type == 'walkin' ? ['Arrival/Tentative', 'Confirmed'] : ['Online']);

    foreach ($data['reservations'] as $i => $booking) {
      $data['reservations'][$i]['rooms'] = $this->get_model->getBookedRooms($booking['booking_id']);
      $data['reservations'][$i]['payment'] = $this->get_model->getPaymentTotal($booking['booking_id']);
      $data['reservations'][$i]['payments'] = $this->get_model->getPayments($booking['booking_id']);
      $data['reservations'][$i]['refund'] = $this->get_model->getRefundTotal($booking['booking_id']);
      $data['reservations'][$i]['refunds'] = $this->get_model->getRefunds($booking['booking_id']);
    }

    $this->load->view('layout/header', $data);
    $this->load->view('body/frontdesk/reservations-' . $reservation_type);
    $this->load->view('body/frontdesk/components/modal_reservation');
    $this->load->view('layout/footer');
  }

  function roomCharge($room) {
    $bed = $this->get_model->getPrice('Bed');
    $person = $this->get_model->getPrice('Person');
    if ($room['using_formula'] == '1') {
      [$multiplicand, $multiplier] = explode('x', $room['percentage']);
      if ($multiplicand == 1.12) {
        $rate = $room['pricing_type'] / $multiplicand * $multiplier;
      } else {
        $rate = $room['pricing_type'] - ($room['pricing_type'] / $multiplicand * $multiplier);
      }
    } else {
      $rate = $this->percentage($room['pricing_type'], $room['percentage']);
    }
    $early = $this->get_model->getEarlyCheckout($room['booked_room_id']);
    $charge_early = $early ? $rate : 0;
    $charge_room = $rate * $room['nights'];
    $charge_person = $person->price * $room['extra_person'];
    $charge_bed = $bed->price * $room['extra_bed'];
    $charge_restaurant = $this->get_model->getRoomCharges($room['booked_room_id'], 'Restaurant', TRUE);
    $charge_coffeeshop = $this->get_model->getRoomCharges($room['booked_room_id'], 'Coffeeshop', TRUE);
    $charge_amenities = $this->get_model->getRoomAmenities($room['booked_room_id'], TRUE);

    $total = $charge_early + $charge_room + $charge_person + $charge_bed + $charge_restaurant->total + $charge_coffeeshop->total + $charge_amenities->total;
    return $total;
  }

  function getCharges($booking_id) {
    $total = 0;
    $rooms = $this->get_model->getBookedRooms($booking_id);

    foreach ($rooms as $room) {
      $total += $this->roomCharge($room);
    }

    return $total;
  }

  function bookingsAjax() {
    $start = $this->input->post('start');
    $length = $this->input->post('length');
    $search = $this->input->post('search')['value'];
    $status = $this->input->post('status');
    // $orderColumn = $this->input->post('order')[0]['column'];
    // $orderDirection = $this->input->post('order')[0]['dir'];

    $data['data'] = $this->get_model->getBookingsByStatus($start, $length, $search, $status);
    // $data['data'] = $this->get_model->getBookingsByStatus($start, $length, $search, $orderColumn, $orderDirection, $status);
    foreach ($data['data'] as $i => $booking) {
      $data['data'][$i]['rooms'] = $this->get_model->getBookedRooms($booking['booking_id']);
      $data['data'][$i]['payment'] = $this->get_model->getPaymentTotal($booking['booking_id']);
      $data['data'][$i]['payments'] = $this->get_model->getPayments($booking['booking_id']);
      $data['data'][$i]['refund'] = $this->get_model->getRefundTotal($booking['booking_id']);
      $data['data'][$i]['refunds'] = $this->get_model->getRefunds($booking['booking_id']);
    }

    $data['recordsTotal'] = count($this->get_model->getBookingsByStatusCount($status));
    $data['recordsFiltered'] = count($this->get_model->getFilteredRecordsCount($status, $search));
    // $data['recordsFiltered'] = count($this->get_model->getFilteredRecordsCount($status, $search, $orderColumn, $orderDirection));

    echo json_encode($data);
  }

  function bookings() {
    $data['active'] = 'bookings';
    $data['charged'] = $this->get_model->getChargedBookings();
    $total_collectable = 0;

    foreach ($data['charged'] as $i => $booking) {
      if ($data['charged'][$i]['reservation_status'] != 6) {
        $data['charged'][$i]['charged_guest'] = $this->get_model->getGuest($booking['charged_to']);
        $data['charged'][$i]['rooms'] = $this->get_model->getBookedRooms($booking['booking_id']);
        $data['charged'][$i]['payment'] = $this->get_model->getPaymentTotal($booking['booking_id']);
        $data['charged'][$i]['payments'] = $this->get_model->getPayments($booking['booking_id']);
        $data['charged'][$i]['refund'] = $this->get_model->getRefundTotal($booking['booking_id']);
        $data['charged'][$i]['refunds'] = $this->get_model->getRefunds($booking['booking_id']);
        $booking_collectable = $this->getCharges($booking['booking_id']);
        $data['charged'][$i]['collectable'] = $booking_collectable - $data['charged'][$i]['payment']->amount;
        $total_collectable += $data['charged'][$i]['collectable'];
      }
    }

    $data['total_collectable'] = $total_collectable;

    $this->load->view('layout/header', $data);
    $this->load->view('body/frontdesk/bookings');
    $this->load->view('layout/footer');
  }

  function booking($booking_number) {
    $data['active'] = 'bookings';
    $data['booking'] = $this->get_model->getBookingByBookingNumber($booking_number);
    $data['booked_rooms'] = $this->get_model->getBookedRooms($data['booking']->booking_id);
    $data['archived_rooms'] = $this->get_model->getBookedRooms($data['booking']->booking_id, [1]);
    $data['bed'] = $this->get_model->getPrice('Bed');
    $data['person'] = $this->get_model->getPrice('Person');
    $data['discounts'] = $this->get_model->getDiscounts();
    $data['categories'] = $this->get_model->getCategories();
    $data['charges'] = $this->get_model->getCharges();
    $data['refund'] = $this->get_model->getRefundTotal($data['booking']->booking_id);
    $data['refunds'] = $this->get_model->getRefunds($data['booking']->booking_id);
    $data['payment'] = $this->get_model->getPaymentTotal($data['booking']->booking_id);
    $data['payments'] = $this->get_model->getPayments($data['booking']->booking_id);
    $data['logs'] = $this->get_model->getBookingLogs($data['booking']->booking_id);
    $data['guests'] = $this->get_model->getGuests();

    if ($data['booking']->charged_to) {
      $data['charged_to'] = $this->get_model->getGuest($data['booking']->charged_to);
    }

    foreach ($data['logs'] as $i => $log) {
      $data['logs'][$i]['ago'] = $this->timeAgo($log['booking_log_added']);
    }

    foreach ($data['booked_rooms'] as $i => $room) {
      $payment_room  = $this->get_model->getPaymentByType($room['booked_room_id'], 'room');
      $payment_advance  = $this->get_model->getPaymentByType($room['booked_room_id'], 'advance');
      $data['booked_rooms'][$i]['restaurant'] = $this->get_model->getRoomCharges($room['booked_room_id'], 'Restaurant');
      $data['booked_rooms'][$i]['coffeeshop'] = $this->get_model->getRoomCharges($room['booked_room_id'], 'Coffeeshop');
      $data['booked_rooms'][$i]['amenities'] = $this->get_model->getRoomAmenities($room['booked_room_id']);
      $data['booked_rooms'][$i]['payment_room'] = $payment_room->amount + $payment_advance->amount;
      $data['booked_rooms'][$i]['payment_restaurant'] = $this->get_model->getPaymentByType($room['booked_room_id'], 'restaurant');
      $data['booked_rooms'][$i]['payment_coffeeshop'] = $this->get_model->getPaymentByType($room['booked_room_id'], 'coffeeshop');
      $data['booked_rooms'][$i]['payment_addons'] = $this->get_model->getPaymentByType($room['booked_room_id'], 'addons');
      $data['booked_rooms'][$i]['refund'] = $this->get_model->getRefundByBookedRoom($room['booked_room_id']);
    }

    $this->load->view('layout/header', $data);
    $this->load->view('body/frontdesk/booking');
    $this->load->view('layout/footer');
  }

  function logs() {
    $data['active'] = 'logs';
    $data['logs'] = $this->get_model->getLogs();
    foreach ($data['logs'] as $i => $log) {
      $data['logs'][$i]['ago'] = $this->timeAgo($log['date_entered']);
    }
    $this->load->view('layout/header', $data);
    $this->load->view('body/frontdesk/logs');
    $this->load->view('layout/footer');
  }

  function getHotelSales($date, $period) {
    $hotel_sales = $this->get_model->getHotelSales($date, $period);
    $hotel_expense = $this->get_model->getHotelExpense($date, $period);
    $hotel_sales_am = 0;
    $hotel_sales_pm = 0;
    $hotel_expense_am = 0;
    $hotel_expense_pm = 0;

    foreach ($hotel_sales as $row) {
      [, $time] = explode(' ', $row['booking_payment_added']);
      [$hour] = explode(':', $time);
      if ($hour <= 12) {
        $hotel_sales_am += $row['amount'];
      } else {
        $hotel_sales_pm += $row['amount'];
      }
    }

    foreach ($hotel_expense as $row) {
      [, $time] = explode(' ', $row['expense_added']);
      [$hour] = explode(':', $time);
      if ($hour <= 12) {
        $hotel_expense_am += $row['expense_amount'];
      } else {
        $hotel_expense_pm += $row['expense_amount'];
      }
    }

    return [$hotel_sales_am - $hotel_expense_am, $hotel_sales_pm - $hotel_expense_pm];
  }

  function getEventSales($date, $period) {
    $event_sales = $this->get_model->getEventSales($date, $period);
    $event_expense = $this->get_model->getEventExpense($date, $period);
    $event_sales_am = 0;
    $event_sales_pm = 0;
    $event_expense_am = 0;
    $event_expense_pm = 0;

    foreach ($event_sales as $row) {
      [, $time] = explode(' ', $row['sales_added']);
      [$hour] = explode(':', $time);
      if ($hour <= 12) {
        $event_sales_am += $row['sales_amount'];
      } else {
        $event_sales_pm += $row['sales_amount'];
      }
    }

    foreach ($event_expense as $row) {
      [, $time] = explode(' ', $row['expense_added']);
      [$hour] = explode(':', $time);
      if ($hour <= 12) {
        $event_expense_am += $row['expense_amount'];
      } else {
        $event_expense_pm += $row['expense_amount'];
      }
    }

    return [$event_sales_am - $event_expense_am, $event_sales_pm - $event_expense_pm];
  }

  function getDummyDCR($dates) {
    $dummy_dcrs = [];
    foreach ($this->getMissingDates($dates) as $date) {
      $dummy_dcr = [
        'sum' => 0,
        'count' => 0,
        'sales' => $this->get_model->getSales($date, NULL),
        'expenses' => $this->get_model->getExpenses($date),
        'collectables' => $this->get_model->getCollectables($date, NULL),
        'sales_total' => $this->get_model->getSales($date, NULL, TRUE),
        'expense_total' => $this->get_model->getExpenses($date, TRUE),
        'collectable_total' => $this->get_model->getCollectables($date, NULL, TRUE),
        'remitted' => $this->get_model->getRemitted($date, NULL),
        'payment_added' => $date,
      ];
      array_push($dummy_dcrs, $dummy_dcr);
    }
    return $dummy_dcrs;
  }

  function dcr($date = NULL, $type = NULL) {
    if (!$date) {
      $dates = [];
      $data['active'] = 'dcr';
      $dcrs = $this->get_model->getCustomDCR();

      $cash = $this->get_model->getCustomDCRTotal(['Cash']);
      $card = $this->get_model->getCustomDCRTotal(['Card', 'Check', 'Bank Transfer']);

      foreach ($dcrs as $i => $row) {
        foreach ($cash as $c) {
          if ($c['payment_added'] == $row['payment_added']) {
            $dcrs[$i]['cash'] = $c['sum'];
          }
        }
        foreach ($card as $c) {
          if ($c['payment_added'] == $row['payment_added']) {
            $dcrs[$i]['card'] = $c['sum'];
          }
        }
        $dcrs[$i]['remitted'] = $this->get_model->getRemitted($row['payment_added'], NULL);
        $dcrs[$i]['sales']  = $this->get_model->getSales($row['payment_added'], NULL);
        $dcrs[$i]['sales_total']  = $this->get_model->getSales($row['payment_added'], NULL, TRUE);
        $dcrs[$i]['collectables']  = $this->get_model->getCollectables($row['payment_added'], NULL);
        $dcrs[$i]['collectable_total']  = $this->get_model->getCollectables($row['payment_added'], NULL, TRUE);
        $dcrs[$i]['expenses']  = $this->get_model->getExpenses($row['payment_added']);
        $dcrs[$i]['expense_total']  = $this->get_model->getExpenses($row['payment_added'], TRUE);
        array_push($dates, $row['payment_added']);
      }

      $dummy_dcrs = $this->getDummyDCR($dates);
      $data['dcr'] = array_merge($dcrs, $dummy_dcrs);

      usort($data['dcr'], function ($item1, $item2) {
        return $item2['payment_added'] <=> $item1['payment_added'];
      });

      $this->load->view('layout/header', $data);
      $this->load->view('body/frontdesk/dcr');
      $this->load->view('layout/footer');
    } else {
      $data['date'] = $date;
      $data['type'] = $type;
      $data['occupied'] = $this->get_model->getOccupiedRooms($date);
      $data['payments'] = $this->get_model->getPaymentsByDateGrouped($date, $type);

      $data['expenses_hotel'] = $this->get_model->getExpenseByDateAndType($date, 'Hotel', $type);
      $data['expenses_event'] = $this->get_model->getExpenseByDateAndType($date, 'Event', $type);
      $data['expenses_pool'] = $this->get_model->getExpenseByDateAndType($date, 'Pool', $type);
      $data['expenses_resto'] = $this->get_model->getExpenseByDateAndType($date, 'Resto', $type);
      $data['expenses_otillas'] = $this->get_model->getExpenseByDateAndType($date, "Otilla's", $type);

      $data['sales_event']  = $this->get_model->getSalesByDateAndType($date, 'Event', $type);
      $data['sales_pool']  = $this->get_model->getSalesByDateAndType($date, 'Pool', $type);

      $data['remitted'] = $this->get_model->getRemitted($date, $type);

      foreach ($data['payments'] as $i => $row) {
        $data['payments'][$i]['cash_room'] = $this->get_model->getPaymentByType($row['booked_room_id'], 'room', 'Cash', $date, $type);
        $data['payments'][$i]['cash_restaurant'] = $this->get_model->getPaymentByType($row['booked_room_id'], 'restaurant', 'Cash', $date, $type);
        $data['payments'][$i]['cash_coffeeshop'] = $this->get_model->getPaymentByType($row['booked_room_id'], 'coffeeshop', 'Cash', $date, $type);
        $data['payments'][$i]['cash_addons'] = $this->get_model->getPaymentByType($row['booked_room_id'], 'addons', 'Cash', $date, $type);
        $data['payments'][$i]['cash_reservation'] = $this->get_model->getPaymentByType($row['booked_room_id'], 'advance', 'Cash', $date, $type);

        $data['payments'][$i]['card_room'] = $this->get_model->getPaymentByType($row['booked_room_id'], 'room', 'Card', $date, $type);
        $data['payments'][$i]['card_restaurant'] = $this->get_model->getPaymentByType($row['booked_room_id'], 'restaurant', 'Card', $date, $type);
        $data['payments'][$i]['card_coffeeshop'] = $this->get_model->getPaymentByType($row['booked_room_id'], 'coffeeshop', 'Card', $date, $type);
        $data['payments'][$i]['card_addons'] = $this->get_model->getPaymentByType($row['booked_room_id'], 'addons', 'Card', $date, $type);
        $data['payments'][$i]['card_reservation'] = $this->get_model->getPaymentByType($row['booked_room_id'], 'advance', 'Card', $date, $type);
      }

      [$hotel_sales_am, $hotel_sales_pm] = $this->getHotelSales($date, $type);
      [$event_sales_am, $event_sales_pm] = $this->getEventSales($date, $type);

      $data['hotel_sales_am'] = $hotel_sales_am;
      $data['hotel_sales_pm'] = $hotel_sales_pm;
      $data['event_sales_am'] = $event_sales_am;
      $data['event_sales_pm'] = $event_sales_pm;

      $data['charged'] = $this->get_model->getChargedBookings();

      foreach ($data['charged'] as $i => $row) {
        $payment = $this->get_model->getRoomPaymentTotal($row['booked_room_id']);
        $charges = $this->roomCharge($row);
        $collectables = $charges - $payment->amount;
        $data['charged'][$i]['charged_guest'] = $this->get_model->getGuest($row['charged_to']);
        $data['charged'][$i]['collectables'] = $collectables;
        if (!$collectables || $row['reservation_status'] == 6) {
          unset($data['charged'][$i]);
        }
      }

      $data['sales'] = $this->get_model->getSales($date, $type);
      $data['collectables'] = $this->get_model->getCollectablesByDate($date, $type);

      [$y, $m, $d] = explode('-', $date);
      $data['y'] = $y;
      $data['m'] = $m;
      $data['d'] = $d;

      $view = $this->load->view('body/frontdesk/components/dcr', $data, TRUE);
      $options = new Options();
      $options->set('dpi', 300);
      $options->set('defaultPaperOrientation', 'landscape');
      $dompdf = new Dompdf($options);
      $dompdf->loadHtml($view);
      $dompdf->render();
      $dompdf->stream('HDF-DCR-' . $y . $m . $d . '-' . $type, ['Attachment' => FALSE]);
    }
  }

  function user($user_id) {
    $data['active'] = 'users';
    $data['user'] = $this->get_model->getUser($user_id);
    $data['logs'] = $this->get_model->getLogsByUser($user_id);
    foreach ($data['logs'] as $i => $log) {
      $data['logs'][$i]['ago'] = $this->timeAgo($log['date_entered']);
    }
    $this->load->view('layout/header', $data);
    $this->load->view('body/frontdesk/user');
    $this->load->view('layout/footer');
  }

  function registration($booking_id) {
    $image = file_get_contents(base_url('assets/img/registration_form_letter.jpg'));
    $data['image'] = 'data:image/jpg;base64,' . base64_encode($image);
    $data['booking'] = $this->get_model->getBooking($booking_id);
    $data['booked_rooms'] = $this->get_model->getBookedRooms($booking_id);
    $view = $this->load->view('body/frontdesk/components/registration_form', $data, TRUE);
    $options = new Options();
    $options->set('dpi', 300);
    $dompdf = new Dompdf($options);
    $dompdf->loadHtml($view);
    $dompdf->render();
    $middle = isset($data['booking']->middle_name[0]) ? $data['booking']->middle_name[0] : '';
    $name = $data['booking']->first_name[0] . $middle . $data['booking']->last_name[0];
    $dompdf->stream($data['booking']->booking_number . ' - ' . $name . ' - Guest Registration Form', ['Attachment' => FALSE]);
  }

  function bookingasd($booking_number) {
    $data['active'] = 'bookings';
    $data['booking'] = $this->get_model->getBookingByBookingNumber($booking_number);
    $data['booked_rooms'] = $this->get_model->getBookedRooms($data['booking']->booking_id);
    $data['archived_rooms'] = $this->get_model->getBookedRooms($data['booking']->booking_id, [1]);
    $data['bed'] = $this->get_model->getPrice('Bed');
    $data['person'] = $this->get_model->getPrice('Person');
    $data['discounts'] = $this->get_model->getDiscounts();
    $data['categories'] = $this->get_model->getCategories();
    $data['charges'] = $this->get_model->getCharges();
    $data['refund'] = $this->get_model->getRefundTotal($data['booking']->booking_id);
    $data['refunds'] = $this->get_model->getRefunds($data['booking']->booking_id);
    $data['payment'] = $this->get_model->getPaymentTotal($data['booking']->booking_id);
    $data['payments'] = $this->get_model->getPayments($data['booking']->booking_id);
    $data['logs'] = $this->get_model->getBookingLogs($data['booking']->booking_id);
    $data['guests'] = $this->get_model->getGuests();

    if ($data['booking']->charged_to) {
      $data['charged_to'] = $this->get_model->getGuest($data['booking']->charged_to);
    }

    foreach ($data['logs'] as $i => $log) {
      $data['logs'][$i]['ago'] = $this->timeAgo($log['booking_log_added']);
    }

    foreach ($data['booked_rooms'] as $i => $room) {
      $payment_room  = $this->get_model->getPaymentByType($room['booked_room_id'], 'room');
      $payment_advance  = $this->get_model->getPaymentByType($room['booked_room_id'], 'advance');
      $data['booked_rooms'][$i]['restaurant'] = $this->get_model->getRoomCharges($room['booked_room_id'], 'Restaurant');
      $data['booked_rooms'][$i]['coffeeshop'] = $this->get_model->getRoomCharges($room['booked_room_id'], 'Coffeeshop');
      $data['booked_rooms'][$i]['amenities'] = $this->get_model->getRoomAmenities($room['booked_room_id']);
      $data['booked_rooms'][$i]['payment_room'] = $payment_room->amount + $payment_advance->amount;
      $data['booked_rooms'][$i]['payment_restaurant'] = $this->get_model->getPaymentByType($room['booked_room_id'], 'restaurant');
      $data['booked_rooms'][$i]['payment_coffeeshop'] = $this->get_model->getPaymentByType($room['booked_room_id'], 'coffeeshop');
      $data['booked_rooms'][$i]['payment_addons'] = $this->get_model->getPaymentByType($room['booked_room_id'], 'addons');
      $data['booked_rooms'][$i]['refund'] = $this->get_model->getRefundByBookedRoom($room['booked_room_id']);
    }

    $this->load->view('layout/header', $data);
    $this->load->view('body/frontdesk/booking');
    $this->load->view('layout/footer');
  }

  function receiptv2($booking_id) {
    $image = file_get_contents(base_url('assets/img/acknowledgement_receipt.jpg'));
    $data['image'] = 'data:image/jpg;base64,' . base64_encode($image);
    $data['booking'] = $this->get_model->getBooking($booking_id);
    $booked_rooms = $this->get_model->getBookedRooms($booking_id);
    $soa = [];

    foreach ($booked_rooms as $booked_room) {
      $room_dates = $this->datesBetween($booked_room['check_in'], $booked_room['check_out']);
      foreach ($room_dates as $room_date) {
        if ($booked_room['using_formula'] == '1') {
          [$multiplicand, $multiplier] = explode('x', $booked_room['percentage']);
          if ($multiplicand == 1.12) {
            $rate = $booked_room['pricing_type'] / $multiplicand * $multiplier;
          } else {
            $rate = $booked_room['pricing_type'] - ($booked_room['pricing_type'] / $multiplicand * $multiplier);
          }
        } else {
          $rate = $this->percentage($booked_room['pricing_type'], $booked_room['percentage']);
        }

        $particular = [
          'added' => $booked_room['booked_room_added'],
          'date' => $room_date,
          'particulars' => "Room Accommodation ({$booked_room['room_type_abbr']} {$booked_room['room_number']})",
          'charges' => $rate,
          'reference' => '',
          'payment' => FALSE
        ];
        array_push($soa, $particular);
      }

      $room_charges = $this->get_model->getRoomChargesv2($booked_room['booked_room_id']);
      foreach ($room_charges as $room_charge) {
        $charge_date = date_create($room_charge['charges_food_added']);
        $charge_date = date_format($charge_date, "m/d/Y");
        $particular = [
          'added' => $room_charge['charges_food_added'],
          'date' => $charge_date,
          'particulars' => preg_replace("/\([^)]+\)/", "", $room_charge['charge_type']) . " Charge ({$booked_room['room_type_abbr']} {$booked_room['room_number']})",
          'charges' => $room_charge['charges_food_amount'] * $room_charge['charges_food_quantity'],
          'reference' => $room_charge['reference'],
          'payment' => FALSE
        ];
        array_push($soa, $particular);
      }

      $amenities = $this->get_model->getRoomAmenities($booked_room['booked_room_id']);
      foreach ($amenities as $amenity) {
        $charge_date = date_create($amenity['charges_other_added']);
        $charge_date = date_format($charge_date, "m/d/Y");
        $qty = $amenity['charge_quantity'] != 1 ? $amenity['charge_quantity'] : '';
        $charge = preg_replace("/\([^)]+\)/", "", $amenity['charge']);

        if ($amenity['charge_id'] == 39) {
          if ($booked_room['using_formula'] == 1) {
            [$multiplicand, $multiplier] = explode('x', $booked_room['percentage']);
            if ($multiplicand == 1.12) {
              $amount = $booked_room['pricing_type'] / $multiplicand * $multiplier;
            } else {
              $amount = $booked_room['pricing_type'] - ($booked_room['pricing_type'] / $multiplicand * $multiplier);
            }
          } else {
            $discount = $booked_room['pricing_type'] * ($booked_room['percentage'] / 100);
            $amount = $booked_room['pricing_type'] - $discount;
          }
        } else {
          $amount = $amenity['charge_amount'];
        }

        $particular = [
          'added' => $amenity['charges_other_added'],
          'date' => $charge_date,
          'particulars' => "{$qty} {$charge} ({$booked_room['room_type_abbr']} {$booked_room['room_number']})",
          'charges' => $amount * $amenity['charge_quantity'],
          'reference' => '',
          'payment' => FALSE
        ];
        array_push($soa, $particular);
      }
    }

    $payments = $this->get_model->getPayments($booking_id);
    foreach ($payments as $payment) {
      $payment_date = date_create($payment['booking_payment_added']);
      $payment_date = date_format($payment_date, "m/d/Y");
      $particular = [
        'added' => $payment['booking_payment_added'],
        'date' => $payment_date,
        'particulars' => ucfirst($payment['payment_for']) . " Payment ({$payment['room_type_abbr']} {$payment['room_number']})",
        'charges' => $payment['amount'],
        'reference' => '',
        'payment' => TRUE
      ];
      array_push($soa, $particular);
    }

    usort($soa, function ($item1, $item2) {
      return $item1['added'] <=> $item2['added'];
    });
    usort($soa, function ($item1, $item2) {
      return $item1['date'] <=> $item2['date'];
    });
    $data['soa'] = $soa;
    $view = $this->load->view('body/frontdesk/components/receiptv2', $data, TRUE);
    $options = new Options();
    $options->set('dpi', 300);
    $dompdf = new Dompdf($options);
    $dompdf->loadHtml($view);
    $dompdf->render();
    $middle = isset($data['booking']->middle_name[0]) ? $data['booking']->middle_name[0] : '';
    $name = $data['booking']->first_name[0] . $middle . $data['booking']->last_name[0];
    $dompdf->stream($data['booking']->booking_number . ' - ' . $name . ' - Acknowledgment Receipt', ['Attachment' => FALSE]);
  }

  function receipt($booking_id, $room = FALSE) {
    $image = file_get_contents(base_url('assets/img/acknowledgement_receipt.jpg'));
    $data['bed'] = $this->get_model->getPrice('Bed');
    $data['person'] = $this->get_model->getPrice('Person');
    $data['image'] = 'data:image/jpg;base64,' . base64_encode($image);
    $data['booking'] = $this->get_model->getBooking($booking_id);
    $data['booked_rooms'] = $this->get_model->getBookedRooms($data['booking']->booking_id);
    $data['refund'] = $this->get_model->getRefundTotal($data['booking']->booking_id);
    $payment = $this->get_model->getPaymentTotal($data['booking']->booking_id);
    $data['payment'] = $payment ? $payment->amount : 0;

    foreach ($data['booked_rooms'] as $i => $room) {
      $data['booked_rooms'][$i]['restaurant'] = $this->get_model->getRoomCharges($room['booked_room_id'], 'Restaurant');
      $data['booked_rooms'][$i]['coffeeshop'] = $this->get_model->getRoomCharges($room['booked_room_id'], 'Coffeeshop');
      $data['booked_rooms'][$i]['amenities'] = $this->get_model->getRoomAmenities($room['booked_room_id']);
    }

    $view = $this->load->view('body/frontdesk/components/receipt', $data, TRUE);
    $options = new Options();
    $options->set('dpi', 300);
    $dompdf = new Dompdf($options);
    $dompdf->loadHtml($view);
    $dompdf->render();
    $middle = isset($data['booking']->middle_name[0]) ? $data['booking']->middle_name[0] : '';
    $name = $data['booking']->first_name[0] . $middle . $data['booking']->last_name[0];
    $dompdf->stream($data['booking']->booking_number . ' - ' . $name . ' - Acknowledgment Receipt', ['Attachment' => FALSE]);
  }

  function soa($booked_room_id) {
    $image = file_get_contents(base_url('assets/img/acknowledgement_receipt.jpg'));
    $data['bed'] = $this->get_model->getPrice('Bed');
    $data['person'] = $this->get_model->getPrice('Person');
    $data['image'] = 'data:image/jpg;base64,' . base64_encode($image);
    $data['booking'] = $this->get_model->getBookingByBookedRoom($booked_room_id);
    $data['booked_rooms'] = $this->get_model->getBookedRoomById($booked_room_id, TRUE);
    $data['refund'] = $this->get_model->getRefundByBookedRoom($booked_room_id);
    $payment = $this->get_model->getRoomPaymentTotal($booked_room_id);
    $data['payment'] = $payment ? $payment->amount : 0;
    $room_charges = $this->get_model->getRoomChargesByRoomId($booked_room_id);
    $amenities = $this->get_model->getRoomAmenitiesByRoomId($booked_room_id);
    $data['charges_total'] = $room_charges->total + $amenities->total;

    foreach ($data['booked_rooms'] as $i => $booked_room) {
      $data['booked_rooms'][$i]['restaurant'] = $this->get_model->getRoomCharges($booked_room_id, 'Restaurant');
      $data['booked_rooms'][$i]['coffeeshop'] = $this->get_model->getRoomCharges($booked_room_id, 'Coffeeshop');
      $data['booked_rooms'][$i]['amenities'] = $this->get_model->getRoomAmenities($booked_room_id);
    }

    $view = $this->load->view('body/frontdesk/components/receipt', $data, TRUE);
    $options = new Options();
    $options->set('dpi', 300);
    $dompdf = new Dompdf($options);
    $dompdf->loadHtml($view);
    $dompdf->render();
    $middle = isset($data['booking']->middle_name[0]) ? $data['booking']->middle_name[0] : '';
    $name = $data['booking']->first_name[0] . $middle . $data['booking']->last_name[0];
    $dompdf->stream($data['booked_rooms'][0]['booking_id'] . ' - ' . $name . ' - Statement of Account', ['Attachment' => FALSE]);
  }

  // ------------------------------------------------------------------------------------------------------- //
  // ------------------------------------------------ FRANZ ------------------------------------------------ //
  // ------------------------------------------------------------------------------------------------------- //

  function updateProfile() {
    $_SESSION['name'] = $_POST['name'];
    $this->update_model->updateProfile();
    $this->insert_model->log('Updated his/her profile', 1);
    $this->session->set_flashdata('success', 'Profile successfully updated');
    $this->redirect();
  }

  function uploadprofileImage() {
    $user = $this->get_model->getUser($_SESSION['user_id']);
    $name = $this->uploadImage('files', 'users');
    $old_image = 'assets/img/users/' . $user->image_source;
    $_SESSION['image'] = $name;
    $this->update_model->updateImage($name);
    $this->unlink($old_image);
    $this->insert_model->log('Updated his/her profile picture', 1);
    $this->session->set_flashdata('success', 'Profile picture successfully updated');
    redirect('main/profile/');
  }

  function determinePeriod() {
    $currentTime = date('H:i:s');

    if ($currentTime >= '22:00:00' || $currentTime < '14:00:00') {
      return 'am';
    } else {
      return 'pm';
    }
  }

  function book() {
    unset($_POST['booked_room_id']);
    unset($_POST['booking_id']);
    if (!$_POST['guest_id']) {
      $_POST['guest_id'] = $this->insert_model->addGuest($_POST, TRUE);
    }
    $room = $this->get_model->getRoom($_POST['room_id']);
    $name = $_POST['first_name'] . ' ' . $_POST['last_name'];
    $type = $_POST['booking_type'] == 'Check In' ? 'booked' : 'reserved';
    $_POST['dates'] = $this->datesBetween($_POST['check_in'], $_POST['check_out'], 'Y-m-d');
    [$booking_number, $booked_room_id] = $this->insert_model->book();
    $log = ucfirst("{$type} {$name} in room {$room->room_number}");
    $this->insert_model->log($log);
    $this->insert_model->addBookingLog($log);
    $this->update_model->updateCheckIn($_POST['guest_id']);
    $this->session->set_flashdata('success', "Successfully {$type} {$name} in room {$room->room_number}");

    // if ($_POST['check_in'] == date('m/d/Y')) {
    //   log_message('error', $booked_room_id);
    //   $this->earlyCheckIn($booked_room_id);
    // }

    if ($_POST['booking_type'] == 'Check In') {
      $this->insert_model->addCount($this->determinePeriod());
      redirect(base_url('index.php/main/booking/' . $booking_number));
    } else {
      if ($_POST['amount']) {
        $_POST['booked_room_id'] = $booked_room_id;
        $_POST['payment_for'] = 'advance';
        if ($_POST['payment_option'] == 'Cash') {
          $_POST['payment_details'] = '';
        } else {
          $_POST['payment_details'] = $_POST['card_number'];
        }
        $this->insert_model->addPayment($_POST['payment_for'], $_POST['amount'], $_POST['booked_room_id']);
      }
      $this->redirect();
    }
  }

  function flatten(array $array) {
    $return = array();
    array_walk_recursive($array, function ($a) use (&$return) {
      $return[] = $a;
    });
    return $return;
  }

  function checkAvailableDates($check_in, $check_out, $room_id, $booked_room_id) {
    $occupied = [];
    $check_dates = $this->datesBetween($check_in, $check_out, 'Y-m-d');
    $unique = [];

    log_message('error', 'null' . json_encode($booked_room_id));
    log_message('error', 'checkin' . json_encode($check_in));

    if ($booked_room_id != 'null') {
      $booked_room = $this->get_model->getBookingByBookedRoom($booked_room_id);
      if ($booked_room) {
        $room_dates = $this->datesBetween($booked_room->c_in, $booked_room->c_out, 'Y-m-d');
        log_message('error', 'roomcheckin' . json_encode($booked_room->c_in));
        foreach ($check_dates as $check_date) {
          if (!in_array($check_date, $room_dates)) {
            if ($check_date != $booked_room->c_out) {
              array_push($unique, $check_date);
            }
          }
        }
        $check_dates = array_diff($check_dates, $room_dates);
      }
    } else {
      $unique = $check_dates;
    }

    log_message('error', 'merged' . json_encode($unique));

    foreach ($unique as $date) {
      $conflict = $this->get_model->checkAvailableDates($date, $room_id);
      if ($conflict) {
        if ($conflict[0]['c_out'] != $check_in) {
          array_push($occupied, $conflict);
        }
      }
    }

    echo json_encode($occupied);
  }

  function checkAvailableRooms($check_in, $check_out) {
    $conflicts = [];
    $occupied = [];
    $check_dates = $this->datesBetween($check_in, $check_out, 'Y-m-d');

    foreach ($check_dates as $date) {
      $conflict = $this->get_model->checkAvailableRooms($date);
      if ($conflict) {
        array_push($conflicts, $conflict);
      }
    }

    foreach ($conflicts as $conflict) {
      foreach ($conflict as $row) {
        if (!in_array($row['room_id'], $occupied)) {
          if ($row['c_out'] != $check_in) {
            array_push($occupied, $row['room_id']);
          }
        }
      }
    }

    echo json_encode($occupied);
  }

  function massBooking() {
    $conflicts = [];
    $check_dates = $this->datesBetween($_POST['check_in_mass'], $_POST['check_out_mass']);
    foreach ($check_dates as $date) {
      $conflict = $this->get_model->checkConflict($date);
      if ($conflict) {
        array_push($conflicts, $conflict);
      }
    }

    if (count($conflicts)) {
      $this->session->set_flashdata('error', "Conflict with existing booking detected");
      $this->redirect();
      exit;
    } else {
      $_POST['dates'] = $this->datesBetween($_POST['check_in'], $_POST['check_out'], 'Y-m-d');
      [$booking_id, $booking_number] = $this->insert_model->massBook();
      $log = "Mass {$_POST['rdo_booking_type']}: {$booking_number}";
      $_POST['booking_id'] = $booking_id;
      $this->insert_model->log($log);
      $this->insert_model->addBookingLog($log);
      $this->session->set_flashdata('success', "Successfully booked multiple rooms");
      if ($_POST['rdo_booking_type'] == 'Reservation') {
        $this->redirect();
      } else {
        redirect(base_url('index.php/main/booking/' . $booking_number));
      }
    }
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
    $this->insert_model->log('Added new guest, ' . $name, 2);
    $this->session->set_flashdata('success', 'Successfully added ' . $name . ' to the guest list.');
    $this->redirect();
  }

  function addNewGuest() {
    $content = trim(file_get_contents("php://input"));
    $post = json_decode($content, true);
    $_POST = $post;

    $guest = $this->get_model->checkGuest();

    if (!$guest) {
      $name = $_POST['first_name'] . ' ' . $_POST['middle_name'] . ' ' . $_POST['last_name'];
      $guest = new \stdClass();
      $guest->guest_id = $this->insert_model->addGuest(NULL);
      $guest->first_name = $post['first_name'];
      $guest->middle_name = $post['middle_name'];
      $guest->last_name = $post['last_name'];
      $guest->contact = $post['contact'];
      $guest->suffix = $post['suffix'];
      $this->insert_model->log('Added new guest, ' . $name, 2);
      $this->session->set_flashdata('success', 'Successfully added ' . $name . ' to the guest list.');
    }

    echo json_encode($guest);
  }

  function updateGuest() {
    $name = $_POST['first_name'] . ' ' . $_POST['middle_name'] . ' ' . $_POST['last_name'];
    if (isset($_POST['booking_number'])) {
      $log = "<b>{$_POST['booking_number']}</b> → Updated guest details";
      $this->insert_model->addBookingLog($log);
    } else {
      $log = "Updated guest details of " . $name;
    }
    $this->insert_model->log($log);
    $this->update_model->updateGuest();
    $this->session->set_flashdata('success', 'Successfully updated ' . $name);
    $this->redirect();
  }

  function statusGuest($disabled, $guest_id) {
    $guest = $this->get_model->getGuest($guest_id);
    $name = $guest->first_name . ' ' . $guest->middle_name . ' ' . $guest->last_name;
    $this->update_model->statusGuest($disabled, $guest_id);
    $this->insert_model->log('Updated status of ' . $name, 3);
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

    $this->insert_model->log('Changed his/her password', 1);
    $this->session->set_flashdata('success', 'Password successfully changed.');
    $this->update_model->changePassword();
    $this->redirect();
  }

  function updateBooking() {
    $booking_number = 'HDF' . str_pad($_POST['booking_id'], 5, '0', STR_PAD_LEFT);
    $booking = $this->get_model->getBooking($_POST['booking_id']);
    $room = $this->get_model->getBookedRoom($_POST['booked_room_id']);
    [$arrival, $departure] = $this->getMinMax($_POST['booking_id']);

    $old_name = "{$booking->first_name} {$booking->middle_name} {$booking->last_name} {$booking->suffix}";
    $new_name = "{$_POST['first_name']} {$_POST['middle_name']} {$_POST['last_name']} {$_POST['suffix']}";

    if ($room->check_in != $_POST['check_in'] || $room->check_out != $_POST['check_out']) {
      $s1 = $room->nights > 1 ? 's' : '';
      $s2 = $_POST['nights'] > 1 ? 's' : '';
      $log = "<b>{$booking_number}</b> → <b>{$room->room_number} {$room->room_type_abbr}</b> → Changed room dates from <b>{$room->check_in} - {$room->check_out}</b> (<b>{$room->nights}</b> night{$s1}) to <b>{$_POST['check_in']} - {$_POST['check_out']}</b> (<b>{$_POST['nights']}</b> night{$s2})";
      $this->insert_model->addBookingLog($log);
      $this->insert_model->log($log);
    }

    if ($booking->request != $_POST['request']) {
      $log = "<b>{$booking_number}</b> → Updated request from <b>{$booking->request}</b> to <b>{$_POST['request']}</b>";
      $this->insert_model->addBookingLog($log);
      $this->insert_model->log($log);
    }

    if ($booking->remarks != $_POST['remarks']) {
      $log = "<b>{$booking_number}</b> → Updated remarks from <b>{$booking->remarks}</b> to <b>{$_POST['remarks']}</b>";
      $this->insert_model->addBookingLog($log);
      $this->insert_model->log($log);
    }

    if ($old_name != $new_name) {
      $log = "<b>{$booking_number}</b> → Updated guest name from <b>{$old_name}</b> to <b>{$new_name}</b>";
      $this->insert_model->addBookingLog($log);
      $this->insert_model->log($log);
    }

    if ($booking->contact != $_POST['contact']) {
      $log = "<b>{$booking_number}</b> → Updated contact number from <b>{$booking->contact}</b> to <b>{$_POST['contact']}</b>";
      $this->insert_model->addBookingLog($log);
      $this->insert_model->log($log);
    }

    $this->update_model->updateBookedRoomNights();
    $this->update_model->updateBooking($arrival, $departure, $_POST['booking_id']);
    $this->update_model->updateReservation();
    $this->update_model->updateGuestName();
    $this->session->set_flashdata('success', 'Booking successfully updated.');
    $this->redirect();
  }

  function updateReservation() {
    if ($_POST['amount']) {
      if ($_POST['payment_option'] == 'Cash') {
        $_POST['payment_details'] = '';
      } else {
        $_POST['payment_details'] = $_POST['card_number'];
      }
      $this->insert_model->addPayment('advance', $_POST['amount'], $_POST['booked_room_id']);
    }

    unset($_POST['booked_room_id']);
    unset($_POST['action']);
    unset($_POST['rdo_booking_type']);
    unset($_POST['booking_type']);
    [$arrival, $departure] = $this->getMinMax($_POST['booking_id']);
    $this->update_model->updateBookedRoomNights();
    $this->update_model->updateBooking($arrival, $departure, $_POST['booking_id']);
    unset($_POST['check_in']);
    unset($_POST['check_out']);
    unset($_POST['nights']);
    unset($_POST['room_id']);
    $name = "{$_POST['first_name']} {$_POST['middle_name']} {$_POST['last_name']} {$_POST['suffix']}";
    $this->update_model->updateReservation();
    unset($_POST['request']);
    unset($_POST['remarks']);
    unset($_POST['reservation_type']);
    unset($_POST['payment_option']);
    unset($_POST['payment_details']);
    unset($_POST['amount']);
    unset($_POST['card_number']);

    $this->update_model->updateGuest();
    $this->insert_model->log("Updated reservation details of <b> {$name}", 4);
    $this->session->set_flashdata('success', 'Reservation successfully updated.');
    $this->redirect();
  }

  function earlyCheckIn($booked_room_id) {
    if (date('H') >= 6 && date('H') <= 11) {
      log_message('error', $booked_room_id);
      $this->insert_model->addEarlyCheckin($booked_room_id);
    }
  }

  function checkIn($booking_id = NULL) {
    unset($_POST['booked_room_id']);
    if (!$booking_id) {
      $booking_id = $_POST['booking_id'];
    }
    $booked_room = $this->get_model->getBookedRoom($booking_id);
    // if ($_POST['check_in'] == date('m/d/Y')) {
    //   $this->earlyCheckIn($booked_room->booked_room_id);
    // }
    $this->update_model->updateGuestFromReservation();
    $this->update_model->updateBookedRoomNights();
    $booking_number = 'HDF' . str_pad($booking_id, 5, '0', STR_PAD_LEFT);
    $log = "<b>{$booking_number}</b> → Successfully checked in!";
    $_POST['booking_id'] = $booking_id;
    $this->update_model->updateReservationStatus(0, $booking_id);
    $this->insert_model->log('Checked in a reservation: #' . $booking_number);
    $this->insert_model->addBookingLog($log);
    $this->session->set_flashdata('success', 'Reservation successfully checked in.');
    redirect(base_url('index.php/main/booking/' . $booking_number));
  }

  function cancelReservation($booking_id = NULL) {
    if (!$booking_id) {
      $booking_id = $_POST['booking_id'];
      $this->update_model->updateReason();
    }
    if (isset($_POST['type'])) {
      $type = 'booking';
      $reservation_status = 6;
    } else {
      $type = 'reservation';
      $reservation_status = 4;
    }
    $this->update_model->updateReservationStatus($reservation_status, $booking_id);
    $booking_number = 'HDF' . str_pad($booking_id, 5, '0', STR_PAD_LEFT);
    $log = "<b>{$booking_number}</b> → Cancelled a {$type}!";
    $this->insert_model->addBookingLog($log);
    $this->insert_model->log("Cancelled a {$type}: #" . $booking_number, 4);
    $this->session->set_flashdata('success', $type . ' successfully cancelled.');
    $this->redirect();
  }

  function confirm() {
    $this->update_model->updateReservationStatus(5, $_POST['booking_id']);
    $this->insert_model->addPayment($_POST['payment_for'], $_POST['amount'], $_POST['booked_room_id']);
    $booking_number = 'HDF' . str_pad($_POST['booking_id'], 5, '0', STR_PAD_LEFT);
    $this->insert_model->log('Verified a reservation: #' . $booking_number, 4);
    $this->session->set_flashdata('success', 'Reservation successfully verified!');
    $this->redirect();
  }

  function updateExtras() {
    $booking_number = 'HDF' . str_pad($_POST['booking_id'], 5, '0', STR_PAD_LEFT);
    $room = $this->get_model->getBookedRoom($_POST['booked_room_id']);
    $this->update_model->updateExtras();
    $beds = $_POST['extra_bed'] == 1 ? '' : 's';
    $persons = $_POST['extra_person'] == 1 ? '' : 's';
    $log = "<b>{$booking_number}</b> → <b>{$room->room_number} {$room->room_type_abbr}</b> → Updated extras: <b>{$_POST['extra_bed']} extra bed{$beds}</b> and <b>{$_POST['extra_person']} extra person{$persons}</b>";
    $this->insert_model->addBookingLog($log);
    $this->insert_model->log($log);
    $this->session->set_flashdata('success', 'Extra bed/person successfully updated!');
    $this->redirect();
  }

  function updateDiscount() {
    $booking_number = 'HDF' . str_pad($_POST['booking_id'], 5, '0', STR_PAD_LEFT);
    $this->update_model->updateDiscount();
    $booked_room = $this->get_model->getBookedRoom($_POST['booked_room_id']);
    $discount = $this->get_model->getDiscount($_POST['discount_id']);
    $log = "<b>{$booking_number}</b> → <b>{$booked_room->room_number} {$booked_room->room_type_abbr}</b> → Set room discount for <b>{$discount->discount_type}</b>";
    $this->insert_model->addBookingLog($log);
    $this->insert_model->log($log);
    $this->session->set_flashdata('success', 'Discount successfully updated!');
    $this->redirect();
  }

  function bookRoom() {
    $booking_number = 'HDF' . str_pad($_POST['booking_id'], 5, '0', STR_PAD_LEFT);
    $_POST['dates'] = json_encode($this->datesBetween($_POST['check_in'], $_POST['check_out'], 'Y-m-d'));
    $this->insert_model->bookRoom();
    $room = $this->get_model->getRoom($_POST['room_id']);
    $s = $_POST['nights'] == 1 ? '' : 's';
    $log = "<b>{$booking_number}</b> → <b>{$booking_number} {$room->room_number} {$room->room_type_abbr}</b> → Booked room for <b>{$_POST['nights']} night{$s}</b> from <b>{$_POST['check_in']}</b> to <b>{$_POST['check_out']}</b>";
    [$arrival, $departure] = $this->getMinMax($_POST['booking_id']);
    $this->insert_model->addBookingLog($log);
    $this->insert_model->log($log);
    $this->update_model->updateBooking($arrival, $departure, $_POST['booking_id']);
    $this->session->set_flashdata('success', 'Room successfully added!');
    $this->redirect();
  }

  function removeRoom() {
    $booked_room_id = $_POST['booked_room_id'];
    $booked_room = $this->get_model->getBookedRoom($booked_room_id);
    [$arrival, $departure] = $this->getMinMax($booked_room->booking_id);
    $_POST['booking_id'] = $booked_room->booking_id;
    $this->update_model->processRoom($booked_room_id, 1);
    $s = $booked_room->nights == 1 ? '' : 's';
    $log = "<b>{$booked_room->room_number} {$booked_room->room_type_abbr}</b> → Removed room <b>{$booked_room->nights} night{$s}</b> from <b>{$booked_room->check_in}</b> to <b>{$booked_room->check_out}</b>";
    $this->insert_model->addBookingLog($log);
    $this->insert_model->log($log);
    $this->update_model->updateBooking($arrival, $departure, $booked_room->booking_id);
    $this->session->set_flashdata('success', 'Room successfully removed!');
    $this->redirect();
  }

  function checkoutRoom() {
    $booked_room_id = $_POST['booked_room_id'];
    $booked_room = $this->get_model->getBookedRoom($booked_room_id);
    $today = date('Y-m-d');
    $checkout = $this->toDashedDate($booked_room->check_out);
    $early = $today < $checkout ? TRUE : FALSE;
    $_POST['booking_id'] = $booked_room->booking_id;
    $_POST['today'] = $this->toSlashedDate($today);
    $this->update_model->processRoom($booked_room_id, 2, $early);
    $booking_number = 'HDF' . str_pad($_POST['booking_id'], 5, '0', STR_PAD_LEFT);
    $s = $booked_room->nights == 1 ? '' : 's';
    $log = "<b>{$booking_number}</b> → Checked out room <b>{$booked_room->room_number} {$booked_room->room_type_abbr} {$booked_room->nights} night{$s}</b> from <b>{$booked_room->check_in}</b> to <b>{$booked_room->check_out}</b>";
    $this->insert_model->addBookingLog($log);
    $this->insert_model->log($log);
    $this->session->set_flashdata('success', 'Room successfully checked out!');
    $this->redirect();
  }

  // function processRoom($archive) {
  //   $booked_room_id = $_POST['booked_room_id'];
  //   $booked_room = $this->get_model->getBookedRoom($booked_room_id);
  //   [$arrival, $departure] = $this->getMinMax($booked_room->booking_id);
  //   $_POST['booking_id'] = $booked_room->booking_id;
  //   $booking_number = 'HDF' . str_pad($_POST['booking_id'], 5, '0', STR_PAD_LEFT);
  //   $this->update_model->processRoom($booked_room_id, $archive);
  //   $s = $booked_room->nights == 1 ? '' : 's';
  //   if ($archive == 2) {
  //     $log = "<b>{$booking_number}</b> → Checked out room <b>{$booked_room->room_number} {$booked_room->room_type_abbr} {$booked_room->nights} night{$s}</b> from <b>{$booked_room->check_in}</b> to <b>{$booked_room->check_out}</b>";
  //     $message = 'Room successfully checked out!';
  //   } else {
  //     $log = "<b>{$booking_number}</b> → Removed room <b>{$booked_room->room_number} {$booked_room->room_type_abbr} {$booked_room->nights} night{$s}</b> from <b>{$booked_room->check_in}</b> to <b>{$booked_room->check_out}</b>";
  //     $message = 'Room successfully removed!';
  //   }
  //   $this->insert_model->addBookingLog($log);
  //   $this->insert_model->log($log);
  //   $this->update_model->updateBooking($arrival, $departure, $booked_room->booking_id);
  //   $this->session->set_flashdata('success', $message);
  //   $this->redirect();
  // }

  function revert($type, $booked_room_id) {
    $booked_room = $this->get_model->getBookedRoom($booked_room_id);

    if ($type == 'request') {
    } else {
    }

    [$arrival, $departure] = $this->getMinMax($booked_room->booking_id);
    $_POST['booking_id'] = $booked_room->booking_id;
    $this->update_model->processRoom($booked_room_id, 2);
    $s = $booked_room->nights == 1 ? '' : 's';
    $log = "<b>{$booked_room->room_number} {$booked_room->room_type_abbr}</b> → Checked out room <b>{$booked_room->nights} night{$s}</b> from <b>{$booked_room->check_in}</b> to <b>{$booked_room->check_out}</b>";
    $this->insert_model->addBookingLog($log);
    $this->insert_model->log($log);
    $this->update_model->updateBooking($arrival, $departure, $booked_room->booking_id);
    $this->session->set_flashdata('success', 'Room successfully checked out!');
    $this->redirect();
  }

  function getMinMax($booking_id) {
    $check_ins = [];
    $check_outs = [];
    $dates = $this->get_model->getDates($booking_id);
    foreach ($dates as $date) {
      array_push($check_ins, $this->toDashedDate($date['check_in']));
      array_push($check_outs, $this->toDashedDate($date['check_out']));
    }
    return [$this->toSlashedDate(min($check_ins)), $this->toSlashedDate(max($check_outs))];
  }

  function changeRoom() {
    $booking_number = 'HDF' . str_pad($_POST['booking_id'], 5, '0', STR_PAD_LEFT);
    $room_from = $this->get_model->getBookedRoom($_POST['booked_room_id']);
    $this->update_model->changeRoom();
    [$arrival, $departure] = $this->getMinMax($_POST['booking_id']);
    $room_to = $this->get_model->getRoom($_POST['room_id']);
    $s1 = $room_from->nights == 1 ? '' : 's';
    $s2 = $_POST['nights'] == 1 ? '' : 's';
    $log = "<b>{$booking_number}</b> → <b>{$room_to->room_number} {$room_to->room_type_abbr}</b> → Changed room from <b>{$room_from->room_type_abbr} {$room_from->room_number}</b> {$room_from->nights} night{$s1} {$room_from->check_in} - {$room_from->check_out} to <b>{$room_to->room_number} {$room_to->room_type_abbr}</b> {$_POST['nights']} night{$s2} {$_POST['check_in']} - {$_POST['check_out']}";
    $this->insert_model->addBookingLog($log);
    $this->insert_model->log($log);
    $this->update_model->updateBooking($arrival, $departure, $_POST['booked_room_id']);
    $this->session->set_flashdata('success', 'Room successfully changed!');
    $this->redirect();
  }

  function changeRoomAjax() {
    $content = trim(file_get_contents("php://input"));
    $post = json_decode($content, true);
    log_message('error', json_encode($post));
    $booking_number = 'HDF' . str_pad($post['booking_id'], 5, '0', STR_PAD_LEFT);
    $room_from = $this->get_model->getBookedRoom($post['booked_room_id']);
    $this->update_model->changeRoomAjax($post);
    [$arrival, $departure] = $this->getMinMax($post['booking_id']);
    $room_to = $this->get_model->getRoom($post['room_id']);
    $s1 = $room_from->nights == 1 ? '' : 's';
    $s2 = $post['nights'] == 1 ? '' : 's';
    $log = "<b>{$booking_number}</b> → <b>{$room_to->room_number} {$room_to->room_type_abbr}</b> → Changed room from <b>{$room_from->room_type_abbr} {$room_from->room_number}</b> {$room_from->nights} night{$s1} {$room_from->check_in} - {$room_from->check_out} to <b>{$room_to->room_number} {$room_to->room_type_abbr}</b> {$post['nights']} night{$s2} {$post['check_in']} - {$post['check_out']}";
    $this->insert_model->addBookingLogAjax($log, $post);
    $this->insert_model->log($log);
    $this->update_model->updateBooking($arrival, $departure, $post['booked_room_id']);
    echo json_encode(TRUE);
  }

  function addCharges() {
    $booking_number = 'HDF' . str_pad($_POST['booking_id'], 5, '0', STR_PAD_LEFT);
    $booked_room = $this->get_model->getBookedRoom($_POST['booked_room_id']);
    $amount = number_format($_POST['charges_food_amount']);
    $log = "<b>{$booking_number}</b> → <b>{$booked_room->room_number} {$booked_room->room_type_abbr}</b> → Added <b>{$_POST['charge_type']}</b> charge: <b>Ref. {$_POST['reference']} {$_POST['particulars']}</b> for ₱<b>{$amount}</b> each";
    $this->insert_model->addBookingLog($log);
    $this->insert_model->log($log);
    $this->insert_model->addCharges();
    $this->session->set_flashdata('success', 'Charges successfully added!');
    $this->redirect();
  }

  function addOtherCharges() {
    $booking_number = 'HDF' . str_pad($_POST['booking_id'], 5, '0', STR_PAD_LEFT);
    $charge = $this->get_model->getCharge($_POST['charge_id']);
    $booked_room = $this->get_model->getBookedRoom($_POST['booked_room_id']);
    $cost = number_format($charge->charge_amount);
    $log = "<b>{$booking_number}</b> → <b>{$booked_room->room_number} {$booked_room->room_type_abbr}</b> → Added <b>{$_POST['charge_quantity']} {$charge->category}</b> - <b>{$charge->charge}</b> amounting ₱<b>{$cost}</b> each";
    $this->insert_model->addBookingLog($log);
    $this->insert_model->log($log);
    $this->insert_model->addOtherCharges();
    $this->session->set_flashdata('success', 'Charges successfully added!');
    $this->redirect();
  }

  function processPayment($room, $amount) {
    $bed = $this->get_model->getPrice('Bed');
    $person = $this->get_model->getPrice('Person');
    if ($room['using_formula'] == '1') {
      [$multiplicand, $multiplier] = explode('x', $room['percentage']);
      if ($multiplicand == 1.12) {
        $rate = $room['pricing_type'] / $multiplicand * $multiplier;
      } else {
        $rate = $room['pricing_type'] - ($room['pricing_type'] / $multiplicand * $multiplier);
      }
    } else {
      $rate = $this->percentage($room['pricing_type'], $room['percentage']);
    }
    $early = $this->get_model->getEarlyCheckout($room['booked_room_id']);
    $charge_early = $early ? $rate : 0;
    $charge_room = $rate * $room['nights'];
    $charge_person = $person->price * $room['extra_person'];
    $charge_bed = $bed->price * $room['extra_bed'];
    $charge_restaurant = $this->get_model->getRoomCharges($room['booked_room_id'], 'Restaurant', TRUE);
    $charge_coffeeshop = $this->get_model->getRoomCharges($room['booked_room_id'], 'Coffeeshop', TRUE);
    $charge_amenities = $this->get_model->getRoomAmenities($room['booked_room_id'], TRUE);

    $payment_room  = $this->get_model->getPaymentByType($room['booked_room_id'], 'room');
    $payment_advance  = $this->get_model->getPaymentByType($room['booked_room_id'], 'advance');
    $payment_restaurant = $this->get_model->getPaymentByType($room['booked_room_id'], 'restaurant');
    $payment_coffeeshop = $this->get_model->getPaymentByType($room['booked_room_id'], 'coffeeshop');
    $payment_addons = $this->get_model->getPaymentByType($room['booked_room_id'], 'addons');

    if ($amount > 0) {
      $payable_room = $charge_room - ($payment_room->amount + $payment_advance->amount);
      $payable_restaurant = $charge_restaurant->total - $payment_restaurant->amount;
      $payable_coffeeshop = $charge_coffeeshop->total - $payment_coffeeshop->amount;
      $payable_addons = ($charge_early + $charge_person + $charge_bed + $charge_amenities->total) - $payment_addons->amount;

      $amount = $this->loopPay($amount, 'room', $payable_room, $room['booked_room_id']);
      $amount = $this->loopPay($amount, 'restaurant', $payable_restaurant, $room['booked_room_id']);
      $amount = $this->loopPay($amount, 'coffeeshop', $payable_coffeeshop, $room['booked_room_id']);
      $amount = $this->loopPay($amount, 'addons', $payable_addons, $room['booked_room_id']);
    }
    return $amount;
  }

  function pay($payment_for, $amount, $booked_room_id) {
    $room = $this->get_model->getBookedRoomById($booked_room_id);
    $room = $room->room_number . ' ' . $room->room_type_abbr;
    $formatted_amount = number_format($amount);
    $option = strtolower($_POST['payment_option']);
    $log = "<b>{$_POST['booking_number']}</b> → Added <b>{$payment_for} payment</b> to <b>{$room}</b> using <b>{$option}</b> amounting ₱<b>{$formatted_amount}</b>";

    if ($_POST['payment_option'] == 'Cash') {
      $_POST['payment_details'] = '';
    } else if ($_POST['payment_option'] == 'Card') {
      $_POST['payment_details'] = $_POST['card_number'];
    } else if ($_POST['payment_option'] == 'Check') {
      $_POST['payment_details'] = "{$_POST['check_name']}|{$_POST['check_number']}|{$_POST['check_branch']}|{$_POST['check_date']}";
    } else if ($_POST['payment_option'] == 'Bank Transfer') {
      $_POST['payment_details'] = "{$_POST['bank_name']}|{$_POST['bank_number']}|{$_POST['bank_date']}";
    }

    $this->insert_model->addPayment($payment_for, $amount, $booked_room_id);
    $this->insert_model->addBookingLog($log);
    $this->insert_model->log($log);
  }

  function loopPay($amount, $payment_for, $payable, $booked_room_id) {
    $amount_payable = $amount < $payable ? $amount :  $payable;
    if ($amount_payable) {
      $this->pay($payment_for, $amount_payable, $booked_room_id);
      $amount -= $amount_payable;
    }
    return $amount;
  }

  function addPayment() {
    if ($_POST['booked_room_id'] == 'All Rooms') {
      $data['booking'] = $this->get_model->getBookingByBookingNumber($_POST['booking_number']);
      $data['booked_rooms'] = $this->get_model->getBookedRooms($data['booking']->booking_id);
      $amount = $_POST['amount'];
      foreach ($data['booked_rooms'] as $room) {
        $amount = $this->processPayment($room, $amount);
      }
    } else {
      if ($_POST['payment_for'] == 'All Types') {
        $room = $this->get_model->getBookedRoomById($_POST['booked_room_id']);
        $room = json_decode(json_encode($room), true);
        $amount = $_POST['amount'];
        $this->processPayment($room, $amount);
      } else {
        $this->pay($_POST['payment_for'], $_POST['amount'], $_POST['booked_room_id']);
      }
    }

    $this->session->set_flashdata('success', 'Payment successfully added!');
    $this->redirect();
  }

  function addRefund() {
    $room = $this->get_model->getBookedRoomById($_POST['booked_room_id']);
    $room = $room->room_number . ' ' . $room->room_type_abbr;
    $refund = number_format($_POST['booking_refund']);
    $log = "<b>{$_POST['booking_number']}</b> → Added refund amount of ₱<b>{$refund}</b> to <b>{$room}</b> with a reason of <b>{$_POST['booking_refund_reason']}</b>";
    $this->insert_model->addBookingLog($log);
    $this->insert_model->log($log);
    $this->insert_model->addRefund();
    $this->session->set_flashdata('success', 'Refund successfully added!');
    $this->redirect();
  }

  function completeOrder($booking_id, $booking_number) {
    $log = "<b>{$booking_number}</b> → Successfully completed order!";
    $_POST['booking_id'] = $booking_id;
    $booked_rooms = $this->get_model->getBookedRooms($booking_id, [0]);

    foreach ($booked_rooms as $row) {
      $_POST['process_reason'] = 'Complete Order';
      $this->update_model->processRoom($row['booked_room_id'], 2);
    }
    $this->insert_model->addBookingLog($log);
    $this->insert_model->log($log);
    $this->update_model->updateReservationStatus(-1, $booking_id);
    $this->session->set_flashdata('success', 'Order successfully completed!');
    $this->redirect();
  }

  function removeExtra($column, $booked_room_id) {
    $booked_room = $this->get_model->getBookedRoom($booked_room_id);
    $type = str_replace('extra_', '', $column) . '(s)';
    $extra = $column == 'extra_bed' ? $booked_room->extra_bed : $booked_room->extra_person;
    $log = "<b>{$booked_room->room_number} {$booked_room->room_type_abbr}</b> → Removed <b>{$extra} extra {$type}</b>";
    $_POST['booking_id'] = $booked_room->booking_id;
    $this->insert_model->addBookingLog($log);
    $this->insert_model->log($log);
    $this->update_model->removeExtra($column, $booked_room_id);
    $this->session->set_flashdata('success', 'Extra ' . str_replace('extra_', '', $column) . ' successfully removed!');
    $this->redirect();
  }

  function removeCharge($table, $charge_id) {
    $charge = $this->get_model->getChargeByTable($charge_id, $table);
    $booked_room = $this->get_model->getBookedRoom($charge->booked_room_id);
    if ($table == 'charges_food') {
      $type = strtolower($charge->charge_type);
      $amount = number_format($charge->charges_food_amount);
      $s = $charge->charges_food_quantity == 1 ? '' : 's';
      $log = "<b>{$booked_room->room_number} {$booked_room->room_type_abbr}</b> → Removed <b>{$type}</b> charge: Ref. <b>{$charge->reference} {$charge->particulars} {$charge->charges_food_quantity}</b> pc{$s} for ₱<b>{$amount}</b> each";
    } else {
      $amount = number_format($charge->charge_amount);
      $log = "<b>{$booked_room->room_number} {$booked_room->room_type_abbr}</b> → Removed <b>{$charge->charge_quantity}</b> <b>{$charge->category}</b> - <b>{$charge->charge}</b> amounting ₱<b>{$amount}</b> each";
    }
    $_POST['booking_id'] = $booked_room->booking_id;
    $this->insert_model->addBookingLog($log);
    $this->insert_model->log($log);
    $this->delete_model->removeCharge($table, $charge_id);
    $this->session->set_flashdata('success', 'Charge successfully removed!');
    $this->redirect();
  }

  function updateOccupant() {
    $booking_number = 'HDF' . str_pad($_POST['booking_id'], 5, '0', STR_PAD_LEFT);
    $occupant = "{$_POST['guest']} / {$_POST['contact']} / {$_POST['email']}";
    $this->update_model->updateOccupant($occupant);
    $booked_room = $this->get_model->getBookedRoom($_POST['booked_room_id']);
    $log = "<b>{$booking_number}</b> → <b>{$booked_room->room_number} {$booked_room->room_type_abbr}</b> → Set <b>{$_POST['guest']}</b> / {$_POST['contact']} / {$_POST['email']} as occupant";
    $this->insert_model->addBookingLog($log);
    $this->insert_model->log($log);
    $this->session->set_flashdata('success', 'Occupant successfully updated!');
    $this->redirect();
  }

  function updateNotes() {
    $this->update_model->updateNotes();
    $booking_number = 'HDF' . str_pad($_POST['booking_id'], 5, '0', STR_PAD_LEFT);
    $log = "<b>{$booking_number}</b> → Updated notes to <b>{$_POST['remarks']}</b>";
    $this->insert_model->addBookingLog($log);
    $this->insert_model->log($log);
    $this->session->set_flashdata('success', 'Notes successfully updated!');
    $this->redirect();
  }

  function updateRequest() {
    $this->update_model->updateRequest();
    $booking_number = 'HDF' . str_pad($_POST['booking_id'], 5, '0', STR_PAD_LEFT);
    $log = "<b>{$booking_number}</b> → Updated special request(s) to <b>{$_POST['request']}</b>";
    $this->insert_model->addBookingLog($log);
    $this->insert_model->log($log);
    $this->session->set_flashdata('success', 'Special Request(s) / allergence  successfully updated!');
    $this->redirect();
  }

  function deletePayment($booking_payment_id) {
    $payment = $this->get_model->getPaymentById($booking_payment_id);
    $amount = number_format($payment->amount);
    $booking_number = 'HDF' . str_pad($payment->booking_id, 5, '0', STR_PAD_LEFT);
    $option = strtolower($payment->payment_option);
    $log = "<b>{$booking_number}</b> → Removed <b>{$option}</b> payment amounting ₱<b>{$amount}</b>";
    $_POST['booking_id'] = $payment->booking_id;
    $this->insert_model->addBookingLog($log);
    $this->insert_model->log($log);
    if ($payment->payment_option == 'Cash') {
      $this->insert_model->addCash($amount, TRUE);
    }
    $this->delete_model->deletePayment($booking_payment_id);
    $this->session->set_flashdata('success', 'Payment successfully removed!');
    $this->redirect();
  }

  function deleteRefund($booking_refund_id) {
    $refund = $this->get_model->getRefundById($booking_refund_id);
    $amount = number_format($refund->booking_refund);
    $booking_number = 'HDF' . str_pad($refund->booking_id, 5, '0', STR_PAD_LEFT);
    $option = strtolower($refund->payment_option);
    $log = "<b>{$booking_number}</b> → Removed <b>{$option}</b> payment amounting ₱<b>{$amount}</b>";
    $_POST['booking_id'] = $refund->booking_id;
    $this->insert_model->addBookingLog($log);
    $this->insert_model->log($log);
    $this->delete_model->deleteRefund($booking_refund_id);
    $this->session->set_flashdata('success', 'Refund successfully removed!');
    $this->redirect();
  }

  function updateRoomStatus() {
    $room = $this->get_model->getRoom($_POST['room_id']);
    $old_status = $this->get_model->getRoomStatuses($room->room_status_id);
    $room_status = $this->get_model->getRoomStatuses($_POST['room_status_id']);
    $booking_number = 'HDF' . str_pad($room->booking_id, 5, '0', STR_PAD_LEFT);
    $this->update_model->updateRoomStatus();
    $this->insert_model->log("Updated room status of <b>{$booking_number}</b> → <b>{$room->room_number} {$room->room_type_abbr}</b> from <b>{$old_status->description}</b> to <b>{$room_status->description}</b>", 4);
    $this->session->set_flashdata('success', 'Room status successfully updated!');
    $this->redirect();
  }

  function remit() {
    $date = date('Y-m-d');
    $this->insert_model->remit();
    $this->insert_model->log("Remitted the daily collection for <b>{$date}</b>", 2);
    $this->session->set_flashdata('success', 'Daily collection successfully remitted!');
    $this->redirect();
  }

  function getPaymentsByDate($date) {
    $payments = $this->get_model->getCustomPaymentsByDate($date);
    echo json_encode($payments);
  }

  function getSalesByDate($date) {
    $sales = $this->get_model->getSalesByDate($date);
    echo json_encode($sales);
  }

  function getExpensesByDate($date) {
    $expenses = $this->get_model->getExpensesByDate($date);
    echo json_encode($expenses);
  }

  function getCollectablesByDate($date) {
    $collectables = $this->get_model->getCollectablesByDate($date);
    echo json_encode($collectables);
  }

  function addSales() {
    $this->insert_model->addSales();
    $this->insert_model->log("{$_POST['sales_type']} sales added on <b>{$_POST['sales_date']}</b> amounting <b>{$_POST['sales_amount']}</b>", 2);
    $this->session->set_flashdata('success', 'Sales successfully added!');
    $this->redirect();
  }

  function addCollectable() {
    $this->insert_model->addCollectable();
    $this->insert_model->log("{$_POST['collectable_type']} collectable added on <b>{$_POST['collectable_date']}</b> amounting <b>{$_POST['collectable_amount']}</b>", 2);
    $this->session->set_flashdata('success', 'Collectable successfully added!');
    $this->redirect();
  }

  function addExpense() {
    $this->insert_model->addExpense();
    $this->insert_model->log("{$_POST['expense_type']} expense added on <b>{$_POST['expense_date']}</b> amounting <b>{$_POST['expense_amount']}</b>", 2);
    $this->session->set_flashdata('success', 'Expense successfully added!');
    $this->redirect();
  }

  function chargeTo() {
    $this->update_model->chargeTo($_POST['guest_id']);
    $guest = $this->get_model->getGuest($_POST['guest_id']);
    $log = "<b>{$_POST['booking_number']}</b> → Charged this booking to <b>{$guest->first_name} {$guest->middle_name} {$guest->last_name} {$guest->suffix}</b>";
    $this->insert_model->log($log, 4);
    $this->insert_model->addBookingLog($log);
    $this->session->set_flashdata('success', "Booking successfully charged to {$guest->first_name} {$guest->middle_name} {$guest->last_name} {$guest->suffix}!");
    $this->redirect();
  }

  function getAllBookedRooms() {
    $all = $this->get_model->getAllBookedRooms();
    foreach ($all as $row) {
      if ($row['check_in'] || $row['check_out']) {
        $data = [
          'c_in' => $this->toDashedDate($row['check_in']),
          'c_out' => $this->toDashedDate($row['check_out']),
        ];
        $this->update_model->updateBookedRoomDates($row['booked_room_id'], $data);
      }
    }
  }

  function getGuests() {
    $guests = $this->get_model->getGuests();
    echo json_encode($guests);
  }

  function getAdvancePayments($booking_id) {
    $payments = $this->get_model->getPayments($booking_id);
    echo json_encode($payments);
  }
}
