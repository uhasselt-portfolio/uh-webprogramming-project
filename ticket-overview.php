<?php

session_start();

require_once "./app/core/Handle.php";
require_once "./app/models/Tickets.php";

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

?>



<div class="uk-container-large uk-margin-xlarge-left uk-margin-xlarge-right uk-margin-medium-top">
    <div class="uk-child-width-1-1@s" uk-grid
         uk-scrollspy="cls: uk-animation-fade; target: > div > .uk-card; delay: 300; repeat: false">
        <div>
            <div class="uk-card uk-card-default uk-card-hover uk-card-body">
                <h3 class="customized-dashboard-card-title">Ticket Overzicht</h3>
                <?php
                Handle::displayPopups();

                require_once "./app/views/ticket-dashboard/created-tickets.php";

                ?>
                <div class="uk-text-center">
                    <a href="./ticket-setup.php" class="uk-button uk-button-text">
                        <button class="uk-button uk-button-secondary"><span uk-icon="plus"></span> Voeg een nieuw
                            ticket toe</button>
                    </a>
                </div>
            </div>
        </div>
    </div>
</div>
</body>

</html>
