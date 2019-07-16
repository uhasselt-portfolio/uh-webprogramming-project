<?php

function displayRefundButton($ticket) {
    $party = Parties::getParty($ticket->party_id);
    if(date('Y-m-d H:i:s', strtotime($party->start_time_party)) < date('Y-m-d H:i:s', strtotime('+ 1 days')))
        echo "<p class='uk-article-meta'>Annuleren is niet meer mogelijk</p>";
    else if($ticket->refund)
        echo "<a href=\"./middleware-ticket-cancel.php?purchaseID=$ticket->purchase_id\" class=\"uk-icon-button uk-button-secondary\" uk-icon=\"close\"></a>";
    else
        echo "<p class='uk-article-meta'>Niet mogelijk</p>";

}

function displayTicket($ticket) {
    ?>

    <tr>
        <td>
            <div class="uk-grid-small uk-flex-middle" uk-grid>
                <div class="uk-width-auto">
                    <img class="customized-picture-logo" src="<?= $ticket->avatar ?>">
                </div>
                <div class="uk-width-expand">
                    <b class="uk-margin-remove-bottom"><?= $ticket->party_name ?></b>
                    <p class="uk-text-meta uk-margin-remove-top">
                        <?= date('d-m-Y H:i', strtotime($ticket->start_time)) ?>
                    </p>
                </div>
            </div>
        </td>
        <td>
            <a class="uk-link-reset" href="./party.php?party=<?= $ticket->party_id ?>">
                <?= $ticket->name ?>
            </a>
        </td>
        <td>
            <?= $ticket->quantity ?>
        </td>
        <td>
            <?= $ticket->price ?> euro
        </td>
        <td>
            <?php displayRefundButton($ticket) ?>
        </td>
    </tr>

    <?php
}

function displayTickets($tickets) {
    ?>

    <table class="uk-table uk-table-responsive uk-table-divider uk-table-striped">
        <thead>
        <tr>
            <th>Fuif</th>
            <th>Ticket</th>
            <th>Aantal</th>
            <th>Prijs</th>
            <th>Annuleren</th>
        </tr>
        </thead>
        <tbody>
        <?php

        foreach($tickets as $item)
            displayTicket($item);

        ?>
        </tbody>
    </table>

    <?php
}

?>

<?php

if(count($tickets) == 0) {
    ?>

    <div class="uk-text-center uk-margin-medium-bottom">
        <div class="uk-width-1-1">
            <img src="./public/images/empty-box.png" alt="Empty box picture" width="5%" height="5%">
        </div>
        <div class="uk-width-1-1">
            U heeft op dit moment nog geen tickets gekocht!
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

            if(count($tickets) >= 1)
                displayTickets($tickets)

            ?>
        </div>
    </div>
</div>
