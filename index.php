<?php
session_start();

require_once "./app/views/index/party-title.php";
require_once "./app/views/index/party-card-row.php";
require_once "./app/models/Parties.php";
require_once "./app/core/Handle.php";

?>

<html>
<head>
    <!-- UIKit CSS -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/uikit/3.0.3/css/uikit.min.css"/>
    <link rel="stylesheet" href="./public/css/uikit_customized.css">

    <!-- UIKit JS -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/uikit/3.0.3/js/uikit.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/uikit/3.0.3/js/uikit-icons.min.js"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    <script src="./public/js/UIKit.js"></script>
    <script src="./public/js/SearchParty.js"></script>

</head>

<body>

<div class="uk-background-cover uk-height-1-1 uk-background-blend-hue"
     style="background-image: url('public/images/background-3.jpg');">
    <?php

    Handle::displayPopups();

    /** Head navbar **/
    require_once "./app/views/global/head-navbar.php";

    /** Popup navbar when screen too small **/
    require_once "./app/views/global/head-navbar-popup.php";


    /** Party search card **/
    require_once "./app/views/index/party-search-card.php";

    /** Party search popup **/
    require_once "./app/views/index/party-search-popup.php";

    ?>
</div>

<?php

/** Overview navbar **/
require_once "./app/views/index/overview-navbar.php";

/** Popular Party **/
displayTitle("Populaire Fuiven", "Wat je niet mag missen", "./parties.php", "popular-parties");
displayPartyRow(Parties::getPopularParties(3));

/** New Party **/
displayTitle("Nieuwe Fuiven", "Ook de nieuwste fuiven vind je ook bij ons", "./parties.php", "new-parties");
displayPartyRow(Parties::getNewParties(3));

/** Genres **/
displayTitle("Top Genres", "Wat jouw muzieksmaak ook mag zijn, bij ons kun je het vinden", "./parties.php", "genre-parties");
require_once "./app/views/index/party-genres.php";

/** Footer **/
require_once "./app/views/global/footer.php"

?>

</body>

</html>

