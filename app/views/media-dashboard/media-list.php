<?php

function displayPhotos($media) {
    for($i = 0; $i < count($media); $i++) {
        ?>

        <div>
            <div class="uk-inline">
                <img src="<?= $media[$i]->path ?>" alt="Foto">
                <div class="uk-position-center">
                    <div class="uk-overlay">
                        <a class="uk-link-reset" href="./middleware-media-delete.php?photoID=<?= $media[$i]->party_photo_id ?>">
                            <span uk-icon="icon: trash; ratio: 2"></span>
                        </a>
                    </div>
                </div>
            </div>
        </div>

        <?php
    }
}

$partyID = $_SESSION['party-manager']->party_id;

$media = Media::getPartyPhotos($partyID);
if(count($media) == 0) {
    ?>

    <div>
        <div class="uk-text-center uk-margin-medium-bottom">
            <div class="uk-width-1-1">
                <img src="./public/images/empty-box.png" alt="Empty box picture" width="15%" height="15%">
            </div>
            <div class="uk-width-1-1">
                U heeft op dit moment geen foto's toegevoegd aan de fuif
            </div>
        </div>
    </div>

    <?php
} else {
    displayPhotos($media);
}

?>