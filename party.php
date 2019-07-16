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

    <!-- Imports -->
    <?php

    require_once "./app/models/Parties.php";
    require_once "./app/models/Artists.php";
    require_once "./app/models/Tickets.php";
    require_once "./app/models/Menus.php";
    require_once "./app/models/Photos.php";
    require_once "./app/models/Accounts.php";
    require_once "./app/models/Organizer.php";
    require_once "./app/models/WaitingList.php";

    ?>
</head>
<body>

<!-- Variables -->
<?php

    $partyID = $_GET['party'];

    if(empty($partyID)) {
        Handle::setPopup(Popups::noPartyFound());
        Handle::redirect("index.php");
    }

    $party = Parties::getParty($partyID);

    if(empty($party)) {
        Handle::setPopup(Popups::noPartyFound());
        Handle::redirect("index.php");
    }

    if(!$party->active) {
        Handle::setPopup(Popups::partyInactive());
        Handle::redirect("index.php");
    }

    $lineUp = Artists::getArtistsPerforming($partyID);
    $ticketsAvailable = Tickets::getTicketsAvailable($partyID);
    $ticketsExpiredOrSoldOut = Tickets::getTicketsExpiredOrSoldOut($partyID);
    $menu = Menus::getMenuList($partyID);
    $photos = Photos::getPhotos($partyID);
    $organizer = Organizer::getPartyOrganizer($partyID);
?>


<div class="uk-background-cover uk-height-large" style="background-image: url('<?= $party->background_image ?>'); ">
    <?php

    Handle::displayPopups();

    /** Head navbar **/
    require_once "./app/views/global/head-navbar.php";

    /** Party header **/
    require_once "./app/views/party/party-header.php";

    ?>
</div>

<?php

/** Popup navbar when screen too small **/
require_once "./app/views/global/head-navbar-popup.php";

/** Party information **/
require_once "./app/views/party/party-information.php";

/** Party trailer **/
require_once "./app/views/party/party-trailer.php";

/** Party line-up **/
require_once "./app/views/party/party-line-up.php";

/** Party tickets **/
require_once "./app/views/party/party-tickets.php";

/** Party menu **/
require_once "./app/views/party/party-menu.php";

/** Party media **/
require_once "./app/views/party/party-media.php";

/** Party organizer **/
require_once "./app/views/party/party-about-organizer.php";

/** Party footer **/
require_once "./app/views/global/footer.php";
?>

</body>

</html>