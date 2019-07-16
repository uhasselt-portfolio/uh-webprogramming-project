<?php

$organizerID = $_SESSION['organizer']->organizer_id;
$accountID = $_GET['accountID'];

$milliseconds = round(microtime(true) * 1000);

?>

<script>
    let account_id = <?= $accountID ?>;
    let organizer_id = <?= $organizerID ?>;
    let lastFetch = new Date().getTime();
    fetchNewMessages(account_id, organizer_id, false);
</script>


<?php 

    $messages = Chat::getAllMessages($_SESSION['organizer']->organizer_id, $_GET['accountID'], $_SESSION['organizer']->organizer_id);
    
    if(count($messages) > 0) {
        ?>
        <div class="uk-margin-medium-bottom uk-margin-medium-top" uk-grid>
            <div class="uk-width-2-5@m"></div>
            <div class="uk-width-3-5@m uk-width-1-1@m">
                <form id="chat"
                      class="uk-background-muted uk-border-rounded uk-padding-small uk-text-right uk-text-muted"
                      action="middleware-chat-submit.php?accountID=<?= $accountID ?>&organizerID=<?= $organizerID ?>&sentByOrganizer=1"
        
                      method="post">
                    <input name="message" id="message"
                           class="customized-chat-box uk-input uk-form-blank uk-text-muted uk-form-small uk-width-4-5"
                           type="text" placeholder="Type je bericht hier...">
                    <button id="sentMessage" class="uk-icon-button uk-button-muted uk-width-1-6" uk-icon="forward"></button>
                </form>
            </div>
        </div>
        <?php
    }

?>


