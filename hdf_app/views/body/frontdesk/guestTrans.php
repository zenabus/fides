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

<?php if ($this->session->flashdata('error')) : ?>
  <script>
    $(document).ready(function() {
      demo.showNotification_error('top', 'right');
    });
  </script>

<?php endif; ?>

<div class="content pb-0">
  <div class="row">
    <div class="col-md-12">
      <h5><b>TRANSACTIONS (<?php echo $firstname . ' ' . $lastname ?>)</b></h5>
      <div class="card">
        <div class="card-header">
          <h6><b>TRANSACTION LISTS</b></h6>
          <!-- <span class="badge badge-pill badge-danger">Transactions </span> -->
        </div>
        <div class="card-body">
          <div class="toolbar">
            <!--        Here you can write extra buttons/actions for the toolbar              -->
          </div>
          <table id="datatables" class="table table-striped table-bordered" cellspacing="0" width="100%">
            <thead>
              <tr>
                <th>OR #</th>
                <th>Check In</th>
                <th>Check Out</th>
                <th>Days Rendered</th>
                <th>Date Processed</th>
                <th>Payment Type</th>
                <th>Total Amount</th>
                <th>Amount Given</th>
                <th>Change</th>

                <th>Refund Amount</th>
                <th class="disabled-sorting text-center">Action</th>
              </tr>
            </thead>
            <tbody>
              <?php foreach ($result as $data) { ?>
                <tr>
                  <td>FHDF<?php echo $data['id_reports'] ?></td>
                  <td><?php echo $data['checkin'] ?></td>
                  <td><?php echo $data['checkout'] ?></td>
                  <td><?php echo $data['days_ren'] ?></td>
                  <td><?php echo $data['date_process'] ?></td>
                  <td><?php echo $data['type_payment'] ?></td>
                  <td><?php echo number_format($data['total_amount_process'] + $data['ad_cash'] + $data['ad_card'], 2) ?></td>
                  <td><?php echo number_format($data['amount_give'], 2) ?></td>


                  <td><?php echo number_format($data['amount_give'] - $data['total_amount_process'], 2);  ?></td>
                  <td><?php echo number_format($data['refund_am'], 2) ?></td>
                  <td class="td-actions text-center">
                    <?php if ($data['table_num'] == '0') { ?>
                      <a href="" onclick="popupCenter('<?php echo base_url('index.php/main/printReciept/' . $data['if_frontdesk']) ?>',  'myPop1', 600,600); return false;" class="btn btn-primary"><span class="nc-icon nc-zoom-split"> </span> View</a>
                  </td>
                <?php } else { ?>
                  <a href="" onclick="popupCenter('<?php echo base_url('index.php/main/printReciept/' . $data['if_frontdesk'] . 'M' . $data['table_num']) ?>',  'myPop1', 600,600); return false;" class="btn btn-primary"><span class="nc-icon nc-zoom-split"> </span> View</a></td>

                <?php } ?>
                </tr>
              <?php } ?>
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

<script type="text/javascript">
  function popupCenter(url, title, w, h) {
    var left = (screen.width / 2) - (w / 2);
    var top = (screen.height / 2) - (h / 2);
    return window.open(url, title, 'toolbar=no, location=no, directories=no, status=no, menubar=no, scrollbars=no, resizable=no, copyhistory=no, width=' + w + ', height=' + h + ', top=' + top + ', left=' + left);
  }
</script>



?>

<footer class="footer">
  <div class="container pt-4 pb-3">
    <div class="row">
      <div class="col-md-12">
        <p class="text-center">&copy; 2020 -
          <script>
            document.write(new Date().getFullYear())
          </script> &nbsp;iHotelier&nbsp; | &nbsp;All Rights Reserved
        </p>
        <p class="text-center">Made with <i class="fa fa-heart heart"></i> by <a href="https://wsmitservices.com/" class="text-dark" target="blank">WSM IT Services</a></p>
      </div>
    </div>
  </div>
</footer>

</div>

</div>
<!-- <script src="<?php //echo base_url() 
                  ?>assets/js/plugins/jquery.dataTables.min.js"></script> -->