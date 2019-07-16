<?php

session_start();
require_once "./app/core/Handle.php";

require_once "./app/models/Accounts.php";

Handle::requiredParameters([$_SESSION['firstName'], $_SESSION['lastName'], $_SESSION['email']],
    Popups::requiredField(), "register.php");

?>

<html>
<head>
    <!-- UIkit CSS -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/uikit/3.0.3/css/uikit.min.css" />
    <link rel="stylesheet" href="./public/css/uikit_customized.css">

    <!-- UIkit JS -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/uikit/3.0.3/js/uikit.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/uikit/3.0.3/js/uikit-icons.min.js"></script>
    <script type="text/javascript" src="./public/js/UIKit.js"></script>
    <script type="text/javascript" src="./public/js/isValidForm.js"></script>
</head>

<body>

<div class="uk-background-cover uk-height-1-1" style="background-image: url('./public/images/background-4.jpg');">
    <?php

    Handle::displayPopups();

    /** Head navbar **/
    require_once "./app/views/global/head-navbar.php";

    /** Popup navbar when screen too small **/
    require_once "./app/views/global/head-navbar-popup.php";

    /** Register form **/
    require_once "./app/views/register/password-setup-form.php";

    ?>
</div>
</body>

</html>
