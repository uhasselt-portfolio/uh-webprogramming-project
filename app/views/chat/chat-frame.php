<?php

function displayMessage($message, $lastMessage) {

    if($message->sent_by_organizer) {

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

$messages = Chat::getAllMessages($_GET['organizerID'], $_SESSION['account']->account_id, $_SESSION['account']->account_id);

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

?>