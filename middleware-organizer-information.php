<?php

session_start();

require_once "./app/models/Organizer.php";
require_once "./app/core/Handle.php";

Handle::authentication("account", Popups::mustBeAuthenticated(), "login.php");

Handle::requiredParameters([$_POST['organizerName'], $_POST['contactEmail'], $_POST['contactPhone'], $_POST['description']],
    Popups::requiredField(),
    "settings-organizer.php");

$organizerName = $_POST['organizerName'];
$description = $_POST['description'];
$contactEmail = $_POST['contactEmail'];
$contactPhone = $_POST['contactPhone'];
$accountID = $_SESSION['account']->account_id;

Organizer::updateInformation($accountID, $organizerName, $description, $contactEmail, $contactPhone);
$_SESSION['organizer'] = Organizer::getOrganizer($accountID);

Handle::setPopup(Popups::settingsSaved());

Handle::redirect("settings-organizer.php");


?>