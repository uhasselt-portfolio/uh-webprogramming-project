<?php

session_start();

require_once "./app/core/Handle.php";
require_once "./app/models/Ratings.php";
require_once "./app/models/Parties.php";
require_once "./app/models/Tickets.php";

Handle::authentication("account", Popups::mustBeAuthenticated(), "login.php");

Handle::requiredParameters([$_GET['purchaseID']], Popups::noIDGiven(), "parties.php");

Handle::requiredParameters([$_POST['title'], $_POST['message'], $_POST['rating']], Popups::noIDGiven(), "parties.php");

$ticket = Tickets::getPurchase($_GET['purchaseID']);
$party = Parties::getParty($ticket->party_id);
$account = $_SESSION['account'];

if($account->account_id != $ticket->account_id) {
    Handle::setPopup(Popups::noPermission());
    Handle::redirect("index.php");
}

$hasBeenRated = Ratings::isPartyRatedByAccount($ticket->party_id, $account->account_id);

if($hasBeenRated) {
    Handle::setPopup(Popups::partyAlreadyRated());
    Handle::redirect("index.php");
}

Ratings::addRating($_POST['title'], $_POST['message'], $_POST['rating'], $party->organizer_id , $account->account_id, $party->party_id);

Handle::setPopup(Popups::addedRating());

Handle::redirect("notifications.php");

?>