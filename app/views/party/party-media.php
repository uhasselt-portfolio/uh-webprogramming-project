<?php

function displayPhoto($photo) {
    ?>

    <li>
        <div uk-lightbox>
            <a href="<?= $photo->path ?>" class="uk-inline">
                <img src="<?= $photo->path ?>" alt="Fuif foto">
            </a>
        </div>
    </li>

<?php
}
?>


<div uk-grid>
    <div class="uk-width-2-3 uk-margin-xlarge-left uk-margin-medium-top">
        <div class="uk-width-1-1">
            <div class="customized-festival-title">
                Foto's
            </div>
        </div>
        <div class="uk-width-1-1">
            <p>Bekijk hier de foto's van de vorige editie</p>
        </div>
    </div>
</div>

<?php

if(count($photos) == 0) {
    ?>

    <div class="uk-width-3-5@m uk-width-1-1@s">
        <div class="uk-container-large uk-margin-xlarge-left uk-margin-xlarge-right">
            <div class="uk-card uk-card-default uk-card-small uk-card-body uk-background-muted">
                <p>Er zijn geen foto's beschikbaar van vorige edities! Deze kunnen altijd op een later tijdstip worden toegevoegd door de organisator.</p>
            </div>
        </div>
    </div>

    <?php
}
?>

<div class="uk-position-relative uk-visible-toggle uk-light uk-margin-medium-top uk-margin-xlarge-left uk-margin-xlarge-right"
     tabindex="-1" uk-slider="sets: true">

    <ul class="uk-slider-items uk-child-width-1-2 uk-child-width-1-3@m uk-grid-match">
        <?php

        foreach($photos as $photo)
            displayPhoto($photo);

        ?>
    </ul>

    <a class="uk-position-center-left uk-position-small uk-hidden-hover" href="#" uk-slidenav-previous
       uk-slider-item="previous"></a>
    <a class="uk-position-center-right uk-position-small uk-hidden-hover" href="#" uk-slidenav-next
       uk-slider-item="next"></a>
</div>

