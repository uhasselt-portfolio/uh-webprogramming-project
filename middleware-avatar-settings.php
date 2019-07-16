<?php

require_once "./app/core/Handle.php";
require_once "./app/models/Accounts.php";

session_start();

Handle::authentication("account", Popups::mustBeAuthenticated(), "login.php");

Handle::requiredParameters([$_FILES['avatar']], Popups::requiredField(), "settings.php");

$account = $_SESSION['account'];

$info = pathinfo($_FILES['avatar']['name']);
$extension = $info['extension'];
$newName = "avatar-" . $account->account_id . "." .$extension;

$isValid = getimagesize($_FILES["avatar"]["tmp_name"]);

if ($_FILES["avatar"]["size"] > 100000000)
    Handle::setPopup(Popups::imageToLarge());
else if(($extension != "jpg" && $extension != "png") || !$isValid)
    Handle::setPopup(Popups::wrongFileType());
else {

    $target = 'public/images/uploaded/account/' . $newName;

    if(file_exists($target))
        unlink($target);

    move_uploaded_file( $_FILES['avatar']['tmp_name'], $target);

    Handle::setPopup(Popups::settingsSaved());

    Handle::redirect("settings.php");

}
?>