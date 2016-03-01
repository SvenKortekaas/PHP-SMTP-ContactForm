# PHP-SMTP-ContactForm [![Code Climate](https://codeclimate.com/github/SvenKortekaas/PHP-SMTP-ContactForm/badges/gpa.svg)](https://codeclimate.com/github/SvenKortekaas/PHP-SMTP-ContactForm) [![Issue Count](https://codeclimate.com/github/SvenKortekaas/PHP-SMTP-ContactForm/badges/issue_count.svg)](https://codeclimate.com/github/SvenKortekaas/PHP-SMTP-ContactForm) [![License 	GPL-3.0](https://img.shields.io/badge/license-%09GPL--3.0-blue.svg)](https://www.gnu.org/licenses/gpl-3.0-standalone.html) [PHP Version 5.2](https://img.shields.io/badge/PHP%20Version-5.2-blue.svg)
It is a fully responsive HTML5 - JavaScript contact form. It can send emails with the PHP mail() function or through a SMTP server by making use of the PHPMailer class (https://github.com/phpmailer/phpmailer)<br>
<br><br>
Besides that it also has a built-in anti-spam control. It uses the reCAPTCHA from Google (https://www.google.com/recaptcha/intro/index.html)<br>
<br><br>
Minimal PHP Version is 5.2<br>

## Install
For the reCAPTCHA you need to have a site-key and a secret key and fill it in on index.php at the right place.
<br>
For the secret look for this code:<br>
```php
//Set here your GOOGLE RECAPTCHA2 SECRET KEY
$secret = 'GOOGLE RECAPTCHA2 SECRET KEY';
```
<br>
For the site key look for this code:<br>
```html
</div>
<div class="g-recaptcha" data-sitekey="GOOGLE RECAPTCHA2 WEBSITE KEY"></div>
<div>
```
<br><br>
Set $SMTPmail to TRUE if you want to use the SMTP mail method. But.. You need to have a SMTP server with the right credentials to make it work. See the code in index.php to change the right fields.
<br><br>
Leave it to FALSE to use the PHP mail() method. Set the right settings for your own email.
<br>
```php
//Set this to TRUE for SMTP mail otherwise it will use the PHP mail() function
$SMTPmail = FALSE; 
```
<br><br>
You can also change the color scheme in the CSS and add more or less fields in the form in index.php. That is up to you.

## License
Copyright 2016 Sven Kortekaas

This file is part of PHP-SMTP-ContactForm.
 
PHP-SMTP-ContactForm is free software: you can redistribute it and/or modify
it under the terms of the GNU General Public License as published by
the Free Software Foundation, either version 3 of the License, or
(at your option) any later version.

PHP-SMTP-ContactForm is distributed in the hope that it will be useful,
but WITHOUT ANY WARRANTY; without even the implied warranty of
MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
GNU General Public License for more details.

You should have received a copy of the GNU General Public License
along with PHP-SMTP-ContactForm.  If not, see <http://www.gnu.org/licenses/>.

## Contact
Name: Sven Kortekaas<br>
Website: https://skortekaas.nl/<br>
PGP Key: E8EB 6D69 6E00 BBC2
