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

  <div class="row">



    <div class="col-md-6">

      <h5><b>TABLES</b></h5>

      <div class="card ">

        <div class="card-header ">

          <div class="timeline-heading">

            <h6><b>COFFEE SHOP</b></h6>

            <span class="badge badge-pill badge-danger">Update a Table</span>

          </div>



        </div>

        <div class="card-body ">

          <form action="<?php echo base_url() ?>index.php/admin/coffeeshopUpdatingTable" method="post" class="form-horizontal">



            <div class="row">
              <div class="col-sm-12">
                <label class="form-label">Table Number</label>

                <div class="form-group">

                  <input type="hidden" name="id" value="<?php echo $result_by_id[0]['id_table'] ?>">

                  <input type="text" class="form-control" name="table_num" value="<?php echo $result_by_id[0]['table_number'] ?>" required>

                </div>

              </div>

            </div>















            <div class="card-footer ">

              <div class="row">

                <label class="col-sm-2 col-form-label"></label>

                <div class="col-md-12">

                  <input type="submit" class="btn btn-success" value="Update">

                  <input type="reset" class="btn btn-info " value="Clear">

                  <!-- <button type="submit" class="btn btn-info btn-round">Sign in</button> -->

                </div>

              </div>

            </div>





          </form>

        </div>

      </div>

    </div>

  </div>



  <div class="row">

    <div class="col-md-12">

      <div class="card">

        <div class="card-header">

          <span class="badge badge-pill badge-danger">List of Table(s)</span>

        </div>

        <div class="card-body">

          <div class="toolbar">

            <!--        Here you can write extra buttons/actions for the toolbar              -->

          </div>

          <table id="datatable" class="table table-striped table-bordered">

            <thead>

              <tr>

                <th>Table #</th>

                <th>Modified</th>

                <th class="disabled-sorting text-right">
                  <center>Actions</center>
                </th>

              </tr>

            </thead>

            <tbody>

              <?php foreach ($result_table as $data) {

                # code...

              ?>

                <tr>

                  <td><?php echo $data['table_number'] ?></td>

                  <td><?php echo $data['date_modified'] ?></td>

                  <td class="td-actions text-center">

                    <a href="<?php echo base_url('index.php/admin/coffeeshopUpdateTables/' . $data['id_table']) ?>" data-placement="top" title="Update" rel="tooltip" class="btn btn-info btn-icon btn-sm"><i class="fa fa-edit"></i></a>

                    <a id="<?php echo base_url('index.php/admin/coffeeshopdeleteTables/' . $data['id_table']) ?>" data-placement="top" title="Delete" rel="tooltip" class="delete btn btn-danger btn-icon btn-sm text-light"><i class="fa fa-times"></i></a>
                  </td>

                </tr>

              <?php } ?>

            </tbody>

            <tbody>





            </tbody>

          </table>

        </div>

        <!-- end content-->

      </div>

      <!--  end card  -->

    </div>

    <!-- end col-md-12 -->

  </div>

  <!-- end row -->

</div>