[![Code Climate](https://codeclimate.com/github/SvenKortekaas/PHP-SMTP-ContactForm/badges/gpa.svg)](https://codeclimate.com/github/SvenKortekaas/PHP-SMTP-ContactForm) [![Issue Count](https://codeclimate.com/github/SvenKortekaas/PHP-SMTP-ContactForm/badges/issue_count.svg)](https://codeclimate.com/github/SvenKortekaas/PHP-SMTP-ContactForm)

# PHP-SMTP-ContactForm
It is a fully responsive HTML5 - JavaScript contact form. It can send emails with the PHP mail() function or through a SMTP server by making use of the PHPMailer class (https://github.com/phpmailer/phpmailer)<br>
<br><br>
Besides that it also has a built-in anti-spam control. It uses the reCAPTCHA from Google (https://www.google.com/recaptcha/intro/index.html)<br>

# Install
For the reCAPTCHA you need to have a site-key and a secret key and fill it in on index.php at the right place.
<br><br>
Set $SMTPmail to TRUE if you want to use the SMTP mail method. But.. You need to have a SMTP server with the right credentials to make it work. See the code in index.php to change the right fields.
<br><br>
Leave it to FALSE to use the PHP mail() method. Set the right settings for your own email.
<br><br>
You can also change the color scheme in the CSS and add more or less fields in the form in index.php. That is up to you.

# Contact
Name: Sven Kortekaas<br>
Website: https://skortekaas.nl/<br>
PGP Key: E8EB 6D69 6E00 BBC2
