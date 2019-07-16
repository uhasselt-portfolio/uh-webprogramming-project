<?php

require_once "./app/models/Accounts.php";
require_once "./app/models/AccountConfirmation.php";
require_once "./app/core/Handle.php";
require_once "./mail-util.php";

session_start();

Handle::requiredParameters([$_POST['password1'], $_SESSION['firstName'], $_SESSION['lastName'], $_SESSION['email']], Popups::requiredField(), "register.php");

$hashedPassword = hash("sha256", $_POST['password1']);
$firstName = $_SESSION['firstName'];
$lastName = $_SESSION['lastName'];
$email = $_SESSION['email'];

Accounts::addNewAccount($firstName, $lastName, $email, $hashedPassword);

$account = Accounts::getAccount($email);
AccountConfirmation::createNewCode($account->account_id);
$confirmation = AccountConfirmation::getConfirmation($account->account_id);

$_SESSION['account'] = $account;

sendEmail($account->email, $account->first_name, "Fuiver - Account Bevestiging",
    "Hallo " . $account->first_name .", bedankt voor je aan te melden bij Fuiver! Jouw code is: ". $confirmation->confirmation_code);

Handle::setPopup(Popups::successfulSendEmail());

Handle::redirect("email-verification.php");

?>