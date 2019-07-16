<?php

$ratings = Ratings::getRatingViaParty($party->party_id);

function displayRating($rating) {
    ?>

    <div class="uk-grid-small uk-flex-middle" uk-grid>
        <div class="uk-width-auto">
            <a class="uk-link-reset" href="./profile.php?account=<?= $rating->account_id ?>&type=a">
                <img class="customized-picture-logo" src="<?= $rating->avatar ?>">
            </a>
        </div>
        <div class="uk-width-expand">
            <a class="uk-link-reset" href="./profile.php?account=<?= $rating->account_id ?>&type=a">
                <b class="uk-margin-remove-bottom"><?= $rating->first_name ?></b>
            </a>
            <p class="uk-text-meta uk-margin-remove-top uk-margin-remove-bottom"> Geplaatst
                om <?= date('d/m/Y H:i', strtotime($rating->created_at)) ?></p>
            <p class="uk-text-meta uk-margin-remove-top uk-margin-remove-bottom">
                Rating:
                <span class="uk-badge uk-background-secondary">
                    <span class="uk-margin-small-left"><?= $rating->rating ?></span>
                    <span class="uk-margin-small-left uk-margin-small-right" uk-icon="star"></span>
                </span>
            </p>


        </div>
    </div>

    <?php
}

?>

<div>
    <div class="uk-card uk-card-default uk-card-hover uk-card-body">
        <h3 class="customized-dashboard-card-title">Recente Beoordelingen</h3>
        <?php

        if (count($ratings) == 0) {
            echo "Nog geen ratings gekregen!";
        } else {
            for ($i = 0; $i < count($ratings); $i++)
                displayRating($ratings[$i]);
        }

        ?>
    </div>
</div>
