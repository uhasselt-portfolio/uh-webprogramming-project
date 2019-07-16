<?php

function displayArtist($artist) {
    ?>

    <a class="customized-genre-image">
        <div class="uk-height-medium uk-flex uk-flex-center uk-flex-middle uk-background-cover uk-light"
             data-src="<?= $artist->avatar ?>" uk-img>
            <div class="customized-genre-text"><?= $artist->name ?></div>
        </div>
    </a>

    <?php
}

function displayLineup($artists) {
    ?>

    <div class="uk-container-large uk-margin-xlarge-left uk-margin-xlarge-right">
        <div class="uk-child-width-1-2@s uk-child-width-1-5@m" uk-grid
             uk-scrollspy="cls: uk-animation-fade; target: > div > .customized-genre-image; delay: 300; repeat: false">
            <?php

            foreach ($artists as $artist)
                displayArtist($artist);

            ?>
        </div>
    </div>

    <?php
}

?>

<div class="uk-margin-medium-top" uk-grid>
    <div class="uk-width-2-3 uk-margin-xlarge-left ">
        <div class="uk-width-1-1">
            <div class="customized-festival-title">
                Line-up
            </div>
        </div>
        <div class="uk-width-1-1">
            <p>Ontdek welke dj's er allemaal naar deze fuif komen</p>
        </div>
    </div>
</div>

<?php

if(count($lineUp) == 0) {
    ?>

    <div class="uk-width-3-5@m uk-width-1-1@s">
        <div class="uk-container-large uk-margin-xlarge-left uk-margin-xlarge-right">
            <div class="uk-card uk-card-default uk-card-small uk-card-body uk-background-muted">
                <p>De organisator heeft nog geen line-up toegevoegd! Deze kunnen altijd op een later tijdstip worden toegevoegd door de organisator.</p>
            </div>
        </div>
    </div>

    <?php
} else
    displayLineup($lineUp);

?>
