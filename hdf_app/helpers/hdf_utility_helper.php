<?php
defined('BASEPATH') or exit('No direct script access allowed');

if (!function_exists('datesBetween')) {
  function datesBetween($start, $end, $format = 'm/d/Y') {
    $array = array();
    $interval = new DateInterval('P1D');

    $realEnd = new DateTime($end);
    $realEnd = $realEnd->modify('-1 day');
    $realEnd->add($interval);

    $period = new DatePeriod(new DateTime($start), $interval, $realEnd);

    foreach ($period as $date) {
      $array[] = $date->format($format);
    }

    return $array;
  }
}

if (!function_exists('determinePeriod')) {
  function determinePeriod() {
    $currentTime = date('H:i:s');

    if ($currentTime >= '22:00:00' || $currentTime < '14:00:00') {
      return 'am';
    } else {
      return 'pm';
    }
  }
}
