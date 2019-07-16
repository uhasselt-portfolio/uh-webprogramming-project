<div uk-grid>
    <div class="uk-width-2-3 uk-margin-xlarge-left">
        <div class="uk-width-1-1">
            <div class="customized-festival-title">
                Trailer
            </div>
        </div>
        <div class="uk-width-1-1">
            <p>Perfecte manier om te kijken of de fuif voldoet aan je verwachtingen</p>
        </div>
    </div>
</div>

<?php

if(isset($party->trailer_video)) {

    ?>

    <div class="uk-width-3-5@m uk-width-1-1@s">
        <div class="uk-container-large uk-margin-xlarge-left uk-margin-xlarge-right ">
        <video src="<?= $party->trailer_video ?>" loop playsinline uk-video="autoplay: inview"></video>
        </div>
    </div>

    <?php

} else {
    ?>

    <div class="uk-width-3-5@m uk-width-1-1@s">
        <div class="uk-container-large uk-margin-xlarge-left uk-margin-xlarge-right">
            <div class="uk-card uk-card-default uk-card-small uk-card-body uk-background-muted">
                <p>De organisator heeft nog geen trailer toegevoegd! Deze kunnen altijd op een later tijdstip worden toegevoegd door de organisator.</p>
            </div>
        </div>
    </div>

    <?php
}


?>