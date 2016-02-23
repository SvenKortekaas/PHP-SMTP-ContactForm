<?php

/**
* 
* It is a fully responsive HTML5 - JavaScript contact form. It can send emails through the PHP mail() function or through a
* SMTP server by making use of the PHPMailer class (https://github.com/phpmailer/phpmailer)
* 
* @license GPL-3.0
* @author Sven Kortekaas - https://skortekaas.nl
* @version 1.0
*
* Copyright 2016 Sven Kortekaas
* 
* This file is part of PHP-SMTP-ContactForm.
* 
* PHP-SMTP-ContactForm is free software: you can redistribute it and/or modify
* it under the terms of the GNU General Public License as published by
* the Free Software Foundation, either version 3 of the License, or
* (at your option) any later version.
* 
* PHP-SMTP-ContactForm is distributed in the hope that it will be useful,
* but WITHOUT ANY WARRANTY; without even the implied warranty of
* MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
* GNU General Public License for more details.
* 
* You should have received a copy of the GNU General Public License
* along with PHP-SMTP-ContactForm.  If not, see <http://www.gnu.org/licenses/>.
* 
*/

//Set this to TRUE for SMTP mail otherwise it will use the PHP mail() function
$SMTPmail = FALSE; 
//If true - don't forget to set the SMTP server credentials
if($SMTPmail) {
	$smtpServer = "smtp.domain.tld"; //Set the hostname of the mail server
	$smtpPort = 25; //Set the SMTP port number - likely to be 25, 465 or 587		
	$smtpAuth = true; //Whether to use SMTP authentication
	//$smtpSecure = "tls"; //Set SSL or TLS
	$smtpUsername = "username@domain.tld"; //Username to use for SMTP authentication
	$smtpPassword = "password"; //Password to use for SMTP authentication
}

if(isset($_POST['submit'])):
    if(isset($_POST['g-recaptcha-response']) && !empty($_POST['g-recaptcha-response'])):
	
		//Set here your GOOGLE RECAPTCHA2 SECRET KEY
		$secret = 'GOOGLE RECAPTCHA2 SECRET KEY';
		
	//Verify the recaptcha
        $verifyResponse = file_get_contents('https://www.google.com/recaptcha/api/siteverify?secret='.$secret.'&response='.$_POST['g-recaptcha-response']);
        $responseData = json_decode($verifyResponse);
		
	//Getting all the values
	$name = !empty($_POST['name'])?$_POST['name']:'';
	$adres = !empty($_POST['adres'])?$_POST['adres']:'';
	$phone = !empty($_POST['phone'])?$_POST['phone']:'';
	$message = !empty($_POST['message'])?$_POST['message']:'';
	$email = !empty($_POST['email'])?$_POST['email']:'';
	$website = !empty($_POST['website'])?$_POST['website']:'';
	
	//The email content
	$htmlContent = "
		<h1>Email body title</h1>
		<p><b>Name: </b>".$name."</p>
		<p><b>Adress: </b>".$adres."</p>
		<p><b>Email: </b>".$email."</p>
		<p><b>Website: </b>".$website."</p>
		<p><b>Telephonenumber: </b>".$phone."</p>
		<p><b>Message: </b>".$message."</p>
	";
	
	//Send the email to this adress
	$to = 'YOUREMAIL@DOMAIN.TLD';
	
	//Put the email subject in here
	$subject = 'EMAIL SUBJECT';
	
	//If the recaptcha verify succeeded continue
        if($responseData->success):
		
		//If SMTPmail is TRUE
		if($SMTPmail) {
			
			/*
			* This will send the email by SMTP making use of the PHPMailer class
			* https://github.com/phpmailer/phpmailer
			* You need to install this on your website
			*/
			
			//SMTP needs accurate times, and the PHP time zone MUST be set
			//This should be done in your php.ini, but this is how to do it if you don't have access to that
			date_default_timezone_set('Etc/UTC');
			
			//Set the right path to PHPMailerAutoload.php
			require 'PHPMailerAutoload.php';
		
			//Create a new PHPMailer instance
			$mail = new PHPMailer;
			
			//Tell PHPMailer to use SMTP
			$mail->isSMTP();
			
			//Enable SMTP debugging
			// 0 = off (for production use)
			// 1 = client messages
			// 2 = client and server messages
			$mail->SMTPDebug = 2;
			
			//Ask for HTML-friendly debug output
			$mail->Debugoutput = 'html';
			
			//Set the hostname of the mail server
			$mail->Host = $smtpServer;
			
			//Set the SMTP port number - likely to be 25, 465 or 587
			$mail->Port = $smtpPort;
			
			//Whether to use SMTP authentication
			$mail->SMTPAuth = $smtpAuth;
			
			//Set SSL or TLS
			//$mail->SMTPSecure = $smtpSecure; 
			
			//Username to use for SMTP authentication
			$mail->Username = $smtpUsername;
			
			//Password to use for SMTP authentication
			$mail->Password = $smtpPassword;
			
			//Set who the message is to be sent from
			$mail->setFrom('username@domain.tld', $name);
			
			//Set who the message is to be sent to
			$mail->addAddress($to, 'John Doe');
			
			//Set who the message is to be sent to in CC
			//$mail->AddCC('email@domain.tld', 'John Doe');
			
			//Set the subject line
			$mail->Subject = $subject;
			
			//Read an HTML message body from an external file, convert referenced images to embedded,
			//convert HTML into a basic plain-text alternative body
			$mail->msgHTML($htmlContent);
			
			//Replace the plain text body with one created manually
			$mail->AltBody = $htmlContent;
			
			//send the message, check for errors
			if (!$mail->send()) {
				$succMsg =  "Something went wrong. Please contact your webmaster. SMTP Mailer Error: " . $mail->ErrorInfo;
			} else {
				$succMsg = "Mailed with succes through SMTP.";
			}
			
			$name = '';
			$adres = '';
			$message = '';
			$phone = '';
			$email = '';
			$url = '';		
		
		} else { //If SMTPmail is FALSE
			
			/*
			* This will send the email with the PHP mail() function
			*/
			
			$headers = "MIME-Version: 1.0" . "\r\n";
			$headers .= "Content-type:text/html;charset=UTF-8" . "\r\n";
			$headers .= 'From:'.$name.' <'.$email.'>' . "\r\n";
			if(mail($to,$subject,$htmlContent,$headers))
			{ 
				$succMsg = 'Mailed with succes with PHP mail()'; 
			} else { 
				$succMsg = 'Something went wrong. Please contact your webmaster. PHP Mail() failed. Returned FALSE.';
			}
			
			$name = '';
			$adres = '';
			$phone = '';
			$message = '';
			$email = '';
			$url = '';
			
		}		
			
        else:
            $errMsg = 'Anti-spam/Robot verification failed. Please try again.';
        endif;
    else:
        $errMsg = 'Check the reCAPTCHA box for anti-spam verification.';
    endif;
