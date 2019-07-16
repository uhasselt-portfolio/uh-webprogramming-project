<?php

require_once "./app/core/Handle.php";
require_once "./app/models/AccountConfirmation.php";
require_once "./app/models/Accounts.php";

session_start();

Handle::authentication("account", Popups::mustBeAuthenticated(), "login.php");

Handle::requiredParameters([$_POST['code']], Popups::requiredField(), "email-verification.php");

$code = $_POST['code'];
$account = $_SESSION['account'];
$isValid = AccountConfirmation::isValidCode($account->account_id, $code);

if($isValid) {
    Accounts::updateSetupProcess($account->account_id, 'INFORMATION_SETUP');
    $_SESSION['account'] = Accounts::getAccount($account->email);
    AccountConfirmation::deleteCode($account->account_id);
} else {
    Handle::setPopup(Popups::verificationCode());
}

Handle::redirect("information-setup.php");

?>