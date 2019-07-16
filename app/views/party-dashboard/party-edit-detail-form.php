<?php

function getTime($date) {
    return date('h:i', strtotime($date));
}

$party = $_SESSION['party-manager'];

?>

<div class="uk-container-large uk-margin-xlarge-left uk-margin-xlarge-right uk-margin-medium-top">
    <div class="uk-width-1-1 uk-margin-medium-top uk-margin-medium-bottom">
        <div class="uk-text-left">
            <a class="uk-link-reset" href="./dashboard.php">
                <span class="uk-margin-small-right" uk-icon="arrow-left"></span>
                Terug naar dashboard
            </a>
        </div>
    </div>
    <form name="party-edit-detail-form"
          action="middleware-party-edit-detail.php"
          onsubmit="return isValidForm('party-edit-detail-form', ['text', 'text', 'number', 'number', 'number', 'number', 'text', 'text', 'url', 'url', 'url']);"
          method="POST"
          enctype="multipart/form-data">
        <div class="uk-child-width-1-2@s" uk-grid
             uk-scrollspy="cls: uk-animation-fade; target: > div > .uk-card; delay: 300; repeat: false">
            <div>
                <div class="uk-card uk-card-default uk-card-hover uk-card-body uk-margin-large-bottom">
                    <h3 class="customized-dashboard-card-title uk-margin-remove-bottomfl">Fuif Start & Einde</h3>
                    <p class="uk-article-meta uk-margin-remove-top ">Start en eind tijd van de fuif.</p>
                    <div class="uk-margin uk-inline uk-margin-remove-top">
                        <span class="uk-form-icon" uk-icon="icon: clock"></span>
                        <input value="<?= getTime($party->start_time_party) ?>" id="startTimeParty" name="startTimeParty" class="uk-input uk-form-width-medium" type="time"
                               placeholder="Kies een begin uur..">
                    </div>
                    <div class="uk-margin uk-inline uk-margin-remove-top">
                        <span class="uk-form-icon" uk-icon="icon: clock"></span>
                        <input value="<?= getTime($party->end_time_party) ?>" id="endTimeParty" name="endTimeParty" class="uk-input uk-form-width-medium" type="time"
                               placeholder="Kies een eind uur..">
                    </div>
                    <h3 class="customized-dashboard-card-title uk-margin-small-top uk-margin-remove-bottom">Minimum leeftijd</h3>
                    <p class="uk-article-meta uk-margin-remove-top ">Minimum leeftijd voor toegang op je fuif.</p>
                    <div class="uk-margin uk-inline uk-margin-remove-top">
                        <span class="uk-form-icon" uk-icon="icon: ban"></span>
                        <input value="<?= $party->age_restriction ?>" id="minimumAge" name="minimumAge" class="uk-input uk-form-width-medium" type="text"
                               placeholder="Minimum leeftijd">
                    </div>
                    <h3 class="customized-dashboard-card-title uk-margin-small-top uk-margin-remove-bottom">Bonnen</h3>
                    <p class="uk-article-meta uk-margin-remove-top">Aantal bonnen per aankoop en prijs in euro per aankoop.</p>
                    <div class="uk-margin uk-inline uk-margin-remove-top">
                        <span class="uk-form-icon" uk-icon="icon: cart"></span>
                        <input value="<?= $party->coupon_amount_buy_in ?>" id="amount" name="amount" class="uk-input uk-form-width-medium" type="text"
                               placeholder="Aantal">
                    </div>
                    <div class="uk-margin uk-inline uk-margin-remove-top">
                        <span class="uk-form-icon" uk-icon="icon: credit-card"></span>
                        <input value="<?= $party->coupon_price ?>" id="minimumPrice" name="minimumPrice" class="uk-input uk-form-width-medium" type="text"
                               placeholder="Prijs">
                    </div>
                    <h3 class="customized-dashboard-card-title uk-margin-small-top uk-margin-remove-bottom">Vestiaire</h3>
                    <p class="uk-article-meta uk-margin-remove-top ">Prijs van de vestiaire per stuk.</p>
                    <div class="uk-margin uk-inline uk-margin-remove-top">
                        <span class="uk-form-icon" uk-icon="icon: credit-card"></span>
                        <input value="<?= $party->cloakroom_price ?>" id="cloakRoom" name="cloakRoom" class="uk-input uk-form-width-medium" type="text"
                               placeholder="Prijs">
                    </div>
                </div>
            </div>
            <div>
                <div class="uk-card uk-card-default uk-card-hover uk-card-body uk-margin-large-bottom">
                    <h3 class="customized-dashboard-card-title uk-margin-small-top uk-margin-remove-bottom">Happy Hour Start & Einde</h3>
                    <p class="uk-article-meta uk-margin-remove-top ">Start en eind tijd voor happy hour.</p>
                    <div class="uk-margin uk-inline uk-margin-remove-top">
                        <span class="uk-form-icon" uk-icon="icon: clock"></span>
                        <input value="<?= getTime($party->start_time_hh) ?>" id="happyHourStartTime" name="happyHourStartTime" class="uk-input uk-form-width-medium" type="time"
                               placeholder="Kies een begin uur..">
                    </div>
                    <div class="uk-margin uk-inline uk-margin-remove-top">
                        <span class="uk-form-icon" uk-icon="icon: clock"></span>
                        <input value="<?= getTime($party->end_time_hh) ?>" id="happyHourEndTime" name="happyHourEndTime" class="uk-input uk-form-width-medium" type="time"
                               placeholder="Kies een begin uur..">
                    </div>
                    <h3 class="customized-dashboard-card-title uk-margin-small-top uk-margin-remove-bottom">Social Media</h3>
                    <p class="uk-article-meta uk-margin-remove-top ">Uw social media links, niet verplicht.</p>
                    <div class="uk-margin">
                                <span href="" class="uk-icon-button uk-margin-small-right uk-button-secondary"
                                      uk-icon="facebook"></span>
                        <input value="<?= $party->social_facebook ?>" id="facebookUrl" name="facebookUrl" class="uk-input uk-form-width-medium" type="text"
                               placeholder="https://facebook.com/....">
                    </div>
                    <div class="uk-margin">
                                <span href="" class="uk-icon-button uk-margin-small-right uk-button-secondary"
                                      uk-icon="instagram"></span>
                        <input value="<?= $party->social_instagram ?>" id="instagramUrl" name="instagramUrl" class="uk-input uk-form-width-medium" type="text"
                               placeholder="https://instagram.com/....">
                    </div>
                    <div class="uk-margin">
                                <span href="" class="uk-icon-button uk-margin-small-right uk-button-secondary"
                                      uk-icon="twitter"></span>
                        <input value="<?= $party->social_twitter ?>" id="twitterUrl" name="twitterUrl" class="uk-input uk-form-width-medium" type="text"
                               placeholder="https://twitter.com/....">
                    </div>
                    <div class="uk-margin-small-top">
                        <button type="submit" class="uk-button uk-button-secondary"><span uk-icon="plus"></span>Bewaar gegevens</button>
                    </div>
                </div>
            </div>
        </div>
</div>
</form>
</div>