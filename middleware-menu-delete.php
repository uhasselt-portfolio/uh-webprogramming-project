<?php

session_start();

require_once "./app/core/Handle.php";
require_once "./app/models/Menus.php";

function hasEditAuthority($id) {
    $menu = Menus::getMenuItem($id);
    if(empty($menu) || $_SESSION['party-manager']->party_id != $menu->party_id) {
        Handle::setPopup(Popups::noEditPermissions());
        Handle::redirect("menu.php");
    }
}

Handle::handleCommercialAuthentication();

Handle::requiredParameters([$_GET['menuID']], Popups::wrongParameters(), "menu.php");

hasEditAuthority($_GET['menuID']);

Menus::deleteItem($_GET['menuID']);

Handle::setPopup(Popups::menuDeleted());

Handle::redirect("menu.php");

?>