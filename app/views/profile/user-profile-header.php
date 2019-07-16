<?php

function displayOptions() {
    if(isset($_SESSION['account'])) {
        if($_GET['account'] == $_SESSION['account']->account_id) {
            // Own profile page
            ?>

            <div class="uk-width-expand uk-text-right">
                <a class="uk-margin-medium-right" href="#modal-overflow" uk-toggle>
                    <button class="uk-button uk-button-secondary">
                        <span class="uk-margin-small-right" uk-icon="users"></span>
                        Mijn Volgers
                    </button>
                </a>
                <a href="./settings.php">
                    <button class="uk-button uk-button-secondary">
                        <span class="uk-margin-small-right" uk-icon="settings"></span>
                        Instellingen
                    </button>
                </a>
            </div>

            <?php
        } else {
            $isFollowing = Followers::isFollowing($_SESSION['account']->account_id, $_GET['account']);
            ?>

            <div class="uk-width-expand uk-text-right">
                <a class="uk-margin-medium-right" href="#modal-overflow" uk-toggle>
                    <button class="uk-button uk-button-secondary">
                        <span class="uk-margin-small-right" uk-icon="users"></span>
                        Volgers
                    </button>
                </a>

                <a href="./middleware-user-follow.php?followingID=<?= $_GET['account'] ?>&following=<?= $isFollowing ?>">
                    <button class="uk-button uk-button-secondary">
                        <span class="uk-margin-small-right" uk-icon="rss"></span>
                        <?= $isFollowing ? "Ontvolg" : "Volg" ?>
                    </button>
                </a>
            </div>

            <?php
        }
    } else {
        // Not logged in
        ?>

        <div class="uk-width-expand uk-text-right">
            <a class="uk-margin-medium-right" href="#modal-overflow" uk-toggle>
                <button class="uk-button uk-button-secondary">
                    <span class="uk-margin-small-right" uk-icon="users"></span>
                    Volgers
                </button>
            </a>
            <a href="./login.php">
                <button class="uk-button uk-button-secondary">
                    <span class="uk-margin-small-right" uk-icon="rss"></span>
                    Volg
                </button>
            </a>
        </div>

        <?php
    }
}

?>

<div class="uk-grid-match uk-child-width-expand@m" uk-grid>
    <div class="uk-width-1-1">
        <div class="uk-text-left">
            <a class="uk-link-reset" href="javascript:history.go(-1)">
                <span class="uk-margin-small-right" uk-icon="arrow-left"></span>
                Terug naar vorige pagina
            </a>
        </div>
    </div>
    <div class="uk-width-1-2@m uk-width-1-1@s uk-flex-middle uk-margin-medium-top" uk-grid>
        <div class="uk-width-auto">
            <img class="customized-picture-logo-big" src="<?= $account->avatar ?>">
        </div>
        <div class="uk-width-expand">
            <h3 class="uk-card-title uk-margin-remove-bottom"><?= $account->first_name ?> <?= $account->last_name ?></h3>
            <p class="uk-text-meta uk-margin-remove-top">Lid sinds <?= date('d/m/Y', strtotime($account->created_at)) ?></p>
        </div>
    </div>
    <div class="uk-width-1-2@m uk-width-1-1@s uk-flex-middle" uk-grid>
        <?php displayOptions() ?>
    </div>
</div>