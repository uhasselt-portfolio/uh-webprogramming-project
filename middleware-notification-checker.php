<?php

session_start();

require_once "./app/core/Handle.php";
require_once "./app/models/Notifications.php";

header('Content-type: application/json');
$response_array = [];

Handle::authentication("account", Popups::mustBeAuthenticated(), "login.php");

$account = $_SESSION['account'];

$unreadNotifications = Notifications::getUnreadNotificationCount($account->account_id);

$response_array['count'] = $unreadNotifications;
echo json_encode($response_array);

?>