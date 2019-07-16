<?php

session_start();

require_once "./app/core/Handle.php";
require_once "./app/models/Parties.php";
require_once "./app/models/Organizer.php";
require_once "./app/models/Tickets.php";
require_once "./app/models/WaitingList.php";
require_once "./app/models/Notifications.php";
require_once "./app/core/Notification";

function sendNotificationPartyDisabled($message, $party) {
    $account = Organizer::getOrganizerViaOrganizerID($party->organizer_id);
    $messageID = Notifications::createMessage($party->name,
        "Je pagina is tijdelijk inactief gezet door de administrator. Je mag je pagina terug actief zetten na dat het volgende hebt veranderd op je pagina: " . $message);
    Notifications::addNotification($party->party_id, $account->account_id, $messageID, "./party.php?party=" . $party->party_id);
}

function sendNotificationPartyDeleted($message, $party) {
    $messagePurchasersID = Notifications::createMessage($party->name, "De administrator van Fuiver heeft " . $party->name . " verwijderd en daarmee is jouw ticket dus ook verwijderd. 
        De fuif werd verwijderd wegens het overschrijden van onze voorwaarden, de volledige reden kan je hier lezen: ". $message);

    $messageWaitingListID = Notifications::createMessage($party->name, "De administrator van Fuiver heeft " . $party->name . " verwijderd en daarmee ben jij dus ook van de wachtlijst gehaald voor deze fuif. 
        De fuif werd verwijderd wegens het overschrijden van onze voorwaarden, de volledige reden kan je hier lezen: ". $message);

    Notification::notifyPurchasersAndWaitingList($party->party_id, $messageWaitingListID, $messagePurchasersID);
}

Handle::mustBeAdmin();

Handle::authentication("account", Popups::mustBeAuthenticated(), "login.php");

Handle::requiredParameters([$_GET['partyID'], $_POST['reason'], $_POST['action']], Popups::wrongParameters(), "admin-panel.php");

$party = Parties::getParty($_GET['partyID']);

if(!isset($party)) {
    Handle::setPopup(Popups::noPartyFound());
    Handle::redirect("admin-panel.php");
}

if($_POST['action'] == 1) {
    Parties::updatePageActivationStatus(0, $_GET['partyID']);
    sendNotificationPartyDisabled($_POST['reason'], $party);
} else {
    sendNotificationPartyDeleted($_POST['reason'], $party);
    Parties::deleteParty($_GET['partyID']);

}

Handle::setPopup(Popups::settingsSaved());

Handle::redirect("admin-panel.php");


?>