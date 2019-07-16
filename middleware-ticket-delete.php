<?php

session_start();

require_once "./app/core/Handle.php";
require_once "./app/models/Tickets.php";
require_once "./app/models/Parties.php";
require_once "./app/models/Notifications.php";
require_once "./app/core/Notification";
require_once "./app/models/WaitingList.php";

function hasEditAuthority($id) {
    $ticket = Tickets::getTicket($id);
    if(empty($ticket) || $_SESSION['party-manager']->party_id != $ticket->party_id) {
        Handle::setPopup(Popups::noEditPermissions());
        Handle::redirect("ticket-overview.php");
    }
}

function sendNotification($party, $ticket) {
    $messagePurchasersID = Notifications::createMessage($party->name, $party->name . " heeft zijn '" . $ticket->name . "' ticket verwijderd. Je hebt dus geen toegang meer tot deze fuif!");
    $messageWaitingListID = Notifications::createMessage($party->name, $party->name . " heeft zijn '" . $ticket->name . "' ticket verwijderd. Je bent van de wachtlijst verwijderd voor dit ticket!");

    Notification::notifyPurchasersAndWaitingList($party->party_id, $messageWaitingListID, $messagePurchasersID);
}

Handle::handleCommercialAuthentication();

Handle::requiredParameters([$_GET['ticketID'], $_GET['partyID']], Popups::wrongParameters(), "ticket-overview.php");

hasEditAuthority($_GET['ticketID']);

$party = Parties::getParty($_GET['partyID']);
$ticket = Tickets::getTicket($_GET['ticketID']);
sendNotification($party, $ticket);

Tickets::deleteTicket($_GET['ticketID']);

Handle::redirect("ticket-overview.php");

?>