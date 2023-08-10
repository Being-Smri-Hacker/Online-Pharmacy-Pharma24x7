<?php
	use PHPMailer\PHPMailer\PHPMailer;
	use PHPMailer\PHPMailer\Exception;

	include 'includes/session.php';

	if(isset($_POST['signup'])){
		$firstname = $_POST['firstname'];
		$lastname = $_POST['lastname'];
		$email = $_POST['email'];
		$password = $_POST['password'];
		$repassword = $_POST['repassword'];
		$contactinfo=$_POST['contactinfo'];
		$address=$_POST['address'];

		$_SESSION['firstname'] = $firstname;
		$_SESSION['lastname'] = $lastname;
		$_SESSION['email'] = $email;

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

		if($password != $repassword){
			$_SESSION['error'] = 'Passwords did not match';
			header('location: signup.php');
		}
		else{
			$conn = $pdo->open();

			$stmt = $conn->prepare("SELECT COUNT(*) AS numrows FROM users WHERE email=:email");
			$stmt->execute(['email'=>$email]);
			$row = $stmt->fetch();
			if($row['numrows'] > 0){
				$_SESSION['error'] = 'Email already taken';
				header('location: signup.php');
			}
			else{
				$now = date('Y-m-d');
				$password = password_hash($password, PASSWORD_DEFAULT);

				//generate code
				$set='123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
				$code=substr(str_shuffle($set), 0, 12);


					$stmt = $conn->prepare("INSERT INTO users (email, password, firstname, lastname,activate_code,created_on,contact_info,address,type,status) VALUES (:email, :password, :firstname, :lastname,:code, :now,:phno,:address,:type,:status)");
					$stmt->execute(['email'=>$email, 'password'=>$password, 'firstname'=>$firstname, 'lastname'=>$lastname,'code'=>$code,'now'=>$now,'phno'=>$contactinfo,'address'=>$address,'type'=>0,'status'=>1]);
					$userid = $conn->lastInsertId();
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
						<h2 style="color:#033B4A">Thank you for Registering.</h2>
						<p style="color:#033B4A"><b>Your Account:</b></p>
						<p style="color:#033B4A">Email: <?php echo $email?></p>
						<p style="color:#033B4A">Password: <?php echo $_POST['password']?></p>
						<h4 style="color:#033B4A">You may <a href="login.php" style="color:#033B4A;">Login</a> or go back to <a href="index.php" style="color:#033B4A;">Homepage</a>.</h4>
					</div></body>
<?php


			}
		}
	}
?>
