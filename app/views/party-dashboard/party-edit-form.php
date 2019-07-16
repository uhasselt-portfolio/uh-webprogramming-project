<?php

require_once "./app/models/Genres.php";
require_once "./app/models/Parties.php";

$party = $_SESSION['party-manager'];

function getGenreOptions($party) {
    $genres = Genres::getAllGenres();
    for ($i = 0; $i < count($genres); $i++) {
        if($genres[$i]->genre_id == $party->genre_id)
            echo "<option selected value=\"" . strtolower($genres[$i]->genre_id) . "\">" . $genres[$i]->name ."</option>";
        else
            echo "<option value=\"" . strtolower($genres[$i]->genre_id) . "\">" . $genres[$i]->name . "</option>";
    }
}

function getPartyDate($party) {
    return date('Y-m-d', strtotime($party->start_time_party));
}

function getProvinces($party) {
    $provinces = ["Antwerpen", "Brussel", "Henegouwen", "Limburg","Luik", "Luxemburg", "Namen", "Oost-Vlaanderen", "Vlaams-Brabant", "Waals-Brabant", "West-Vlaanderen"];
    foreach($provinces as $province) {
        if(strtolower($province) == $party->province)
            echo "<option selected value=\"" . strtolower($province) . "\">" . $province . "</option>";
        else
            echo "<option value=\"" . strtolower($province) . "\">" . $province . "</option>";
    }
}

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
    <form name="party-edit-form"
          action="middleware-party-edit.php"
          onsubmit="return isValidForm('party-edit-form', ['text', 'text', 'text', 'date', 'not-required', 'not-required', 'not-required', 'text', 'text', 'text']);"
          method="POST"
          enctype="multipart/form-data">
        <div class="uk-child-width-1-2@s" uk-grid
             uk-scrollspy="cls: uk-animation-fade; target: > div > .uk-card; delay: 300; repeat: false">
            <div>
                <div class="uk-card uk-card-default uk-card-hover uk-card-body uk-margin-large-bottom">
                    <h3 class="customized-dashboard-card-title">Fuif Naam</h3>
                    <div class="uk-margin uk-inline uk-margin-remove-top">
                        <span class="uk-form-icon" uk-icon="icon: tag"></span>
                        <input value="<?= $party->name ?>" id="partyName" name="partyName"
                               class="uk-input uk-form-width-medium" type="text" placeholder="Fuif naam..">
                    </div>
                    <h3 class="customized-dashboard-card-title uk-margin-small-top">Beschrijving</h3>
                    <div class="uk-margin">
                        <textarea id="description" name="description" class="uk-textarea"
                                  placeholder="Beschrijving van uw activiteiten als organisatie.."><?= $party->description ?></textarea>
                    </div>
                    <h3 class="customized-dashboard-card-title uk-margin-small-top">Genre</h3>
                    <div class="uk-margin uk-inline uk-margin-remove-top">
                        <span class="uk-form-icon" uk-icon="icon: bookmark"></span>
                        <select id="genres" name="genres" class="uk-input uk-form-width-medium">
                            <?php getGenreOptions($party) ?>
                        </select>
                    </div>
                    <h3 class="customized-dashboard-card-title uk-margin-small-top">Datum</h3>
                    <div class="uk-margin uk-inline uk-margin-remove-top">
                        <span class="uk-form-icon" uk-icon="icon: calendar"></span>
                        <input value="<?= getPartyDate($party) ?>" id="date" name="date" class="uk-input uk-form-width-medium" type="date"
                               placeholder="Datum.." min="<?= date('Y-m-d') ?>">
                    </div>
                    <h3 class="customized-dashboard-card-title uk-margin-small-top">Upload Trailer</h3>
                    <input name="trailerVideo" id="trailerVideo" class="uk-input uk-form-width-medium" type="file" accept="video/mp4,video/x-m4v,video/*" >
                </div>
            </div>
            <div>
                <div class="uk-card uk-card-default uk-card-hover uk-card-body uk-margin-large-bottom">
                    <h3 class="customized-dashboard-card-title uk-margin-remove-bottom">Upload Voorgrond Foto</h3>
                    <p class="uk-article-meta uk-margin-remove-top">Huidige foto</p>
                    <img data-src="<?= $party->card_image ?>" width="150" height="150" alt="" uk-img>
                    <input name="cardImage" id="cardImage" class="uk-input uk-form-width-medium" type="file"
                           accept="image/x-png,image/jpeg">
                    <h3 class="customized-dashboard-card-title uk-margin-remove-bottom">Upload Achtergrond Foto</h3>
                    <p class="uk-article-meta uk-margin-remove-top">Huidige foto</p>
                    <img data-src="<?= $party->background_image ?>" width="150" height="150" alt="" uk-img>
                    <input name="backgroundImage" id="backgroundImage" class="uk-input uk-form-width-medium" type="file"
                           accept="image/x-png,image/jpeg">
                    <h3 class="customized-dashboard-card-title">Locatie</h3>
                    <div class="uk-child-width-1-1" uk-grid>
                        <div class="uk-margin-small-top">
                            <div class="uk-margin uk-inline uk-margin-remove-top">
                                <span class="uk-form-icon" uk-icon="icon: world"></span>
                                <select name="province" id="province" class="uk-input uk-form-width-medium">
                                    <?php getProvinces($party) ?>
                                </select>
                            </div>
                        </div>
                        <div class="uk-margin-small-top">
                            <div class="uk-margin uk-inline uk-margin-remove-top">
                                <span class="uk-form-icon" uk-icon="icon: location"></span>
                                <input value="<?= $party->city ?>" id="city" name="city" class="uk-input uk-form-width-medium" type="text"
                                       placeholder="Stad">
                            </div>
                        </div>
                        <div class="uk-margin-small-top">
                            <div class="uk-margin uk-inline uk-margin-remove-top">
                                <span class="uk-form-icon" uk-icon="icon: home"></span>
                                <input value="<?= $party->address ?>" id="address" name="address" class="uk-input uk-form-width-medium" type="text"
                                       placeholder="Adres">
                            </div>
                        </div>
                        <div class="uk-margin-small-top">
                            <button type="submit" class="uk-button uk-button-secondary">Volgende</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </form>
</div>