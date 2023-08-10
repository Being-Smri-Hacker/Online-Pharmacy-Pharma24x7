<?php
	use PHPMailer\PHPMailer\PHPMailer;
	use PHPMailer\PHPMailer\Exception;

	include 'includes/session.php';

	if(isset($_POST['subs'])){
		$firstname = $_POST['firstname'];
		$lastname = $_POST['lastname'];
		$email = $_POST['email'];
		$cardno=$_POST['cardinfo'];
		$expiryDate=$_POST['expiryDate'];
		$cvv=$_POST['cvv'];
		$subsamt=$_POST['subs_amt'];

		function validateCreditCardNumber($cardNumber) {
		// Remove any non-digit characters from the card number
		$cardNumber = preg_replace('/\D/', '', $cardNumber);

		// Check if the card number is empty or contains non-digit characters
		if (empty($cardNumber) || !ctype_digit($cardNumber)) {
			return false;
		}

		// Reverse the card number for easier processing
		$reversedCardNumber = strrev($cardNumber);

		// Initialize variables
		$sum = 0;
		$digit = 0;
		$numDigits = strlen($reversedCardNumber);

		// Iterate through each digit
		for ($i = 0; $i < $numDigits; $i++) {
			$digit = intval($reversedCardNumber[$i]);

			// Double every second digit
			if ($i % 2 === 1) {
				$digit *= 2;

				// If the doubled digit is greater than 9, subtract 9
				if ($digit > 9) {
					$digit -= 9;
				}
			}

			// Add the digit to the sum
			$sum += $digit;
		}

		// The card number is valid if the sum is divisible by 10
		return $sum % 10 === 0;
		}

		function validateExpiryDate($expiryDate) {
  $pattern = '/^(0[1-9]|1[0-2])\/\d{4}$/'; // Regular expression pattern for mm/yyyy format

  if (preg_match($pattern, $expiryDate)) {
    $currentYear = date('Y');
    $currentMonth = date('m');

    $parts = explode('/', $expiryDate);
    $month = (int)$parts[0];
    $year = (int)$parts[1];

    if ($year > $currentYear || ($year === $currentYear && $month >= $currentMonth)) {
      // Expiry date is valid
      return true;
    } else {
      // Expiry date is in the past
      return false;
    }
  } else {
    // Invalid format
    return false;
  }
}
function validateCVV($cvv) {
$pattern = '/^[0-9]{3,4}$/'; // Regular expression pattern for 3 or 4 digits

if (preg_match($pattern, $cvv)) {
// CVV is valid
return true;
} else {
// CVV is not valid
return false;
}
}
function encrypt($data) {
  // Implement your encryption logic here
  $encryptedData = base64_encode($data);
  return $encryptedData;
}


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
				header('location: subscriberphno299.php');
			}
			else{


// Usage example

				if (validateCreditCardNumber($cardno)) {

							if (validateExpiryDate($expiryDate)){

									if (validateCVV($cvv)){

										$stmt = $conn->prepare("SELECT COUNT(*) AS numrows FROM users WHERE email=:email");
										$stmt->execute(['email'=>$email]);
										$row = $stmt->fetch();
										if($row['numrows']==0){

											$_SESSION['error'] = 'This Email is not registered with us';
											header('location: subscriberphno299.php');
										}
										else {
											$encryptedccno=encrypt($cardno);
											$encryptedcvv=encrypt($cvv);
											date_default_timezone_set('Asia/Kolkata');
											$sdate=date('Y-m-d H:i:s',time());
											$stmt=$conn->prepare("SELECT id from users where email=:email");
											$stmt->execute(['email'=>$email]);
											$row=$stmt->fetch();
											$userid=$row['id'];

											$stmt=$conn->prepare("INSERT INTO subs_user(email,credit_card_no,expiry_date,cvv,subs_amt,user_id,subs_date) values (:email,:ccno,:ed,:cvv,:subsamt,:userid,:s_date)");
											$stmt->execute(['email'=>$email,'ccno'=>$encryptedccno,'ed'=>$expiryDate,'cvv'=>$encryptedcvv,'subsamt'=>$subsamt,'userid'=>$userid,'s_date'=>$sdate]);
										}
								}
								else {
									$_SESSION['error'] = 'Invalid CVV';
									header('location: subscriberphno299.php');
								}
							}
							else {
								$_SESSION['error'] = 'Invalid expiry date';
								header('location: subscriberphno299.php');
							}
				}
				else {
					$_SESSION['error'] = 'Invalid credit card number';
					header('location: subscriberphno299.php');
				}

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
