<?php 
include"PHPMailer/src/PHPMailer.php";
include"PHPMailer/src/Exception.php";
// include"PHPMailer/src/OAuth.php";
// include"PHPMailer/src/OAuthTokenProvider.php";
include"PHPMailer/src/POP3.php";
include"PHPMailer/src/SMTP.php";
 
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;
class Mailer{
	public function dathangmail($tieude,$noidung,$maildathang){
	// print_r($mail);
		$mail = new PHPMailer(true);
		$mail->CharSet = 'UTF-8';
		try {
		    //Server settings
		    $mail->SMTPDebug = 0;                                 // Enable verbose debug output
		    $mail->isSMTP();                                      // Set mailer to use SMTP
		    $mail->Host = 'smtp.gmail.com';  // Specify main and backup SMTP servers
		    $mail->SMTPAuth = true;                               // Enable SMTP authentication
		    $mail->Username = 'phongnguyenvandiep@gmail.com';                 // SMTP username
		    $mail->Password = 'soonkxczmhqkdjqf';                           // SMTP password 
		    $mail->SMTPSecure = 'tls';                            // Enable TLS encryption, `ssl` also accepted
		    $mail->Port = 587;                                    // TCP port to connect to
		 
		    //Recipients
		    $mail->setFrom('phongnguyenvandiep@gmail.com', 'Mailer');
		    
		    $mail->addAddress($maildathang, 'Kỳ Duyên');     // Add a recipient
            // $mail->addAddress('caonguyenkyduyen17@gmail.com', 'Cao Nguyễn Kỳ Duyên'); 
		  
		    $mail->addCC('phongnguyenvandiep@gmail.com');
		  
		    //Content
		    $mail->isHTML(true);                                  // Set email format to HTML
		    $mail->Subject = $tieude;
		    $mail->Body    = $noidung;
		    // $mail->AltBody = 'This is the body in plain text for non-HTML mail clients';
            // $mail->Subject = 'Test Mail';
		    // $mail->Body    = 'Content';
		    $mail->send();
		    echo 'Message has been sent';

		} catch (Exception $e) {

		    echo 'Message could not be sent. Mailer Error: ', $mail->ErrorInfo;
		}
	}
}
?>