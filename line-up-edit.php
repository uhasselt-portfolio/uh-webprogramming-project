<?php

session_start();
require_once "./app/core/Handle.php";
require_once "./app/models/Genres.php";
require_once "./app/models/Artists.php";

function hasEditAuthority($id) {
    $artist = Artists::getArtist($id, $_SESSION['party-manager']->party_id);
    if(empty($artist) || $_SESSION['party-manager']->party_id != $artist->party_id) {
        Handle::setPopup(Popups::noEditPermissions());
        Handle::redirect("line-up-overview.php");
    }
}

Handle::hasManageAuthority();

Handle::handleCommercialAuthentication();

hasEditAuthority($_GET['artistID']);

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

require_once "./app/views/line-up-dashboard/line-up-edit-form.php";

?>
</body>

</html>
