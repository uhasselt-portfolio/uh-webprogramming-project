<?php

function displayTitle($title, $description, $redirect, $scroll_id) {
    ?>
    <div id="<?= $scroll_id ?>" class="uk-grid-small uk-margin-large-top" uk-grid>
        <div class="uk-width-1-2">
            <h3 class="uk-text-bold uk-margin-xlarge-left"><?= $title ?></h3>
        </div>
        <div class="uk-width-1-2 uk-text-center">
        </div>
        <div class="uk-width-1-2 uk-margin-medium-bottom">
            <p class="uk-margin-xlarge-left"><?= $description ?></p>
        </div>
        <div class="uk-width-1-2 uk-text-right">
            <a class="customized-see-more uk-margin-xlarge-right" href="<?= $redirect ?>">
                <span>Zie alles</span>
                <span uk-icon="chevron-right"></span>
            </a>
        </div>
    </div>
    <?php
}
?>