else:
	$errMsg = '';
	$succMsg = '';
	$name = '';
	$adres = '';
	$phone = '';
	$message = '';
	$email = '';
	$url = '';
endif;
?>

<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <title>Website title</title>
    <meta name="viewport" content="width=device-width,initial-scale=1.0">
    <meta name="keywords" content="keyword,keyword,keyword,keyword">
    <meta name="description" content="Site description">
    <meta name="author" content="Sven Kortekaas - https://skortekaas.nl/">
    <link href="css/style.css" rel="stylesheet">
    <script src="https://www.google.com/recaptcha/api.js" async defer></script>
</head>

<body>

    <div class="wrapper">
        <div id="main" style="padding:50px 0 0 0;">
            <!-- Form -->
            <form id="contact-form" action="" method="POST">
                <h4><?php if(!empty($errMsg)): ?><div class="errMsg"><?php echo $errMsg; ?></div><?php endif; ?></h4>
                <h4><?php if(!empty($succMsg)): ?><div class="succMsg"><?php echo $succMsg; ?></div><?php endif; ?></h4>
                <h3>Title</h3>
                <h4>Subtitle text.</h4>
                <div>
                    <label>
                        <span>Name: (required)</span>
                        <input name="name" placeholder="Full name" type="text" tabindex="1" required autofocus>
                    </label>
                </div>
                <div>
                    <label>
                        <span>Adress:</span>
                        <input name="adres" placeholder="Your adress" type="text" tabindex="2">
                    </label>
                </div>
                <div>
                    <label>
                        <span>Email: (required)</span>
                        <input name="email" placeholder="Your email" type="email" tabindex="3" required>
                    </label>
                </div>
                <div>
                    <label>
                        <span>Website:</span>
                        <input name="website" placeholder="http://www.yourwebsite.tld" type="url" tabindex="4">
                    </label>
                </div>
                <div>
                    <label>
                        <span>Telephonenumber:</span>
                        <input name="phone" placeholder="Your telephonenumber" type="tel" tabindex="5">
                    </label>
                </div>
                <div>
                    <label>
                        <span>Message:</span>
                        <textarea name="message" placeholder="Your message" tabindex="6"></textarea>
                    </label>
                </div>
                <div class="g-recaptcha" data-sitekey="GOOGLE RECAPTCHA2 WEBSITE KEY"></div>
                <div>
                    <br>
                    <button name="submit" type="submit" id="contact-submit">Send Email</button>
                </div>
                <p><strong>Credits:</strong>
                    <br> Contact form by <a href="https://skortekaas.nl">Sven Kortekaas</a>
                </p>
            </form>
            <!-- /Form -->

        </div>
    </div>

    <script>
        (function() {

            // Create input element for testing
            var inputs = document.createElement('input');

            // Create the supports object
            var supports = {};

            supports.autofocus = 'autofocus' in inputs;
            supports.required = 'required' in inputs;
            supports.placeholder = 'placeholder' in inputs;

            // Fallback for autofocus attribute
            if (!supports.autofocus) {

            }

            // Fallback for required attribute
            if (!supports.required) {

            }

            // Fallback for placeholder attribute
            if (!supports.placeholder) {

            }

            // Change text inside send button on submit
            var send = document.getElementById('contact-submit');
            if (send) {
                send.onclick = function() {
                    this.innerHTML = '...Sending';
                }
            }

        })();
    </script>

</body>

</html>
