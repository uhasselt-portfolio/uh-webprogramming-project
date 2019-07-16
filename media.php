<?php

session_start();

require_once "./app/core/Handle.php";
require_once "./app/models/Media.php";

Handle::hasManageAuthority();

Handle::handleCommercialAuthentication();

?>

<html>

<head>
    <!-- UIkit CSS -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/uikit/3.0.3/css/uikit.min.css" />
    <link rel="stylesheet" href="./public/css/uikit_customized.css">

    <!-- UIkit JS -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/uikit/3.0.3/js/uikit.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/uikit/3.0.3/js/uikit-icons.min.js"></script>
    <script src="./public/js/UIKit.js"></script>
    <script src="./public/js/isValidForm.js"></script>
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
    <div uk-grid>
        <div class="uk-width-1-2@m uk-width-1-3@l">
            <div class="uk-card uk-card-default uk-card-hover uk-card-body">
                <h3 class="customized-dashboard-card-title">Upload Media</h3>
                <?php require_once "./app/views/media-dashboard/media-upload-form.php" ?>
            </div>
        </div>
        <div class="uk-width-1-2@m uk-width-2-3@l">
            <div class="uk-card uk-card-default uk-card-hover uk-card-body">
                <h3 class="customized-dashboard-card-title">Media overzicht</h3>
                <div class="uk-child-width-1-3" uk-grid>
                    <?php require_once "./app/views/media-dashboard/media-list.php" ?>
                </div>
            </div>
        </div>
    </div>
</div>
</body>

</html>
