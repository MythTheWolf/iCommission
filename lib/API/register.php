<?php
require_once $_SERVER ['DOCUMENT_ROOT'] . "/lib/PhpMailer/PHPMailerAutoload.php";
require_once $_SERVER ['DOCUMENT_ROOT'] . "/lib/config/MySQL.php";
$mail = new PHPMailer ();
if (empty ( $_POST ['login'] ) || empty ( $_POST ['password'] ) || empty ( $_POST ['email'] ) || empty ( $_POST ['password_confirm'] ) || empty ( $_POST ['gender'] )) {
	die ( "ERR_NUMFIELDS" );
}
if ($_POST ['password'] !== $_POST ['password_confirm']) {
	die ( "ERR_PASSWORDMIX" );
}
$SQL = new MySQL ();
$req = $SQL->getConnection ()->prepare ( "INSERT INTO `Icomission_User` (`email`,`username`,`password`,`gender`) VALUES (?,?,?,?)" );
if (! $req) {
	die ( "Fatal: The SQL prepared statement failed.." );
}
if (! $req->bind_param ( "ssss", $_POST ['email'], $_POST ['login'], sha1 ( $_POST ['password'] ), $_POST ['gender'] )) {
	die ( "error: Could not bind paramaters.." );
}

$mail->isSMTP (); // Set mailer to use SMTP
$mail->Host = 'mail.furryminecraft.com'; // Specify main and backup SMTP servers
$mail->SMTPAuth = true; // Enable SMTP authentication
$mail->Username = 'admin@furryminecraft.com'; // SMTP username
$mail->Password = 'nA@00163827'; // SMTP password // Enable TLS encryption, `ssl` also accepted
$mail->Port = 26; // TCP port to connect to
$mail->addAddress ( $_POST ['email'] );
$mail->isHTML ( true ); // Set email format to HTML
$mail->Subject = 'Here is the subject';
$mail->Body = 'This is the HTML message body <b>in bold!</b>';
$mail->AltBody = 'This is the body in plain text for non-HTML mail clients';
if (! $mail->send ()) {
	echo 'Fatal: The registration email could not be sent. <br />';
	echo "Your registeration was canceled.";
	die ();
} else {
	$req->execute ();
	die();
}