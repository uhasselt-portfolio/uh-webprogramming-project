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

Handle::handleCommercialAuthentication();

Handle::requiredParameters([$_GET['partyID']], Popups::wrongParameters(), "party-overview.php");

hasEditAuthority($_GET['partyID']);

Parties::deleteParty($_GET['partyID']);

Handle::redirect("party-overview.php");

?>