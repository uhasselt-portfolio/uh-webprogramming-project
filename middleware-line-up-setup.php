<?php

session_start();
require_once "./app/core/Handle.php";
require_once "./app/models/Artists.php";
require_once "./app/models/Parties.php";
require_once "./app/core/Notification";
require_once "./app/models/Notifications.php";

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

Handle::hasManageAuthority();

Handle::authentication("organizer", Popups::mustBeAuthenticated(), "login.php");

Handle::requiredParameters([$_POST['artistName'], $_POST['filterGenre'],
    $_POST['startTime'], $_POST['endTime'], $_FILES['artistPhoto']],
    Popups::requiredField(), "line-up-overview.php");

$artistName = $_POST['artistName'];
$filterGenre = $_POST['filterGenre'];
$startTime = $_POST['startTime'];
$endTime = $_POST['endTime'];
$artistPhoto = $_FILES['artistPhoto'];
$partyID = $_SESSION['party-manager']->party_id;

$party = Parties::getParty($partyID);
$date = getPartyDate($party);

$startTime = date('Y-m-d H:i:s', strtotime("$date $startTime"));
$endTime = date('Y-m-d H:i:s', strtotime("$date $endTime"));

$artistID = Artists::addArtist($artistName, $filterGenre);

$artistPhotoPath = uploadPhoto($artistPhoto, $artistID);

Artists::uploadArtistPhoto($artistID, $artistPhotoPath);

Artists::addBooking($artistID, $partyID, $startTime, $endTime);

$messageID = Notifications::createMessage($party->name, $artistName . " is toegevoegd aan de line-up, neem snel een kijkje op onze pagina!");
Notification::notifyPurchasersAndWaitingList($partyID, $messageID, $messageID);

Handle::setPopup(Popups::artistAdded());

Handle::redirect("line-up-overview.php");



?>