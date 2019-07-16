<?php

function displayHappyHourTimes($party) {
    if ($party->start_time_hh == NULL && $party->end_time_hh == NULL)
        return "Niet aanwezig";

    $begin = date('h:i', strtotime($party->start_time_hh));
    $end = date('h:i', strtotime($party->end_time_hh));

    return "$begin - $end";
}

?>


<div class="uk-margin-large-top" uk-grid>
    <div class="uk-width-2-3 uk-margin-xlarge-left">
        <div class="uk-width-1-1">
            <div class="customized-festival-title">
                Informatie
            </div>
        </div>
        <div class="uk-width-1-1">
            <p>Hier vind je alle informatie terug over de fuif en de organisator</p>
            <span class="uk-margin-small-right" uk-icon="clock"></span><b>Datum & Deuren </b><?= date('d/m/Y h:i', strtotime($party->start_time_party)) ?><br>
            <span class="uk-margin-small-right" uk-icon="location"></span><b>Locatie </b><?= $party->province ?>, <?= $party->city ?>, <?= $party->address ?><br>
            <span class="uk-margin-small-right" uk-icon="tag"></span><b>Bonnen </b><?= $party->coupon_amount_buy_in ." voor ". $party->coupon_price ?>  euro<br>
            <span class="uk-margin-small-right" uk-icon="bolt"></span><b>Happy hour </b><?= displayHappyHourTimes($party) ?><br>
            <span class="uk-margin-small-right" uk-icon="bookmark"></span><b>Vestiare </b><?= $party->cloakroom_price == NULL ? "Niet aanwezig" : $party->cloakroom_price ?> euro<br>
            <span class="uk-margin-small-right" uk-icon="warning"></span><b>Leeftijd </b><?= $party->age_restriction ?>+<br>
            <br>
        </div>
    </div>
</div>