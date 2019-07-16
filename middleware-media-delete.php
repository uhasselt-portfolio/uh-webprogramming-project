<?php

session_start();

require_once "./app/core/Handle.php";
require_once "./app/models/Media.php";

function hasEditAuthority($id) {
    $media = Media::getPhoto($id);
    if(empty($media) || $_SESSION['party-manager']->party_id != $media->party_id) {
        Handle::setPopup(Popups::noEditPermissions());
        Handle::redirect("media.php");
    }
}

Handle::handleCommercialAuthentication();

Handle::requiredParameters([$_GET['photoID']], Popups::wrongParameters(), "media.php");

hasEditAuthority($_GET['photoID']);

Media::deletePhoto($_GET['photoID']);

Handle::setPopup(Popups::settingsSaved());

Handle::redirect("media.php");

?>