<?php

function displayCertification($organizer) {
    if($organizer->verified)
        return "Geverifieerde organisator";
    else
        return "Nieuwe organisator";
}
?>

<div uk-grid>
    <div class="uk-width-2-3 uk-margin-xlarge-left uk-margin-medium-top">
        <div class="uk-width-1-1">
            <div class="customized-festival-title">
                Over Organisator
            </div>
        </div>
        <div class="uk-width-1-1">
            <p>Kom meer te weten over ons</p>
        </div>
    </div>
</div>

<div class="uk-container-large uk-margin-xlarge-left uk-margin-xlarge-right">
    <div class="uk-child-width-1-1@s" uk-grid
         uk-scrollspy="cls: uk-animation-fade; target: > div > .uk-card; delay: 300; repeat: false">
        <div>
            <div class="uk-card uk-card-default uk-width-1-2@m text">
                <div class="uk-card-header">
                    <div class="uk-grid-small uk-flex-middle" uk-grid>
                        <div class="uk-width-auto">
                            <img class="customized-picture-logo"
                                 src="<?= $organizer->avatar ?>">
                        </div>
                        <div class="uk-width-expand">
                            <h3 class="uk-card-title uk-margin-remove-bottom"><?= $organizer->organisation_name ?></h3>
                            <p class="uk-text-meta uk-margin-remove-top"><?= displayCertification($organizer) ?></p>
                        </div>
                    </div>
                </div>
                <div class="uk-card-body">
                    <span class="uk-margin-small-right" uk-icon="receiver"></span><b>Contact </b><?= $organizer->contact_phone ?><br>
                    <span class="uk-margin-small-right" uk-icon="mail"></span><b>E-mail </b><?= $organizer->contact_email ?><br>
                    <p><?= $organizer->description ?></p>

                </div>

                <div class="uk-card-footer">
                    <div uk-grid>
                        <div class="uk-width-1-2">
                            <a href="./profile.php?account=<?= $organizer->account_id ?>&type=o" class="uk-button uk-button-secondary">Bekijk profiel</a>
                        </div>
                        <div class="uk-width-1-2 uk-text-right">
                            <a href="<?= $party->social_twitter ?>" class="uk-icon-button uk-margin-small-right uk-button-secondary" uk-icon="twitter"></a>
                            <a href="<?= $party->social_facebook ?>" class="uk-icon-button uk-margin-small-right uk-button-secondary" uk-icon="facebook"></a>
                            <a href="<?= $party->social_instagram ?>" class="uk-icon-button uk-margin-small-right uk-button-secondary" uk-icon="instagram"></a>
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </div>
</div>