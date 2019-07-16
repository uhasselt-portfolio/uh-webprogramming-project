<?php

session_start();

require_once "./app/core/Handle.php";
require_once "./app/core/Notification";
require_once "./app/models/Artists.php";
require_once "./app/models/Notifications.php";
require_once "./app/models/Parties.php";

function hasEditAuthority($id) {
    $artist = Artists::getArtist($id, $_SESSION['party-manager']->party_id);

    if(empty($artist) || $_SESSION['party-manager']->party_id != $artist->party_id) {
        Handle::setPopup(Popups::noEditPermissions());
        Handle::redirect("line-up-overview.php");
    }
}

Handle::handleCommercialAuthentication();

Handle::requiredParameters([$_GET['artistID']], Popups::wrongParameters(), "line-up-overview.php");

hasEditAuthority($_GET['artistID']);

$partyID = $_SESSION['party-manager']->party_id;
$party = Parties::getParty($partyID);

$artist = Artists::getArtist($_GET['artistID'], $partyID);

Artists::deleteArtist($_GET['artistID']);

$messageID = Notifications::createMessage($party->name, $artist->name . " is verwijderd uit de line-up, neem snel een kijkje op onze pagina!");
Notification::notifyPurchasersAndWaitingList($partyID, $messageID, $messageID);

Handle::setPopup(Popups::settingsSaved());

Handle::redirect("line-up-overview.php");

?>