<?php

function displayCreatedLineUp($artist) {
    ?>

    <tr>

        <td>
            <img class="uk-preserve-width customized-picture-logo"
                 src="<?= $artist->avatar ?>" alt="">
        </td>
        <td><?= ucfirst($artist->name) ?></td>
        <td><?= date('H:i', strtotime($artist->start_time_performance))?> -
            <?= date('H:i', strtotime($artist->end_time_performance))?>
        </td>
        <td>
            <button class="uk-icon-button" uk-icon="more-vertical"></button>
            <div uk-dropdown="mode: click">
                <ul class="uk-nav uk-dropdown-nav">
                    <li class="uk-nav-header">Opties</li>
                    <li>
                        <a href="./line-up-edit.php?artistID=<?= $artist->artist_id ?>" class="uk-margin-small-right">
                            <span uk-icon="file-edit"></span> Beheer
                        </a>
                    </li>
                    <li>
                        <a href="./middleware-line-up-delete.php?artistID=<?= $artist->artist_id ?>" class="uk-margin-small-right">
                            <span uk-icon="trash"></span> Verwijder
                        </a>
                    </li>
                </ul>
            </div>
        </td>
    </tr>

    <?php
}

function displayCreatedLineUps($artists) {
    ?>

    <table class="uk-table uk-table-divider">
        <thead>
        <tr>
            <th>Foto</th>
            <th>Artiestennaam</th>
            <th >Performance start en eide</th>
            <th>Opties</th>
        </tr>
        </thead>
        <tbody>
        <?php

        for ($i = 0; $i < count($artists); $i++) {
            displayCreatedLineUp($artists[$i]);
        }

        ?>
        </tbody>
    </table>

    <?php
}
$partyID = $_SESSION['party-manager']->party_id;
$artists = Artists::getArtistsPerforming($partyID);

if(count($artists) == 0) {
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
    displayCreatedLineUps($artists);
}

?>

