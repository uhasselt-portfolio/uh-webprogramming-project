<?php

session_start();
require_once "./app/core/Handle.php";
require_once "./app/models/Parties.php";

function uploadPhoto($image, $organizer, $isBackgroundImage) {

    $info = pathinfo($image['name']);
    $extension = $info['extension'];
    if($isBackgroundImage)
        $newName = "background-" . $organizer->account_id . "." .$extension;
    else
        $newName = "card-" . $organizer->account_id . "." .$extension;

    $target = './public/images/uploaded/party/setup/' . $newName;

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

function uploadVideo($video, $organizer) {

    $info = pathinfo($video['name']);
    $extension = $info['extension'];
    $newName = "video-" . $organizer->account_id . "." .$extension;

    $target = './public/images/uploaded/party/setup/' . $newName;

    if($extension != "mp4" && $extension != "wmv")
        Handle::setPopup(Popups::wrongFileType());
    else
        move_uploaded_file($video['tmp_name'], $target);

    return $target;
}

function removePreviousPhotos($organizer) {
    $backgroundImageMask = './public/images/uploaded/party/setup/background-' . $organizer->account_id . '.*' ;
    $cardImageMask = './public/images/uploaded/party/setup/card-' . $organizer->account_id . '.*' ;
    array_map('unlink', glob($backgroundImageMask));
    array_map('unlink', glob($cardImageMask));
}

Handle::authentication("organizer", Popups::mustBeAuthenticated(), "login.php");

Handle::requiredParameters([$_POST['partyName'], $_POST['description'], $_POST['genres'],
    $_POST['province'], $_POST['date'], $_POST['city'],  $_POST['address']], Popups::requiredField(), "party-overview.php");

Handle::hasManageAuthority();

$backgroundImagePath = "";
$cardImagePath = "";
removePreviousPhotos($_SESSION['organizer']);

if(isset($_FILES['backgroundImage']))
    if($_FILES['backgroundImage']['name'] != "")
        $backgroundImagePath = uploadPhoto($_FILES['backgroundImage'], $_SESSION['organizer'], true);

if(isset($_FILES['cardImage']))
    if($_FILES['cardImage']['name'] != "")
        $cardImagePath = uploadPhoto($_FILES['cardImage'], $_SESSION['organizer'], false);

if(isset($_FILES['trailerVideo']))
    if($_FILES['trailerVideo']['name'] != "") {
        $trailerVideoMask = './public/images/uploaded/party/setup/video-' . $organizer->account_id . '.*' ;
        array_map('unlink', glob($trailerVideoMask));
        $trailerVideoPath = uploadVideo($_FILES['trailerVideo'], $_SESSION['organizer']);
    }

$_SESSION['party-setup'] = array(
    "genreID" => $_POST['genres'],
    "partyName" => $_POST['partyName'],
    "description" => $_POST['description'],
    "province" => $_POST['province'],
    "city" => $_POST['city'],
    "address" => $_POST['address'],
    "date" => $_POST['date'],
    "cardImagePath" => $cardImagePath,
    "backgroundImagePath" => $backgroundImagePath,
    "trailerVideoPath" => $trailerVideoPath
);

Handle::redirect("party-edit-detail.php");

?>