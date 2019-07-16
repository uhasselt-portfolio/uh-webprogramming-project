<?php

session_start();

require_once "./app/core/Handle.php";
require_once "./app/models/Parties.php";

Handle::hasManageAuthority();

Handle::authentication("organizer", Popups::mustBeAuthenticated(), "login.php");

Handle::requiredParameters([$_POST['status']], Popups::requiredField(), "dashboard.php");

$partyID = $_SESSION['party-manager']->party_id;

$status = $_POST['status'] == 'visible' ? 1 : 0;

Parties::updatePageActivationStatus($status, $partyID);

Handle::setPopup(Popups::settingsSaved());

$_SESSION['party-manager'] = Parties::getParty($partyID);

Handle::redirect("dashboard.php");

?>