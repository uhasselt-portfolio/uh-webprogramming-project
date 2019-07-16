<?php

function displayPartyCard($ratings) {
    if(count($ratings) <= 0) {
        ?>

        <div>
            Deze organisator heeft nog geen review.
        </div>

        <?php
    }
    else
        foreach($ratings as $rating) {
            ?>
            <div class="uk-width-1-3@m uk-width-1-1@s">
                <div class="uk-width-1-1">
                    <div class="uk-grid-small uk-flex-middle" uk-grid>
                        <div class="uk-width-auto">
                            <a class="uk-link-reset" href="./profile.php?account=<?= $rating->account_id ?>&type=a">
                                <img class="customized-picture-logo" src="<?= $rating->avatar ?>">
                            </a>
                        </div>
                        <div class="uk-width-expand">
                            <a class="uk-link-reset" href="./profile.php?account=<?= $rating->account_id ?>&type=a">
                                <h3 class="uk-card-title uk-margin-remove-bottom"><?= $rating->first_name ?></h3>
                            </a>
                            <p class="uk-text-meta uk-margin-remove-top uk-margin-remove-bottom"> Geplaatst om <?= date('d/m/Y H:i', strtotime($rating->created_at))  ?></p>
                            <p class="uk-text-meta uk-margin-remove-top uk-margin-remove-bottom">
                                Rating: <span class="uk-badge uk-background-secondary">
                                    <span class="uk-margin-small-left"><?= $rating->rating ?></span>
                                    <span class="uk-margin-small-left uk-margin-small-right" uk-icon="star"></span>
                                </span>
                            </p>
                        </div>
                    </div>
                </div>
                <div class="uk-width-1-1 uk-margin-large-left uk-margin-small-top">
                    <div class="uk-width-expand">
                        <b><?= $rating->title ?> </b><br>
                        <?= $rating->comment ?>
                    </div>
                </div>
            </div>

            <?php
        }
}

?>

<h3>Recente Reviews</h3>
<div class="uk-grid-match uk-child-width-expand@m" uk-grid>
    <?php

    displayPartyCard($ratings);

    ?>
</div>