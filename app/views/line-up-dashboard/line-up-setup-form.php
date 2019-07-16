<?php

require_once "./app/models/Genres.php";

function getGenreOptions() {
    $genres = Genres::getAllGenres();
    for($i = 0; $i < count($genres); $i++) {
        echo "<option value=\"" . strtolower($genres[$i]->genre_id) ."\">" . $genres[$i]->name ."</option>";
    }
}

?>

<div class="uk-container-large uk-margin-xlarge-left uk-margin-xlarge-right uk-margin-medium-top ">
    <form name="line-up-setup-form"
          action="middleware-line-up-setup.php"
          onsubmit="return isValidForm('line-up-setup-form', ['text', 'text', 'text', 'text', 'file']);"
          method="POST"
          enctype="multipart/form-data">
        <div class="uk-child-width-1-3@m" uk-grid
             uk-scrollspy="cls: uk-animation-fade; target: > div > .uk-card; delay: 300; repeat: false">
            <div>
                <div class="uk-card uk-card-default uk-card-hover uk-margin-medium-bottom">
                    <div class="uk-card-header">
                        <h3 class="customized-dashboard-card-title">Artiest Instellingen</h3>
                    </div>
                    <div class="uk-card-body">
                        <h3 class="customized-dashboard-card-title">Artiestennaam</h3>
                        <div class="uk-margin uk-inline uk-margin-remove-top">
                            <span class="uk-form-icon" uk-icon="icon: user"></span>
                            <input id="artistName" name="artistName" class="uk-input uk-form-width-medium" type="text" placeholder="Artiestennaam..">
                        </div>
                        <h3 class="customized-dashboard-card-title uk-margin-small-top">Genre</h3>
                        <div class="uk-margin">
                            <div class="uk-margin uk-inline uk-margin-remove-top">
                                <span class="uk-form-icon" uk-icon="icon: bookmark"></span>
                                <select  name="filterGenre" id="filterGenre"  class="uk-input uk-form-width-medium">
                                    <?php getGenreOptions() ?>
                                </select>
                            </div>
                        </div>
                    </div>

                </div>
            </div>
            <div>
                <div class="uk-card uk-card-default uk-card-hover uk-margin-medium-bottom">
                    <div class="uk-card-header">
                        <h3 class="customized-dashboard-card-title">Performance Instellingen</h3>
                    </div>
                    <div class="uk-card-body">
                        <h3 class="customized-dashboard-card-title uk-margin-small-top">Start uur</h3>
                        <div class="uk-margin uk-inline uk-margin-remove-top">
                            <span class="uk-form-icon" uk-icon="icon: clock"></span>
                            <input id="startTime" name="startTime" class="uk-input uk-form-width-medium" type="time"
                                   placeholder="Kies een begin uur..">
                        </div>
                        <h3 class="customized-dashboard-card-title uk-margin-small-top">Eind uur</h3>
                        <div class="uk-margin uk-inline uk-margin-remove-top">
                            <span class="uk-form-icon" uk-icon="icon: clock"></span>
                            <input id="endTime" name="endTime" class="uk-input uk-form-width-medium" type="time"
                                   placeholder="Kies een eind uur..">
                        </div>
                    </div>
                </div>
            </div>
            <div>
                <div class="uk-card uk-card-default uk-card-hover uk-margin-medium-bottom">
                    <div class="uk-card-header">
                        <h3 class="customized-dashboard-card-title">Geavanceerde Instellingen</h3>
                    </div>
                    <div class="uk-card-body">
                        <h3 class="customized-dashboard-card-title  uk-margin-remove">Foto artiest</h3>
                        <input name="artistPhoto" id="artistPhoto" class="uk-input uk-form-width-medium" type="file" accept="image/x-png,image/jpeg" >
                        <button class="uk-button uk-button-secondary"><span uk-icon="plus"></span> Bewaar Gegevens</button>
                    </div>
                </div>
            </div>
        </div>
    </form>
</div>