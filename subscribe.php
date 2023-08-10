<?php include 'includes/session.php'; ?>
<?php include 'includes/header.php'; ?>

<style>
body {

background-color:#F6F6F6;
}

.pricing .card {
border: none;
border-radius: 1rem;
transition: all 0.2s;
box-shadow: 0 0.5rem 1rem 0 rgba(0, 0, 0, 0.1);
background-color:white;
margin-top:9rem;
margin-bottom: 9rem;
padding-bottom:1rem;

}

.pricing hr {
margin: 1.5rem 0;
}

.pricing .card-title {
margin: 0.5rem 0;
font-size: 0.9rem;
letter-spacing: .1rem;
font-weight: bold;
}

.pricing .card-price {
font-size: 3rem;
margin: 1rem;
}

.pricing .card-price .period {
font-size: 0.8rem;
}

.pricing ul li {
margin-bottom: 1.5rem;
}

.pricing .text-muted {
opacity: 0.7;
}

.pricing .btn {
margin-bottom:2rem:
font-size: 80%;
border-radius: 5rem;
letter-spacing: .1rem;
font-weight: bold;
padding: 1rem;
opacity: 0.8;
transition: all 0.2s;
width:90%;
background-color:green;

}

/* Hover Effects on Card */

@media (min-width: 992px) {
.pricing .card:hover {
	margin-top: -.25rem;
	box-shadow: 0 0.5rem 1rem 0 rgba(0, 0, 0, 0.3);
}

.pricing .card:hover .btn {
	opacity: 1;
}
}
h2
{
	text-align:center;
	color:white;

}
body{ min-height:100vh; margin:0; position:relative; }
header{ min-height:50px; background:lightcyan; }

/* Trick: */
body {
  position: relative;
}

body::after {
  content: '';
  display: block;
  height: 50px; /* Set same as footer's height */
}


</style>

<body class="hold-transition skin-blue layout-top-nav">

<?php include 'includes/navbar.php'; ?>

	<!-- This snippet uses Font Awesome 5 Free as a dependency. You can download it at fontawesome.io! -->

<h2 style="font-family: 'Montserrat', sans-serif; color: #033B4A">Subscription plans</h2>
<section class="pricing py-5">
  <div class="container">
    <div class="row" style="margin-bottom:auto; !important">
      <!-- Free Tier -->
      <div class="col-lg-4">
        <div class="card mb-5 mb-lg-0">
          <div class="card-body">
            <h5 class="card-title text-muted text-uppercase text-center">Free</h5>
            <h6 class="card-price text-center">&#8377;0<span class="period">/month</span></h6>
            <hr>
            <ul class="fa-ul">
              <li ><span class="fa-li"><i class="fa fa-check"></i></span>Get updates on offers</li>
              <li class="text-muted"><span class="fa-li"><i class="fa fa-times"></i></span>Get 25% off on each purchase</li>
							<li class="text-muted"><span class="fa-li"><i class="fa fa-times"></i></span>Free delivery</li>
              <li class="text-muted"><span class="fa-li"><i class="fa fa-times"></i></span>Get 30% off on lab tests</li>
              <li class="text-muted"><span class="fa-li"><i class="fa fa-times"></i></span>Digitize your medical records in a convenient place</li>
              <li class="text-muted"><span class="fa-li"><i class="fa fa-times"></i></span>Access to Emergency doctor on call</li>
            </ul>
            <div class="d-grid" style="text-align:center;">
              <a href="direct.php" class="btn btn-primary text-uppercase" style="background-color: #033B4A; color: white;">Subscribe now</a>
            </div>
          </div>
        </div>
      </div>
      <!-- Plus Tier -->
      <div class="col-lg-4">
        <div class="card mb-5 mb-lg-0">
          <div class="card-body">
            <h5 class="card-title text-muted text-uppercase text-center">Plus</h5>
            <h6 class="card-price text-center">&#8377;199<span class="period">/month</span></h6>
            <hr>
            <ul class="fa-ul">
							<li><span class="fa-li"><i class="fa fa-check"></i></span>Get updates on offers</li>
              <li><span class="fa-li"><i class="fa fa-check"></i></span>Get 20% off on each purchase</li>
							<li><span class="fa-li"><i class="fa fa-check"></i></span>Free delivery</li>
              <li class="text-muted"><span class="fa-li"><i class="fa fa-times"></i></span>Get 30% off on lab tests</li>
              <li class="text-muted"><span class="fa-li"><i class="fa fa-times"></i></span>Digitize your medical records in a convenient place</li>
              <li class="text-muted"><span class="fa-li"><i class="fa fa-times"></i></span>Access to Emergency doctor on call</li>
            </ul>
            <div class="d-grid" style="text-align:center;">
              <a href="direct199.php" class="btn btn-primary text-uppercase" style="background-color: #033B4A; color: white;">Subscribe now</a>
            </div>
          </div>
        </div>
      </div>
      <!-- Pro Tier -->
      <div class="col-lg-4">
        <div class="card">
          <div class="card-body">
            <h5 class="card-title text-muted text-uppercase text-center">Pro</h5>
            <h6 class="card-price text-center">&#8377;299<span class="period">/month</span></h6>
            <hr>
            <ul class="fa-ul">
							<li><span class="fa-li"><i class="fa fa-check"></i></span>Get updates on offers</li>
              <li><span class="fa-li"><i class="fa fa-check"></i></span>Get 30% off on each purchase</li>
							<li><span class="fa-li"><i class="fa fa-check"></i></span>Free delivery</li>
              <li><span class="fa-li"><i class="fa fa-check"></i></span>Get 30% off on lab tests</li>
              <li><span class="fa-li"><i class="fa fa-check"></i></span>Digitize your medical records in a convenient place</li>
              <li><span class="fa-li"><i class="fa fa-check"></i></span>Access to Emergency doctor on call</li>
            </ul>
            <div class="d-grid" style="text-align:center;">
              <a href="direct299.php" class="btn btn-primary text-uppercase" style="background-color: #033B4A; color: white;">Subscribe now</a>
            </div>
          </div>
        </div>
      </div>
    </div>
		
  </div>
</section>


    <?php include 'includes/footer.php'; ?>
</body>
</html>
<?php include 'includes/scripts.php'; ?>
</html>
