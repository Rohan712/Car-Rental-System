<?php
    session_start();
    error_reporting(0);
    include('../includes/config.php');
    if(strlen($_SESSION['alogin'])==0) {	
        header('location:../index.php');
    }
?>
<?php 

use PHPMailer\PHPMailer\PHPMailer; 
use PHPMailer\PHPMailer\Exception; 

require 'vendor/autoload.php'; 

$mail = new PHPMailer(true); 
$useremail=$_SESSION['login'];
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

	
		 $mail->addAddress($useremail, "user");

	$mail->isHTML(true);								 

	$mail->Subject = 'Rent And Drive'; 
	
	$otp = rand(1000,9999);
	$mail->Body =  "OTP for registration is ".$otp; 
	
	$mail->AltBody = 'Body in plain text for non-HTML mail clients'; 
	$mail->send(); 
	echo "Mail has been sent successfully!";

		?> <script>
	window.location.replace("../registration.php");
	</script>
	 
	 <?php

} catch (Exception $e) { 
	echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}"; 
} 
header('Refresh: 0; URL=../booking-confirmed.php');
?> 
