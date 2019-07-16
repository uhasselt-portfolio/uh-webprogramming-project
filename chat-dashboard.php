<?php

require_once "./app/core/Handle.php";
require_once "./app/models/Chat.php";
require_once "./app/models/Accounts.php";

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
require_once "./app/views/global/head-navbar-organizer.php";
require_once "./app/views/global/head-navbar-organizer-popup.php";

require_once "./app/views/global/sub-navbar-organizer.php";
require_once "./app/views/global/sub-navbar-organizer-popup.php";

Handle::displayPopups();

?>

<div class="uk-container-large uk-margin-xlarge-left uk-margin-xlarge-right uk-margin-medium-top">
    <div uk-grid>
        <?php

        require_once "./app/views/chat-dashboard/chat-partner-overview.php";
        require_once "./app/views/chat-dashboard/chat-frame.php";
        require_once "./app/views/chat-dashboard/chat-submit.php";

        ?>
    </div>
</div>
</body>

</html>