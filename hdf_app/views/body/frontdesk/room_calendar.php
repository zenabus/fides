<div class="content pb-0">
  <div class="row">

    <div class="col-md-12">
      <div class="card ">
        <div class="card-header ">
          <div class="timeline-heading">
            <span class="badge badge-pill badge-danger"></span>

          </div>

        </div>
        <div class="card-body">
          <script src='<?php echo base_url() ?>assets/cal/lib/dhtmlxScheduler/dhtmlxscheduler.js'></script>
          <script src='<?php echo base_url() ?>assets/cal/lib/dhtmlxScheduler/ext/dhtmlxscheduler_limit.js'></script>
          <script src='<?php echo base_url() ?>assets/cal/lib/dhtmlxScheduler/ext/dhtmlxscheduler_collision.js'></script>
          <script src='<?php echo base_url() ?>assets/cal/lib/dhtmlxScheduler/ext/dhtmlxscheduler_timeline.js'></script>
          <script src='<?php echo base_url() ?>assets/cal/lib/dhtmlxScheduler/ext/dhtmlxscheduler_editors.js'></script>
          <script src='<?php echo base_url() ?>assets/cal/lib/dhtmlxScheduler/ext/dhtmlxscheduler_minical.js'></script>
          <script src='<?php echo base_url() ?>assets/cal/lib/dhtmlxScheduler/ext/dhtmlxscheduler_tooltip.js'></script>
          <!-- <script src='<?php echo base_url() ?>assets/cal/js/mock_backend.js'></script> -->
          <script src='<?php echo base_url() ?>assets/cal/js/scripts.js'></script>

          <link rel='stylesheet' href='<?php echo base_url() ?>assets/cal/lib/dhtmlxScheduler/dhtmlxscheduler_flat.css'>
          <link rel='stylesheet' href='<?php echo base_url() ?>assets/cal/css/styles.css'>

          <body onload="init()">
            <style type="text/css">
              .dhx_delete_btn_set {
                display: none;
              }
            </style>
            <div id="scheduler_here" class="dhx_cal_container" style='width:100%; height:100%;'>
              <div class="dhx_cal_navline">

                <div>
                  <b style="font-size: 15px; font-weight: normal;">Show rooms:</b>
                  <select id="room_filter" onchange='updateSections(this.value)'>


                  </select>
                </div>
                <div class="dhx_cal_prev_button">&nbsp;</div>
                <div class="dhx_cal_next_button">&nbsp;</div>
                <div class="dhx_cal_today_button"></div>
                <div class="dhx_cal_date"></div>
              </div>
              <div class="dhx_cal_header">
              </div>
              <div class="dhx_cal_data">
              </div>
            </div>
          </body>