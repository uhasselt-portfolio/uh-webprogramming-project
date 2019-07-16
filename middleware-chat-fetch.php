<?php

session_start();

require_once "./app/core/Handle.php";
require_once "./app/models/Chat.php";

header('Content-type: application/json');
$response_array = [];

Handle::authentication("account", Popups::mustBeAuthenticated(), "login.php");

Handle::requiredParameters([$_POST['organizerID'], $_POST['accountID']], Popups::wrongParameters(), "index.php");

$boolSentByOrganizer = !$_POST['sentByOrganizer'] == "false";
$sentByOrganizer = $_POST['sentByOrganizer'] == "false" ? 0 : 1;

$response_array['new-messages'] = Chat::getNewMessages($_POST['organizerID'], $_POST['accountID'], $sentByOrganizer);

$updated = false;

if(count($response_array['new-messages']) > 0) {
    Chat::setSeen($_POST['organizerID'], $_POST['accountID'], $boolSentByOrganizer);
    $updated = true;
}

$response_array['errorTest'] = [$_POST['organizerID'], $_POST['accountID'], $boolSentByOrganizer, count($response_array['new-messages']), $updated];

echo json_encode($response_array);

?>