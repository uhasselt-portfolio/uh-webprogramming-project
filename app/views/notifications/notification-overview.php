<?php

function displayNotification($notification) {
    ?>

    <tr>
        <td>
            <div class="uk-grid-small uk-flex-middle" uk-grid>
                <div class="uk-width-auto">
                    <img class="customized-picture-logo" width="40" height="40" src="<?= $notification->avatar ?>">
                </div>
                <div class="uk-width-expand">
                    <b class="uk-margin-remove-bottom"><?= $notification->type ?></b>
                    <p class="uk-text-meta uk-margin-remove-top">
                        <?= date('d-m-Y H:i', strtotime($notification->created_at)) ?>
                    </p>
                </div>
            </div>
        </td>
        <td>
            <a class="uk-link-reset" href="<?= $notification->action ?>">
                <?= $notification->message ?>
            </a>
        </td>
    </tr>

    <?php
}

function displayNotifications($notifications) {
    ?>

    <h3 class="customized-dashboard-card-title uk-margin-remove-bottom uk-margin-small-top">Nieuwe Meldingen</h3>
    <p class="uk-article-meta uk-margin-remove-top">Dit zijn jouw nieuwe meldingen.</p>
    <table class="uk-table uk-table-responsive uk-table-divider uk-table-striped">
        <thead>
        <tr>
            <th>Informatie</th>
            <th>Bericht</th>
        </tr>
        </thead>
        <tbody>
        <?php

        foreach($notifications as $item)
            displayNotification($item);

        ?>
        </tbody>
    </table>

    <?php
}

?>

<?php

if(count($notifications) == 0) {
    ?>

    <div class="uk-text-center uk-margin-medium-bottom">
        <div class="uk-width-1-1">
            <img src="./public/images/empty-box.png" alt="Empty box picture" width="5%" height="5%">
        </div>
        <div class="uk-width-1-1">
            U heeft op dit moment geen nieuwe meldingen!
        </div>
    </div>

    <?php
}
?>

<div class="uk-container-large">
    <div class="uk-child-width-1-1" uk-grid
         uk-scrollspy="cls: uk-animation-fade; target: > div > .uk-card; delay: 300; repeat: false">
        <div>
            <?php

            if(count($notifications) >= 1)
                displayNotifications($notifications)

            ?>
        </div>
    </div>
</div>

<div class="uk-container-large">
    <div class="uk-child-width-1-1" uk-grid
         uk-scrollspy="cls: uk-animation-fade; target: > div > .uk-card; delay: 300; repeat: false">
        <div id="oldNotificationSection" style="display: block" >
            <?php require_once "show-read-notifications.php" ?>
        </div>

    </div>
</div>


<div class="uk-text-center uk-margin-medium-bottom">
    <div class="uk-width-1-1 uk-article-meta ">
        <a id="oldNotificationButton" onclick="showOldNotifications();" class="uk-link-reset">
            Toon oude meldingen
        </a>
    </div>
</div>

<noscript>
    <?php require_once "show-read-notifications.php" ?>
</noscript>