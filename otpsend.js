// JavaScript function to send OTP
function sendOTP() {
  var phone = document.getElementById('phone').value;

  // Perform AJAX request to send OTP to the server
  // Replace the following code with your own implementation
  // Example using jQuery:

  $.ajax({
    type: 'POST',
    url: 'send_otp.php',
    data: { phone: phone },
    success: function(response) {
      if (response === 'success') {
        // OTP sent successfully
        alert('OTP sent successfully!');
      } else {
        // Error sending OTP
        alert('Error sending OTP. Please try again.');
      }
    }
  });


  
}
