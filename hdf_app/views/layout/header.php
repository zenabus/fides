<?php
if (!$this->session->userdata('connect')) {
  redirect('user');
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8" />
  <link rel="icon" type="jpeg" href="<?= base_url('assets/img/logo.jpg') ?>">
  <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />
  <title><?= TITLE ?> | iHotelier by WSM IT Services</title>
  <meta content='width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0, shrink-to-fit=no' name='viewport' />
  <!--  Fonts and icons -->
  <link href="https://fonts.googleapis.com/css?family=Montserrat:400,700,200" rel="stylesheet" />
  <!-- CSS Files -->
  <link href="<?= base_url() ?>assets/css/bootstrap.min.css" rel="stylesheet" />
  <link href="<?= base_url() ?>assets/css/paper-dashboard.css?v=2.0.1" rel="stylesheet" />

  <!-- CSS Just for demo purpose, don't include it in your project -->
  <link href="<?= base_url() ?>assets/demo/demo.css" rel="stylesheet" />
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-select@1.13.14/dist/css/bootstrap-select.min.css">
  <!-- Scripts -->
  <script src="https://kit.fontawesome.com/3abc918931.js" crossorigin="anonymous"></script>
  <script src="<?= base_url() ?>assets/js/core/jquery.min.js"></script>
  <script src="<?= base_url() ?>assets/js/core/popper.min.js"></script>
  <script src="<?= base_url() ?>assets/js/core/bootstrap.min.js"></script>
  <script src="<?= base_url() ?>assets/js/plugins/moment.min.js"></script>
  <script src="<?= base_url() ?>assets/js/plugins/bootstrap-datetimepicker.js"></script>
  <script src="<?= base_url() ?>assets/js/functions.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap-select@1.13.14/dist/js/bootstrap-select.min.js"></script>

  <style type="text/css">
    .dataTables_paginate {
      float: right;
    }

    .form-check-label,
    .pointer {
      cursor: pointer;
    }

    .action>* {
      padding-left: 8px;
      padding-right: 8px;
    }

    .separator {
      display: flex;
      align-items: center;
      text-align: center;
      color: #9A9A9A;
    }

    .separator::before,
    .separator::after {
      content: '';
      flex: 1;
      border-bottom: 1px solid #dee2e6;
    }

    .separator:not(:empty)::before {
      margin-right: .25em;
    }

    .separator:not(:empty)::after {
      margin-left: .25em;
    }

    .alert {
      z-index: 9999;
      left: 50%;
      transform: translate(-50%, 0);
      top: 32px;
      min-width: 400px;
    }

    small {
      color: #6c757d;
      font-weight: normal !important;
    }

    th {
      white-space: nowrap;
    }

    td {
      vertical-align: baseline !important;
    }

    .table-sm td {
      padding-top: 4px !important;
      padding-bottom: 4px !important;

    }

    .arrow {
      display: none !important
    }

    summary {
      user-select: none;
    }

    .modal,
    .swal2-container {
      z-index: 99999;
    }

    textarea {
      resize: none;
      max-height: unset !important;
    }

    .wsp {
      white-space: pre;
    }

    input::-webkit-outer-spin-button,
    input::-webkit-inner-spin-button {
      -webkit-appearance: none;
      margin: 0;
    }

    input[type=number] {
      -moz-appearance: textfield;
    }

    select {
      font-family: "Helvetica Neue", Arial, sans-serif !important;
    }

    .room[disabled] {
      color: #ccc;
      border-color: #ccc;
    }

    #guest-name {
      text-transform: capitalize;
    }
  </style>

  <script>
    $(document).ready(function() {
      setTimeout(() => {
        $('.alert').fadeOut();
      }, 8000);

      $('.close').click(function() {
        $('.alert').fadeOut();
      });
    });
  </script>
</head>

