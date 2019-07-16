<?php

session_start();

require_once "./app/core/Handle.php";
require_once "./app/models/Tickets.php";
require_once "./app/models/WaitingList.php";
require_once "./app/models/Notifications.php";
require_once "./app/models/Parties.php";

function calculateDaysUntilParty($startDate) {
    $startDate = strtotime($startDate);
    $dateDifference = $startDate - time();
    return $dateDifference / (60 * 60 * 24);
}

function saveNotificationUntilPartyIsOver($party, $purchaseID) {

    $daysUntilParty = calculateDaysUntilParty($party->end_time_party);

    $messageID = Notifications::createMessage("Review", "Laat je mening achter over " . $party->name . ", zij zouden dit erg warderen!");
    Notifications::addNotification($_GET['partyID'], $_SESSION['account']->account_id, $messageID,
        "./rating.php?purchaseID=" . $purchaseID,
        date('Y-m-d H:i:s', strtotime($party->end_time_party)));
}

Handle::requiredParameters([$_SESSION['account']], Popups::mustBeAuthenticated(), "login.php");

Handle::requiredParameters([$_GET['partyID']], Popups::wrongParameters(), "parties.php");

$tickets = Tickets::getTicketsAvailable($_GET['partyID']);
$party = Parties::getParty($_GET['partyID']);

for ($i = 0; $i < count($tickets); $i++) {
    $amount = $_POST['ticket-' . $i];
    $available = $tickets[$i]->quantity_available;
    if ($amount >= 1 && $available >= $amount) {
        Handle::setPopup(Popups::ticketsBought());

        if(WaitingList::isWaiting($_SESSION['account']->account_id, $tickets[$i]->ticket_id))
            WaitingList::deleteWaiter($_SESSION['account']->account_id, $tickets[$i]->ticket_id);

        $purchaseID = Tickets::buyTicket($tickets[$i]->ticket_id, $_POST['ticket-' . $i], $_SESSION['account']->account_id);

        saveNotificationUntilPartyIsOver($party, $purchaseID);

    }
}


Handle::redirect("party.php?party=" . $_GET['partyID']);

?>