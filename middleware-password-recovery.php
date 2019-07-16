<?php

require_once "./app/models/Accounts.php";
require_once "./app/models/AccountRecovery.php";
require_once "./app/core/Handle.php";

session_start();

Handle::authentication("recovery-info", Popups::mustBeAuthenticated(), "login.php");

Handle::requiredParameters([$_POST['password1'], $_POST['password2']], Popups::requiredField(), "register.php");

if($_POST['password1'] !== $_POST['password2']) {
    Handle::setPopup(Popups::passwordsNotEqual());
    Handle::redirect("password-recovery.php");
} else {
    $hashedPassword = hash("sha256", $_POST['password1']);
    $result = Accounts::updatePassword($hashedPassword, $_SESSION['recovery-info']->account_id);
    AccountRecovery::deleteCode($_SESSION['recovery-info']->account_id);

    Handle::setPopup(Popups::modifiedPassword());

    Handle::redirect("login.php");
}

?>