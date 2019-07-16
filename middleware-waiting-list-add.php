<?php

session_start();

require_once "./app/core/Handle.php";
require_once "./app/models/WaitingList.php";

Handle::authentication("account", Popups::mustBeAuthenticated(), "login.php");

Handle::requiredParameters([$_GET['partyID'], $_GET['ticketID']], Popups::noIDGiven(), "parties.php");

if(WaitingList::isWaiting($_SESSION['account']->account_id, $_GET['ticketID'])) {
    Handle::setPopup(Popups::deletedFromWaitingList());
    WaitingList::deleteWaiter($_SESSION['account']->account_id, $_GET['ticketID']);
}
else {
    Handle::setPopup(Popups::addedToWaitingList());
    WaitingList::add($_SESSION['account']->account_id, $_GET['ticketID']);
}

Handle::redirect("party.php?party=" . $_GET['partyID']);

?>