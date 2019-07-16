<?php

require_once "./app/models/Accounts.php";
require_once "./app/models/AccountRecovery.php";
require_once "./app/core/Handle.php";

session_start();

Handle::authentication("account", Popups::mustBeAuthenticated(), "login.php");

Handle::requiredParameters([$_POST['password1']], Popups::requiredField(), "settings.php");

$hashedPassword = hash("sha256", $_POST['password1']);
$result = Accounts::updatePassword($hashedPassword, $_SESSION['account']->account_id);

Handle::setPopup(Popups::settingsSaved());

Handle::redirect("settings.php");

?>