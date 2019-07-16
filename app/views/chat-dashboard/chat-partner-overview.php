<?php

function displayConversation($accountID) {
    $account = Accounts::getAccountViaID($accountID);
    ?>


        <div class="uk-card uk-card-default uk-padding-small uk-flex-middle uk-link-reset">
            <a href="./chat-dashboard.php?accountID=<?= $accountID ?>" href="uk-link-reset">
                <img class="customized-picture-logo uk-margin-small-right " src="<?= $account->avatar ?>">
                <?= $account->first_name ?> <?= $account->last_name ?>
            </a>
        </div>

    <?php
}

function displayConversations() {
    $organizerID = $_SESSION['party-manager']->organizer_id;
    $accountsChattedWith = Chat::getConversations($organizerID);
    if(count($accountsChattedWith) <= 0) {
        echo "Nog geen conversaties...";
    } else {
        foreach($accountsChattedWith as $account) {
            displayConversation($account->account_id);
        }
    }
}

?>


<div class="uk-width-1-3@m">
    <div class="uk-card uk-card-default uk-card-hover">
        <div class="uk-card-header">
            <h3 class="customized-dashboard-card-title">Mijn Conversaties</h3>
        </div>
        <div class="uk-card-body">
            <?php displayConversations() ?>
        </div>
    </div>
</div>