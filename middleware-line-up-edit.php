<?php

session_start();
require_once "./app/core/Handle.php";
require_once "./app/models/Artists.php";
require_once "./app/models/Parties.php";

function hasEditAuthority($id) {
    $artist = Artists::getArtist($id, $_SESSION['party-manager']->party_id);
    if(empty($artist) || $_SESSION['party-manager']->party_id != $artist->party_id) {
        Handle::setPopup(Popups::noEditPermissions());
        Handle::redirect("line-up-overview.php");
    }
}
function uploadPhoto($image, $artistID) {
    $info = pathinfo($image['name']);
    $extension = $info['extension'];
    $newName = "artist-" . $artistID . "." .$extension;

    $target = './public/images/uploaded/artist/' . $newName;

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

function getPartyDate($party) {
    return date('Y-m-d', strtotime($party->start_time_party));
}

function removePreviousPhotos($artistID) {
    $backgroundImageMask = './public/images/uploaded/artist/artist-' . $artistID . '.*' ;
    array_map('unlink', glob($backgroundImageMask));
}

Handle::hasManageAuthority();

Handle::authentication("organizer", Popups::mustBeAuthenticated(), "login.php");

Handle::requiredParameters([$_POST['artistName'], $_POST['filterGenre'],
    $_POST['startTime'], $_POST['endTime']],
    Popups::requiredField(), "line-up-overview.php");

Handle::requiredParameters([$_GET['artistID']], Popups::wrongParameters(), "line-up-overview.php");

hasEditAuthority($_GET['artistID']);

$artistName = $_POST['artistName'];
$filterGenre = $_POST['filterGenre'];
$startTime = $_POST['startTime'];
$endTime = $_POST['endTime'];
$artistPhoto = $_FILES['artistPhoto'];
$partyID = $_SESSION['party-manager']->party_id;
$artistID = $_GET['artistID'];

$party = Parties::getParty($partyID);
$date = getPartyDate($party);

$startTime = date('Y-m-d H:i:s', strtotime("$date $startTime"));
$endTime = date('Y-m-d H:i:s', strtotime("$date $endTime"));

if(!empty($artistPhoto['name'])) {
    removePreviousPhotos($artistID);
    $path = uploadPhoto($artistPhoto, $artistID);
    Artists::uploadArtistPhoto($artistID, $path);
}

Artists::updateArtist($artistName, $filterGenre, $startTime, $endTime, $artistID);

Handle::setPopup(Popups::artistAdded());

Handle::redirect("line-up-overview.php");



?>