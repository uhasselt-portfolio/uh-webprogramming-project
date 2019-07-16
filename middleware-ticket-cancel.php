<?php

session_start();

require_once "./app/core/Handle.php";
require_once "./app/models/Tickets.php";
require_once "./app/models/WaitingList.php";
require_once "./app/models/Notifications.php";
require_once "./app/core/Notification";
require_once "./app/models/Parties.php";

Handle::authentication("account", Popups::mustBeAuthenticated(), "tickets.php");

Handle::requiredParameters([$_GET['purchaseID']], Popups::noIDGiven(), "tickets.php");

$purchase = Tickets::getPurchase($_GET['purchaseID']);
$account = $_SESSION['account'];
$tickets = Tickets::getTicket($purchase->ticket_id);
$party = Parties::getParty($tickets->party_id);

if($account->account_id != $purchase->account_id) {
    Handle::setPopup(Popups::noPermission());
} else {
    if($purchase->refund) {
        $ticket = Tickets::getTicket($purchase->ticket_id);
        if($ticket->quantity_available <= 0) {
            $messageID = Notifications::createMessage($party->name, "Er zijn plaatsen vrij gekomen voor " . $party->name . "! Koop snel je tickets voordat ze ingenomen zijn!");
            Notification::notifyWaitingList($party->party_id, $messageID);
        }
        Notifications::deleteNotification($ticket->party_id, $account->account_id);
        Tickets::updateQuantityAvailable($ticket->ticket_id, $purchase->quantity);
        Tickets::cancelPurchase($_GET['purchaseID']);
        Handle::setPopup(Popups::ticketCanceled());
    }
}

Handle::redirect("tickets.php");

?>