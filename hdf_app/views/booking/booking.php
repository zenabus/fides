<!DOCTYPE html>
<html>

<head>
  <title><?= TITLE ?> | iHotelier</title>
  <link rel="stylesheet" type="text/css" href="<?= base_url('assets/css/bootstrap.min.css') ?>">
  <link rel="stylesheet" type="text/css" href="<?= base_url('assets/css/paper-kit.min.css') ?>">
  <link rel="stylesheet" type="text/css" href="<?= base_url('assets/css/booking.css') ?>">
  <link rel="stylesheet" type="text/css" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
  <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@400;500;700&display=swap" rel="stylesheet">
  <link rel="icon" type="jpeg" href="<?= base_url('assets/img/logo.jpg') ?>">
  <meta name="viewport" content="width=device-width, initial-scale=1">

  <!-- SEO -->
  <meta name="author" content="Francisco Ibanez III" />
  <meta name="description" content="iHotelier is developed and designed by Elpidio Villarosa, Francisco Ibanez III and Jovin Maneja of WSM IT Services for <?= TITLE ?>." />
  <meta name="keywords" content="iHotelier, hoteldefides, defides, hotel tacloban, tacloban city, hotel tacloban city, hotel booking, booking, <?= TITLE ?> tacloban, <?= TITLE ?>" />
  <!-- SEO -->

  <script src="<?= base_url() ?>assets/js/plugins/jspdf.js"></script>

  <style>
    .wizardry-panel {
      min-height: 400px;
    }

    #wizard2,
    #wizard3,
    #wizard4 {
      display: none;
    }

    .reservation {
      border-right: 4px solid white;
      height: 100%
    }

    .invalid {
      cursor: not-allowed !important;
    }

    .overlay,
    .message-overlay {
      background-color: rgba(0, 0, 0, 0.5);
      z-index: 9999999;
      position: fixed;
      left: 0;
      top: 0;
      width: 100%;
      height: 100%;
      padding-top: 20%;
      padding-left: 49%;
    }

    .overlay {
      display: none;
    }

    .form-check-label {
      cursor: pointer;
    }

    .modal-amenities {
      white-space: pre;
    }

    [disabled] {
      pointer-events: none;
    }
  </style>
</head>
<div class="overlay">
  <div class="spinner-border text-light">
    <i class="fa fa-spinner fa-pulse fa-3x fa-fw"></i>
    <span class="sr-only">Loading...</span>
  </div>
</div>

