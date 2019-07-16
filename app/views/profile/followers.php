<?php

$followers = Followers::getFollowers($account->account_id);

function displayFollower($follower) {
    ?>

    <div uk-grid>
        <div class="uk-width-auto">
            <img class="customized-picture-logo" src="<?= $follower->avatar ?>">
        </div>
        <div class="uk-width-expand">
            <h4 class=" uk-margin-remove-bottom"><?= $follower->first_name ?> <?= $follower->last_name ?></h4>
            <p class="uk-text-meta uk-margin-remove-top">Volgt sinds <?= date('d/m/Y', strtotime($follower->created_at)) ?></p>
        </div>
        <div class="uk-width-expand uk-text-right">
            <a href="./profile.php?account=<?= $follower->account_id ?>&type=a" class="uk-icon-button" uk-icon="user"></a>
        </div>
    </div>

    <?php
}

?>

<div id="modal-overflow" uk-modal>
    <div class="uk-modal-dialog">

        <button class="uk-modal-close-default" type="button" uk-close></button>

        <div class="uk-modal-header">
            <h2 class="uk-modal-title"><?= $account->first_name ?>'s Volgers</h2>
        </div>

        <div class="uk-modal-body" uk-overflow-auto>
            <?php

            if(count($followers) == 0) {
                echo "Geen volgers op dit moment...";
            }
            for($i = 0; $i < count($followers); $i++) {
                displayFollower($followers[$i]);
            }

            ?>
        </div>
    </div>
</div>