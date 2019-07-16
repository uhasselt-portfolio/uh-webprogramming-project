<?php

require_once "./app/models/Genres.php";

function getGenreOptions() {
    $genres = Genres::getAllGenres();
    for($i = 0; $i < count($genres); $i++) {
        echo "<option value=\"" . strtolower($genres[$i]->name) ."\">" . $genres[$i]->name ."</option>";
    }
}

?>

<div class="uk-grid-medium uk-margin-xlarge-left" >
    <form action="parties.php" method="GET">
        <div class="uk-child-width-1-5@l uk-child-width-1-2@m" uk-grid>
            <div class="uk-padding-remove-left">
                <p>Kies een datum</p>
                <div class="uk-margin uk-inline uk-margin-remove-top">
                    <span class="uk-form-icon" uk-icon="icon: calendar"></span>
                    <input name="date" id="date" value="<?= date("Y-m-d") ?>" class="uk-input uk-form-width-medium" type="date" placeholder="Kies een begin datum.." min="<?= date('Y-m-d') ?>">
                </div>
            </div>
            <div class="uk-padding-remove-left">

                <p>Kies een genre</p>
                <div class="uk-margin uk-inline uk-margin-remove-top">
                    <span class="uk-form-icon" uk-icon="icon: bookmark"></span>
                    <select name="genre" id="genre" class="uk-input uk-form-width-medium">
                        <option value="no-preference">Geen voorkeur</option>
                        <?php getGenreOptions() ?>
                    </select>
                </div>
            </div>
            <div class="uk-padding-remove-left">
                <p>Locatie</p>
                <div class="uk-margin uk-inline uk-margin-remove-top">
                    <span class="uk-form-icon" uk-icon="icon: location"></span>
                    <select name="location" id="location" class="uk-input uk-form-width-medium">
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
            <div></div>
            <div></div>
            <div class="uk-padding-remove-left">
                <a href="#" class="uk-button uk-button-text">
                    <button type="submit" class="uk-button uk-button-secondary">Zoek</button>
                </a>
            </div>
        </div>
    </form>
</div>