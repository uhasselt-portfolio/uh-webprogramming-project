<?php

function displayCreatedParty($party) {
    ?>

    <tr>

        <td>
            <img class="uk-preserve-width customized-picture-logo"
                 src="<?= $party->card_image ?>" width="40" alt="">
        </td>
        <td><?= ucfirst($party->name) ?></td>
        <td><?= ucfirst($party->province) ?>, <?= ucfirst($party->city) ?></td>
        <td><?= date('d/m/Y H:i', strtotime($party->start_time_party) )?></td>
        <td><?= $party->age_restriction ?>+</td>
        <td>
            <button class="uk-icon-button" uk-icon="more-vertical"></button>
            <div uk-dropdown="mode: click">
                <ul class="uk-nav uk-dropdown-nav">
                    <li class="uk-nav-header">Opties</li>
                    <li>
                        <a href="./middleware-party-dashboard.php?partyID=<?= $party->party_id ?>" class="uk-margin-small-right">
                            <span uk-icon="file-edit"></span> Beheer
                        </a>
                    </li>
                    <li>
                        <a href="./middleware-party-delete.php?partyID=<?= $party->party_id ?>" class="uk-margin-small-right">
                            <span uk-icon="trash"></span> Verwijder
                        </a>
                    </li>
                </ul>
            </div>
        </td>
    </tr>

    <?php
}

function displayCreatedParties($parties) {
    ?>

    <table class="uk-table uk-table-divider ">
        <thead>
        <tr>
            <th class="uk-table-shrink">Logo</th>
            <th class="uk-width-small">Naam</th>
            <th class="uk-width-small">Locatie</th>
            <th class="uk-width-small">Datum</th>
            <th class="uk-table-shrink">Leeftijdsbeperking</th>
            <th class="uk-width-small">Opties</th>
        </tr>
        </thead>
        <tbody>
        <?php

        for ($i = 0; $i < count($parties); $i++) {
            displayCreatedParty($parties[$i]);
        }

        ?>
        </tbody>
    </table>

    <?php
}

$parties = Organizer::getCreatedParties($_SESSION['organizer']->organizer_id);

if(count($parties) == 0) {
    ?>

    <div class="uk-text-center uk-margin-medium-bottom">
        <div class="uk-width-1-1">
            <img src="./public/images/empty-box.png" alt="Empty box picture" width="5%" height="5%">
        </div>
        <div class="uk-width-1-1">
            U heeft op dit moment geen fuiven om te beheren.
        </div>
    </div>

    <?php
} else {
    displayCreatedParties($parties);
}

?>

