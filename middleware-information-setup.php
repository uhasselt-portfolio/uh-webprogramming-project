<?php

require_once "./app/models/Accounts.php";
require_once "./app/core/Handle.php";

session_start();

Handle::authentication("account", Popups::mustBeAuthenticated(), "login.php");

Handle::requiredParameters([$_POST['dob'], $_POST['city'], $_POST['phone']], Popups::requiredField(), "information-setup.php");

$dob = $_POST['dob'];
$city = $_POST['city'];
$phone = $_POST['phone'];
$account = $_SESSION['account'];

Accounts::updateAdditionalInformation($dob, $city, $phone, $account->account_id);

Accounts::updateSetupProcess($account->account_id, 'AVATAR_SETUP');

$_SESSION['account'] = Accounts::getAccountViaID($account->account_id);

Handle::redirect("register.php");

?>