 <!-- ======= Footer ======= -->
 <footer id="footer" class="footer">

<div class="container">
  <div class="row gy-4">
    <div class="col-lg-5 col-md-12 footer-info">
      <a href="./" class="logo d-flex align-items-center">
        <span>Smart Campus</span>
      </a>
      <p>Smart Campus, the ultimate solution to stress-free schooling.</p>
      <div class="social-links d-flex mt-4">
        <a href="#" class="twitter"><i class="bi bi-twitter"></i></a>
        <a href="#" class="facebook"><i class="bi bi-facebook"></i></a>
        <a href="#" class="instagram"><i class="bi bi-instagram"></i></a>
        <a href="#" class="linkedin"><i class="bi bi-linkedin"></i></a>
      </div>
    </div>

    <div class="col-lg-2 col-6 footer-links">
      <h4>Useful Links</h4>
      <ul>
        <li><a href="./">Home</a></li>
        <li><a href="./about.php">About us</a></li>
        <li><a href="./services.php">Services</a></li>
        <li><a href="#">Terms of service</a></li>
        <li><a href="#">Documentation</a></li>
      </ul>
    </div>

    <div class="col-lg-2 col-6 footer-links">
      <h4>Our Services</h4>
      <ul>
        <li><a href="intro.php">Donate Pdf</a></li>
        <li><a href="intro.php">Hostel Finder</a></li>
        <li><a href="intro.php">Room Mate Finder</a></li>
        <li><a href="intro.php">Easy Learn Tutorial</a></li>
        <li><a href="intro.php">Download Pdf</a></li>
      </ul>
    </div>

    <div class="col-lg-3 col-md-12 footer-contact text-center text-md-start">
      <h4>Contact Us</h4>
      <p>
        Faalex, Oye-Ekiti, <br>
        Ekiti State,<br>
        Nigeria.<br><br>
        <strong>Phone:</strong> +234 9048480552<br>
        <strong>Email:</strong> info@smartcampus.com.ng<br>
      </p>

    </div>

  </div>
</div>

<div class="container mt-4">
  <div class="copyright">
    &copy; Copyright <strong><span>Smart Campus</span></strong>. All Rights Reserved
  </div>
 
</div>

</footer><!-- End Footer -->
<!-- End Footer -->

<a href="#" class="scroll-top d-flex align-items-center justify-content-center"><i class="bi bi-arrow-up-short"></i></a>

<div id="preloader"></div>

<!-- Vendor JS Files -->
<script src="assets/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
<script src="assets/vendor/purecounter/purecounter_vanilla.js"></script>
<script src="assets/vendor/glightbox/js/glightbox.min.js"></script>
<script src="assets/vendor/swiper/swiper-bundle.min.js"></script>
<script src="assets/vendor/aos/aos.js"></script>
<script src="assets/vendor/php-email-form/validate.js"></script>


<!-- Template Main JS File -->
<script src="assets/js/main.js"></script>
<script>
  $(document).ready(function(){
	// Add animation to hostel panels when hovering
	$(".panel").hover(
		function(){
			$(this).addClass("panel-info");
			$(this).find(".btn").addClass("btn-info");
		},
		function(){
			$(this).removeClass("panel-info");
			$(this).find(".btn").removeClass("btn-info");
		}
	);
});

</script>

</body>

</html>