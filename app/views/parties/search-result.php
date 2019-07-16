<?php

require_once "./app/models/Parties.php";

$parties = [];
if (isset($_GET['date']) && isset($_GET['genre']) && isset($_GET['location'])) {
    $date = $_GET['date'];
    $genre = $_GET['genre'] == "no-preference" ? null : $_GET['genre'];
    $location = $_GET['location'];
    $parties = Parties::advancedSearchParty($date, $genre, $location);
} else {
    $parties = Parties::getNewParties(100);
}

?>

<div class="uk-grid-small uk-margin-large-top uk-margin-large-bottom" uk-grid>
    <div class="uk-width-1-2">
        <h3 id="new-parties" class="customized-festival-title uk-margin-xlarge-left">Alle aankomende fuiven</h3>
    </div>
</div>

<?php

function displayPartyCard($party) {
    $url = './party.php?party=' . $party->party_id;
    ?>

    <div>
        <div class="uk-card uk-card-default uk-card-hover">
            <div class="uk-card-media-top">
                <img src="<?= $party->card_image ?>" alt="Party Image">
            </div>
            <div class="uk-card-body uk-padding-remove-bottom">
                <h3 class="uk-card-title customized-party-card-title"><?= $party->name ?></h3>
                <span class="uk-margin-small-right" uk-icon="clock"></span><b>Datum </b><?= $party->start_time_party ?>
                <br>
                <span class="uk-margin-small-right" uk-icon="location"></span><b>Locatie </b><?= $party->city ?><br>
                <span class="uk-margin-small-right" uk-icon="plus-circle"></span><b>Ticket </b><?= $party->price ?> euro<br>
                <br>
            </div>
            <div class="uk-card-footer uk-text-center">
                <a href="<?= $url ?>" class="uk-button uk-button-text">
                    <button class="uk-button uk-button-secondary">Bestel je tickets nu</button>
                </a>
            </div>
        </div>
    </div>

    <?php
}

if (count($parties) == 0) {
    ?>

    <div class="uk-container-large uk-margin-xlarge-left uk-margin-xlarge-right uk-margin-remove-top" uk-grid>
        <div class="uk-width-1-2@m uk-width-1-1@s uk-card uk-card-default uk-card-body uk-background-muted">
            Er zijn geen fuiven gevonden met deze opties
        </div>
    </div>

    <?php
} else {

    ?>

    <div class="uk-container-large uk-margin-xlarge-left uk-margin-xlarge-right"
         uk-height-match="target: > div > div > .uk-card">
        <div class="uk-child-width-1-2@s uk-child-width-1-3@m" uk-grid
             uk-scrollspy="cls: uk-animation-fade; target: > div > .uk-card; delay: 300; repeat: false">
            <?php
            for ($i = 0; $i < count($parties); $i++)
                displayPartyCard($parties[$i]);
            ?>
        </div>
    </div>
    <?php
}
?>


