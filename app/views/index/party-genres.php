<?php

require_once "./app/models/Genres.php";

function displayGenreCard($genre) {
    ?>

    <div>
        <a class="customized-genre-image" href="./parties.php">
            <div class="uk-height-medium uk-flex uk-flex-center uk-flex-middle uk-background-cover uk-light"
                 data-src="<?= $genre->background_image ?>" uk-img>
                <div class="customized-genre-text"><?= $genre->name ?></div>
            </div>
        </a>
    </div>

    <?php
}
?>


<div class="uk-container-large uk-margin-xlarge-left uk-margin-xlarge-right">
    <div class="uk-child-width-1-2@s uk-child-width-1-5@m" uk-grid
         uk-scrollspy="cls: uk-animation-fade; target: > div > .customized-genre-image; delay: 300; repeat: false">
        <?php
        $genres = Genres::getPopularPartyGenres(5);
        for($i = 0; $i < 5; $i++)
            displayGenreCard($genres[$i]);
        ?>
    </div>
</div>