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

  <h5><b>DASHBOARD SUPER ADMIN</b></h5>

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

                <p class="card-category">Room Types</p>

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

                <p class="card-category">Rooms</p>

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

                <p class="card-category">Available</p>

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

                <p class="card-category">Unavailable</p>

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



  <!-- end row -->

  <div class="content pb-0">

    <div class="col-md-10 mr-auto ml-auto">

      <!--      Wizard container        -->

      <div class="wizard-container">

        <div class="card card-wizard" data-color="primary" id="wizardProfile">

          <form action="" method="">

            <!--        You can switch " data-color="primary" "  with one of the next bright colors: "green", "orange", "red", "blue"       -->

            <div class="card-header text-center">



              <h5 class="description"></h5>

              <div class="wizard-navigation">

                <ul>

                  <li class="nav-item">

                    <a class="nav-link active" href="#available" data-toggle="tab" role="tab" aria-controls="available" aria-selected="true">

                      <i class="fa fa-thumbs-o-up"></i> Available

                    </a>

                  </li>

                  <li class="nav-item">

                    <a class="nav-link" href="#unavailable" data-toggle="tab" role="tab" aria-controls="unavailable" aria-selected="true">

                      <i class="fa fa-thumbs-o-down"></i> Unavailable

                    </a>

                  </li>



                </ul>

              </div>

            </div>

            <div class="card-body">

              <div class="tab-content">

                <div class="tab-pane show active" id="available">

                  <div class="col-lg-12">



                    <?php foreach ($result_av as $data) {

                      # code...

                    ?>

                      <div class="col-lg-2 col-md-6 col-sm-6 float-left">

                        <div class="card card-stats ">

                          <div class="card-body ">

                            <div class="row">

                              <div class="col-5 col-md-4">

                                <div class="icon-big text-center icon-warning">

                                  <i class="fa fa-bed text-primary"></i>

                                </div>

                              </div>

                              <div class="col-7 col-md-8">

                                <div class="numbers">

                                  <p class="card-category"></p>

                                  <p class="card-title">

                                  <p>

                                </div>

                              </div>

                            </div>

                          </div>

                          <div class="card-footer ">

                            <hr>

                            <div class="stats">

                              No. <?php echo $data['label'] ?>

                            </div>

                          </div>

                        </div>

                      </div>



                    <?php } ?>

























                  </div>









                  <!-- end -->

                </div>



                <div class="tab-pane" id="unavailable">

                  <?php foreach ($result_un as $data) {

                    # code...

                  ?>

                    <div class="col-lg-2 col-md-6 col-sm-6 float-left">

                      <div class="card card-stats ">

                        <div class="card-body ">

                          <div class="row">

                            <div class="col-5 col-md-4">

                              <div class="icon-big text-center icon-warning">

                                <i class="fa fa-bed text-danger"></i>

                              </div>

                            </div>

                            <div class="col-7 col-md-8">

                              <div class="numbers">

                                <p class="card-category"></p>

                                <p class="card-title">

                                <p>

                              </div>

                            </div>

                          </div>

                        </div>

                        <div class="card-footer ">

                          <hr>

                          <div class="stats">

                            No. <?php echo $data['label'] ?>

                          </div>

                        </div>

                      </div>

                    </div>



                  <?php } ?>



                </div>

              </div>

            </div>

            <div class="card-footer">



            </div>

          </form>

        </div>

      </div>

      <!-- wizard container -->

    </div>









  </div>

</div>









<script>
  $(document).ready(function() {

    // Initialise the wizard

    demo.initWizard();

    setTimeout(function() {

      $('.card.card-wizard').addClass('active');

    }, 600);

  });
</script>