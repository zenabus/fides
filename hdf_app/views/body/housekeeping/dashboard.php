<?php if (validation_errors()) : ?>

  <script>
    $(document).ready(function() {

      demo.showNotification_error('top', 'right');

    });
  </script>



<?php endif; ?>



<?php if ($this->session->flashdata('success')) : ?>

  <script>
    $(document).ready(function() {

      demo.showNotification('top', 'right');

    });
  </script>



<?php endif; ?>

<div class="content pb-0">

  <h5><b>DASHBOARD</b></h5>

  <div class="row">

    <div class="col-lg-3 col-md-6 col-sm-6">

      <div class="card card-stats">

        <div class="card-body ">

          <div class="row">

            <div class="col-5 col-md-4">

              <div class="icon-big text-center icon-warning">

                <i class="fa fa-tags text-primary"></i>

              </div>

            </div>

            <div class="col-7 col-md-8">

              <div class="numbers">

                <p class="card-category">Block</p>

                <p class="card-title"><?php echo $count_room_types[0]['total'] ?>

                <p>

              </div>

            </div>

          </div>

        </div>

        <div class="card-footer ">

          <hr>

          <div class="stats">

            <i class="fa fa-clock-o"></i> <?php echo date('m-y-d m:i:h') ?>

          </div>

        </div>

      </div>

    </div>

    <div class="col-lg-3 col-md-6 col-sm-6">

      <div class="card card-stats">

        <div class="card-body ">

          <div class="row">

            <div class="col-5 col-md-4">

              <div class="icon-big text-center icon-warning">

                <i class="fa fa-bed text-info"></i>

              </div>

            </div>

            <div class="col-7 col-md-8">

              <div class="numbers">

                <p class="card-category">Ready</p>

                <p class="card-title"><?php echo $count_rooms[0]['total'] ?>

                <p>

              </div>

            </div>

          </div>

        </div>

        <div class="card-footer ">

          <hr>

          <div class="stats">

            <i class="fa fa-clock-o"></i> <?php echo date('m-y-d m:i:h') ?>

          </div>

        </div>

      </div>

    </div>

    <div class="col-lg-3 col-md-6 col-sm-6">

      <div class="card card-stats">

        <div class="card-body ">

          <div class="row">

            <div class="col-5 col-md-4">

              <div class="icon-big text-center icon-warning">

                <i class="fa fa-thumbs-o-up text-primary"></i>

              </div>

            </div>

            <div class="col-7 col-md-8">

              <div class="numbers">

                <p class="card-category">Cleaning</p>

                <p class="card-title"><?php echo $count_ar[0]['total'] ?>

                <p>

              </div>

            </div>

          </div>

        </div>

        <div class="card-footer ">

          <hr>

          <div class="stats">

            <i class="fa fa-clock-o"></i> <?php echo date('m-y-d m:i:h') ?>

          </div>

        </div>

      </div>

    </div>

    <div class="col-lg-3 col-md-6 col-sm-6">

      <div class="card card-stats">

        <div class="card-body ">

          <div class="row">

            <div class="col-5 col-md-4">

              <div class="icon-big text-center icon-warning">

                <i class="fa fa-thumbs-o-down text-danger"></i>

              </div>

            </div>

            <div class="col-7 col-md-8">

              <div class="numbers">

                <p class="card-category">Maintenance</p>

                <p class="card-title"><?php echo $count_ur[0]['total'] ?>

                <p>

              </div>

            </div>

          </div>

        </div>

        <div class="card-footer ">

          <hr>

          <div class="stats">

            <i class="fa fa-clock-o"></i> <?php echo date('m-y-d m:i:h') ?>

          </div>

        </div>

      </div>

    </div>

  </div>

  <div class="content pb-0">

    <div class="col-md-10 mr-auto ml-auto">


    </div>







  </div>



  <!-- end row -->















  <script>
    $(document).ready(function() {

      // Initialise the wizard

      demo.initWizard();

      setTimeout(function() {

        $('.card.card-wizard').addClass('active');

      }, 600);

    });
  </script>