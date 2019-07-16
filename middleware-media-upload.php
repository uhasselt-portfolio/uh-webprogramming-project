<?php

session_start();

require_once "./app/core/Handle.php";
require_once "./app/models/Media.php";

function uploadPhoto($image, $partyID, $number) {
    $info = pathinfo($image['name']);
    $extension = $info['extension'];
    $newName = "artist-" . $partyID . "-" .  $number ."." .$extension;

    $target = './public/images/uploaded/party/album/' . $newName;

    $isValid = getimagesize($image["tmp_name"]);

    if ($image["size"] > 100000000)
        Handle::setPopup(Popups::imageToLarge());
    else if(($extension != "jpg" && $extension != "png") || !$isValid)
        Handle::setPopup(Popups::wrongFileType());
    else {
        move_uploaded_file($image['tmp_name'], $target);
    }
    return $target;
}

Handle::hasManageAuthority();

Handle::authentication("organizer", Popups::mustBeAuthenticated(), "login.php");

Handle::requiredParameters([$_FILES['media']], Popups::requiredField(), "media.php");

$partyID = $_SESSION['party-manager']->party_id;
$number = Media::getNumberOfPhotos($partyID)->count;
$path = uploadPhoto($_FILES['media'], $partyID, $number);

Media::addPhoto($partyID, $path);

Handle::setPopup(Popups::photoAdded());

Handle::redirect("media.php");

?>