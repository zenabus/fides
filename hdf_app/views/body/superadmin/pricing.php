<div class="content pb-0">
  <div class="row">
    <div class="col-md-12">
      <h5><b>RATES</b></h5>
      <div class="card">
        <div class="card-header">
          <h6><b>ROOM RATES</b></h6>
          <!--<span class="badge badge-pill badge-danger">Room Rate(s)</span>-->
        </div>
        <div class="card-body">
          <div class="toolbar">
            <!--        Here you can write extra buttons/actions for the toolbar              -->
          </div>
          <style>
            .mainedit {
              display: none;
            }
          </style>
          <table id="datatable" class="table table-striped table-bordered">
            <thead>
              <tr>
                <th>Type</th>
                <th>Rate per day</th>
                <th>Breakfast Rate</th>
                <th>Modified</th>

              </tr>
            </thead>
            <tbody>
              <?php foreach ($result_room as $data) {
                # code...
              ?>
                <tr>
                  <td><?php echo $data['room_type'] ?></td>
                  <td>
                    <div class="main" data-placement="left" title="Click to Update Rate" rel="tooltip">&nbsp; <?php echo $data['pricing_type'] ?></div>
                    <input type="number" class="mainedit" value="<?php echo $data['pricing_type'] ?>" id="pricing_type/<?= $data['id'] ?>">
                  </td>

                  <td>
                    <div class="main" data-placement="left" title="Click to Update Rate" rel="tooltip">&nbsp; <?php echo $data['pricing_breakfast'] ?></div>
                    <input type="number" class="mainedit" value="<?php echo $data['pricing_breakfast'] ?>" id="pricing_breakfast/<?= $data['id'] ?>">
                  </td>
                  <td><?php echo $data['type_date_modified'] ?></td>

                </tr>
              <?php } ?>

            </tbody>
          </table>
        </div>
        <!-- end content-->
      </div>
      <!--  end card  -->
    </div>
    <!-- end col-md-6 -->

    <div class="col-md-12">
      <div class="card">
        <div class="card-header">
          <span class="badge badge-pill badge-danger">Extra(s)</span>
        </div>
        <div class="card-body">
          <div class="toolbar">
            <!--        Here you can write extra buttons/actions for the toolbar              -->
          </div>
          <style>
            .secondedit {
              display: none;
            }

            .thirdedit {
              display: none;
            }
          </style>
          <table id="datatable" class="table table-striped table-bordered">
            <thead>
              <tr>
                <th>Type</th>
                <th>Rate</th>
                <th>Modified</th>

              </tr>
            </thead>
            <tbody>
              <?php foreach ($result_bed as $data) {
                # code...
              ?>
                <tr>
                  <td><?php echo $data['add_bed'] ?></td>
                  <td>
                    <div class="second data-placement=" left" title="Click to Update" rel="tooltip"">&nbsp; <?php echo $data['bed_pricing'] ?></div>
                        <input type=" number" class="secondedit" value="<?php echo $data['bed_pricing'] ?>" id="bed_pricing/<?= $data['id'] ?>">
                  </td>
                  <td><?php echo $data['bed_date_modified'] ?></td>

                </tr>
              <?php } ?>


              <!-- <?php //foreach ($result_person as $data) {
                    # code...
                    ?>
                    <tr>
                      <td><?php //echo $data['add_person'] 
                          ?></td>
                      <td>
                        <div class="third">&nbsp; <?php //echo $data['person_pricing'] 
                                                  ?></div>
                        <input type="number" class="thirdedit"  value="<?php //echo $data['person_pricing'] 
                                                                        ?>" id="person_pricing/<?= $data['id'] ?>">
                      </td>
                      <td><?php //echo $data['person_date_modified'] 
                          ?></td>

                    </tr>
                    <?php //} 
                    ?> -->

            </tbody>
          </table>
        </div>
        <!-- end content-->
      </div>
      <!--  end card  -->
    </div>


  </div>
  <!-- end row -->
</div>