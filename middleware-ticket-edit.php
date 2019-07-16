<?php

session_start();

require_once "./app/core/Handle.php";
require_once "./app/models/Tickets.php";

function hasEditAuthority($id) {
    $ticket = Tickets::getTicket($id);
    if(empty($ticket) || $_SESSION['party-manager']->party_id != $ticket->party_id) {
        Handle::setPopup(Popups::noEditPermissions());
        Handle::redirect("ticket-overview.php");
    }
}

Handle::handleCommercialAuthentication();

Handle::requiredParameters([$_POST['ticketName'], $_POST['description'], $_POST['price'], $_POST['amount'], $_POST['startDate']
    , $_POST['endDate'], $_POST['startTime'], $_POST['endTime'], $_POST['cancelTicket']], Popups::requiredField(), "ticket-overview.php");

hasEditAuthority($_GET['ticketID']);


$startDate = $_POST['startDate'];
$endDate = $_POST['endDate'];
$startTime = $_POST['startTime'];
$endTime = $_POST['endTime'];

$startTimeParty = date('Y-m-d H:i', strtotime("$startDate $startTime"));
$endTimeParty = date('Y-m-d H:i', strtotime("$endDate $endTime"));
$refund= $_POST['cancelTicket'] == "allowed" ? true : false;

Tickets::updateTicket($_GET['ticketID'], $_POST['ticketName'], $_POST['description'], $_POST['amount'], $_POST['price'], $startTimeParty, $endTimeParty, $refund);

Handle::setPopup(Popups::settingsSaved());

Handle::redirect("ticket-overview.php");

?>