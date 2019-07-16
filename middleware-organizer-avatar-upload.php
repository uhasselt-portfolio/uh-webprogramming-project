<?php

require_once "./app/core/Handle.php";
require_once "./app/models/Organizer.php";

session_start();

Handle::authentication("account", Popups::mustBeAuthenticated(), "login.php");

Handle::requiredParameters([$_FILES['avatar']], Popups::requiredField(), "settings-organizer.php");

$organizer = $_SESSION['organizer'];
$accountID = $organizer->account_id;

$info = pathinfo($_FILES['avatar']['name']);
$extension = $info['extension'];
$newName = "organizer-" . $organizer->account_id . "." .$extension;

$isValid = getimagesize($_FILES["avatar"]["tmp_name"]);

if ($_FILES["avatar"]["size"] > 100000000)
    Handle::setPopup(Popups::imageToLarge());
else if(($extension != "jpg" && $extension != "png") || !$isValid)
    Handle::setPopup(Popups::wrongFileType());
else {

    $target = './public/images/uploaded/organizer/avatar/' . $newName;

    Organizer::updateAvatar($accountID, $target);
    $_SESSION['organizer'] = Organizer::getOrganizer($accountID);

    if(file_exists($target))
        unlink($target);

    move_uploaded_file( $_FILES['avatar']['tmp_name'], $target);

    Handle::setPopup(Popups::imageUploadSuccess());

    Handle::redirect("settings-organizer.php");

}
?>