<?php

session_start();

require_once "./app/core/Handle.php";
require_once "./app/models/Tickets.php";

Handle::handleCommercialAuthentication();

Handle::hasManageAuthority();

Handle::requiredParameters([$_POST['ticketName'], $_POST['description'], $_POST['price'], $_POST['amount'], $_POST['startDate']
    , $_POST['endDate'], $_POST['startTime'], $_POST['endTime'], $_POST['cancelTicket']], Popups::requiredField(), "ticket-overview.php");

$partyID = $_SESSION['party-manager']->party_id;

$startDate = $_POST['startDate'];
$endDate = $_POST['endDate'];
$startTime = $_POST['startTime'];
$endTime = $_POST['endTime'];

$startTimeParty = date('Y-m-d H:i:s', strtotime("$startDate $startTime"));
$endTimeParty = date('Y-m-d H:i:s', strtotime("$endDate $endTime"));
$refund= $_POST['cancelTicket'] == "allowed" ? 1 : 0;

Tickets::addTicket($partyID, $_POST['ticketName'], $_POST['description'], $_POST['amount'], $_POST['price'], $startTimeParty, $endTimeParty, $refund);

Handle::setPopup(Popups::ticketAdded());

Handle::redirect("ticket-overview.php");

?>