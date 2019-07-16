<?php

session_start();

require_once "./app/core/Handle.php";

if(isset($_SESSION['organizer']) && isset($_SESSION['account'])) {
    Handle::redirect("dashboard.php");
}

?>


<html>

<head>
    <!-- UIkit CSS -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/uikit/3.0.3/css/uikit.min.css" />
    <link rel="stylesheet" href="./public/css/uikit_customized.css">

    <!-- UIkit JS -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/uikit/3.0.3/js/uikit.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/uikit/3.0.3/js/uikit-icons.min.js"></script>
    <script src="./public/js/isValidForm.js"></script>
</head>

<body>

<div class="uk-background-cover uk-height-1-1" style="background-image: url('./public/images/background-commercial.jpg');">

    <?php

    require_once "./app/views/global/head-navbar-organizer.php";

    require_once "./app/views/global/head-navbar-organizer-popup.php";

    require_once "./app/views/register/organizer-register-form.php";

    ?>

</div>

</body>

</html>