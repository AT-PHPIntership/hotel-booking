<?php

if(!$_POST) exit;

// Email address verification, do not edit.
function isEmail($email) {
	return(preg_match("/^[-_.[:alnum:]]+@((([[:alnum:]]|[[:alnum:]][[:alnum:]-]*[[:alnum:]])\.)+(ad|ae|aero|af|ag|ai|al|am|an|ao|aq|ar|arpa|as|at|au|aw|az|ba|bb|bd|be|bf|bg|bh|bi|biz|bj|bm|bn|bo|br|bs|bt|bv|bw|by|bz|ca|cc|cd|cf|cg|ch|ci|ck|cl|cm|cn|co|com|coop|cr|cs|cu|cv|cx|cy|cz|de|dj|dk|dm|do|dz|ec|edu|ee|eg|eh|er|es|et|eu|fi|fj|fk|fm|fo|fr|ga|gb|gd|ge|gf|gh|gi|gl|gm|gn|gov|gp|gq|gr|gs|gt|gu|gw|gy|hk|hm|hn|hr|ht|hu|id|ie|il|in|info|int|io|iq|ir|is|it|jm|jo|jp|ke|kg|kh|ki|km|kn|kp|kr|kw|ky|kz|la|lb|lc|li|lk|lr|ls|lt|lu|lv|ly|ma|mc|md|me|mg|mh|mil|mk|ml|mm|mn|mo|mp|mq|mr|ms|mt|mu|museum|mv|mw|mx|my|mz|na|name|nc|ne|net|nf|ng|ni|nl|no|np|nr|nt|nu|nz|om|org|pa|pe|pf|pg|ph|pk|pl|pm|pn|pr|pro|ps|pt|pw|py|qa|re|ro|ru|rw|sa|sb|sc|sd|se|sg|sh|si|sj|sk|sl|sm|sn|so|sr|st|su|sv|sy|sz|tc|td|tf|tg|th|tj|tk|tm|tn|to|tp|tr|tt|tv|tw|tz|ua|ug|uk|um|us|uy|uz|va|vc|ve|vg|vi|vn|vu|wf|ws|ye|yt|yu|za|zm|zw)$|(([0-9][0-9]?|[0-1][0-9][0-9]|[2][0-4][0-9]|[2][5][0-5])\.){3}([0-9][0-9]?|[0-1][0-9][0-9]|[2][0-4][0-9]|[2][5][0-5]))$/i",$email));
}

if (!defined("PHP_EOL")) define("PHP_EOL", "\r\n");


$email    = $_POST['email'];
$checkin    = $_POST['checkin'];
$checkout    = $_POST['checkout'];
$room    = $_POST['room'];
$adults    = $_POST['adults'];
$children    = $_POST['children'];


if(trim($email) == '') {
	echo '<div class="alert alert-danger alert-dismissable">
  <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>Attention! Please enter a valid email address.</div>';
	exit();
	
} else if(trim($room) == '') {
	echo '<div class="alert alert-danger alert-dismissable">
  <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>Attention! Please enter a your room.</div>';
	exit();
	
	} else if(trim($checkin) == '') {
echo '<div class="alert alert-danger alert-dismissable">
  <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>Attention! Please enter your check-in date.</div>';
exit();

	} else if(trim($checkout) == '') {
echo '<div class="alert alert-danger alert-dismissable">
  <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>Attention! Please enter your check-out date.</div>';
exit();

} else if(!isEmail($email)) {
	echo '<div class="alert alert-danger alert-dismissable">
  <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>Attention! You have enter an invalid e-mail address, try again.</div>';
	exit();
}

if(get_magic_quotes_gpc()) {
	$comments = stripslashes($comments);
}


// Configuration option.
// Enter the email address that you want to emails to be sent to.
// Example $address = "joe.doe@yourdomain.com";

//$address = "example@themeforest.net";
$address = "example@themeforest.net";


// Configuration option.
$e_subject = 'A reservation request by ' . $email . '.';


// Configuration option.
// You can change this if you feel that you need to.
// Developers, you may wish to add more fields to the form, in which case you must be sure to add them here.

$e_body = "Good news! A reservation has been requested by $email 

The customer wants to check-in at: $checkin 
and check-out at: $checkout

The customer requested a $room room for $adults adult(s) and $children child(ren)."  . PHP_EOL . PHP_EOL;

$e_reply = "You can contact the customer via email, $email or hit 'reply' in your email browser to make the reservation complete.";

$msg = wordwrap( $e_body . $e_reply, 70 );

$headers = "From: $email" . PHP_EOL;
$headers .= "Reply-To: $email" . PHP_EOL;
$headers .= "MIME-Version: 1.0" . PHP_EOL;
$headers .= "Content-type: text/plain; charset=utf-8" . PHP_EOL;
$headers .= "Content-Transfer-Encoding: quoted-printable" . PHP_EOL;

if(mail($address, $e_subject, $msg, $headers)) {

	// Email has sent successfully, echo a success page.

	echo "<fieldset>";
	echo "<div id='success_page'>";
	echo "<h1>Reservation sent successfully!</h1>";
	echo "<p>Thank you, your reservation has been submitted to us and we'll contact you as quickly as possible to complete your booking.</p>";
	echo "</div>";
	echo "</fieldset>";

} else {

	echo 'ERROR!';

}