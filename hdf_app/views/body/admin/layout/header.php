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

  <script src="<?php echo base_url() ?>assets/demo/demo.js"></script>



  <script src='<?= base_url('assets/jquery-3.0.0.js') ?>' type='text/javascript'></script>

  <script src='<?= base_url('assets/daboy_script.js') ?>' type='text/javascript'></script>

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

            <img src="<?php echo base_url() ?>uploaded_files/" />

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

                  <a href="<?php echo base_url() ?>index.php/admin/profile">

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

            <a href="<?php echo base_url() ?>index.php/admin/">

              <i class="fa fa-home"></i>

              <p>Dashboard</p>

            </a>

          </li>

          <li>
            <a target="blank2" href="<?php echo base_url('index.php/main/roomCalendar') ?>">
              <i class="fa fa-calendar "></i>
              <p>Room Calendar</p>
            </a>
          </li>
          <li>
          <li>
            <a href="<?php echo base_url() ?>index.php/main/listOfCheckedInAdmin">
              <i class="fa fa-sign-in"></i>
              <p>Bookings</p>
            </a>
          </li>

          <li>
            <a data-toggle="collapse" href="#formsExamplesReservations">
              <i class="fa fa-check-square-o"></i>
              <p>Reservations
                <b class="caret"></b>
              </p>
            </a>
            <div class="collapse " id="formsExamplesReservations">
              <ul class="nav">
                <li>
                  <a href="<?php echo base_url() ?>index.php/main/reservations/online">
                    <span class="sidebar-mini-icon">O</span>
                    <span class="sidebar-normal">Online</span>
                  </a>
                </li>
                <li>
                  <a href="<?php echo base_url() ?>index.php/main/reservations/walkin">
                    <span class="sidebar-mini-icon">WI</span>
                    <span class="sidebar-normal">Walk-In</span>
                  </a>
                </li>
              </ul>
            </div>
          </li>




          <!-- <li>
            <a href="<?php //echo base_url() 
                      ?>index.php/main/lockTransaction">
              <i class="fa fa-lock"></i>
              <p>Locked Booking</p>
            </a>
          </li> -->
          <!-- <li>

            <a href="<?php //echo base_url() 
                      ?>index.php/admin/cancelBOoking">

              <i class="fa fa-tasks"></i>

              <p>Cancel Booking</p>

            </a>

          </li> -->

          <li>

            <a data-toggle="collapse" href="#formsExamples">

              <i class="fa fa-bed"></i>

              <p>

                Rooms

                <b class="caret"></b>

              </p>

            </a>

            <div class="collapse " id="formsExamples">

              <ul class="nav">

                <li>

                  <a href="<?php echo base_url() ?>index.php/admin/roomTypes">

                    <span class="sidebar-mini-icon">T</span>

                    <span class="sidebar-normal">Type</span>

                  </a>

                </li>

                <li>

                  <a href="<?php echo base_url() ?>index.php/admin/rooms">

                    <span class="sidebar-mini-icon">L</span>

                    <span class="sidebar-normal">List</span>

                  </a>

                </li>



              </ul>

            </div>

          </li>



          <li>

            <a href="<?php echo base_url() ?>index.php/admin/createTables">

              <i class="fa fa-table"></i>

              <p>Tables</p>

            </a>

            <!-- <a data-toggle="collapse" href="#formsExamples1">

              <i class="fa fa-table"></i>
              <i class="fa fa-coffee"></i>

              <p>

                Tables

                <b class="caret"></b>

              </p>

            </a> -->

            <div class="collapse " id="formsExamples1">

              <ul class="nav">

                <!-- <li>

                  <a href="<?php echo base_url() ?>index.php/admin/coffeeshopcreateTables">

                    <span class="sidebar-mini-icon">CS</span>

                    <span class="sidebar-normal"> Coffee Shop</span>

                  </a>

                </li> -->

                <li>

                  <a href="<?php echo base_url() ?>index.php/admin/createTables">

                    <span class="sidebar-mini-icon">R</span>

                    <span class="sidebar-normal"> Restaurant </span>

                  </a>

                </li>



              </ul>

            </div>

          </li>



          <li>

            <a data-toggle="collapse" href="#formsExamples2">

              <i class="fa fa-dollar"></i>

              <p>

                Rates

                <b class="caret"></b>

              </p>

            </a>

            <div class="collapse " id="formsExamples2">

              <ul class="nav">

                <li>

                  <a href="<?php echo base_url() ?>index.php/admin/pricing">

                    <span class="sidebar-mini-icon">R</span>

                    <span class="sidebar-normal"> Rooms</span>

                  </a>

                </li>

                <li>

                  <a href="<?php echo base_url() ?>index.php/admin/CoffeeProduct">

                    <span class="sidebar-mini-icon">CS</span>

                    <span class="sidebar-normal"> Coffee Shop</span>

                  </a>

                </li>

                <li>

                  <a href="<?php echo base_url() ?>index.php/admin/resProduct">

                    <span class="sidebar-mini-icon">R</span>

                    <span class="sidebar-normal"> Restaurant </span>

                  </a>

                </li>



              </ul>

            </div>

          </li>









          <li>

            <a data-toggle="collapse" href="#formsExamples5">

              <i class="fa fa-calendar-check-o"></i>

              <p>

                Logs

                <b class="caret"></b>

              </p>

            </a>

            <div class="collapse " id="formsExamples5">

              <ul class="nav">

                <li>

                  <a href="<?php echo base_url() ?>index.php/admin/userlogs">

                    <span class="sidebar-mini-icon">UL</span>

                    <span class="sidebar-normal"> User</span>

                  </a>

                </li>

                <li>

                  <a href="<?php echo base_url() ?>index.php/admin/activitylogs">

                    <span class="sidebar-mini-icon">AL</span>

                    <span class="sidebar-normal"> Activty</span>

                  </a>

                </li>



              </ul>

            </div>

          </li>



          <li>
            <a data-toggle="collapse" href="#lock">
              <i class="fa fa-check-square-o"></i>
              <p>Lock
                <b class="caret"></b>
              </p>
            </a>
            <div class="collapse " id="lock">
              <ul class="nav">
                <li>
                  <a href="<?php echo base_url() ?>index.php/main/lockTransaction">
                    <span class="sidebar-mini-icon">O</span>
                    <span class="sidebar-normal">Locked Booking</span>
                  </a>
                </li>
                <li>
                  <a href="<?php echo base_url() ?>index.php/admin/cancelBOoking">
                    <span class="sidebar-mini-icon">WI</span>
                    <span class="sidebar-normal">Cancel Booking</span>
                  </a>
                </li>
              </ul>
            </div>
          </li>



          <li>

            <a href="<?php echo base_url() ?>index.php/admin/deduction">

              <i class="fa fa-percent"></i>

              <p>Discounts</p>

            </a>

          </li>

          <li>

            <a href="<?php echo base_url() ?>index.php/admin/createUser">

              <i class="fa fa-user"></i>

              <p>Users</p>

            </a>

          </li>




          <li>

            <a href="<?php echo base_url() ?>index.php/admin/transactions">

              <i class="fa fa-tasks"></i>

              <p>Transactions</p>

            </a>

          </li>


          <li>
            <a href="<?php echo base_url() ?>index.php/main/guests">
              <i class="fa fa-users"></i>
              <p>Guest Lists</p>
            </a>
          </li>




          <li>

            <a href="<?php echo base_url() ?>index.php/admin/reports">

              <i class="fa fa-list-alt"></i>

              <p>Reports</p>

            </a>

          </li>

          <!--  <li>

            <a href="<?php //echo base_url() 
                      ?>index.php/admin/resProduct">

              <i class="nc-icon nc-pin-3"></i>

              <p>Product</p>

            </a>

          </li> -->









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

                <a class="nav-link dropdown-toggle" href="" id="navbarDropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">

                  <i class="nc-icon nc-bell-55"></i>

                  <!-- <p>

                    <span class="d-lg-none d-md-block">Some Actions</span>

                  </p> -->

                </a>

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
                  <a class="dropdown-item" href="<?php echo base_url() ?>index.php/admin/Profile">Account Details</a>
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