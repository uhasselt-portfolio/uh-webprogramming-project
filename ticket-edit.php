<?php

session_start();

require_once "./app/core/Handle.php";
require_once "./app/models/Tickets.php";

function hasEditAuthority($id) {
    $ticket = Tickets::getTicket($id);
    if(empty($ticket) || $_SESSION['party-manager']->party_id != $ticket->party_id) {
        Handle::setPopup(Popups::noEditPermissions());
        Handle::redirect("ticket-overview.php");
    }
}

Handle::handleCommercialAuthentication();

Handle::hasManageAuthority();

Handle::requiredParameters([$_GET['ticketID']], Popups::wrongParameters(), "ticket-overview.php");

hasEditAuthority($_GET['ticketID']);

?>

<html>

<head>
    <!-- UIkit CSS -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/uikit/3.0.3/css/uikit.min.css"/>
    <link rel="stylesheet" href="./public/css/uikit_customized.css">

    <!-- UIkit JS -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/uikit/3.0.3/js/uikit.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/uikit/3.0.3/js/uikit-icons.min.js"></script>
    <script src="./public/js/UIKit.js"></script>
    <script src="./public/js/isValidForm.js"></script>
</head>

<body>

<?php

Handle::displayPopups();

require_once "./app/views/global/head-navbar-organizer.php";
require_once "./app/views/global/head-navbar-organizer-popup.php";

require_once "./app/views/global/sub-navbar-organizer.php";
require_once "./app/views/global/sub-navbar-organizer-popup.php";

require_once "./app/views/ticket-dashboard/ticket-edit-form.php";

?>


</body>

</html>