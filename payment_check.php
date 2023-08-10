<?php
	use PHPMailer\PHPMailer\PHPMailer;
	use PHPMailer\PHPMailer\Exception;

	include 'includes/session.php';

	if(isset($_POST['subs'])){
		$firstname = $_POST['firstname'];
		$lastname = $_POST['lastname'];
		$cardno=$_POST['cardinfo'];
		$expiryDate=$_POST['expiryDate'];
		$cvv=$_POST['cvv'];
		$totalamt=$_POST['total_amt'];

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

// Usage example

				if (validateCreditCardNumber($cardno)) {

							if (validateExpiryDate($expiryDate)){

									if (validateCVV($cvv)){
										$payid = "PAY" . uniqid();
										date_default_timezone_set('Asia/Kolkata');
										$date = date('Y-m-d H:i:s',time());
										$status='in progress';
										$stmt = $conn->prepare("INSERT INTO sales (user_id, pay_id, sales_date,sales_amt,status) VALUES (:user_id, :pay_id, :sales_date,:sales_amt,:status)");
										$stmt->execute(['user_id'=>$user['id'], 'pay_id'=>$payid, 'sales_date'=>$date,'sales_amt'=>$totalamt,'status'=>$status]);
										$salesid = $conn->lastInsertId();


										$stmt = $conn->prepare("SELECT * FROM cart LEFT JOIN products ON products.id=cart.product_id WHERE user_id=:user_id");
										$stmt->execute(['user_id'=>$user['id']]);

										foreach($stmt as $row){
											$stmt = $conn->prepare("INSERT INTO details (sales_id, product_id, quantity) VALUES (:sales_id, :product_id, :quantity)");
											$stmt->execute(['sales_id'=>$salesid, 'product_id'=>$row['product_id'], 'quantity'=>$row['quantity']]);

											$stmt=$conn->prepare("SELECT stock from products where id=:product_id");
											$stmt->execute(['product_id'=>$row['product_id']]);
											$new=$stmt->fetch();
											$stock=$new['stock'];

											$stock=$stock-$row['quantity'];
											$stmt=$conn->prepare("UPDATE products set stock=:stock where id=:product_id");
											$stmt->execute(['stock'=>$stock,'product_id'=>$row['product_id']]);

											$stmt=$conn->prepare("SELECT user_id,quantity from cart where product_id=:product_id");
											$stmt->execute(['product_id'=>$row['product_id']]);

											foreach($stmt as $newr)
											{
												if ($newr['quantity']>$stock)
												{
													$stmt=$conn->prepare("UPDATE cart set quantity=:newqty where user_id=:user_id and product_id=:product_id");
													$stmt->execute(['newqty'=>$stock,'user_id'=>$newr['user_id'],'product_id'=>$row['product_id']]);
												}
											}
										}
										$stmt = $conn->prepare("DELETE FROM cart WHERE user_id=:user_id");
										$stmt->execute(['user_id'=>$user['id']]);

								}
								else {
									$_SESSION['error'] = 'Invalid CVV';
									header('location: payment.php?totalAmount='.$totalamt);
								}
							}
							else {
								$_SESSION['error'] = 'Invalid expiry date';
								header('location: payment.php?totalAmount='.$totalamt);
							}
				}
				else {
					$_SESSION['error'] = 'Invalid credit card number';
					header('location: payment.php?totalAmount='.$totalamt);
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
						<h2 style="color:#033B4A">Payment Successful!</h2>
						<h3 style="color:#033B4A">Payment Details</h3>
						<p style="color:#033B4A"><b>First Name:<?php echo $firstname?></p>
						<p style="color:#033B4A"><b>Last Name:<?php echo $lastname?></p>
						<p style="color:#033B4A">Amount: <?php echo $totalamt?></p>
						<h4 style="color:#033B4A">Go to <a href="index.php" style="color:#033B4A;">Homepage</a> or view <a href="profile.php" style="color:#033B4A;">order details</a>.</h4>
					</div></body>
<?php


			}


?>
