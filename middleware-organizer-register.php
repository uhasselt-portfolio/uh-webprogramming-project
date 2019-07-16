<?php

session_start();

require_once "./app/core/Handle.php";
require_once "./app/models/Organizer.php";

Handle::authentication("account", Popups::mustBeAuthenticated(), "login.php");

Handle::requiredParameters([$_POST['organizerName'], $_POST['phone'], $_POST['email']], Popups::requiredField(), "organizer-register.php");

$accountID = $_SESSION['account']->account_id;
$name = $_POST['organizerName'];
$phone = $_POST['phone'];
$email = $_POST['email'];

Organizer::register($accountID, $name, $phone, $email);
$organizer = Organizer::getOrganizer($accountID);

$_SESSION['organizer'] = $organizer;

Handle::redirect("organizer-register.php");

?>