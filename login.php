<?php
    session_start();
    require_once "./app/core/Handle.php";

    Handle::accountSetupProcess('LOGIN');
?>

<html>

<head>
    <!-- UIkit CSS -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/uikit/3.0.3/css/uikit.min.css"/>
    <link rel="stylesheet" href="./public/css/uikit_customized.css">

    <!-- UIkit JS -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/uikit/3.0.3/js/uikit.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/uikit/3.0.3/js/uikit-icons.min.js"></script>
    <script type="text/javascript" src="./public/js/UIKit.js"></script>
    <script type="text/javascript" src="./public/js/isValidForm.js"></script>
</head>

<body>
<div class="uk-background-cover uk-height-1-1" style="background-image: url('./public/images/background-1.jpg');">

    <?php

    Handle::displayPopups();

    /** Head navbar **/
    require_once "./app/views/global/head-navbar.php";

    /** Popup navbar when screen too small **/
    require_once "./app/views/global/head-navbar-popup.php";

    /** Login Form **/
    require_once "./app/views/login/login-form.php";

    ?>

</div>
</body>

</html>