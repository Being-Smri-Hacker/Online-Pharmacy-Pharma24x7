<?php
	use PHPMailer\PHPMailer\PHPMailer;
	use PHPMailer\PHPMailer\Exception;

	include 'includes/session.php';

	if(isset($_POST['subs'])){
		$firstname = $_POST['firstname'];
		$lastname = $_POST['lastname'];
		$email = $_POST['email'];
		$subsamt=$_POST['subs_amt'];


		/*if(!isset($_SESSION['captcha'])){
			require('recaptcha/src/autoload.php');
			$recaptcha = new \ReCaptcha\ReCaptcha('6LevO1IUAAAAAFCCiOHERRXjh3VrHa5oywciMKcw', new \ReCaptcha\RequestMethod\SocketPost());
			$resp = $recaptcha->verify($_POST['g-recaptcha-response'], $_SERVER['REMOTE_ADDR']);

			if (!$resp->isSuccess()){
		  		$_SESSION['error'] = 'Please answer recaptcha correctly';
		  		header('location: signup.php');
		  		exit();
		  	}
		  	else{
		  		$_SESSION['captcha'] = time() + (10*60);
		  	}

		}*/



			$conn = $pdo->open();

			$stmt = $conn->prepare("SELECT COUNT(*) AS numrows FROM subs_user WHERE email=:email");
			$stmt->execute(['email'=>$email]);
			$row = $stmt->fetch();
			if($row['numrows'] > 0){
				$_SESSION['error'] = 'You are already a Subscriber';
				header('location: subscriberphnofree.php');
			}
			else{


// Usage example


											$stmt=$conn->prepare("SELECT id from users where email=:email");
											$stmt->execute(['email'=>$email]);
											$row=$stmt->fetch();
											$userid=$row['id'];
											date_default_timezone_set('Asia/Kolkata');
											$sdate=date('Y-m-d H:i:s',time());

											$stmt=$conn->prepare("INSERT INTO subs_user(email,user_id,subs_amt,subs_date) values (:email,:userid,:subsamt,:subs_date)");
											$stmt->execute(['email'=>$email,'userid'=>$userid,'subsamt'=>$subsamt,'subs_date'=>$sdate]);



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
						<h2 style="color:#033B4A">You are a subscriber now!</h2>
						<p style="color:#033B4A"><b>Your will get updates to your mail id</b></p>
						<p style="color:#033B4A">Email: <?php echo $email?></p>
						<h4 style="color:#033B4A">Go to <a href="index.php" style="color:#033B4A;">Homepage</a>.</h4>
					</div></body>
<?php


			}
		}

?>
