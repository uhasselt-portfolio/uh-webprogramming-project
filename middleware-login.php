<?php

session_start();

require_once "./app/models/Accounts.php";
require_once "./app/models/Organizer.php";
require_once "./app/core/Handle.php";

Handle::requiredParameters([$_POST['email'], $_POST['password']], Popups::requiredField(), "login.php");

$email = $_POST['email'];
$hashedPassword = hash("sha256", $_POST['password']);

$isValid = Accounts::isValidLogin($email, $hashedPassword);

if (!$isValid)
    Handle::setPopup(Popups::wrongLoginCredentials());
else {
    $_SESSION['account'] = Accounts::getAccount($email);
    $accountID = $_SESSION['account']->account_id;

    $isOrganizer = Accounts::isOrganizer($accountID);

    if($isOrganizer)
        $_SESSION['organizer'] = Organizer::getOrganizer($accountID);
}

Handle::redirect('login.php');
?>