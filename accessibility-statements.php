<?php

session_start();

require_once "./app/core/Handle.php";

?>


<html class="uk-background-muted">
<head>
    <!-- UIkit CSS -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/uikit/3.0.3/css/uikit.min.css" />
    <link rel="stylesheet" href="./public/css/uikit_customized.css">

    <!-- UIkit JS -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/uikit/3.0.3/js/uikit.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/uikit/3.0.3/js/uikit-icons.min.js"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    <script type="text/javascript" src="./public/js/UIKit.js"></script>
</head>
<body>

<?php

/** Head navbar **/
require_once "./app/views/global/head-navbar.php";

/** Popup navbar when screen too small **/
require_once "./app/views/global/head-navbar-popup.php";

Handle::displayPopups();

?>

<div class="uk-margin-xlarge-left uk-margin-xlarge-right uk-margin-medium-top uk-margin-medium-bottom">

    <div class="uk-container-large" uk-grid>
        <div class="uk-width-1-1">
            <div class="uk-text-left">
                <a class="uk-link-reset" href="javascript:history.go(-1)">
                    <span class="uk-margin-small-right" uk-icon="arrow-left"></span>
                    Terug naar vorige pagina
                </a>
            </div>
        </div>
        <div class="uk-width-1-1">
            <div class="uk-card uk-card-default uk-card-hover">
                <div class="uk-card-header">
                    <h3 class="customized-dashboard-card-title">Accessibility Statements</h3>
                </div>
                <div class="uk-card-body">
                    <ul class="uk-list uk-list-bullet">

                        <li>Filters worden standaard voorzien van de huidige datum zodat de gebruiker deze zelf niet moet veranderen.</li>
                        <li>Login en register pagina weinig input velden. Input velden zijn verdeeld over meerdere forms zodat het minder bombastisch lijkt en de aanmeld drempel lager ligt.</li>
                        <li>Success en fail kleuren toegevoegd wanneer form submit, makkelijk zichtbaar wanneer iets fout gaat.</li>
                        <li>Grote fail pop-up die duidelijk in beeld komt zonder de rest van de content te storen.</li>
                        <li>Als account setup nog niet gedaan is kan de gebruiker altijd zonder problemen hier mee verder gaan door terug in te loggen of in de navigatie balk op setup process te k klikken.</li>
                        <li>Instellingen worden automatisch opgeslagen + real time input checking.</li>
                        <li>Foto's op fuif pagina's kunnen vergroot worden voor slechtziende.</li>
                        <li>Duidelijke aangeving van organisator en fuifganger pagina a.d.h.v verschillende navigatie balk kleuren.</li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
</div>


</body>

</html>