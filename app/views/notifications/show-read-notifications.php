<?php

function displayOldNotification($notification) {
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

function displayOldNotifications($oldNotifications) {
    ?>
    <hr>
    <h3 class="customized-dashboard-card-title uk-margin-remove-bottom uk-margin-small-top">Oude Meldingen</h3>
    <p class="uk-article-meta uk-margin-remove-top">Dit zijn jouw oude meldingen.</p>
    <table class="uk-table uk-table-responsive uk-table-divider uk-table-striped">
        <thead>
        <tr>
            <th>Informatie</th>
            <th>Bericht</th>
        </tr>
        </thead>
        <tbody>
        <?php

        foreach($oldNotifications as $item)
            displayOldNotification($item);

        ?>
        </tbody>
    </table>

    <?php
}

?>

<?php

if(count($oldNotifications) == 0) {
    ?>

    <div class="uk-text-center uk-margin-medium-bottom">
        <div class="uk-width-1-1">
            U heeft op dit moment nog geen meldingen!
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

            if(count($oldNotifications) >= 1)
                displayOldNotifications($oldNotifications)

            ?>
        </div>
    </div>
</div>