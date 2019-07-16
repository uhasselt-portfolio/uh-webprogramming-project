<?php

session_start();
require_once "./app/core/Handle.php";
require_once "./app/models/Parties.php";

function moveToPermanentPhotoFolder($path, $id, $type) {
    $extension = pathinfo($path, PATHINFO_EXTENSION);
    
    if(empty($path))
        return null;
    
    $newPath = './public/images/uploaded/party/';
    
    if($type == 0)
        $newPath .= 'background/party-' . $id . '.' . $extension;
    else if($type == 1)
        $newPath .= 'card/party-' . $id . '.' . $extension;
    else
        $newPath .= 'trailer/party-' . $id . '.' . $extension;

    copy($path, $newPath);
    return $newPath;
}

Handle::authentication("organizer", Popups::mustBeAuthenticated(), "login.php");

Handle::requiredParameters([$_SESSION['party-setup'], $_POST['startTimeParty'], $_POST['endTimeParty'],
    $_POST['minimumAge'], $_POST['amount'], $_POST['minimumPrice'], $_POST['cloakRoom'],
    $_POST['happyHourStartTime'], $_POST['happyHourEndTime'], $_POST['facebookUrl'], $_POST['instagramUrl'],
    $_POST['twitterUrl']], Popups::requiredField(), "party-overview.php");

$genreID = $_SESSION['party-setup']['genreID'];
$partyName = $_SESSION['party-setup']['partyName'];
$description = $_SESSION['party-setup']['description'];
$province = $_SESSION['party-setup']['province'];
$city = $_SESSION['party-setup']['city'];
$date = $_SESSION['party-setup']['date'];
$address = $_SESSION['party-setup']['address'];
$cardImagePath = $_SESSION['party-setup']['cardImagePath'];
$backgroundImagePath = $_SESSION['party-setup']['backgroundImagePath'];
$trailerVideoPath = $_SESSION['party-setup']['trailerVideoPath'];
$organizer = $_SESSION['organizer'];

$startTimeParty = $_POST['startTimeParty'];
$endTimeParty = $_POST['endTimeParty'];
$minimumAge = $_POST['minimumAge'];
$amountCoupons = $_POST['amount'];
$minimumPriceCoupons = $_POST['minimumPrice'];
$cloakRoomPrice = $_POST['cloakRoom'];
$happyHourStartTime = $_POST['happyHourStartTime'];
$happyHourEndTime = $_POST['happyHourEndTime'];
$facebookUrl = $_POST['facebookUrl'];
$instagramUrl = $_POST['instagramUrl'];
$twitterUrl = $_POST['twitterUrl'];

$partyID = Parties::createParty($genreID, $organizer->organizer_id, $partyName, $description, $province, $city, $address);

$cardImagePath = moveToPermanentPhotoFolder($cardImagePath, $partyID, 1);
$backgroundImagePath = moveToPermanentPhotoFolder($backgroundImagePath, $partyID, 0);
$trailerVideoPath = moveToPermanentPhotoFolder($trailerVideoPath, $partyID, 2);

Parties::uploadCardPhoto($partyID, $cardImagePath);
Parties::uploadBackgroundPhoto($partyID, $backgroundImagePath);
Parties::uploadTrailerVideo($partyID, $trailerVideoPath);

$startTimeParty = date('Y-m-d H:i:s', strtotime("$date $startTimeParty"));
$endTimeParty = date('Y-m-d H:i:s', strtotime("$date $endTimeParty"));
$happyHourStartTime = date('Y-m-d H:i:s', strtotime("$date $happyHourStartTime"));
$happyHourEndTime = date('Y-m-d H:i:s', strtotime("$date $happyHourEndTime"));

$id = Parties::addPartyInformation($partyID, $facebookUrl, $twitterUrl, $instagramUrl, $startTimeParty, $endTimeParty, $minimumAge, $minimumPriceCoupons, $amountCoupons,
    $cloakRoomPrice, $happyHourStartTime, $happyHourEndTime);

Handle::setPopup(Popups::newPartyAdded());
Handle::redirect("party-overview.php");

?>