<body>
  <div class="container-fluid pt-3 pb-3" style="height: 150px;background: white">
    <div class="container">
      <div class="row mt-4">
        <div class="col-md-4 d-none d-sm-none d-md-block">
          <p class="font-weight-bold text-green">+63 53 888 7204 | +63 963 193 1094</p>
          <p class="font-weight-bold text-green">+63 977 405 4201</p>
          <p style="color:#73777f">reservations@hoteldefides.com</p>
        </div>
        <div class="col-md-4 col-sm-12">
          <a href="https://hoteldefides.com/"><img class="img-fluid" src="<?= base_url() ?>assets/img/hdf_logo_brown.png" height="60"></a>
        </div>
      </div>
    </div>
  </div>

  <div class="container pt-3 pb-4">
    <div class="row ml-1 mr-1">
      <div class="col-md-12">
        <div class="wizard row">
          <a href="javascript:" class="col-md-2 col-sm-2 col-xs-2 active wizard-btn" id="w1">
            <span class="badge badge-dark">1</span>
            <span class="hide-this">Select Date</span>
          </a>
          <a href="javascript:" class="col-md-2 col-sm-2 col-xs-2 wizard-btn" id="w2">
            <span class="badge badge-dark">2</span>
            <span class="hide-this">Select Room</span>
          </a>
          <a href="javascript:" class="col-md-2 col-sm-2 col-xs-2 wizard-btn invalid" id="w3">
            <span class="badge badge-dark">3</span>
            <span class="hide-this">Information</span>
          </a>
          <a href="javascript:" class="col-md-2 col-sm-2 col-xs-2 wizard-btn invalid" id="w4">
            <span class="badge badge-dark">4</span>
            <span class="hide-this">Confirmation</span>
          </a>
        </div>

        <div class="wizardry-panel">
          <div class="wizards" id="wizard1">
            <div class="row">
              <div class="bg-semi-light mt-3 p-4 col-lg-3 col-md-12 reservation">
                <h6 class="text-green">Reservation Summary</h6>
                <button type="button" class="btn btn-green rounded-0 w100" id="search"><i class="nc-icon nc-calendar-60"></i> Search</button>
              </div>
              <div class="bg-semi-light mt-3 p-4 col-lg-9 col-md-12">
                <div class="row">
                  <div class="col-md-6">
                    <h6 class="text-green text-center">Check-In Date</h6>
                    <div class="datetimepicker bg-light p-2" id="checkin"></div>
                  </div>
                  <div class="col-md-6">
                    <h6 class="text-green text-center mt-top-sm">Check-Out Date</h6>
                    <div class="datetimepicker bg-light p-2" id="checkout"></div>
                  </div>
                </div>
                <div class="row">
                  <div class="col-md-12">
                    <p class="text-dark mt-3 pb-0 mb-0" id="days">Select your dates by clicking on the calendar above</p>
                  </div>
                </div>
              </div>
            </div>
          </div>

          <div class="wizards" id="wizard2">
            <div class="row">
              <div class="bg-semi-light mt-3 p-4 col-md-3 reservation">
                <h6 class="text-green">Reservation Summary</h6>
                <div class="form-group">
                  <label>Check-In Date</label>
                  <input type="text" class="form-control form-control-sm rounded-0 checkinDate" readonly>
                </div>
                <div class="form-group">
                  <label>Check-Out Date</label>
                  <input type="text" class="form-control form-control-sm rounded-0 checkoutDate" readonly>
                </div>
                <div class="form-group">
                  <label>No. of Night(s)</label>
                  <input type="text" class="form-control form-control-sm rounded-0 nights" readonly>
                </div>
                <button type="button" class="btn btn-green rounded-0 w100" id="gow1"><i class="nc-icon nc-minimal-left"></i> Go Back </button>
              </div>

              <div class="bg-semi-light mt-3 p-4 col-md-9" id="rooms_div">
                <!-- javascript -->
              </div>
            </div>
          </div>

          <div class="wizards" id="wizard3">
            <div class="row">
              <div class="bg-semi-light mt-3 p-4 col-md-3 reservation">
                <h6 class="text-green">Reservation Summary</h6>
                <div class="form-group">
                  <label>Check-In Date</label>
                  <input type="text" class="form-control form-control-sm rounded-0 checkinDate" readonly>
                </div>
                <div class="form-group">
                  <label>Check-Out Date</label>
                  <input type="text" class="form-control form-control-sm rounded-0 checkoutDate" readonly>
                </div>
                <div class="form-group">
                  <label>No. of Night(s)</label>
                  <input type="text" class="form-control form-control-sm rounded-0 nights" readonly>
                </div>

                <h6 class="text-green">Room Details</h6>
                <div class="form-group">
                  <label>Room Type</label>
                  <input type="text" class="form-control form-control-sm rounded-0 roomType" readonly>
                  <input type="hidden" class="form-control form-control-sm rounded-0 room_id">
                </div>
                <div class="form-group">
                  <label>Max Occupancy</label>
                  <input type="text" class="form-control form-control-sm rounded-0 occupancy" readonly>
                </div>
                <div class="form-group">
                  <label>Total Price</label>
                  <input type="text" class="form-control form-control-sm rounded-0 total" readonly>
                </div>
                <button type="button" class="btn btn-green rounded-0 w100" id="gow2"><i class="nc-icon nc-minimal-left"></i> Go Back </button>
              </div>

              <div class="bg-semi-light mt-3 p-4 col-md-9 text-dark" style="height:100%">
                <h6 class="text-green">Personal Information</h6>
                <div class="row">
                  <div class="col-md-4 form-group">
                    <label>First Name *</label>
                    <input type="text" class="form-control rounded-0" id="first">
                  </div>
                  <div class="col-md-3 form-group">
                    <label>Middle Name</label>
                    <input type="text" class="form-control rounded-0" id="middle">
                  </div>
                  <div class="col-md-3 form-group">
                    <label>Last Name *</label>
                    <input type="text" class="form-control rounded-0" id="last">
                  </div>
                  <div class="col-md-2 form-group">
                    <label>Suffix</label>
                    <input type="text" class="form-control rounded-0" id="suffix">
                  </div>
                </div><!-- row -->
                <div class="row">
                  <div class="col-md-4 form-group">
                    <label>Email Address *</label>
                    <input type="email" class="form-control rounded-0" id="email">
                  </div>
                  <div class="col-md-4 form-group">
                    <label>Phone Number *</label>
                    <input type="text" class="form-control rounded-0" id="phone">
                  </div>
                  <div class="col-md-4 form-group">
                    <label>Special Request(s)</label>
                    <textarea class="form-control rounded-0" id="special"></textarea>
                  </div>
                </div>

                <h6 class="text-green">Payment Details</h6>
                <div class="row">
                  <div class="col-md-12">
                    <label>Payment Method</label>
                    <div class="d-flex align-items-center">
                      <div class="form-check-radio mr-3">
                        <label class="form-check-label">
                          <input class="form-check-input" type="radio" name="payment_option" value="Card" checked> GCash / Bank Deposit
                          <span class="form-check-sign"></span>
                        </label>
                      </div>
                    </div>
                  </div>
                </div>
                <div class="row mb-4">
                  <div class="col-md-12">
                    <label>I have read and agreed the following:</label><br>
                    <input type="checkbox" id="chkterms"> <a href="#" data-toggle="modal" data-target="#terms" class="text-green">Terms and Conditions</a>
                  </div>
                </div>
                <button type="button" class="btn btn-green rounded-0" id="complete" disabled><i class="nc-icon nc-check-2"></i> Complete Transaction </button>
              </div>
            </div>
          </div>

          <div class="wizards" id="wizard4">
            <div class="row">
              <div class="bg-semi-light mt-3 p-4 col-md-3 reservation">
                <h6 class="text-green">Reservation Summary</h6>
                <div class="form-group">
                  <label>Check-In Date</label>
                  <input type="text" class="form-control form-control-sm rounded-0 checkinDate" readonly>
                </div>
                <div class="form-group">
                  <label>Check-In Date</label>
                  <input type="text" class="form-control form-control-sm rounded-0 checkoutDate" readonly>
                </div>
                <div class="form-group">
                  <label>No. of Night(s)</label>
                  <input type="text" class="form-control form-control-sm rounded-0 nights" readonly>
                </div>

                <h6 class="text-green">Room Details</h6>
                <div class="form-group">
                  <label>Room Type</label>
                  <input type="text" class="form-control form-control-sm rounded-0 roomType" readonly>
                </div>
                <div class="form-group">
                  <label>Max Occupancy</label>
                  <input type="text" class="form-control form-control-sm rounded-0 occupancy" readonly>
                </div>
                <div class="form-group">
                  <label>Total Price</label>
                  <input type="text" class="form-control form-control-sm rounded-0 total" readonly>
                </div>

                <h6 class="text-green">Contact Information</h6>
                <div class="form-group">
                  <label>Name</label>
                  <input type="text" class="form-control form-control-sm rounded-0 name" readonly>
                </div>
                <div class="form-group">
                  <label>Email</label>
                  <input type="text" class="form-control form-control-sm rounded-0 email" readonly>
                </div>
                <div class="form-group">
                  <label>Phone</label>
                  <input type="text" class="form-control form-control-sm rounded-0 phone" readonly>
                </div>
              </div>

              <div class="mt-3 col-md-9 px-0">
                <div class="bg-semi-light p-4 text-green verified" id="imageDIV">
                  <h3 class="mt-0 mb-3">Please check your email for verification</h3>
                  <p>Dear Mr./Mrs. <span class="last_name"></span></p>
                  <p>Thank you for choosing <?= TITLE ?>. We have sent verification message to <span class="email_address"></span> to confirm your reservation. Please advise us if any changes need to be made to this reservation by calling us.</p>
                  <div class="row pt-2">
                    <div class="col-md-7">
                      <table class="table table-bordered bg-light">
                        <thead>
                          <tr>
                            <th class="p-1 bg-success" colspan="2">RESERVATION DETAILS</th>
                          </tr>
                        </thead>
                        <tbody>
                          <tr>
                            <th class="p-1">Booking Number</th>
                            <td class="p-1" id="td_booking"></td>
                          </tr>
                          <tr>
                            <th class="p-1">Guest Name</th>
                            <td class="p-1" id="td_guest"></td>
                          </tr>
                          <tr>
                            <th class="p-1">Email Address</th>
                            <td class="p-1" id="td_email"></td>
                          </tr>
                          <tr>
                            <th class="p-1">Contact Number</th>
                            <td class="p-1" id="td_contact"></td>
                          </tr>
                          <tr>
                            <th class="p-1">Arrival Date</th>
                            <td class="p-1" id="td_arrival"></td>
                          </tr>
                          <tr>
                            <th class="p-1">Departure Date</th>
                            <td class="p-1" id="td_departure"></td>
                          </tr>
                          <tr>
                            <th class="p-1">Number of Nights</th>
                            <td class="p-1" id="td_nights"></td>
                          </tr>
                          <tr>
                            <th class="p-1">Room Type</th>
                            <td class="p-1" id="td_room_type"></td>
                          </tr>
                          <tr>
                            <th class="p-1">Nightly Rate</th>
                            <td class="p-1" id="td_rate"></td>
                          </tr>
                          <tr>
                            <th class="p-1">Amount to be Paid</th>
                            <td class="p-1" id="td_amount"></td>
                          </tr>
                          <tr>
                            <th class="p-1">Payment Option</th>
                            <td class="p-1" id="td_option"></td>
                          </tr>
                        </tbody>
                      </table>
                    </div>
                    <div class="col-md-5">
                      <table class="table table-sm table-bordered bg-light" style="height:368.35px">
                        <thead>
                          <tr>
                            <th class=" p-1 bg-success" colspan="2">POLICIES</th>
                          </tr>
                        </thead>
                        <tbody>
                          <tr>
                            <th class="p-1">Check-In Time</th>
                            <td class="p-1">2:00 PM</td>
                          </tr>
                          <tr>
                            <th class="p-1">Check-Out Time</th>
                            <td class="p-1">12:00 NN</td>
                          </tr>
                          <tr>
                            <th class="p-1 text-center" colspan="2">Cancellation Policy</th>
                          </tr>
                          <tr>
                            <td colspan="2">
                              <ol>
                                <li>All payments received by the <?= TITLE ?> is NON-REFUNDABLE.</li>
                                <li>If cancelled or a no-show, 80% of the first night's room cost will be charged.</li>
                                <li>Modification of booking can be done anytime and free of charge.</li>
                                <li>Any cancellation fees are determined by the property.</li>
                              </ol>
                            </td>
                          </tr>
                        </tbody>
                      </table>
                    </div>
                  </div>
                  <a href="javascript:" class="btn btn-green rounded-0" id="download"><i class="fa fa-download"></i> Download Copy </a>
                  <a href="" class="btn btn-green rounded-0" id="download"><i class="fa fa-book"></i> Book Again </a>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>

  <div class="container-fluid about bg-solid-green pt-5 pb-4">
    <div class="container text-light">
      <div class="row">
        <div class="col-md-4 mb-3">
          <h5><?= TITLE ?></h5>
          <p class="text-justify"><?= TITLE ?> is a family-oriented hotel overlooking the Cancabato Bay. It is the perfect place to go to for an amazing atmosphere and venue. The ambience of the hotel is relaxing and pleasant from its thematic, to its general location. The service also aims to meet guest standards and leave a lasting positive impression upon them. <?= TITLE ?> will stay true to its name and be faithful to your standards for “Fides” means faith in Latin.</p><br>
          <a href="https://www.facebook.com/HoteldeFides/" class="btn btn-just-icon btn-green border-0" target="_blank">
            <i class="fa fa-facebook" aria-hidden="true"></i>
          </a>
        </div>
        <div class="col-md-4 mb-3">
          <h5>Contact Us</h5>
          <ul class="list-group list-group-flush">
            <li class="list-group-item"><i class="nc-icon nc-pin-3 list-icon pr-2"></i> Fatima Village Brgy. 75, Tacloban City, Leyte 6500</li>
            <li class="list-group-item"><i class="nc-icon nc-mobile list-icon pr-2"></i> +63 53 888 7204 | +63 963 193 1094 | +63 977 405 4201</li>
            <li class="list-group-item"><i class="nc-icon nc-email-85 list-icon pr-2"></i> reservations@hoteldefides.com</li>
            <li class="list-group-item"><i class="nc-icon nc-badge list-icon pr-2"></i> <a href="https://hoteldefides.com/" class="text-light" target="blank">Visit our website</a></li>
          </ul>
        </div>
        <div class="col-md-4">
          <!-- google map here -->
          <h5>Location</h5>
          <iframe src="https://www.google.com/maps/embed?pb=!1m14!1m8!1m3!1d1956.797236057042!2d125.00636643267974!3d11.2176105511827!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x330877a2d727885b%3A0x8a81fe1be4faa83d!2sHOTEL%20DE%20FIDES!5e0!3m2!1sen!2sph!4v1582262068131!5m2!1sen!2sph" width="100%" height="230" frameborder="0" style="border:0;" allowfullscreen=""></iframe>
        </div>
      </div>
    </div>
  </div>

  <nav class="bg-light text-dark">
    <div class="container pt-4 pb-3">
      <div class="row">
        <div class="col-md-12">
          <p class="text-center text-dark">&copy; 2020 - <?= date('Y') ?> &nbsp;iHotelier&nbsp; | &nbsp;All Rights Reserved
          </p>
          <p class="text-center text-dark">Made with <i class="fa fa-heart heart"></i> by <a href="https://wsmitservices.com/" class="text-dark" target="blank">WSM IT Services</a></p>
        </div>
      </div>
    </div>
  </nav>

  <!-- small modal -->
  <div class="modal fade" id="modalAlert" tabindex="-1" role="dialog">
    <div class="modal-dialog modal-sm ">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title text-center mt-0">Confirmation</h5>
        </div>
        <div class="modal-body text-center">
          <h5>Are you sure you want to select this room? </h5>
        </div>
        <div class="modal-footer">
          <div class="left-side">
            <button type="button" class="btn btn-link" data-dismiss="modal" id="btn-no">Never mind</button>
          </div>
          <div class="divider"></div>
          <div class="right-side">
            <button type="button" class="btn btn-danger btn-link" id="btn-yes">Yes</button>
          </div>
        </div>
      </div>
    </div>
  </div>

  <!-- view modal -->
  <div class="modal fade" id="modalView" tabindex="-1" role="dialog">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header no-border-header">
          <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
          <h5 class="modal-title text-center mt-0">Room Details</h5>
        </div>
        <div class="modal-body px-4 pt-0">
          <p class="modal-details text-justify mb-3"></p>
          <h6>Amenities</h6>
          <p class="modal-amenities"></p>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-danger btn-link" data-dismiss="modal">Okay</button>
        </div>
      </div>
    </div>
  </div>

  <!-- privacy modal -->
  <div class="modal fade" id="privacy" tabindex="-1" role="dialog">
    <div class="modal-dialog modal-lg">
      <div class="modal-content">
        <div class="modal-header no-border-header pb-0">
          <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
          <h3 class="mt-0">Privacy Policy</h3>
        </div>
        <div class="modal-body">
          <p>Last updated: March 09, 2020</p>

          <p>This Privacy Policy describes Our policies and procedures on the collection, use and disclosure of Your information when You use the Service and tells You about Your privacy rights and how the law protects You.</p>

          <p>We use Your Personal data to provide and improve the Service. By using the Service, You agree to the collection and use of information in accordance with this Privacy Policy. This Privacy Policy has been created with the help of <a href="https://www.termsfeed.com/privacy-policy-generator/">Privacy Policy Generator</a>.</p>

          <h3>Interpretation and Definitions</h3>
          <h3>Interpretation</h3>
          <p>The words of which the initial letter is capitalized have meanings defined under the following conditions.</p>
          <p>The following definitions shall have the same meaning regardless of whether they appear in singular or in plural.</p>

          <h3>Definitions</h3>
          <p>For the purposes of this Privacy Policy:</p>
          <ul>
            <li>
              <p><strong>You</strong> means the individual accessing or using the Service, or the company, or other legal entity on behalf of which such individual is accessing or using the Service, as applicable.</p>
            </li>
            <li>
              <p><strong>Company</strong> (referred to as either "the Company", "We", "Us" or "Our" in this Agreement) refers to <?= TITLE ?>, Real Street, Brgy. 75 Fatima, Tacloban City, 6500 Leyte.</p>
            </li>
            <li><strong>Affiliate</strong> means an entity that controls, is controlled by or is under common control with a party, where "control" means ownership of 50% or more of the shares, equity interest or other securities entitled to vote for election of directors or other managing authority.</li>
            <li><strong>Account</strong> means a unique account created for You to access our Service or parts of our Service.</li>
            <li><strong>Website</strong> refers to <?= TITLE ?>, accessible from hoteldefides.com</li>
            <li><strong>Service</strong> refers to the Website.</li>
            <li><strong>Country</strong> refers to: Philippines</li>
            <li>
              <p><strong>Service Provider</strong> means any natural or legal person who processes the data on behalf of the Company. It refers to third-party companies or individuals employed by the Company to facilitate the Service, to provide the Service on behalf of the Company, to perform services related to the Service or to assist the Company in analyzing how the Service is used.</p>
            </li>
            <li><strong>Third-party Social Media Service</strong> refers to any website or any social network website through which a User can log in or create an account to use the Service.</li>
            <li>
              <p><strong>Personal Data</strong> is any information that relates to an identified or identifiable individual.</p>
            </li>
            <li><strong>Cookies</strong> are small files that are placed on Your computer, mobile device or any other device by a website, containing the details of Your browsing history on that website among its many uses.</li>
            <li><strong>Usage Data</strong> refers to data collected automatically, either generated by the use of the Service or from the Service infrastructure itself (for example, the duration of a page visit).</li>
          </ul>

          <h3>Collecting and Using Your Personal Data</h3>
          <h3>Types of Data Collected</h3>

          <h4>Personal Data</h4>
          <p>While using Our Service, We may ask You to provide Us with certain personally identifiable information that can be used to contact or identify You. Personally identifiable information may include, but is not limited to:</p>
          <ul>
            <li>Email address</li>
            <li>First name and last name</li>
            <li>Phone number</li>
            <li>Address, State, Province, ZIP/Postal code, City</li>
            <li>Usage Data</li>
          </ul>

          <h4>Usage Data</h4>
          <p>Usage Data is collected automatically when using the Service.</p>
          <p>Usage Data may include information such as Your Device's Internet Protocol address (e.g. IP address), browser type, browser version, the pages of our Service that You visit, the time and date of Your visit, the time spent on those pages, unique device identifiers and other diagnostic data.</p>
          <p>When You access the Service by or through a mobile device, We may collect certain information automatically, including, but not limited to, the type of mobile device You use, Your mobile device unique ID, the IP address of Your mobile device, Your mobile operating system, the type of mobile Internet browser You use, unique device identifiers and other diagnostic data.</p>
          <p>We may also collect information that Your browser sends whenever You visit our Service or when You access the Service by or through a mobile device.</p>

          <h4>Tracking Technologies and Cookies</h4>
          <p>We use Cookies and similar tracking technologies to track the activity on Our Service and store certain information. Tracking technologies used are beacons, tags, and scripts to collect and track information and to improve and analyze Our Service.</p>
          <p>You can instruct Your browser to refuse all Cookies or to indicate when a Cookie is being sent. However, if You do not accept Cookies, You may not be able to use some parts of our Service.</p>
          <p>Cookies can be "Persistent" or "Session" Cookies. Persistent Cookies remain on your personal computer or mobile device when You go offline, while Session Cookies are deleted as soon as You close your web browser.</p>
          <p>We use both session and persistent Cookies for the purposes set out below:</p>
          <ul>
            <li>
              <p><strong>Necessary / Essential Cookies</strong>
              <p>Type: Session Cookies</p>
              <p>Administered by: Us</p>
              <p>Purpose: These Cookies are essential to provide You with services available through the Website and to enable You to use some of its features. They help to authenticate users and prevent fraudulent use of user accounts. Without these Cookies, the services that You have asked for cannot be provided, and We only use these Cookies to provide You with those services.</p>
            </li>
            <li>
              <p><strong>Cookies Policy / Notice Acceptance Cookies</strong></p>
              <p>Type: Persistent Cookies</p>
              <p>Administered by: Us</p>
              <p>Purpose: These Cookies identify if users have accepted the use of cookies on the Website.</p>
            </li>
            <li>
              <p><strong>Functionality Cookies</strong></p>
              <p>Type: Persistent Cookies</p>
              <p>Administered by: Us</p>
              <p>Purpose: These Cookies allow us to remember choices You make when You use the Website, such as remembering your login details or language preference. The purpose of these Cookies is to provide You with a more personal experience and to avoid You having to re-enter your preferences every time You use the Website.</p>
            </li>
          </ul>
          <p>For more information about the cookies we use and your choices regarding cookies, please visit our Cookies Policy.</p>

          <h3>Use of Your Personal Data</h3>
          <p>The Company may use Personal Data for the following purposes:</p>
          <ul>
            <li><strong>To provide and maintain our Service</strong>, including to monitor the usage of our Service.</li>
            <li><strong>To manage Your Account:</strong> to manage Your registration as a user of the Service. The Personal Data You provide can give You access to different functionalities of the Service that are available to You as a registered user.</li>
            <li><strong>For the performance of a contract:</strong> the development, compliance and undertaking of the purchase contract for the products, items or services You have purchased or of any other contract with Us through the Service.</li>
            <li><strong>To contact You:</strong> To contact You by email, telephone calls, SMS, or other equivalent forms of electronic communication, such as a mobile application's push notifications regarding updates or informative communications related to the functionalities, products or contracted services, including the security updates, when necessary or reasonable for their implementation.</li>
            <li><strong>To provide You</strong> with news, special offers and general information about other goods, services and events which we offer that are similar to those that you have already purchased or enquired about unless You have opted not to receive such information.</li>
            <li><strong>To manage Your requests:</strong> To attend and manage Your requests to Us.</li>
          </ul>

          <p>We may share your personal information in the following situations:</p>

          <ul>
            <li><strong>With Service Providers:</strong> We may share Your personal information with Service Providers to monitor and analyze the use of our Service, to show advertisements to You to help support and maintain Our Service, to contact You, to advertise on third party websites to You after You visited our Service or for payment processing.</li>
            <li><strong>For Business transfers:</strong> We may share or transfer Your personal information in connection with, or during negotiations of, any merger, sale of Company assets, financing, or acquisition of all or a portion of our business to another company.</li>
            <li><strong>With Affiliates:</strong> We may share Your information with Our affiliates, in which case we will require those affiliates to honor this Privacy Policy. Affiliates include Our parent company and any other subsidiaries, joint venture partners or other companies that We control or that are under common control with Us.</li>
            <li><strong>With Business partners:</strong> We may share Your information with Our business partners to offer You certain products, services or promotions.</li>
            <li><strong>With other users:</strong> when You share personal information or otherwise interact in the public areas with other users, such information may be viewed by all users and may be publicly distributed outside. If You interact with other users or register through a Third-Party Social Media Service, Your contacts on the Third-Party Social Media Service may see Your name, profile, pictures and description of Your activity. Similarly, other users will be able to view descriptions of Your activity, communicate with You and view Your profile.</li>
          </ul>

          <h3>Retention of Your Personal Data</h3>
          <p>The Company will retain Your Personal Data only for as long as is necessary for the purposes set out in this Privacy Policy. We will retain and use Your Personal Data to the extent necessary to comply with our legal obligations (for example, if we are required to retain your data to comply with applicable laws), resolve disputes, and enforce our legal agreements and policies.</p>
          <p>The Company will also retain Usage Data for internal analysis purposes. Usage Data is generally retained for a shorter period of time, except when this data is used to strengthen the security or to improve the functionality of Our Service, or We are legally obligated to retain this data for longer time periods.</p>

          <h3>Transfer of Your Personal Data</h3>
          <p>Your information, including Personal Data, is processed at the Company's operating offices and in any other places where the parties involved in the processing are located. It means that this information may be transferred to — and maintained on — computers located outside of Your state, province, country or other governmental jurisdiction where the data protection laws may differ than those from Your jurisdiction.</p>
          <p>Your consent to this Privacy Policy followed by Your submission of such information represents Your agreement to that transfer.</p>
          <p>The Company will take all steps reasonably necessary to ensure that Your data is treated securely and in accordance with this Privacy Policy and no transfer of Your Personal Data will take place to an organization or a country unless there are adequate controls in place including the security of Your data and other personal information.</p>

          <h3>Disclosure of Your Personal Data</h3>
          <h4>Business Transactions</h4>
          <p>If the Company is involved in a merger, acquisition or asset sale, Your Personal Data may be transferred. We will provide notice before Your Personal Data is transferred and becomes subject to a different Privacy Policy.</p>
          <h4>Law enforcement</h4>
          <p>Under certain circumstances, the Company may be required to disclose Your Personal Data if required to do so by law or in response to valid requests by public authorities (e.g. a court or a government agency).</p>
          <h4>Other legal requirements</h4>
          <p>The Company may disclose Your Personal Data in the good faith belief that such action is necessary to:</p>
          <ul>
            <li>Comply with a legal obligation</li>
            <li>Protect and defend the rights or property of the Company</li>
            <li>Prevent or investigate possible wrongdoing in connection with the Service</li>
            <li>Protect the personal safety of Users of the Service or the public</li>
            <li>Protect against legal liability</li>
          </ul>

          <h3>Security of Your Personal Data</h3>
          <p>The security of Your Personal Data is important to Us, but remember that no method of transmission over the Internet, or method of electronic storage is 100% secure. While We strive to use commercially acceptable means to protect Your Personal Data, We cannot guarantee its absolute security.</p>

          <h3>Children's Privacy</h3>
          <p>Our Service does not address anyone under the age of 13. We do not knowingly collect personally identifiable information from anyone under the age of 13. If You are a parent or guardian and You are aware that Your child has provided Us with Personal Data, please contact Us. If We become aware that We have collected Personal Data from anyone under the age of 13 without verification of parental consent, We take steps to remove that information from Our servers.</p>
          <p>We also may limit how We collect, use, and store some of the information of Users between 13 and 18 years old. In some cases, this means We will be unable to provide certain functionality of the Service to these users.</p>
          <p>If We need to rely on consent as a legal basis for processing Your information and Your country requires consent from a parent, We may require Your parent's consent before We collect and use that information.</p>

          <h3>Links to Other Websites</h3>
          <p>Our Service may contain links to other websites that are not operated by Us. If You click on a third party link, You will be directed to that third party's site. We strongly advise You to review the Privacy Policy of every site You visit.</p>
          <p>We have no control over and assume no responsibility for the content, privacy policies or practices of any third party sites or services.</p>

          <h3>Changes to this Privacy Policy</h3>
          <p>We may update our Privacy Policy from time to time. We will notify You of any changes by posting the new Privacy Policy on this page.</p>
          <p>We will let You know via email and/or a prominent notice on Our Service, prior to the change becoming effective and update the "Last updated" date at the top of this Privacy Policy.</p>
          <p>You are advised to review this Privacy Policy periodically for any changes. Changes to this Privacy Policy are effective when they are posted on this page.</p>

          <h3>Contact Us</h3>
          <p>If you have any questions about this Privacy Policy, You can contact us:</p>
          <ul>
            <li>By email: reservations@hoteldefides.com</li>
            <li>By visiting this page on our website: hoteldefides.com</li>
          </ul>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-primary btn-link" data-dismiss="modal">Okay</button>
        </div>
      </div>
    </div>
  </div>

  <!-- terms modal -->
  <div class="modal fade" id="terms" tabindex="-1" role="dialog">
    <div class="modal-dialog modal-lg">
      <div class="modal-content">
        <div class="modal-header no-border-header pb-0">
          <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
          <h3 class="mt-0">Terms and Conditions</h3>
        </div>
        <div class="modal-body">
          <ul class="text-justify">
            <li class="mb-2">Front Desk is available 24/7. Check-in time is at 2:00 PM and check out time is at 12:00 NN. Early check-in or late check-out is subject to additional charges. Early check-in and late check-out are available on requests subject to room availability and occupancy level on the day. Please check with the hotel's Front Desk Associate at least 24 hours prior to your intended check-out time on availability of late check-out. A charge of Php 560.00 fee will be charged for early check-in after 10:00 AM and late check-out before 3:00 PM. A full day room charge will be applied for early check-in before 10:00 AM and late check-out after 3:00 PM.</li>
            <li class="mb-2">Housekeeping Department closes at 12:00 midnight. MAKE-UP ROOM IS AVAILABLE UPON REQUEST ONLY.</li>
            <li class="mb-2">De Fides Resto opens from 7:00 AM - 9:00 PM and breakfast is from 7:00 AM - 10:00 AM (breakfast can be served earlier upon request).</li>
            <li class="mb-2">Pool opens at 8:00 AM - 9:00 PM only. All guests using the pool should wear proper swimming attire and shower first before entering the pool. Unaccompanied children under 12 years old are not allowed in the pool. White towels are not allowed outside the room (pool towels are available upon requests).</li>
            <li class="mb-2">All deliveries (food and otherwise) as well as guests’ visitor(s) must be coordinated at the Front Office. Visitor(s) is/are allowed until 8:30 PM local time. Visitor(s) staying beyond the allowed time should pay the additional charges.</li>
            <li class="mb-2">Gues\t rooms in total disarray or waste strewn every corner in the room is subject to maintenance and cleaning fee of Php 2,500.00.</li>
            <li class="mb-2">All rooms and public areas are non-smoking (including vape), a penalty of Php 2,500.00 will be imposed in case of violation (please ask designated smoking areas from the front desk or housekeeping).</li>
            <li class="mb-2">Damages to mattresses and linens (towels, duvet covers, pillow cases, etc.) resulting from blood stains, oils (from massage or other oils), food stains, wines, make-up, hair color, shoe polish, etc. will result to extra charges for the special cleaning or replacement of stained/damaged items (inquire from the Front Desk)</li>
            <li class="mb-2">Pets are not allowed inside the hotel.</li>
            <li class="mb-2"><?= TITLE ?> is not responsible for any valuables and money left unlocked and outside the individual safe, including those in the guest's rooms and public areas. We have provided safety deposit boxes available for use in every rooms.</li>
            <li class="mb-2">Please observe silence, we hope you do not bother other guests. If more than 3 warnings have been issued, the hotel thru our security personnel has the authority to ask the guests to vacate the rooms.</li>
          </ul>
          <h4 class="mt-3">Extra bed and extra person</h4>
          <ul>
            <li>Extra bed is at additional cost of Php 1,000 per night with breakfast.</li>
            <li>Extra person is at additional cost of Php 700 per night without breakfast.</li>
            <li>Below 12 years old is free.</li>
          </ul>
          <h4 class="mt-3">Reservation Policy</h4>
          <ul>
            <li>We will require a 25% advance payment of the total room cost.</li>
            <li>Extension request of stay must be requested at the Front Desk at least 24 hours prior to check-out date subject to room availability.</li>
          </ul>
          <h4 class="mt-3">Payment Policy</h4>
          <ul>
            <li>A non-refundable payment of 25% of the total room cost is required to reserve your preferred date. If payment of the reservation fee has not been made within 3 days your reservation automatically expires. Remaining balance should be settled upon check-in.</li>
            <li>Check payments must be made payable to JACO and JULS Hotel and Restaurant Corp. Cheques can be deposited to our bank accounts.</li>
            <li>You can pay thru GCash or Bank Deposit with the following details:</li>
            <?php if (isset($payment_details)): ?>
              <?php foreach ($payment_details as $type => $details): ?>
                <strong>For <?= $details['label'] ?>:</strong>
                <ul>
                  <li>Account Name: <strong><?= $details['name'] ?></strong></li>
                  <li>Account Number: <strong><?= $details['number'] ?></strong></li>
                </ul>
              <?php endforeach; ?>
            <?php else: ?>
              <!-- Fallback if config not loaded (should not happen) -->
              <p>Please check your email for payment details.</p>
            <?php endif; ?>
          </ul>
          <h4 class="mt-3">Cancellation Policy</h4>
          <h6>Cancellation charge will apply as below:</h6>
          <ol>
            <li>All payments received by the <?= TITLE ?> is <b>NON-REFUNDABLE.</b></li>
            <li>If cancelled or a no-show, 80% of the first night's room cost will be charged.</li>
            <li>Modification of booking can be done anytime and free of charge.</li>
            <li>Any cancellation fees are determined by the property.</li>
          </ol>
          <i><?= TITLE ?> reserves the right to cancel / release the bookings which have not been paid on the cut-off time of 6:00 PM on the arrival day without prior notice unless specified as late arrival.</i>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-primary btn-link" data-dismiss="modal">Okay</button>
        </div>
      </div>
    </div>
  </div>
