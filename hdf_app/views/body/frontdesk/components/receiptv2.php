<!DOCTYPE html>
<html>

<head>
  <title><?= TITLE ?> - Acknowledgment Receipt</title>
  <style type="text/css">
    * {
      font-family: 'DejaVu Serif' !important;
      font-size: 36px;
    }

    body,
    html {
      margin: 0;
      margin-top: 80px !important;
    }

    .absolute {
      position: absolute;
    }

    footer {
      position: absolute;
      font-size: 24px;
      font-weight: normal;
      bottom: 32px;
      right: 32px;
    }

    .page {
      position: relative;
      margin: 180px;
    }

    .date {
      top: 31px;
      left: 1500px;
    }

    .name,
    .contact,
    .address,
    .company_name {
      left: 385px;
      /* left: 0; */
    }

    .name {
      top: 140px;
    }

    .address {
      top: 217px;
    }

    .contact,
    .email {
      top: 294px;
    }

    .company_name,
    .company_address {
      top: 373px;
    }

    .email,
    .company_address {
      left: 1560px
    }

    .table,
    .table th {
      border-collapse: collapse;
      width: 100%;
      font-size: 28px;
    }

    th {
      border-top: 1px solid black;
      border-bottom: 1px solid black;
    }

    td {
      font-size: 32px;
      padding-left: 8px;
      padding-right: 8px;
      vertical-align: top;
    }

    td:last-child,
    td:nth-child(3) {
      width: 300px;
    }

    .bt,
    table {
      border-top: 1px solid black;
    }

    .br {
      border-right: 1px solid black;
    }

    .bb {
      border-bottom: 1px solid black;
    }

    .bl {
      border-left: 1px solid black;
    }

    .tl {
      text-align: left !important;
    }

    .tr {
      text-align: right !important;
    }

    .ts {
      text-align: center !important;
    }

    .cost td,
    .cost th {
      border-right: 1px solid black
    }

    .bold {
      font-weight: bold;
    }

    .space {
      height: 510px;
    }

    img {
      top: -80px;
      width: 2565px;
    }

    .bg-apricot {
      background-color: #f8cbad;
    }

    .bg-silver {
      background-color: #C9C9C9;
    }

    .underline {
      text-decoration: underline;
    }

    .wrap {
      white-space: nowrap;
    }

    .bt-0 {
      border-top: 0 !important;
    }

    .b {
      font-weight: bold;
    }
  </style>
</head>

<body>
  <footer>
    Document generated: <?= date('F d, Y h:ia'); ?>
  </footer>
  <img src="<?= $image ?>" width="100%" class="absolute">
  <div class="page">
    <p class="absolute date"><?= date('m/d/Y'); ?></p>
    <p class="absolute name"><?= $booking->first_name ?> <?= $booking->middle_name ?> <?= $booking->last_name ?> <?= $booking->suffix ?></p>
    <p class="absolute address"><?= $booking->address ?></p>
    <p class="absolute contact"><?= $booking->contact ?></p>
    <p class="absolute company_name"><?= $booking->company_name ?></p>
    <p class="absolute email"><?= $booking->email ?></p>
    <p class="absolute company_address"><?= $booking->company_address ?></p>

    <div class="space"></div>

    <table class="table">
      <thead>
        <tr class="bl br bg-apricot">
          <th class="br" style="width:250px">DATE</th>
          <th class="br">PARTICULARS</th>
          <th class="br">REFERENCE</th>
          <th class="br">CHARGES</th>
          <th class="br">PAYMENT</th>
          <th>BALANCE</th>
        </tr>
      </thead>
      <tbody>
        <?php
        $balance = 0;
        $charges = 0;
        $payment = 0;
        $date_holder = '';
        foreach ($soa as $row) {

        ?>
          <tr class="bb bl br">
            <?php
            $date = date_create($row['date']);
            $date = date_format($date, "M d, Y");
            ?>
            <?php if ($date != $date_holder) { ?>
              <td class="br ts"><?= strtoupper($date) ?></td>
            <?php } else { ?>
              <td class="br ts"></td>
            <?php } ?>
            <?php $date_holder = $date; ?>
            <td class="br ts"><?= strtoupper($row['particulars']) ?></td>
            <td class="br ts"><?= $row['reference'] ?></td>
            <td class="br ts">
              <?php
              if (!$row['payment']) {
                echo '₱ ';
                echo number_format($row['charges'], 2);
                $charges += $row['charges'];
                $balance += $row['charges'];
              }
              ?>
            </td>
            <td class="br ts">
              <?php
              if ($row['payment']) {
                echo '₱ ';
                echo number_format($row['charges'], 2);
                $payment += $row['charges'];
                $balance -= $row['charges'];
              }
              ?>
            </td>
            <td class="ts">₱ <?= number_format($balance, 2) ?></td>
          </tr>
        <?php } ?>
        <!-- <tr class="bb bl br">
          <td class="br"></td>
          <td class="br ts bg-apricot">PAYMENT</td>
          <td class="br bg-apricot"></td>
          <td class="br bg-apricot"></td>
          <td class="br bg-apricot"></td>
          <td></td>
        </tr> -->
        <tr class="bb bl br">
          <td colspan="2"></td>
          <td class="br tr b">TOTAL</td>
          <td class="br ts b">₱ <?= number_format($charges, 2) ?></td>
          <td class="br ts">₱ <?= number_format($payment, 2) ?></td>
          <td class="ts">₱ <?= number_format($balance, 2) ?></td>
        </tr>
        <tr>
          <td colspan="6">&nbsp;</td>
        </tr>
        <tr>
          <td class="tr b" colspan="5">BALANCE</td>
          <td class="ts bg-apricot underline b">₱ <?= number_format($balance, 2) ?></td>
        </tr>
    </table>
    <table class="bt-0">
      <tr>
        <td class="bg-silver b" colspan="2">BANK PAYMENT DETAILS</td>
      </tr>
      <tr>
        <td>BANK NAME:</td>
        <td class="b">CHINABANK</td>
      </tr>
      <tr>
        <td>ACCOUNT NAME:</td>
        <td class="b wrap">JACO AND JULS HOTEL AND RESTAURANT CORP.</td>
      </tr>
      <tr>
        <td>ACCOUNT NO.:</td>
        <td class="b">109700008829</td>
      </tr>
      </tbody>
    </table>
  </div>
</body>

</html>