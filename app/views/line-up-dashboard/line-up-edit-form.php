<?php

function getGenreOptions($genreID) {
    $genres = Genres::getAllGenres();
    for($i = 0; $i < count($genres); $i++) {
        if($genreID == $genres[$i]->genre_id)
            echo "<option selected value=\"" . strtolower($genres[$i]->genre_id) ."\">" . $genres[$i]->name ."</option>";
        else
            echo "<option value=\"" . strtolower($genres[$i]->genre_id) ."\">" . $genres[$i]->name ."</option>";
    }
}

function getTime($date) {
    return date("H:i", strtotime($date));
}

$artistID = $_GET['artistID'];

$artist = Artists::getArtist($artistID, $_SESSION['party-manager']->party_id);

?>

<div class="uk-container-large uk-margin-xlarge-left uk-margin-xlarge-right uk-margin-medium-top ">
    <div class="uk-width-1-1 uk-margin-medium-top uk-margin-medium-bottom">
        <div class="uk-text-left">
            <a class="uk-link-reset" href="./line-up-overview.php">
                <span class="uk-margin-small-right" uk-icon="arrow-left"></span>
                Terug naar line-up overzicht
            </a>
        </div>
    </div>
    <form name="line-up-edit-form"
          action="middleware-line-up-edit.php?artistID=<?= $artistID ?>"
          onsubmit="return isValidForm('line-up-edit-form', ['text', 'text', 'text', 'text', 'not-required']);"
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
                            <input value="<?= $artist->name ?>" id="artistName" name="artistName" class="uk-input uk-form-width-medium" type="text" placeholder="Artiestennaam..">
                        </div>
                        <h3 class="customized-dashboard-card-title uk-margin-small-top">Genre</h3>
                        <div class="uk-margin">
                            <div class="uk-margin uk-inline uk-margin-remove-top">
                                <span class="uk-form-icon" uk-icon="icon: bookmark"></span>
                                <select  name="filterGenre" id="filterGenre"  class="uk-input uk-form-width-medium">
                                    <?php getGenreOptions($artist->genre_id) ?>
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
                        <h3 class="customized-dashboard-card-title">Start uur</h3>
                        <div class="uk-margin uk-inline uk-margin-remove-top">
                            <span class="uk-form-icon" uk-icon="icon: clock"></span>
                            <input value="<?= getTime($artist->start_time_performance) ?>"
                                   id="startTime" name="startTime" class="uk-input uk-form-width-medium" type="time" placeholder="Kies een begin uur..">
                        </div>
                        <h3 class="customized-dashboard-card-title uk-margin-small-top">Eind uur</h3>
                        <div class="uk-margin uk-inline uk-margin-remove-top">
                            <span class="uk-form-icon" uk-icon="icon: clock"></span>
                            <input value="<?= getTime($artist->end_time_performance) ?>"
                                   id="endTime" name="endTime" class="uk-input uk-form-width-medium" type="time" placeholder="Kies een eind uur..">
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
                        <img data-src="<?= $artist->avatar ?>" width="150" height="150" alt="" uk-img>
                        <input name="artistPhoto" id="artistPhoto" class="uk-input uk-form-width-medium uk-margin-small-top" type="file" accept="image/x-png,image/jpeg" >
                        <button class="uk-button uk-button-secondary uk-margin-small-top"><span uk-icon="plus"></span> Bewaar Gegevens</button>
                    </div>
                </div>
            </div>
        </div>
    </form>
</div>