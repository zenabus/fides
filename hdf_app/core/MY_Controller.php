<?php
defined('BASEPATH') or exit('No direct script access allowed');

class MY_Controller extends CI_Controller {

  public function prompt($message, $type = 0) {
    if ($type) {
      $_SESSION['error'] = $message;
    } else {
      $_SESSION['success'] = $message;
    }
  }

  public function redirect() {
    redirect($_SERVER['HTTP_REFERER']);
  }

  public function dd($data) {
    echo "<pre>";
    print_r(var_dump($data));
    die;
  }

  public function sendMail($email, $message, $subject) {
    $this->load->library('email');

    $config = [
      'protocol' => 'smtp',
      'smtp_host' => 'ssl://smtp.gmail.com',
      'smtp_port' => 465,
      'smtp_user' => 'hoteldefides@gmail.com',
      'smtp_pass' => 'fwzpyxikagivihlk',
      'mailtype' => 'html',
      'charset' => 'utf-8',
      'wordwrap' => TRUE,
    ];

    $this->email->initialize($config);
    $this->email->from('hoteldefides@gmail.com', 'Hotel De Fides');
    $this->email->to($email);
    $this->email->subject($subject);
    $this->email->message($message);
    $this->email->set_newline("\r\n");
    $this->email->send();
    $this->email->print_debugger();
  }

  function toDashedDate($date) {
    [$month, $day, $year] = explode('/', $date);
    return $year . '-' . $month . '-' . $day;
  }

  function getDaysInBetween($check_in, $check_out) {
    $days = [];
    $start = new DateTime($check_in);
    $end = new DateTime($check_out);
    $end = $end->modify('+1 day');

    $interval = new DateInterval('P1D');
    $dates = new DatePeriod($start, $interval, $end);

    foreach ($dates as $date) {
      array_push($days, $date->format("Y-m-d"));
    }

    return $days;
  }

  function removeDuplicate($whole, $part) {
    $unique = [];
    foreach ($whole as $w) {
      if (!in_array($w, $part)) {
        array_push($unique, $w);
      }
    }

    return $unique;
  }
}
