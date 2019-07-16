<?php

function displayMemberState($organizer) {
    if($organizer->verified)
        return "Geverifieerde organisator";
    else
        return "Nieuwe organisator";
}

?>

<div class="uk-grid-match uk-child-width-expand@m" uk-grid>
    <div class="uk-width-1-1">
        <div class="uk-text-left">
            <a class="uk-link-reset" href="javascript:history.go(-1)">
                <span class="uk-margin-small-right" uk-icon="arrow-left"></span>
                Terug naar vorige pagina
            </a>
        </div>
    </div>
    <div class="uk-width-1-2@m uk-width-1-1@s uk-flex-middle" uk-grid>
        <div class="uk-width-auto">
            <img class="customized-picture-logo-big" src="<?= $organizer->avatar ?>">
        </div>
        <div class="uk-width-expand">
            <h3 class="uk-card-title uk-margin-remove-bottom"><?= $organizer->organisation_name ?></h3>
            <p class="uk-text-meta uk-margin-remove-top uk-margin-remove-bottom"><?= displayMemberState($organizer) ?></p>
            <p class="uk-text-meta uk-margin-remove-top">Lid sinds <?= date('d/m/Y', strtotime($organizer->created_at)) ?></p>
        </div>
    </div>
    <div class="uk-width-1-2@m uk-width-1-1@s " uk-grid>
        <div class="uk-width-expand uk-text-right">
            <a class="uk-margin-medium-right" href="">
                <button class="uk-button uk-button-secondary">
                    <span class="uk-margin-small-right" uk-icon="receiver"></span>
                    Call
                </button>
            </a>
            <a href="./chat.php?organizerID=<?= $organizer->organizer_id ?>">
                <button class="uk-button uk-button-secondary">
                    <span class="uk-margin-small-right" uk-icon="comment"></span>
                    Chat
                </button>
            </a>
        </div>
    </div>
</div>