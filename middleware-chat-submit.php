<?php

session_start();

require_once "./app/core/Handle.php";
require_once "./app/models/Chat.php";

$response_array = [];

Handle::authentication("account", Popups::mustBeAuthenticated(), "login.php");

Handle::requiredParameters([$_GET['accountID'], $_GET['organizerID'], $_POST['message']], Popups::wrongParameters(), "index.php" );

$sentByOrganizer = 1;

if(isset($_GET['sentByOrganizer']))
    if($_GET['sentByOrganizer'] == 0)
        $sentByOrganizer = 0;

Chat::sentMessage($_GET['organizerID'], $_GET['accountID'], $sentByOrganizer, $_POST['message']);

if($sentByOrganizer) {
    Handle::redirect("chat-dashboard.php?accountID=" .  $_GET['accountID']);
} else {
    Handle::redirect("chat.php?organizerID=" .  $_GET['organizerID']);
}

?>