<?php

session_start();
require_once "./app/core/Handle.php";
require_once "./app/models/Organizer.php";
require_once "./app/models/Chat.php";
require_once "./app/core/Pop-ups.php";

Handle::authentication("account", Popups::mustBeAuthenticated(), "login.php");

Handle::requiredParameters([$_GET['organizerID']], Popups::wrongParameters(), "index.php");
?>

<html class="uk-background-muted">
<head>
    <!-- UIkit CSS -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/uikit/3.0.3/css/uikit.min.css"/>
    <link rel="stylesheet" href="./public/css/uikit_customized.css">
    <!-- UIkit JS -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/uikit/3.0.3/js/uikit.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/uikit/3.0.3/js/uikit-icons.min.js"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    <script type="text/javascript" src="./public/js/UIKit.js"></script>
    <script type="text/javascript" src="./public/js/FetchChatMessages.js"></script>

    <script>
        $(document).ready(function() {
            document.getElementById('lastMessage').scrollIntoView();
        });
    </script>
</head>
<body>

<?php

Handle::displayPopups();

$organizer = Organizer::getOrganizerViaOrganizerID($_GET['organizerID']);

if (!isset($organizer)) {
    Handle::setPopup(Popups::organizerNotFound());
    Handle::redirect("index.php");
} else {
    if($organizer->account_id == $_SESSION['account']->account_id) {
        Handle::setPopup(Popups::cannotChatWithYourself());
        Handle::redirect("index.php");
    }
}

/** Head navbar **/
require_once "./app/views/global/head-navbar.php";

/** Popup navbar when screen too small **/
require_once "./app/views/global/head-navbar-popup.php";

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
        <div class="uk-width-1-1 uk-margin-medium-bottom">
            <div class="uk-card uk-card-default uk-card-hover">
                <div class="uk-card-header">
                    <h3 class="customized-dashboard-card-title">Praat met <?= $organizer->organisation_name ?></h3>
                </div>
                <div class="uk-card-body uk-height-large uk-overflow-auto">
                    <?php require_once "./app/views/chat/chat-frame.php" ?>
                    <?php require_once "./app/views/chat/chat-submit.php" ?>
                </div>
            </div>
        </div>
    </div>
</div>