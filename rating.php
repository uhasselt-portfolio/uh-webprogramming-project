<?php

session_start();

require_once "./app/models/Parties.php";
require_once "./app/core/Handle.php";
require_once "./app/models/Ratings.php";
require_once "./app/models/Parties.php";
require_once "./app/models/Tickets.php";

Handle::authentication("account", Popups::mustBeAuthenticated(), "login.php");

Handle::requiredParameters([$_GET['purchaseID']], Popups::noIDGiven(), "parties.php");

$account = $_SESSION['account'];
$ticket = Tickets::getPurchase($_GET['purchaseID']);
$party = Parties::getParty($ticket->party_id);

if($account->account_id != $ticket->account_id) {
    Handle::setPopup(Popups::noPermission());
    Handle::redirect("index.php");
}

$hasBeenRated = Ratings::isPartyRatedByAccount($ticket->party_id, $account->account_id);

if($hasBeenRated) {
    Handle::setPopup(Popups::partyAlreadyRated());
    Handle::redirect("index.php");
}

?>


<html class="uk-background-muted">
<head>
    <!-- UIkit CSS -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/uikit/3.0.3/css/uikit.min.css">
    <link rel="stylesheet" href="./public/css/uikit_customized.css">

    <!-- UIkit JS -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/uikit/3.0.3/js/uikit.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/uikit/3.0.3/js/uikit-icons.min.js"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    <script type="text/javascript" src="./public/js/UIKit.js"></script>
    <script type="text/javascript" src="./public/js/isValidForm.js"></script>

</head>
<body>

<?php

Handle::displayPopups();

require_once "./app/views/global/head-navbar.php";
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
        <div class="uk-width-1-2">
            <div class="uk-card uk-card-default uk-card-hover">
                <?php require_once "./app/views/rating/rating-form.php"?>
            </div>
        </div>
    </div>
</div>


</body>