<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8" />
  <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />
  <title> <?= TITLE ?> | iHotelier by WSM IT Services </title>
  <meta content='width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0, shrink-to-fit=no' name='viewport' />
  <!-- Fonts & Icons -->
  <link rel="icon" type="jpeg" href="<?= base_url('assets/img/logo.jpg') ?>">
  <link href="https://fonts.googleapis.com/css?family=Montserrat:400,700,200" rel="stylesheet" />
  <link href="https://maxcdn.bootstrapcdn.com/font-awesome/latest/css/font-awesome.min.css" rel="stylesheet">
  <!-- CSS Files -->
  <link href="<?= base_url() ?>assets/css/bootstrap.min.css" rel="stylesheet" />
  <link href="<?= base_url() ?>assets/css/paper-dashboard.css?v=2.0.1" rel="stylesheet" />
  <style type="text/css">
    .full-page>.content {
      padding-top: 21vh;
    }

    .logo {
      width: 100%;
    }

    .alert {
      z-index: 9999;
      left: 50%;
      transform: translate(-50%, 0);
      top: 32px;
      min-width: 400px;
    }
  </style>
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

<body class="login-page">
  <nav class="navbar navbar-expand-lg navbar-absolute fixed-top navbar-transparent">
    <div class="container">
      <div class="navbar-wrapper">
        <a class="navbar-brand text-center" href="javascript:"><?= TITLE ?></a>
      </div>
      <div class="collapse navbar-collapse justify-content-end" id="navigation">
        <ul class="navbar-nav">
          <li class="nav-item">
            <a href="https://hoteldefides.com/" class="nav-link" target="_blank">
              <i class="fa fa-globe"></i>
              Website
            </a>
          </li>
          <li class="nav-item">
            <a href="https://booking.hoteldefides.com/" class="nav-link" target="_blank">
              <i class="nc-icon nc-book-bookmark"></i>
              Booking
            </a>
          </li>
          <li class="nav-item active">
            <a href="https://www.facebook.com/HoteldeFides" class="nav-link" target="_blank">
              <i class="fa fa-facebook"></i>
              Facebook
            </a>
          </li>
        </ul>
      </div>
    </div>
  </nav>
  <div class="wrapper wrapper-full-page ">
    <div class="full-page section-image" filter-color="black" data-image="<?= base_url() ?>assets/img/bg/fabio-mangione.jpg">
      <div class="content pb-0">
        <div class="container">
          <div class="col-lg-4 col-md-6 ml-auto mr-auto">
            <?= form_open('user/login') ?>
            <div class="card card-login">
              <div class="card-header ">
                <div class="card-header text-center mb-3">
                  <img src="<?= base_url('assets/img/hdf_logo_brown.png') ?>" class="img-fluid logo">
                </div>
              </div>
              <div class="card-body p-3">
                <div class="input-group">
                  <div class="input-group-prepend">
                    <span class="input-group-text">
                      <i class="nc-icon nc-single-02"></i>
                    </span>
                  </div>
                  <input type="text" class="form-control" name="username" placeholder="Username" required>
                </div>
                <div class="input-group mb-3">
                  <div class="input-group-prepend">
                    <span class="input-group-text">
                      <i class="nc-icon nc-key-25"></i>
                    </span>
                  </div>
                  <input type="password" placeholder="Password" name="password" class="form-control" required>
                </div>
              </div>
              <div class="card-footer px-3 py-1">
                <input type="submit" class="btn btn-block mb-0" value="Login">
              </div>
            </div>
            <div class="row">
              <div class="col-md-12">
                <p class="text-center text-light">&copy; 2020 - <?= date('Y') ?> &nbsp;iHotelier&nbsp; | &nbsp;All Rights Reserved
                </p>
                <p class="text-center text-light">Made with <i class="fa fa-heart heart"></i> by <a href="https://wsmitservices.com/" class="text-light" target="blank">WSM IT Services</a></p>
              </div>
            </div>
            <?= form_close() ?>
          </div>
        </div>
      </div>
    </div>
  </div>
  <script src="<?= base_url() ?>assets/js/core/jquery.min.js"></script>
  <script>
    $(document).ready(function() {
      const page = $('.full-page');
      const image_src = page.data('image');

      if (image_src !== undefined) {
        page.append('<div class="full-page-background" style="background-image: url(' + image_src + ') "/>');
      }

      setTimeout(() => {
        $('.alert').fadeOut();
      }, 8000);
    });

    $('.close').click(function() {
      $('.alert').fadeOut();
    });

    $('.form-control').focus(function() {
      $(this).prev().children().css('border-color', '#9a9a9a');
    });

    $('.form-control').focusout(function() {
      $(this).prev().children().css('border-color', '#ddd');
    });
  </script>
</body>

</html>