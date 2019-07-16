<?php

session_start();

require_once "./app/core/Handle.php";
require_once "./app/models/Menus.php";

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
<div class="uk-margin-xlarge-left uk-margin-xlarge-right uk-margin-medium-top uk-margin-medium-bottom">
    <div class="uk-container-large" uk-grid>

        <?php
        Handle::displayPopups();
        require_once "./app/views/menu-dashboard/menu-add-form.php";
        require_once "./app/views/menu-dashboard/menu-overview.php";

        ?>

    </div>

</div>

</body>

</html>