</body>

<script type="text/javascript" src="<?= base_url('assets/js/core/jquery.min.js') ?>"></script>
<script type="text/javascript" src="<?= base_url('assets/js/core/bootstrap.min.js') ?>"></script>
<script type="text/javascript" src="<?= base_url('assets/js/core/popper.min.js') ?>"></script>
<script type="text/javascript" src="<?= base_url('assets/js/paper-kit.min.js') ?>"></script>
<script type="text/javascript" src="<?= base_url('assets/js/plugins/moment.min.js') ?>"></script>
<script type="text/javascript" src="<?= base_url('assets/js/plugins/bootstrap-datetimepicker.js') ?>"></script>
<script type="text/javascript" src="<?= base_url('assets/js/plugins/jquery.dataTables.min.js') ?>"></script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@9"></script>
<script type="text/javascript" src="<?= base_url('assets/js/functions.js') ?>"></script>


<script type="text/javascript">
  const base_url = '<?= base_url() ?>';
  let booking_number;
  const payment_details = <?= json_encode($payment_details ?? []) ?>;

  $(document).ready(function() {
    // ---------------------- CALENDAR ---------------------- //
    $('.datetimepicker').datetimepicker({
      inline: true,
      sideBySide: false,
      icons: {
        time: "fa fa-clock-o",
        date: "fa fa-calendar",
        up: "nc-icon nc-minimal-up",
        down: "nc-icon nc-minimal-down",
        previous: 'nc-icon nc-minimal-left',
        next: 'nc-icon nc-minimal-right',
        today: 'fa fa-screenshot',
        clear: 'fa fa-trash',
        close: 'fa fa-remove'
      },
      format: 'L'
    });

    $("th[title='Select Decade']").click(function(e) {
      e.stopPropagation();
    });

    $('#checkin').on('dp.change', function(e) {
      checkin = e.date._d;
      checkout = moment(e.date).add(1, 'days');
      $('#checkout').data('DateTimePicker').minDate(checkout);
      $('#checkout').data('DateTimePicker').date(checkout);
      getNights(checkin, checkout);
    });
    $('#checkout').on('dp.change', function(e) {
      checkout = e.date._d;
      checkin = $('#checkin').data('DateTimePicker').date()._d;
      getNights(checkin, checkout);
    });
    $('#checkin').data('DateTimePicker').minDate(new Date());
    // ---------------------- CALENDAR ---------------------- //

    // ----------------------- WIZARD ----------------------- //

    $('#complete').click(function() {
      const first_name = $('#first').val();
      const middle_name = $('#middle').val();
      const last_name = $('#last').val();
      const suffix = $('#suffix').val();
      const email = $('#email').val();
      const contact = $('#phone').val();
      const check_in = $('.checkinDate').val();
      const check_out = $('.checkoutDate').val();
      const nights = $('.nights').val();
      const room_id = $('.room_id').val();
      const request = $('#special').val();
      const company_name = '';
      const booking_type = 'Reservation';
      const reservation_type = 'Online';
      const payment_option = $('[name=payment_option]:checked').val();

      if (!first_name || !last_name || !email || !contact) {
        Swal.fire({
          icon: 'error',
          title: 'Incomplete form',
          text: 'Please fillup the required fields.',
        });
      } else {
        $.ajax({
          url: `${base_url}index.php/booking/book`,
          type: 'post',
          data: {
            first_name,
            middle_name,
            last_name,
            suffix,
            contact,
            email,
            check_in,
            check_out,
            nights,
            room_id,
            request,
            company_name,
            booking_type,
            payment_option,
            reservation_type,
          },
          success: function(response) {
            const name = `${first_name} ${middle_name} ${last_name} ${suffix}`;
            $('#w4').removeClass('invalid');
            $('#w4').click();
            $('#w1').addClass('invalid');
            $('#w2').addClass('invalid');
            $('#w3').addClass('invalid');
            $('.name').val(name);
            $('.email').val(email);
            $('.phone').val(contact);
            $('.overlay').hide();
            $('.last_name').text(last_name);
            $('.email_address').text(email);
            $('#td_booking').text(response);
            $('#td_guest').text(name);
            $('#td_email').text(email);
            $('#td_contact').text(contact);
            $('#td_arrival').text(check_in);
            $('#td_departure').text(`${check_out}`);
            $('#td_nights').text(`${nights} ${nights == 1 ? 'night' : 'nights'}`);
            $('#td_option').text('GCash/Card');
            $('.verified').show();
          },
          beforeSend: function() {
            $('.overlay').show();
          },
          error: function(error) {
            $('.overlay').hide();
            console.log(error)
          }
        });
      }
    });

    forPayment = '';

    $(document).on('click', '.btn-modal', function() {
      forPayment = this.id;
    });

    $('#search').click(function() {
      $('#w2').click();
    });

    $('#gow1').click(function() {
      $('#w1').click();
    });

    $('#gow2').click(function() {
      $('#w2').click();
    });

    let minimum = 0;

    $('#btn-yes').click(function() {
      $('#w3').removeClass('invalid');
      forPayment = forPayment.split('//');
      $('.room_id').val(forPayment[0]);
      $('.roomType').val(forPayment[1]);
      $('#td_room_type').text(forPayment[1]);
      $('.occupancy').val(forPayment[2]);
      total = $('.nights').val() * forPayment[3];
      if (total == 0) {
        total = forPayment[3]
        minimum = 0.25 * forPayment[3];
      } else {
        minimum = 0.25 * total;
      }
      total = `₱ ${formatNumber(total + '.00')}`;
      minimum = `₱ ${formatNumber(minimum + '.00')}`;
      $('.total').val(total);
      $('#td_rate').text(total);
      $('#td_amount').text(minimum);
      $('#w3').click();
      $('#btn-no').click();
    });

    $('#w1').click(function() {
      if ($(this).hasClass('invalid')) return;
      $('.wizard-btn').removeClass('active');
      $(this).addClass('active');
      $('.wizards').hide();
      $('#wizard1').show();
    });

    $('#w2').click(function() {
      $('.overlay').show();
      const check_in = moment($('#checkin').data('DateTimePicker').date()._d).format('YYYY-MM-DD');
      const check_out = moment($('#checkout').data('DateTimePicker').date()._d).format('YYYY-MM-DD');
      fetch(base_url + 'index.php/booking/getAvailableRoomTypes/' + check_in + '/' + check_out)
        .then(res => res.json())
        .then(res => {
          $('#rooms_div').html('');
          res.forEach((room, i) => {
            console.log(room.room_id)
            const html = `
              <div class="row">
                <div class="col-md-5">
                  <img src="${base_url}assets/img/rooms/${room.upload_file}" style="width: 100%">
                </div>
                <div class="col-md-7 text-light">
                  <h6 class="text-green mb-3">${room.room_type}</h6>
                  <p><span class="text-dark">Max occupancy: </span><span class="text-green">${room.max_persons} Person(s)</span></p>
                  <p><span class="text-dark">Room Price: </span><span class="text-green">₱ ${formatNumber(room.pricing_type)}.00</span></p>
                  <p><span class="text-dark">Breakfast-Included for </span><span class="text-green">${room.breakfast} Person(s)</span></p>
                  <p>
                    <span class="text-dark">Room Details: </span>
                    <span class="text-green">
                      <a href="javascript:" class="modalView" details="${room.details}" amenities="${room.amenities}">View</a>
                    </span>
                  </p>
                  <p><span class="text-dark">Availability: </span><span class="text-green">${room.available ? '✔️ Available' : '⏳ Unavailable'}</span></p>
                  <div class="row mt-4">
                    <div class="col-md-12">
                      <button type="button" class="btn btn-green rounded-0 w100 btn-modal" data-toggle="modal" data-target="#modalAlert" id="${room.room_id}//${room.room_type}//${room.max_persons}//${room.pricing_type}" ${room.available  ? '' : 'disabled'}><i class="nc-icon nc-check-2"></i> SELECT THIS ROOM </button>
                    </div>
                  </div>
                </div>
              </div>
              ${res.length ? '<hr class="border">' : ''}
            `;
            $('#rooms_div').append(html);
          });

          if ($(this).hasClass('invalid')) return;
          $('.checkinDate').val(moment($('#checkin').data('DateTimePicker').date()._d).format('MM/DD/YYYY'));
          $('.checkoutDate').val(moment($('#checkout').data('DateTimePicker').date()._d).format('MM/DD/YYYY'));
          $('.wizard-btn').removeClass('active');
          $(this).addClass('active');
          $('.wizards').hide();
          $('#wizard2').show();
          $('.overlay').hide();
        });
    });

    $('#w3').click(function(e) {
      if ($(this).hasClass('invalid')) return;
      $('.wizard-btn').removeClass('active');
      $(this).addClass('active');
      $('.wizards').hide();
      $('#wizard3').show();
    });

    $('#w4').click(function() {
      if ($(this).hasClass('invalid')) return;
      $('.wizard-btn').removeClass('active');
      $(this).addClass('active');
      $('.wizards').hide();
      $('#wizard4').show();
    });

    // ----------------------- WIZARD ----------------------- //
  });

  function getNights(checkin, checkout) {
    let days = (checkout - checkin) / 60 / 60 / 24 / 1000;
    days = Math.round(days);
    const label = days == 1 ? 'night' : 'nights';
    $('#days').text(moment(checkin).format('MMMM D, YYYY') + ' - ' + moment(checkout).format('MMMM D, YYYY') + ' (' + days + ' ' + label + ')');
    $('.nights').val(days);
  }

  $(document).on('click', '.modalView', function() {
    const details = $(this).attr('details');
    const amenities = $(this).attr('amenities');
    $('.modal-details').text(details);
    $('.modal-amenities').text(amenities);
    $('#modalView').modal('show');
  });

  $('[name=payment_option]').change(function() {
    let method = $(this).val();

    let details = payment_details[method];
    if (details) {
      $('#method').val(details.label);
      $('#name').val(details.name);
      $('#number').val(details.number);
    }
  });

  $(document).on("input", ".numeric", function() {
    this.value = this.value.replace(/\D/g, '');
  });

  $('#chkterms').change(function() {
    if ($(this).is(':checked')) {
      $('#complete').removeAttr('disabled');
    } else {
      $('#complete').attr('disabled', true);
    }
  });
</script>

<script>
  let element = $("#imageDIV");
  let getCanvas;
  $('document').ready(function() {
    html2canvas(element, {
      onrendered: function(canvas) {
        $("#previewImage").append(canvas);
        getCanvas = canvas;
      }
    });
  });
  $("#download").on('click', function() {
    var imageData = getCanvas.toDataURL("image/png");
    var newData = imageData.replace(/^data:image\/png/, "data:application/octet-stream");
    $("#download").attr("download", booking_number + ".png").attr("href", newData);
  });
</script>

</html>