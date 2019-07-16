<?php

session_start();

require_once "./app/core/Handle.php";
require_once "./app/models/Parties.php";

function hasEditAuthority($id) {
    $party = Parties::getParty($id);
    if(empty($party) || $_SESSION['organizer']->organizer_id != $party->organizer_id) {
        Handle::setPopup(Popups::noEditPermissions());
        Handle::redirect("party-overview.php");
    }
}

Handle::requiredParameters([$_GET['partyID']], Popups::noIDGiven(), "party-overview.php");

hasEditAuthority($_GET['partyID']);

$_SESSION['party-manager'] = Parties::getParty($_GET['partyID']);

Handle::redirect("dashboard.php");

?>

