<?php

session_start();

require_once "./app/core/Handle.php";
require_once "./app/models/Followers.php";

Handle::authentication("account", Popups::mustBeAuthenticated(), "login.php");

Handle::requiredParameters([$_GET['followingID']], Popups::noIDGiven(), "index.php");

if($_GET['followingID'] == $_SESSION['account']->account_id)
    Handle::redirect("profile.php?account=" .  $_GET['followingID'] . "&type=a");

if($_GET['following']) {
    Followers::unfollow($_SESSION['account']->account_id, $_GET['followingID']);
    Handle::setPopup(Popups::unfollowingSuccess());
} else {
    Followers::follow($_SESSION['account']->account_id, $_GET['followingID']);
    Handle::setPopup(Popups::followingSuccess());
}


Handle::redirect("profile.php?account=" .  $_GET['followingID'] . "&type=a");

?>