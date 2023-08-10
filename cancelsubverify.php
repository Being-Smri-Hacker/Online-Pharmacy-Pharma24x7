<?php
	include 'includes/session.php';

	$conn = $pdo->open();
if(isset($_POST['cancelsub']))
{
	$email=$_POST['email'];
  $stmt = $conn->prepare("SELECT COUNT(*) AS numrows FROM subs_user WHERE email=:email");
  $stmt->execute(['email'=>$email]);
  $row = $stmt->fetch();

  if ($row['numrows']==0)
  {
		$_SESSION['error']='You are not a subscriber!';
		header("location:cancelsub.php");
  }
	else {
		
		$stmt = $conn->prepare("DELETE FROM subs_user WHERE email=:email");
	  $stmt->execute(['email'=>$email]);
		?>
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
			<h2 style="color:#033B4A">Your Subscription is Cancelled!!</h2>
			<p style="color:#033B4A"><b>Your will not get any offers or updates anymore!</b></p>
			<h4 style="color:#033B4A">Go to <a href="index.php" style="color:#033B4A;">Homepage</a>.</h4>
		</div></body>
<?php


}
}

?>
