<style>

.form-control
{
border-style:outset;
border-color:#033B4A;

}
.col-xs-4
{
color:#033B4A;
}
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
  opacity:0.7; !important
}
</style>
<?php include 'includes/session.php'; ?>
<?php
  if(isset($_SESSION['user'])){
    header('location: cart_view.php');
  }
?>
<?php include 'includes/header.php'; ?>
<body class="hold-transition login-page" >
<div class="login-box">
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
    ?>
  	<div class="login-box-body">
    	<p class="login-box-msg"  style="background: #SAFBFF; font-size:20px;color:#033B4A;">Sign in to start your session</p>

    	<form action="verify.php" method="POST">
      		<div class="form-group has-feedback">
        		<input type="email" class="form-control" name="email" placeholder="Email" required>
        		<span class="glyphicon glyphicon-envelope form-control-feedback" style="color:#033B4A"></span>
      		</div>
          <div class="form-group has-feedback">
            <input type="password" class="form-control" name="password" placeholder="Password" required>
            <span class="glyphicon glyphicon-lock form-control-feedback" style="color:#033B4A"></span>
          </div>
      		<div class="row" style="color:white">
    			<div class="col-xs-4" style="color:#9DABAF">
          			<button type="submit" class="btn" name="login" style="color:white;padding:auto;"><i class="fa fa-pencil" style="color:white" ></i> Sign In</button>

        		</div>
      		</div>

    	</form>
      <br>
      <!--<a href="password_forgot.php" style="color:#033B4A;">I forgot my password</a><br>-->
      <a href="signup.php" class="text-center" style="color:#033B4A">Register a new membership</a><br>
      <a href="index.php" style="color:#033B4A"><i class="fa fa-home" style="color:#033B4A"></i> Home</a>
  	</div>
</div>

<?php include 'includes/scripts.php' ?>

</body>
