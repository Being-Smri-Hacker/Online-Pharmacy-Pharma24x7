<style>
button {
  background-color:#033B4A ;
  color: white;
  padding: 14px 20px;
  margin: 8px 0;
  border: none;
  cursor: pointer;
  width: 100%;
  opacity: 0.9;
}

button:hover {
  opacity:1;


}
a:hover
{
  opacity:0.7;
}



</style>
<?php include 'includes/session.php'; ?>

<?php include 'includes/header.php'; ?>

<body class="hold-transition register-page" style="background: #SAFBFF;justify-content:center;">
<br>
<br>
<div class="register-box" style="box-shadow: 5px 5px 5px grey;justify-content:center;">
  	<?php
      if(isset($_SESSION['error'])){
        echo "
          <div class='callout callout-danger text-center'>
            <p>".$_SESSION['error']."</p>
          </div>
        ";
        unset($_SESSION['error']);
      }

      if(isset($_SESSION['success'])){
        echo "
          <div class='callout callout-success text-center'>
            <p>".$_SESSION['success']."</p>
          </div>
        ";
        unset($_SESSION['success']);

      }
      $total=$_GET['totalAmount'];
      if ($total>0){
    ?>
  	<div class="register-box-body">
    	<p class="login-box-msg" style="color:#033B4A;font-size:17px;">Payment</p>

    	<form action="payment_check.php" method="POST" >

        <div class="form-group has-feedback">
          <input type="text" class="form-control" name="firstname" placeholder="Firstname"   required>
          <span class="glyphicon glyphicon-user form-control-feedback" style="color:#033B4A"></span>
        </div>

          <div class="form-group has-feedback">
            <input type="text" class="form-control" name="lastname" placeholder="Lastname"   required>
            <span class="glyphicon glyphicon-user form-control-feedback" style="color:#033B4A"></span>
          </div>
          <div class="form-group has-feedback">
            <input type="text" class="form-control" name="cardinfo" placeholder="Credit Card Number"  id="cardinfo" required>
            <span class="glyphicon glyphicon-credit-card form-control-feedback" style="color:#033B4A"></span>
          </div>
          <div class="form-group has-feedback">
            <input type="text" class="form-control" name="expiryDate" placeholder="Expiry Date MM/YYYY"  id="expiryDate" maxlength='7' required>
            <span class="glyphicon glyphicon-calendar form-control-feedback" style="color:#033B4A"></span>
          </div>
          <div class="form-group has-feedback">
            <input type="password" class="form-control" name="cvv" placeholder="CVV"  id="cvv"  required>
            <span class="glyphicon glyphicon-credit-card form-control-feedback" style="color:#033B4A"></span>
          </div>
          <input type="hidden" name="total_amt" value=<?php echo $total ?> >
          <hr>
          <div class="form-group has-feedback">
          <h4 style="color:#033B4A;">Total amount:&#8377;<?php echo $total ?></h4>
        </div>

      		<div class="row" style="color:white">
    			<div class="col-xs-4" style="color:#9DABAF;">
        <button type="submit" class="btn" name="subs" style="color:white;width:10rem" ><i class="fa fa-pencil" style="color:white;" ></i>Pay</button>
        		</div>
      		</div>
    	</form>

      <a href="index.php" style="color:#033B4A;"><i class="fa fa-home" style="color:#033B4A"></i> Home</a>
  	</div>
</div>

<?php include 'includes/scripts.php' ?>
</body>
<?php }
else {?>
  <head>
  <style>
  .boxcen
  {
    position: fixed;
    top: 50%;
    left: 50%;
/* bring your own prefixes */
    transform: translate(-50%, -50%);
    box-shadow:5px 5px 5px grey ;
    padding:20px;
    background-color:white;

  }

  </style>
</head>

  <body style="background:linear-gradient(to top, #e6e9f0 0%, #eef1f5 100%);;">
  <div class="boxcen">
    <h2 style="color:#033B4A">No item in cart!!!!</h2>
    <h4 style="color:#033B4A">Go back to <a href="cart_view.php" style="color:#033B4A;">cart</a></h4>
  </div></body>
<?php } ?>
