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
    $this->email->from('hoteldefides@gmail.com', 'The Hotel de Fides');
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

  function uploadImage($file, $folder) {
    if (isset($_FILES[$file]['name']) && $_FILES[$file]['name'] != "") {
      $name = $_FILES[$file]['name'];
      $exname = explode('.', $name);
      $ext = end($exname);
      $location = 'assets/img/' . $folder . '/' . $_FILES[$file]['name'];

      if (file_exists($location)) {
        $i = 0;
        list($base, $exts) = explode('.', $name);
        while (file_exists($location)) {
          $i++;
          $name = $base . $i . '.' . $exts;
          $location = 'assets/img/' . $folder . '/' . $name;
        }
      }

      move_uploaded_file($_FILES[$file]['tmp_name'], $location);
      return $name;
    }
  }

  function unlink($image) {
    if (file_exists($image)) {
      unlink($image);
    }
  }
}
