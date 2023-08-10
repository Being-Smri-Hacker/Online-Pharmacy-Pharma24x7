<?php
// Get the phone number from the form submission
$phone = $_POST['phone'];

// Generate a random OTP (replace this with your own OTP generation logic)
$otp = rand(1000, 9999);

// Perform any necessary OTP sending operations here (e.g., sending SMS, email, etc.)
// Replace the following code with your own implementation
// Example using SMS gateway API:

$api_key = 'your_api_key';
$api_url = 'https://api.smsgateway.com/send';

// Prepare the SMS data
$sms_data = array(
    'api_key' => $api_key,
    'phone' => $phone,
    'message' => 'Your OTP is: ' . $otp,
);

// Send the SMS using cURL
$ch = curl_init($api_url);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
curl_setopt($ch, CURLOPT_POSTFIELDS, http_build_query($sms_data));
$response = curl_exec($ch);
curl_close($ch);

if ($response === 'success') {
    // OTP sent successfully
    echo 'success';
} else {
    // Error sending OTP
    echo 'error';
}

?>
``
