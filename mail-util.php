<?php

/**
 * External library
 * Using the PHP Mailer from https://github.com/PHPMailer/PHPMailer
 */

use PHPMailer\PHPMailer\PHPMailer;

require_once './PHPMailer/src/PHPMailer.php';
require_once './PHPMailer/src/Exception.php';
require_once './PHPMailer/src/SMTP.php';

function sendEmail($to, $name, $title, $message) {
    $mail = new PHPMailer(true);

    $mail->isSMTP();
    $mail->Host = 'smtp.googlemail.com';  //gmail SMTP server
    $mail->SMTPAuth = true;
    $mail->Username = 'michiel.swaanen.gsm@gmail.com';   //username
    $mail->Password = 'qf#QWJAe76Sp^I27wTDEFWATB60@z5';   //password
    $mail->SMTPSecure = 'ssl';
    $mail->Port = 465;                    //SMTP port

    $mail->setFrom('noreply@fuiver.com', 'Fuiver');
    $mail->addAddress($to, $name);

    $mail->isHTML(true);

    $mail->Subject = $title;
    $mail->Body = $message;
    $mail->send();
}

?>