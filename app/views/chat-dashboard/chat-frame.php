<?php

function checkBeforeChat() {
    $found = false;
    if(isset($_GET['accountID'])) {
        $organizer = $_SESSION['party-manager']->organizer_id;
        $accountsChattedWith = Chat::getConversations($organizer);
        foreach($accountsChattedWith as $account) {
            if($account->account_id == $_GET['accountID'])
                $found = true;
        }
    }
    return $found;
}

function displayMessage($message, $lastMessage) {

    if(!$message->sent_by_organizer) {

        ?>

        <div uk-grid>
            <div class="uk-width-3-5@m uk-width-1-1@m">
                <div id="<?= $lastMessage ? "lastMessage" : "" ?>" class="uk-background-secondary uk-border-rounded uk-padding-small uk-text-left uk-text-muted">
                    <?= $message->message ?>
                </div>
            </div>
        </div>


        <?php

    } else {

        ?>
        <div uk-grid>
            <div class="uk-width-2-5@m"></div>
            <div class="uk-width-3-5@m uk-width-1-1@s">
                <div id="<?= $lastMessage ? "lastMessage" : "" ?>" class="uk-background-muted uk-padding-small uk-text-right">
                    <?= $message->message ?>
                </div>
            </div>
        </div>

        <?php

    }
}

function displayChatFrame() {

    $messages = Chat::getAllMessages($_SESSION['organizer']->organizer_id, $_GET['accountID'], $_SESSION['organizer']->organizer_id);

    if(count($messages) <= 0) {
        echo "<div class='uk-text-center'>Geen berichten...</div>";
    } else {
        echo "<div class='uk-text-center uk-article-meta uk-margin-medium-bottom'>Begin van het gesprek</div>";
        for($i= 0; $i < count($messages); $i++) {
            displayMessage($messages[$i], count($messages) == $i + 1);
        }
        ?>

        <div uk-grid>
            <div id="messages" class="uk-width-3-5@m uk-width-1-1@s">
                <!-- Reserved for jQuery -->
            </div>
        </div>

        <?php

    }
}

function displayChat() {
    if(!isset($_GET['accountID'])) {
        ?>

        <div class="uk-text-center uk-article-meta">
            Selecteer een conversatie...
        </div>

        <?php
    } else {
        displayChatFrame();
        require_once "./app/views/chat-dashboard/chat-submit.php";
    }
}

?>


<div class="uk-width-2-3@m uk-margin-medium-bottom">
    <div class="uk-card uk-card-default uk-card-hover">
        <div class="uk-card-header">
            <h3 class="customized-dashboard-card-title">Chat</h3>
        </div>
        <div class="uk-card-body uk-height-large uk-overflow-auto">
            <?php displayChat() ?>
        </div>
    </div>
</div>