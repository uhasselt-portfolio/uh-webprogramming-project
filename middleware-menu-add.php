<?php

session_start();

require_once "./app/core/Handle.php";
require_once "./app/models/Menus.php";

Handle::hasManageAuthority();

Handle::authentication("organizer", Popups::mustBeAuthenticated(), "login.php");

Handle::requiredParameters([$_POST['name'], $_POST['coupon'], $_POST['age']], Popups::requiredField(), "menu.php");

$partyID = $_SESSION['party-manager']->party_id;

Menus::addItem($partyID, $_POST['name'], $_POST['age'], $_POST['coupon']);

Handle::setPopup(Popups::menuAdded());

Handle::redirect("menu.php");

?>