
<?php 

use PHPMailer\PHPMailer\PHPMailer; 
use PHPMailer\PHPMailer\Exception; 

require 'vendor/autoload.php'; 

$mail = new PHPMailer(true); 

try { 
	$mail->SMTPDebug = 2;									 
	$mail->isSMTP();											 
	$mail->Host	 = 'smtp.gmail.com;';					 
	$mail->SMTPAuth = true;							 
	$mail->Username = 'rentanddrive24by7@gmail.com';
	$mail->Password = 'rent@123';
	
	$mail->SMTPSecure = 'tls';							 
	$mail->Port	 = 587; 

		$mail->From = "rentanddrive24by7@gmail.com";
	
		$mail->FromName = "Rent-And-Drive";

	
		 $mail->addAddress($_GET['emailid'] , "user");

	$mail->isHTML(true);								 

	$mail->Subject = 'Rent And Drive'; 
	
	
	$mail->Body =  "OTP for registration is ".$_GET['otp']; 
	
	$mail->AltBody = 'Body in plain text for non-HTML mail clients'; 
	$mail->send(); 
	echo "Mail has been sent successfully!";

		

} catch (Exception $e) { 
	echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}"; 
} 

?> 
