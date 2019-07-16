<?php

session_start();

require_once "./app/core/Handle.php";

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
    <script type="text/javascript" src="./public/js/UIKit.js"></script>

    <!-- PHP Functions -->
    <?php

    require_once "app/models/Parties.php";

    ?>
</head>

<body>
<?php

/** Head navbar **/
require_once "./app/views/global/head-navbar.php";

/** Popup navbar when screen too small **/
require_once "./app/views/global/head-navbar-popup.php";

Handle::displayPopups();

?>

<!-- Header -->

<div class="uk-height-medium uk-flex uk-flex-center uk-flex-middle uk-background-cover uk-light"
     data-src="./public/images/background-4.jpg" uk-img>
    <div class="customized-festival-header">Vind jouw perfecte fuif hier</div>
</div>

<!-- Filter -->

<div class="uk-grid-small uk-margin-large-top uk-margin-large-bottom" uk-grid>
    <div class="uk-width-1-2">
        <h3 id="new-parties" class="customized-festival-title uk-margin-xlarge-left">Personaliseer je zoek resultaten </h3>
    </div>
</div>

<?php

require_once "./app/views/parties/filter.php";

require_once "./app/views/parties/search-result.php";

require_once "./app/views/global/footer.php"

?>

</body>

</html>