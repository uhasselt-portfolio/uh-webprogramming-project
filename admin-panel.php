
<?php
require_once "./app/core/Handle.php";
require_once "./app/models/Parties.php";

session_start();

Handle::authentication("account", Popups::mustBeAuthenticated(), "login.php");

Handle::mustBeAdmin();

$parties = Parties::getAllParties();

?>
<html class="uk-background-muted">
<head>
    <!-- UIkit CSS -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/uikit/3.0.3/css/uikit.min.css" />
    <link rel="stylesheet" href="./public/css/uikit_customized.css">

    <!-- UIkit JS -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/uikit/3.0.3/js/uikit.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/uikit/3.0.3/js/uikit-icons.min.js"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    <script type="text/javascript" src="./public/js/UIKit.js"></script>
</head>
<body>

<?php

/** Head navbar **/
require_once "./app/views/global/head-navbar.php";

/** Popup navbar when screen too small **/
require_once "./app/views/global/head-navbar-popup.php";

Handle::displayPopups();

?>

<div class="uk-margin-xlarge-left uk-margin-xlarge-right uk-margin-medium-top uk-margin-medium-bottom">

    <div class="uk-container-large" uk-grid>
        <div class="uk-width-1-1">
            <div class="uk-text-left">
                <a class="uk-link-reset" href="javascript:history.go(-1)">
                    <span class="uk-margin-small-right" uk-icon="arrow-left"></span>
                    Terug naar vorige pagina
                </a>
            </div>
        </div>
        <div class="uk-width-1-1">
            <div class="uk-card uk-card-default uk-card-hover">
                <div class="uk-card-header">
                    <h3 class="customized-dashboard-card-title">Beheerders Paneel</h3>
                </div>
                <div class="uk-card-body">
                    <?php require_once "./app/views/admin-panel/created_parties.php" ?>
                </div>
            </div>
        </div>
    </div>
</div>


</body>

</html>