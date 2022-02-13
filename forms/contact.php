<?php
/*
 * Date          User            Desc
 * 1/21/22       cpalmer         created page
 * 2/11/22       cpalmer         refactor to use DB constructor and visit methods 
 * 
 */
//read input from POST
$first_name = filter_input(INPUT_POST, 'name');
$email_address = filter_input(INPUT_POST, 'email');
$contact_reason = filter_input(INPUT_POST, 'subject');
$contact_message = filter_input(INPUT_POST, 'message');

//validate input
if ($first_name == null || $email_address == null || 
        $contact_reason == null || $contact_message == null) {
    $error = "Invalid :P Try Again..";
    echo "Form Data Error: " . $error;
    exit();
} else {
    //data is valid. define pdo $ insert data.
    try {  
//        $dsn = 'mysql:host=localhost;dbname=dsr';
//        $username = 'cpalmer';
//        $password = 'Pa$$w0rd';
//        $db = new PDO($dsn, $username, $password);
        require_once ('.model/database.php');
        require_once ('.model/visit.php');
//        $db = Database::getDB();
        addVisit($first_name, $email_address, $contact_reason, $contact_message);
    } catch (PDOException $ex) {
        $error_message = $e->getMessage();
        echo 'DB Error: ' . $error_message;
    }
    // add to database - QUER | PEREPARE | BIND | EXECUTE | CLOSE
     
    $query = 'INSERT INTO contact
	(first_name, email_address, contact_reason, contact_message, contact_date, contractor_id)
        VALUES (:name, :email, :subject, :message, NOW(), 1)';
       $statement = $db->prepare($query);
        $statement->bindValue(':name', $first_name);
        $statement->bindValue(':email', $email_address);
        $statement->bindValue(':subject', $contact_reason);
        $statement->bindValue(':message', $contact_message);
        $statement->execute();
        $statement->closeCursor();
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta content="width=device-width, initial-scale=1.0" name="viewport">

  <title>Dreamscape Retreats</title>
  <meta content="" name="description">
  <meta content="" name="keywords">

  <!-- Favicons -->
  <link href="assets/img/favicon.png" rel="icon">
  <link href="assets/img/apple-touch-icon.png" rel="apple-touch-icon">

  <!-- Google Fonts -->
  <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,300i,400,400i,600,600i,700,700i|Playfair+Display:ital,wght@0,400;0,500;0,600;0,700;1,400;1,500;1,600;1,700|Poppins:300,300i,400,400i,500,500i,600,600i,700,700i" rel="stylesheet">

  <!-- Vendor CSS Files -->
  <link href="assets/vendor/animate.css/animate.min.css" rel="stylesheet">
  <link href="assets/vendor/aos/aos.css" rel="stylesheet">
  <link href="assets/vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
  <link href="assets/vendor/bootstrap-icons/bootstrap-icons.css" rel="stylesheet">
  <link href="assets/vendor/boxicons/css/boxicons.min.css" rel="stylesheet">
  <link href="assets/vendor/glightbox/css/glightbox.min.css" rel="stylesheet">
  <link href="assets/vendor/swiper/swiper-bundle.min.css" rel="stylesheet">

  <!-- Template Main CSS File -->
  <link href="assets/css/style.css" rel="stylesheet">

  
</head>

<body>

  <!-- ======= Top Bar ======= -->
  <div id="topbar" class="d-flex align-items-center fixed-top">
    <div class="container d-flex justify-content-center justify-content-md-between">

      <div class="contact-info d-flex align-items-center">
        <i class="bi bi-phone d-flex align-items-center"><span>(208) 965-4389</span></i>
        <i class="bi bi-envelope d-flex align-items-center ms-4"><span> info@dreamscaperetreats.com</span></i>
      </div>
    </div>
  </div>

  <!-- ======= Header ======= -->
  <header id="header" class="fixed-top d-flex align-items-center">
    <div class="container-fluid container-xl d-flex align-items-center justify-content-lg-between">

      <h1 class="logo me-auto me-lg-0"><a href="index.html">Dreamscape Retreats</a></h1>

      <nav id="navbar" class="navbar order-last order-lg-0">
        <ul>
          <li><a class="nav-link scrollto active" href="#hero">Home</a></li>
          <li><a class="nav-link scrollto" href="#about">About</a></li>
          <li><a class="nav-link scrollto" href="#events">Experiences</a></li>
          <li><a class="nav-link scrollto" href="#book-a-stay">Booking</a></li>
          <li><a class="nav-link scrollto" href="#contact">Contact</a></li>
        </ul>
        <i class="bi bi-list mobile-nav-toggle"></i>
      </nav><!-- .navbar -->

    </div>
  </header><!-- End Header -->

  <!-- ======= Hero Section ======= -->
  <section id="hero" class="d-flex align-items-center">
    <div class="container position-relative text-center text-lg-start" data-aos="zoom-in" data-aos-delay="100">
      <div class="row">
        <div class="col-lg-8">
          <h1>Thank you <span><?php echo $first_name; ?></span> for your submission. We will respond as soon as possible</h1>
          <h2>Your dream experience awaits</h2>

          <div class="btns">
            <a href="#book-a-stay" class="btn-book animated fadeInUp scrollto">Book <span>your</span> retreat</a>
          </div>
        </div>
      </div>
    </div>
  </section><!-- End Hero -->

  <main id="main">

   

  </main><!-- End #main -->

  <!-- ======= Footer ======= -->
  <footer id="footer">
    <div class="footer-top">
      <div class="container">
        <div class="row">

          <div class="col-lg-3 col-md-6">
            <div class="footer-info">
              <h3>Dreamscape Retreats</h3>
              <p>
                Calle 7 <br>
                Aguada, PR 00677, USA<br><br>
                <strong>Phone:</strong> (208) 965-4389<br>
                <strong>Email:</strong> info@dreamscaperetreats.com<br>
              </p>
              <div class="social-links mt-3">
                <a href="#" class="twitter"><i class="bx bxl-twitter"></i></a>
                <a href="#" class="facebook"><i class="bx bxl-facebook"></i></a>
                <a href="#" class="instagram"><i class="bx bxl-instagram"></i></a>
                <a href="#" class="google-plus"><i class="bx bxl-skype"></i></a>
                <a href="#" class="linkedin"><i class="bx bxl-linkedin"></i></a>
              </div>
            </div>
          </div>

          <div class="col-lg-2 col-md-6 footer-links">
            <h4>Useful Links</h4>
            <ul>
              <li><i class="bx bx-chevron-right"></i> <a href="#">Home</a></li>
              <li><i class="bx bx-chevron-right"></i> <a href="#">About us</a></li>
              <li><i class="bx bx-chevron-right"></i> <a href="#">Services</a></li>
              <li><i class="bx bx-chevron-right"></i> <a href="#">Terms of service</a></li>
              <li><i class="bx bx-chevron-right"></i> <a href="#">Privacy policy</a></li>
            </ul>
          </div>

          <div class="col-lg-4 col-md-6 footer-newsletter">
            <h4>Our Newsletter</h4>
            <p>Join our newsletter today</p>
            <form action="" method="post">
              <input type="email" name="email"><input type="submit" value="Subscribe">
            </form>

          </div>

        </div>
      </div>
    </div>

    <div class="container">
      <div class="copyright">
        &copy; Copyright <strong><span>Delusional Web Design</span></strong>. All Rights Reserved
      </div>
      
    </div>
  </footer><!-- End Footer -->

  <div id="preloader"></div>
  <a href="#" class="back-to-top d-flex align-items-center justify-content-center"><i class="bi bi-arrow-up-short"></i></a>

  <!-- Vendor JS Files -->
  <script src="assets/vendor/aos/aos.js"></script>
  <script src="assets/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
  <script src="assets/vendor/glightbox/js/glightbox.min.js"></script>
  <script src="assets/vendor/isotope-layout/isotope.pkgd.min.js"></script>
  <script src="assets/vendor/swiper/swiper-bundle.min.js"></script>

  <!-- Template Main JS File -->
  <script src="assets/js/main.js"></script>

  <!-- Datepicker Files -->
  <link  href="../Dreamscape-Retreats/assets/vendor/hotel-datepicker-4.0.0/hotel-datepicker-4.0.0/dist/css/hotel-datepicker.css" rel="stylesheet"><!-- Optional -->
  <script src="/node_modules/fecha/lib/fecha.js"></script>
  <script src="/Dreamscape-Retreats/assets/vendor/hotel-datepicker-4.0.0/hotel-datepicker-4.0.0/dist/js/hotel-datepicker.min.js"></script>


  
  


</body>

</html>