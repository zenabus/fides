<!--
=========================================================
Paper Dashboard 2 PRO - v2.0.1
=========================================================

Product Page: https://www.creative-tim.com/product/paper-dashboard-2-pro
Copyright 2019 Creative Tim (https://www.creative-tim.com)

Coded by Creative Tim

=========================================================

The above copyright notice and this permission notice shall be included in all copies or substantial portions of the Software. -->

<?php

if ($this->session->userdata('connect') == true);
# code...
$sess = $this->session->userdata('username');

if (!$this->session->userdata('connect') == true) {
  redirect('user');
}

?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8" />
  <link rel="icon" type="jpeg" href="<?= base_url('assets/img/logo.jpg') ?>">
  <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />
  <title>
    Hotel de Fides | iHotelier by WSM IT Services
  </title>
  <meta content='width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0, shrink-to-fit=no' name='viewport' />

  <!--     Fonts and icons     -->
  <link href="https://fonts.googleapis.com/css?family=Montserrat:400,700,200" rel="stylesheet" />
  <link href="https://maxcdn.bootstrapcdn.com/font-awesome/latest/css/font-awesome.min.css" rel="stylesheet">
  <!-- CSS Files -->
  <link href="<?php echo base_url() ?>assets/css/bootstrap.min.css" rel="stylesheet" />
  <link href="<?php echo base_url() ?>assets/css/paper-dashboard.css?v=2.0.1" rel="stylesheet" />
  <!-- CSS Just for demo purpose, don't include it in your project -->
  <link href="<?php echo base_url() ?>assets/demo/demo.css" rel="stylesheet" />


  <script src="<?php echo base_url() ?>assets/js/core/jquery.min.js"></script>

  </script>
  <script src="<?php echo base_url() ?>assets/demo/demo.js"></script>


</head>

<body class="">
  <div class="wrapper ">
    <div class="sidebar" data-color="brown" data-active-color="danger">
      <!--
        Tip 1: You can change the color of the sidebar using: data-color="blue | green | orange | red | yellow"
    -->

      <div class="sidebar-wrapper">
        <div class="user">
          <div class="photo">
            <img src="<?php echo base_url() ?>uploaded_files/<?php echo $get_user[0]['image_source'] ?>" />
          </div>
          <div class="info">
            <a data-toggle="collapse" href="#collapseExample" class="collapsed">
              <span>
                <?php echo $sess ?>
                <b class="caret"></b>
              </span>
            </a>
            <div class="clearfix"></div>
            <div class="collapse" id="collapseExample">
              <ul class="nav">

                <li class="">
                  <a href="<?php echo base_url() ?>index.php/main/RestaurantProfile">
                    <span class="sidebar-mini-icon">AD</span>
                    <span class="sidebar-normal">Account Details</span>
                  </a>
                </li>
                <li class="">
                  <a href="<?php echo base_url() ?>index.php/user/destroy">
                    <span class="sidebar-mini-icon">SO</span>
                    <span class="sidebar-normal">Sign out</span>
                  </a>
                </li>

              </ul>
            </div>
          </div>
        </div>

        <ul class="nav">
          <li>
            <a href="<?php echo base_url() ?>index.php/main/RestaurantDashboard">
              <i class="fa fa-home"></i>
              <p>Dashboard</p>
            </a>
          </li>

          <li>
            <a href="<?php echo base_url() ?>index.php/main/PerTable">
              <!-- <i class="fa fa-coffee"></i> -->
              <i class="fa fa-table"></i>
              <p>Tables</p>
            </a>
          </li>

          <li>
            <a href="<?php echo base_url() ?>index.php/main/process">
              <i class="fa fa-briefcase"></i>
              <p>Walk-in</p>
            </a>
          </li>

          <li>
            <a href="<?php echo base_url() ?>index.php/main/restaurantTransactions">
              <i class="fa fa-tasks"></i>
              <p>Transactions</p>
            </a>
          </li>

          <li>
            <a href="<?php echo base_url() ?>index.php/main/restauarantReports">
              <i class="fa fa-list-alt"></i>
              <p>Reports</p>
            </a>
          </li>





        </ul>
        </li>
        <!-- <li>
            <a href="<?php //echo base_url() 
                      ?>index.php/main/checkForm">
              <i class="nc-icon nc-chart-bar-32"></i>
              <p>Form</p>
            </a>
          </li> -->

        </li>
        </ul>
      </div>
    </div>
    <div class="main-panel">
      <!-- Navbar -->
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
          <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navigation" aria-controls="navigation-index" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-bar navbar-kebab"></span>
            <span class="navbar-toggler-bar navbar-kebab"></span>
            <span class="navbar-toggler-bar navbar-kebab"></span>
          </button>
          <div class="collapse navbar-collapse justify-content-end" id="navigation">

            <ul class="navbar-nav">

              <li class="nav-item btn-rotate dropdown">
                <!-- <a class="nav-link dropdown-toggle" href="" id="navbarDropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                  <i class="nc-icon nc-bell-55"></i>
                  <p>
                    <span class="d-lg-none d-md-block">Some Actions</span>
                  </p>
                </a> -->
                <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdownMenuLink">
                  <?php foreach ($notif as $data) {
                    # code...
                  ?>
                    <a class="dropdown-item" href="<?php echo base_url() ?><?php echo $data['redirection'] ?>"><?php echo $data['content'] ?></a>
                  <?php } ?>
                  <a class="dropdown-item" href="#">
                    <center> View all</center>
                  </a>

                </div>
              </li>

              <li class="nav-item dropdown">
                <a href="#paper-kit" class="nav-link" data-toggle="dropdown" width="30" height="30" aria-expanded="false">
                  <div class="profile-photo-small btn-rotate">
                    <i class="nc-icon nc-settings-gear-65"></i>
                  </div>
                </a>
                <ul class="dropdown-menu dropdown-menu-right dropdown-default">
                  <a class="dropdown-item" href="<?php echo base_url() ?>index.php/main/RestaurantProfile">Account Details</a>
                  <li class="divider"></li>
                  <a class="dropdown-item" href="<?php echo base_url() ?>index.php/user/destroy">Sign out</a>
                </ul>
              </li>
            </ul>
          </div>
        </div>
      </nav>
      <!-- End Navbar -->
      <!-- <div class="panel-header">

  <canvas id="bigDashboardChart"></canvas>


</div> -->