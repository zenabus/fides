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

      <h5><b>RATES</b></h5>

      <div class="card ">

        <div class="card-header ">

          <div class="timeline-heading">

            <h6><b>COFFEE SHOP</b></h6>
            <!--<span class="badge badge-pill badge-danger">Coffee Shop</span>-->
            <!--<b>(Coffee Shop)</b>-->

          </div>



        </div>

        <div class="card-body ">

          <form action="<?php echo base_url() ?>index.php/admin/CoffeeAdd_product" method="post" class="form-horizontal">







            <div class="row">

              <div class="col-sm-12">

                <label class="form-label">Product</label>

                <div class="form-group">

                  <input type="text" class="form-control" name="prod_name" required>

                </div>

              </div>

            </div>



            <div class="row">

              <div class="col-sm-12">

                <label class="form-label">Rate</label>

                <div class="form-group">

                  <input type="number" class="form-control" name="prod_price" required>

                </div>

              </div>

            </div>





            <div class="card-footer ">

              <div class="row">



                <div class="col-md-12">

                  <input type="submit" class="btn btn-success" value="Add">

                  <input type="reset" class="btn btn-info " value="Clear">

                  <!-- <button type="submit" class="btn btn-info btn-round">Sign in</button> -->

                </div>

              </div>

            </div>







          </form>

        </div>

      </div>

    </div>





    <!--  -->







    <div class="col-md-12 ">

      <div class="card ">

        <div class="card-header ">

          <div class="timeline-heading">

            <span class="badge badge-pill badge-danger">Product List(s)</span>

          </div>



        </div>

        <div class="card-body ">

          <table id="datatable" class="table table-striped table-bordered" cellspacing="0" width="100%">

            <style>
              .CNmainedit {

                display: none;

              }



              .CPmainedit {

                display: none;

              }
            </style>

            <thead>

              <tr>

                <th>Product</th>

                <th>Rate</th>

                <th>Status</th>

                <th class="disabled-sorting text-center">Action</th>

              </tr>

            </thead>

            <tbody>

              <?php foreach ($result_product_res as $data) {

                # code...
                if ($data['product_status'] == 'Active') {
                  $stat = "<span class='badge badge-info'>ACTIVE</span>";
                } else {
                  $stat = "<span class='badge badge-danger'>INACTIVE</span>";
                }
              ?>

                <tr>

                  <td>

                    <div class="CNmain" data-placement="left" title="Click to Update" rel="tooltip">&nbsp; <?php echo $data['product_name'] ?></div>

                    <input type="text" class="CNmainedit" value="<?php echo $data['product_name'] ?>" id="product_name/<?= $data['id'] ?>">

                  </td>

                  <td>

                    <div class="CPmain" data-placement="left" title="Click to Update" rel="tooltip">&nbsp; <?php echo $data['product_cost'] ?></div>

                    <input type="number" class="CPmainedit" value="<?php echo $data['product_cost'] ?>" id="product_cost/<?= $data['id'] ?>">

                  </td>

                  <!-- <td>sad asd</td> -->

                  <td><?php echo $stat ?> </td>

                  <td class="td-actions text-center">

                    <a id="<?php echo base_url('index.php/admin/CoffeechangeActive/' . $data['id']) ?>" data-placement="top" title="Active" rel="tooltip" class="active btn btn-primary btn-icon btn-sm"><i class="fa fa-edit"></i></a>

                    <a id="<?php echo base_url('index.php/admin/CoffeechnageInactive/' . $data['id']) ?>" data-placement="top" title="Inactive" rel="tooltip" class="inactive btn btn-secondary btn-icon btn-sm text-light"><i class="fa fa-edit"></i></a>

                    <a id="<?php echo base_url('index.php/admin/CoffeedeleteResProduct/' . $data['id']) ?>" data-placement="top" title="Delete" rel="tooltip" class="delete btn btn-danger btn-icon btn-sm text-light"><i class="fa fa-times"></i></a>


                  </td>

                </tr>

              <?php } ?>

            </tbody>









          </table>

        </div>

      </div>

    </div>







  </div>

</div>



<script type="text/javascript">
  $('.active').click(function() {

    swal({

      title: 'Switch to Active?',

      text: '',

      type: 'warning',

      showCancelButton: true,

      confirmButtonText: 'Yes',

      cancelButtonText: 'Cancel',

      confirmButtonClass: "btn btn-success",

      cancelButtonClass: "btn btn-danger",

      buttonsStyling: false

    }).then((result) => {

      if (!result.value) {

        window.location.replace(this.id);

      }

    });

  });
</script>



<script type="text/javascript">
  $('.inactive').click(function() {

    swal({

      title: 'Switch to Inactive?',

      text: '',

      type: 'warning',

      showCancelButton: true,

      confirmButtonText: 'Yes',

      cancelButtonText: 'Cancel',

      confirmButtonClass: "btn btn-success",

      cancelButtonClass: "btn btn-danger",

      buttonsStyling: false

    }).then((result) => {

      if (!result.value) {

        window.location.replace(this.id);

      }

    });

  });
</script>