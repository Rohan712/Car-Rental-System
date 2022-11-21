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
	
	if($_GET['status'] == 1) {
	$mail->Body =  "<div> <h3 style= 'color:green;'>Booking Confirmed </h3><p>Enjoy Your Drive </p></div>"; 
	} else {
		$mail->Body =  "<div> <h3 style= 'color:red;'>Booking cancelled </h3> <p>Sorry booking cancelled, please book another car </p></div>"; 
	}
	$mail->AltBody = 'Body in plain text for non-HTML mail clients'; 
	$mail->send(); 
	echo "Mail has been sent successfully!";
	if($_GET['status'] == 1) {
		?> <script>
	window.location.replace("../booking-confirmed.php");
	</script>
	 <?php
		} else {
			?> <script>
	window.location.replace("../booking-cancelled.php");
	</script>
	 <?php
		} 


} catch (Exception $e) { 
	echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}"; 
} 
header('Refresh: 0; URL=../booking-confirmed.php');
?> 
