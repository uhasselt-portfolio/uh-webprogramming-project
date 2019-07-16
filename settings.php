<?php
session_start();
require_once "./app/core/Handle.php";


if(!isset($_SESSION['account'])) {
    Handle::redirect("login.php");
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
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    <script src="./public/js/UIKit.js"></script>
    <script src="./public/js/isValidForm.js"></script>
    <script src="./public/js/SettingSaver.js"></script>

</head>

<body>
<?php

/** Head navbar **/
require_once "./app/views/global/head-navbar.php";

/** Popup navbar when screen too small **/
require_once "./app/views/global/head-navbar-popup.php";

?>

<!-- Header -->

<div class="uk-height-medium uk-flex uk-flex-center uk-flex-middle uk-background-cover uk-light"
     data-src="./public/images/background-4.jpg" uk-img>
    <div class="customized-festival-header">Account Instellingen</div>
</div>

<!-- Security -->

<div class="uk-grid-small uk-margin-large-top uk-margin-large-bottom" uk-grid>

    <?php require_once "./app/views/settings/account-form.php"; ?>

    <div class="uk-container uk-margin-xlarge-left">
        <?php
        
            Handle::displayPopups();

            if(isset($_SESSION['settings-save-success'])) {
                if($_SESSION['settings-save-success'] == 1)
                    Handle::handleSuccessAlert("Instellingen opgeslagen!");
                unset($_SESSION['settings-save-success']);
            }

            require_once "./app/views/settings/avatar-form.php";
            require_once "./app/views/settings/security-form.php";
        ?>
    </div>
</div>

<?php

require_once "./app/views/global/footer.php"

?>

</body>

</html>