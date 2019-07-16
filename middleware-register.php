<?php

require_once "./app/core/Handle.php";
require_once "./app/models/Accounts.php";
session_start();

Handle::requiredParameters([$_POST['email'], $_POST['firstName'], $_POST['lastName']], Popups::requiredField(), "register.php");

$email = $_POST['email'];
$firstName = $_POST['firstName'];
$lastName = $_POST['lastName'];

$isTaken = Accounts::isEmailTaken($email);

if($isTaken) {
    Handle::setPopup(Popups::emailTaken());
}
else {
    $_SESSION['email'] = $email;
    $_SESSION['firstName'] = $firstName;
    $_SESSION['lastName'] = $lastName;
    Handle::redirect("password-setup.php");
}

Handle::redirect("register.php");

?>