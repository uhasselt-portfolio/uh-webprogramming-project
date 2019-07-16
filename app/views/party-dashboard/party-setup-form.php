<?php

require_once "./app/models/Genres.php";

function getGenreOptions() {
    $genres = Genres::getAllGenres();
    for($i = 0; $i < count($genres); $i++) {
        echo "<option value=\"" . strtolower($genres[$i]->genre_id) ."\">" . $genres[$i]->name ."</option>";
    }
}

?>

<div class="uk-container-large uk-margin-xlarge-left uk-margin-xlarge-right uk-margin-medium-top">
    <div class="uk-width-1-1 uk-margin-medium-top uk-margin-medium-bottom">
        <div class="uk-text-left">
            <a class="uk-link-reset" href="./party-overview.php">
                <span class="uk-margin-small-right" uk-icon="arrow-left"></span>
                Terug naar fuif overzicht
            </a>
        </div>
    </div>
    <form name="party-setup-form"
          action="middleware-party-setup.php"
          onsubmit="return isValidForm('party-setup-form', ['text', 'text', 'text', 'date', 'not-required', 'file', 'file', 'text', 'text', 'text']);"
          method="POST"
          enctype="multipart/form-data">
        <div class="uk-child-width-1-2@s" uk-grid
             uk-scrollspy="cls: uk-animation-fade; target: > div > .uk-card; delay: 300; repeat: false">
            <div>
                <div class="uk-card uk-card-default uk-card-hover uk-card-body uk-margin-large-bottom">
                    <h3 class="customized-dashboard-card-title">Fuif Naam</h3>
                    <div class="uk-margin uk-inline uk-margin-remove-top">
                        <span class="uk-form-icon" uk-icon="icon: tag"></span>
                        <input id="partyName" name="partyName" class="uk-input uk-form-width-medium" type="text" placeholder="Fuif naam..">
                    </div>
                    <h3 class="customized-dashboard-card-title uk-margin-small-top">Beschrijving</h3>
                    <div class="uk-margin">
                                <textarea id="description" name="description" class="uk-textarea"
                                          placeholder="Beschrijving van uw activiteiten als organisatie.."></textarea>
                    </div>
                    <h3 class="customized-dashboard-card-title uk-margin-small-top">Genre</h3>
                    <div class="uk-margin uk-inline uk-margin-remove-top">
                        <span class="uk-form-icon" uk-icon="icon: bookmark"></span>
                        <select id="genres" name="genres" class="uk-input uk-form-width-medium">
                            <?php getGenreOptions() ?>
                        </select>
                    </div>
                    <h3 class="customized-dashboard-card-title uk-margin-small-top">Datum</h3>
                    <div class="uk-margin uk-inline uk-margin-remove-top">
                        <span class="uk-form-icon" uk-icon="icon: calendar"></span>
                        <input id="date" name="date" class="uk-input uk-form-width-medium" type="date" placeholder="Datum.." min="<?= date('Y-m-d') ?>">
                    </div>
                    <h3 class="customized-dashboard-card-title uk-margin-small-top">Upload Trailer</h3>
                    <input name="trailerVideo" id="trailerVideo" class="uk-input uk-form-width-medium" type="file" accept="video/mp4,video/x-m4v,video/*" >
                </div>
            </div>
            <div>
                <div class="uk-card uk-card-default uk-card-hover uk-card-body uk-margin-large-bottom">
                    <h3 class="customized-dashboard-card-title">Upload Voorgrond Foto</h3>
                    <input name="cardImage" id="cardImage" class="uk-input uk-form-width-medium" type="file" accept="image/x-png,image/jpeg" >
                    <h3 class="customized-dashboard-card-title">Upload Achtergrond Foto</h3>
                    <input name="backgroundImage" id="backgroundImage" class="uk-input uk-form-width-medium" type="file" accept="image/x-png,image/jpeg">
                    <h3 class="customized-dashboard-card-title">Locatie</h3>
                    <div class="uk-child-width-1-1" uk-grid>
                        <div class="uk-margin-small-top">
                            <div class="uk-margin uk-inline uk-margin-remove-top">
                                <span class="uk-form-icon" uk-icon="icon: world"></span>
                                <select name="province" id="province" class="uk-input uk-form-width-medium">
                                    <option value="antwerpen">Antwerpen</option>
                                    <option value="brussel">Brussel</option>
                                    <option value="henegouwen">Henegouwen</option>
                                    <option value="limburg">Limburg</option>
                                    <option value="luik">Luik</option>
                                    <option value="luxemburg">Luxemburg</option>
                                    <option value="namen">Namen</option>
                                    <option value="oost-vlaanderen">Oost-Vlaanderen</option>
                                    <option value="vlaams-brabant">Vlaams-Brabant</option>
                                    <option value="waals-brabant">Waals-Brabant</option>
                                    <option value="west-vlaanderen">West-Vlaanderen</option>
                                </select>
                            </div>
                        </div>
                        <div class="uk-margin-small-top">
                            <div class="uk-margin uk-inline uk-margin-remove-top">
                                <span class="uk-form-icon" uk-icon="icon: location"></span>
                                <input id="city" name="city" class="uk-input uk-form-width-medium" type="text" placeholder="Stad">
                            </div>
                        </div>
                        <div class="uk-margin-small-top">
                            <div class="uk-margin uk-inline uk-margin-remove-top">
                                <span class="uk-form-icon" uk-icon="icon: home"></span>
                                <input id="address" name="address" class="uk-input uk-form-width-medium" type="text" placeholder="Adres">
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