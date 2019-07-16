<?php

require_once "./app/core/Handle.php";
require_once "./app/models/Tickets.php";
require_once "./app/models/Ratings.php";

session_start();

Handle::hasManageAuthority();

Handle::handleCommercialAuthentication();

$party = $_SESSION['party-manager'];

?>

<html>

<head>
    <!-- UIkit CSS -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/uikit/3.0.3/css/uikit.min.css"/>
    <link rel="stylesheet" href="./public/css/uikit_customized.css">

    <!-- UIkit JS -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/uikit/3.0.3/js/uikit.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/uikit/3.0.3/js/uikit-icons.min.js"></script>
    <script type="text/javascript" src="./public/js/UIKit.js"></script>
</head>

<body>

<?php
require_once "./app/views/global/head-navbar-organizer.php";
require_once "./app/views/global/head-navbar-organizer-popup.php";

require_once "./app/views/global/sub-navbar-organizer.php";
require_once "./app/views/global/sub-navbar-organizer-popup.php";

Handle::displayPopups();

?>

<div class="uk-container-large uk-margin-xlarge-left uk-margin-xlarge-right uk-margin-medium-top">
    <div class="uk-child-width-1-2@s uk-child-width-1-3@m" uk-grid>
        <?php require_once "./app/views/dashboard/activate-party-form.php" ?>
        <?php require_once "./app/views/dashboard/party-sales-overview.php" ?>
        <?php require_once "./app/views/dashboard/party-rating-overview.php" ?>

    </div>
</div>
</body>

</html>