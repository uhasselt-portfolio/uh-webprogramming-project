<?php

$tickets = Tickets::getTickets($party->party_id);

function displayTicketSale($ticket) {
    $amountSold = intval($ticket->total_quantity_available) - intval($ticket->quantity_available);
    ?>

    <div class="uk-margin-small-top" uk-grid>
        <div class="uk-width-1-2">
            <b><?= $ticket->name ?></b>
            <p class="uk-article-meta uk-margin-remove-top"><?= $ticket->price ?> euro</p>
        </div>
        <div class="uk-width-1-2">
            <?= $amountSold ?> <?= $amountSold == 1 ? "ticket" : "tickets" ?> verkocht
        </div>
    </div>

    <?php
}

function totalPrice($tickets) {
    $total = 0;
    for($i = 0; $i < count($tickets); $i++)
        $total += floatval($tickets[$i]->price) * (intval($tickets[$i]->total_quantity_available) - intval($tickets[$i]->quantity_available));
    return $total;
}

?>

<div>
    <div class="uk-card uk-card-default uk-card-hover uk-card-body">
        <h3 class="customized-dashboard-card-title">Verkoop Tickets</h3>
        <?php

        for($i = 0; $i < count($tickets); $i++)
            displayTicketSale($tickets[$i]);

        ?>
        <hr>
        <b>Totaal</b>
        <?= totalPrice($tickets) ?> euro
    </div>
</div>