<?php

require_once "./app/models/Parties.php";

function displaySuggestedParties($party)
{
    ?>
    <li>
        <a class="uk-accordion-title"><?= $party->name ?></a>
        <div class="uk-accordion-content">
            <span class="uk-margin-small-right" uk-icon="location"></span><b>Locatie </b><?= $party->city ?><br>
            <span class="uk-margin-small-right" uk-icon="clock"></span><b>Datum & Deuren </b><?= date('d/m/Y h:i', strtotime($party->start_time_party)) ?><br>
            <span class="uk-margin-small-right" uk-icon="warning"></span><b>Leeftijd </b><?= $party->age_restriction ?>+<br>
            <a href="./party.php?party=<?= $party->party_id ?>">
                <div class="uk-button uk-button-secondary uk-margin-small-top">
                    Bezoek pagina
                </div>
            </a>
        </div>
    </li>
    <?php
}


if (isset($_POST['value'])) {

    $parties = Parties::searchParty($_POST['value']);

    if (count($parties) == 0) {
        echo "Geen fuiven gevonden.";
    } else {
        for ($i = 0; $i < count($parties); $i++)
            displaySuggestedParties($parties[$i]);
        ?>
        <div class=" uk-margin-medium-top uk-text-center">
            <a class="uk-link-reset" href="./parties.php">
                Geavanceerd zoeken
                <span  uk-icon="icon: arrow-right"></span>
            </a>
        </div>

        <?php
    }
}

?>
