<?php

function displaySearchTitle() {
    if(isset($_SESSION['account'])) {
        echo "<h4 class=\"uk-text-bold uk-margin-small-bottom customized-search-title \">Hallo " . $_SESSION['account']->first_name .", tijd voor een fuifke?</h4>";
    } else {
        echo "<h4 class=\"uk-text-bold uk-margin-small-bottom customized-search-title \">Zoek naar de perfecte fuif in heel België</h4>";
    }
}

?>

<div id="modal-full" class="uk-modal-full uk-modal" uk-modal>
    <div class="uk-modal-dialog" uk-height-viewport>
        <button class="uk-modal-close-full uk-padding-remove uk-margin-medium-top uk-margin-xlarge-right"
                type="button" uk-icon="icon: close; ratio: 2"></button>

        <div class="uk-grid-small uk-text-center" uk-grid>
            <div class="uk-width-1-3"></div>
            <div class="uk-width-1-3 uk-text-center">
                <div class="uk-margin-large-top">
                    <img data-src="./public/images/search.png" width="100" height="100" alt="Search" uk-img>
                </div>
            </div>
        </div>

        <div class="uk-grid-small uk-text-center uk-margin-remove-top" uk-grid>
            <div class="uk-width-1-1 uk-margin-small-top">
                <div>
                    <?= displaySearchTitle() ?>
                    <p class="uk-margin-remove customized-search-description">Zoek op fuif, stad of
                        provincie</p>
                </div>
            </div>
        </div>

        <div class="uk-grid-small uk-text-center" uk-grid>
            <div class="uk-width-1-3"></div>
            <div class="uk-width-1-3">
                <form class="uk-search uk-search-navbar">
                    <span uk-search-icon></span>
                    <input id="search" class="uk-search-input customized-search-bar" type="search" placeholder="Zoek...">
                </form>
            </div>
        </div>

        <div class="uk-grid-small uk-margin-large-top" uk-grid>
            <div class="uk-width-1-3"></div>
            <div class="uk-width-1-3">
                <ul id="search-result" class="uk-list uk-list-divider" uk-accordion>

                </ul>
            </div>
        </div>
    </div>
</div>