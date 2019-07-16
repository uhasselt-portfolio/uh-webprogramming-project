<?php

$accountID = $_SESSION['account']->account_id;
$organizerID = $organizer->organizer_id;

$milliseconds = round(microtime(true) * 1000);

?>

<script>
    let account_id = <?= $accountID ?>;
    let organizer_id = <?= $organizerID ?>;
    fetchNewMessages(account_id, organizer_id, true);
</script>


<div class="uk-margin-medium-bottom uk-margin-medium-top" uk-grid>
    <div class="uk-width-2-5@m"></div>
    <div class="uk-width-3-5@m uk-width-1-1@m">
        <form id="chat"
              class="uk-background-muted uk-border-rounded uk-padding-small uk-text-right uk-text-muted"
              action="./middleware-chat-submit.php?accountID=<?= $accountID ?>&organizerID=<?= $organizerID ?>&sentByOrganizer=0"

              method="post">
            <input name="message" id="message"
                   class="customized-chat-box uk-input uk-form-blank uk-text-muted uk-form-small uk-width-4-5"
                   type="text" placeholder="Type je bericht hier...">
            <button id="sentMessage" class="uk-icon-button uk-button-muted uk-width-1-6" uk-icon="forward"></button>
        </form>
    </div>
</div>
