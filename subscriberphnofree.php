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
    ?>
  	<div class="register-box-body">
    	<p class="login-box-msg" style="color:#033B4A;font-size:17px;">Subscribe</p>

    	<form action="subregfree.php" method="POST" >

        <div class="form-group has-feedback">
          <input type="text" class="form-control" name="firstname" placeholder="Firstname"   required>
          <span class="glyphicon glyphicon-user form-control-feedback" style="color:#033B4A"></span>
        </div>

          <div class="form-group has-feedback">
            <input type="text" class="form-control" name="lastname" placeholder="Lastname"   required>
            <span class="glyphicon glyphicon-user form-control-feedback" style="color:#033B4A"></span>
          </div>
      		<div class="form-group has-feedback">
        		<input type="email" class="form-control" name="email" placeholder="Email" required>
        		<span class="glyphicon glyphicon-envelope form-control-feedback" style="color:#033B4A"></span>
      		</div>
          <input type="hidden" name="subs_amt" value=0>
          <hr>
          <div class="form-group has-feedback">
          <h4 style="color:#033B4A;">Subscription amount:&#8377;0</h4>
        </div>
      		<div class="row" style="color:white">
    			<div class="col-xs-4" style="color:#9DABAF;">
        <button type="submit" class="btn" name="subs" style="color:white;width:10rem" ><i class="fa fa-pencil" style="color:white;" ></i>Subscribe</button>
        		</div>
      		</div>
    	</form>

      <a href="index.php" style="color:#033B4A;"><i class="fa fa-home" style="color:#033B4A"></i> Home</a>
  	</div>
</div>

<?php include 'includes/scripts.php' ?>
</body>