<?php if ($this->session->flashdata('success') || $this->session->flashdata('error')) : ?>
  <?php $alert = $this->session->flashdata('success') ? 'success' : 'danger'; ?>
  <div class="alert alert-<?= $alert ?> alert-dismissible fade show position-absolute">
    <button type="button" class="close">
      <i class="nc-icon nc-simple-remove"></i>
    </button>
    <div class="d-flex align-items-center">
      <span class="nc-icon nc-bell-55 mr-2"></span>
      <span><?= $this->session->flashdata($alert == 'success' ? 'success' : 'error') ?></span>
    </div>
  </div>
<?php endif; ?>

<body class="">
  <div class="position-absolute bg-white loader" style="height:100%; width:100%;z-index:999999">
    <div class="d-flex justify-content-center align-items-center" style="height: 100%;">
      <div class="text-center">
        <img src="<?= base_url('assets/img/logo.jpg') ?>" alt="logo.jpg" height="128">
        <h3 class="mt-2 mb-0">Hotel de Fides</h3>
        <p class="text-muted">iHotelier by WSM IT Services</p>
      </div>
    </div>
  </div>
  <div class="wrapper ">
    <div class="sidebar" data-color="brown" data-active-color="danger">
      <div class="sidebar-wrapper">
        <div class="user">
          <div class="photo">
            <img src="<?= base_url('assets/img/users/' . $_SESSION['image']) ?>" alt="profile pic" />
          </div>
          <div class="info">
            <a data-toggle="collapse" href="#collapseExample" class="collapsed" aria-expanded="<?= $active == 'account' ? 'true' : 'false' ?>">
              <span>
                <?= $this->session->userdata('name') ?>
                <b class="caret"></b>
              </span>
            </a>
            <div class="clearfix"></div>
            <div class="collapse <?= $active == 'account' ? 'show' : '' ?>" id="collapseExample">
              <ul class="nav">
                <li class="<?= $active == 'account' ? 'active' : '' ?>">
                  <a href="<?= base_url('index.php/main/profile') ?>">
                    <span class="sidebar-mini-icon">AD</span>
                    <span class="sidebar-normal">Account Details</span>
                  </a>
                </li>
                <li>
                  <a href="<?= base_url('index.php/user/destroy') ?>">
                    <span class="sidebar-mini-icon">SO</span>
                    <span class="sidebar-normal">Sign out</span>
                  </a>
                </li>
              </ul>
            </div>
          </div>
        </div>

        <ul class="nav">
          <?php $access = ['Admin', 'Superadmin', 'Front Desk']; ?>
          <?php if (in_array($_SESSION['user_type'], $access)) { ?>
            <li class="<?= $active == 'dashboard' ? 'active' : '' ?>">
              <a href="<?= base_url('index.php/main') ?>">
                <i class="fa fa-home"></i>
                <p>Dashboard</p>
              </a>
            </li>
          <?php } ?>

          <?php $access = ['Admin', 'Superadmin', 'Front Desk']; ?>
          <?php if (in_array($_SESSION['user_type'], $access)) { ?>
            <li class="<?= $active == 'calendar' ? 'active' : '' ?>">
              <a href="<?= base_url('index.php/main/calendar/' . date('Y') . '/' . date('m')) ?>">
                <i class="fa fa-calendar"></i>
                <p>Express Calendar</p>
              </a>
            </li>
          <?php } ?>

          <?php $access = ['Admin', 'Superadmin', 'Front Desk', 'Housekeeping']; ?>
          <?php if (in_array($_SESSION['user_type'], $access)) { ?>
            <li class="<?= $active == 'rooms' ? 'active' : '' ?>">
              <a href="<?= base_url('index.php/main/rooms') ?>">
                <i class="fa fa-bed "></i>
                <p>Rooms</p>
              </a>
            </li>
          <?php } ?>

          <?php $access = ['Admin', 'Superadmin', 'Front Desk']; ?>
          <?php if (in_array($_SESSION['user_type'], $access)) { ?>
            <li class="<?= $active == 'bookings' ? 'active' : '' ?>">
              <a href="<?= base_url('index.php/main/bookings') ?>">
                <i class="fa fa-bookmark"></i>
                <p>Bookings</p>
              </a>
            </li>
          <?php } ?>

          <?php $access = ['Admin', 'Superadmin', 'Front Desk']; ?>
          <?php if (in_array($_SESSION['user_type'], $access)) { ?>
            <li>
              <a data-toggle="collapse" href="#collapseReservation" aria-expanded="<?= $active == 'online' || $active == 'walkin' ? 'true' : 'false' ?>">
                <i class="fa fa-clock"></i>
                <p>Reservations
                  <b class="caret"></b>
                </p>
              </a>
              <div class="collapse  <?= $active == 'online' || $active == 'walkin' ? 'show' : '' ?>" id="collapseReservation">
                <ul class="nav">
                  <li class="<?= $active == 'online' ? 'active' : '' ?>">
                    <a href="<?= base_url('index.php/main/reservations/online') ?>">
                      <span class="sidebar-mini-icon">O</span>
                      <span class="sidebar-normal">Online</span>
                    </a>
                  </li>
                  <li class="<?= $active == 'walkin' ? 'active' : '' ?>">
                    <a href="<?= base_url('index.php/main/reservations/walkin') ?>">
                      <span class="sidebar-mini-icon">WI</span>
                      <span class="sidebar-normal">Walk-In</span>
                    </a>
                  </li>
                </ul>
              </div>
            </li>
          <?php } ?>


          <?php $access = ['Admin', 'Superadmin', 'Front Desk', 'Housekeeping']; ?>
          <?php if (in_array($_SESSION['user_type'], $access)) { ?>
            <li class="<?= $active == 'checkout' ? 'active' : '' ?>">
              <a href="<?= base_url('index.php/main/checkout') ?>">
                <i class="fa fa-calendar-check"></i>
                <p>For Check-out</p>
              </a>
            </li>
          <?php } ?>

          <?php $access = ['Admin', 'Superadmin', 'Front Desk']; ?>
          <?php if (in_array($_SESSION['user_type'], $access)) { ?>
            <li class="<?= $active == 'guests' ? 'active' : '' ?>">
              <a href="<?= base_url('index.php/main/guests') ?>">
                <i class="fa fa-users"></i>
                <p>Guest List</p>
              </a>
            </li>
          <?php } ?>


          <?php $access = ['Admin', 'Superadmin']; ?>
          <?php if (in_array($_SESSION['user_type'], $access)) { ?>
            <li>
              <a data-toggle="collapse" href="#collapseRates" aria-expanded="<?= $active == 'room_rates' || $active == 'discounts' ||  $active == 'charges' ? 'true' : 'false' ?>">
                <i class="fa fa-peso-sign"></i>
                <p>Rates<b class="caret"></b></p>
              </a>
              <div class="collapse  <?= $active == 'room_rates' || $active == 'discounts' ||  $active == 'charges' ? 'show' : '' ?>" id="collapseRates">
                <ul class="nav">
                  <li class="<?= $active == 'room_rates' ? 'active' : '' ?>">
                    <a href="<?= base_url('index.php/admin/roomRates') ?>">
                      <span class="sidebar-mini-icon">RR</span>
                      <span class="sidebar-normal"> Room Rates </span>
                    </a>
                  </li>
                  <li class="<?= $active == 'discounts' ? 'active' : '' ?>">
                    <a href="<?= base_url('index.php/admin/discounts') ?>">
                      <span class="sidebar-mini-icon">D</span>
                      <span class="sidebar-normal"> Discounts </span>
                    </a>
                  </li>
                  <li class="<?= $active == 'charges' ? 'active' : '' ?>">
                    <a href="<?= base_url('index.php/admin/charges') ?>">
                      <span class="sidebar-mini-icon">EC</span>
                      <span class="sidebar-normal"> Extras & Charges </span>
                    </a>
                  </li>
                </ul>
              </div>
            </li>

            <li class="<?= $active == 'users' ? 'active' : '' ?>">
              <a href="<?= base_url('index.php/admin/users') ?>">
                <i class="fa-solid fa-user-group"></i>
                <p>Users</p>
              </a>
            </li>
          <?php } ?>

          <li class="<?= $active == 'logs' ? 'active' : '' ?>">
            <a href="<?= base_url('index.php/main/logs') ?>">
              <i class="fa fa-clipboard-check"></i>
              <p>Logs</p>
            </a>
          </li>

          <?php $access = ['Admin', 'Superadmin', 'Front Desk']; ?>
          <?php if (in_array($_SESSION['user_type'], $access)) { ?>
            <li class="<?= $active == 'dcr' ? 'active' : '' ?>">
              <a href="<?= base_url('index.php/main/dcr') ?>">
                <i class="fa-solid fa-file-invoice-dollar"></i>
                <p>Daily Collection</p>
              </a>
            </li>
          <?php } ?>
        </ul>
      </div>
    </div>
    <div class="main-panel">
      <nav class="navbar navbar-expand-lg navbar-absolute fixed-top navbar-transparent">
        <div class="container-fluid">
          <div class="navbar-wrapper">
            <div class="navbar-minimize">
              <button id="minimizeSidebar" class="btn btn-icon btn-round">
                <i class="nc-icon nc-minimal-right text-center visible-on-sidebar-mini"></i>
                <i class="nc-icon nc-minimal-left text-center visible-on-sidebar-regular"></i>
              </button>
            </div>
            <div class="navbar-toggle">
              <button type="button" class="navbar-toggler">
                <span class="navbar-toggler-bar bar1"></span>
                <span class="navbar-toggler-bar bar2"></span>
                <span class="navbar-toggler-bar bar3"></span>
              </button>
            </div>
          </div>

          <?php if (isset($cash)) { ?>
            <!-- <h3 class="mb-0" data-placement="bottom" title="(Beginning Balance + Total Sales of the day)" rel="tooltip">₱ <?= number_format($cash->cash_amount, 2) ?>
              <?php if ($remitted) { ?>
                <span class="fa fa-check-circle text-success"></span>
              <?php } else { ?>
                <a href="<?= base_url('index.php/main/dcr') ?>"> <span class="fa fa-info-circle text-danger heart"></span></a>
              <?php } ?>
            </h3> -->
          <?php } ?>

          <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navigation" aria-controls="navigation-index" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-bar navbar-kebab"></span>
            <span class="navbar-toggler-bar navbar-kebab"></span>
            <span class="navbar-toggler-bar navbar-kebab"></span>
          </button>
          <div class="collapse navbar-collapse justify-content-end" id="navigation">
            <ul class="navbar-nav">
              <li class="nav-item btn-rotate dropdown">
                <a class="nav-link dropdown-toggle" href="" id="navbarDropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                  <i class="nc-icon nc-bell-55"></i>
                </a>
                <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdownMenuLink">
                  <a class="dropdown-item" href="#">Content</a>
                  <a class="dropdown-item" href="#">View all</a>
                </div>
              </li>

              <li class="nav-item dropdown">
                <a href="#paper-kit" class="nav-link" data-toggle="dropdown" width="30" height="30" aria-expanded="false">
                  <div class="profile-photo-small btn-rotate">
                    <i class="nc-icon nc-settings-gear-65"></i>
                  </div>
                </a>
                <ul class="dropdown-menu dropdown-menu-right dropdown-default">
                  <a class="dropdown-item" href="<?= base_url('index.php/main/profile') ?>">Account Details</a>
                  <li class="divider"></li>
                  <a class="dropdown-item" href="<?= base_url('index.php/user/destroy') ?>">Sign out</a>
                </ul>
              </li>
            </ul>
          </div>
        </div>
      </nav>

      <script>
        $(document).ready(function() {
          setTimeout(() => {
            $('.loader').fadeOut();
          }, 500);
        });
      </script>