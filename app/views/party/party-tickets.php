<?php

function displayOptions($quantity) {
    if ($quantity > 10)
        $quantity = 10;

    for ($i = 0; $i <= $quantity; $i++)
        echo "<option value='$i'>$i</option>";
}

function displayButton($quantity) {
    if ($quantity >= 1)
        echo "<button type=\"submit\" class=\"uk-button uk-button-secondary\">Bestel tickets</button>";
}

function displayTicketAvailable($ticket, $i) {

    ?>

    <div>
        <div class="uk-card uk-card-default uk-card-small uk-card-body">
            <h3 class="uk-card-title"><strong><?= $ticket->name ?></strong></h3>
            <div><strong><?= $ticket->price ?> euro</strong> per ticket</div>
            <div>Beschikbaar tot <?= date("d/m/Y", strtotime($ticket->end_time_sale)) ?></div>
            <div>Nog <b><?= $ticket->quantity_available ?></b> tickets verkrijgbaar!</div>
            <div>Dit ticket
                is <?= $ticket->refund ? "annuleerbaar tot 2 dagen op voorhand" : "niet annuleerbaar" ?></div>
            <p class="uk-margin-small-bottom">Kies aantal tickets</p>
            <div class="uk-margin uk-inline uk-margin-remove-top">
                <span class="uk-form-icon" uk-icon="icon: copy"></span>
                <select name="ticket-<?= $i ?>" id="ticket-<?= $i ?>" class="uk-input uk-form-width-medium">
                    <?php displayOptions($ticket->quantity_available) ?>
                </select>
            </div>
        </div>
    </div>

    <?php
}

function displayTicketExpiredOrSoldOut($ticket) {

    $isWaiting = WaitingList::isWaiting($_SESSION['account']->account_id, $ticket->ticket_id);
    $button = "<div class=\"uk-button uk-button-secondary uk-margin-small-top\">Voeg mij toe aan wachtlijst</div>";

    if($isWaiting)
        $button = "<div class=\"uk-button uk-button-secondary uk-margin-small-top\">Verwijder mij van de wachtlijst</div>"

    ?>

    <div>
        <div class="uk-card uk-card-default uk-card-small uk-card-body uk-background-muted">
            <h3 class="uk-card-title"><strong><?= $ticket->name ?></strong></h3>
            <div><strong><?= $ticket->price ?> euro</strong> per ticket</div>
            <div>Beschikbaar tot <?= date("d/m/Y", strtotime($ticket->end_time_sale)) ?></div>
            <div class="uk-margin-medium-top"><b>Deze tickets zijn niet meer beschikbaar!</b></div>
            <a href="./middleware-waiting-list-add.php?partyID=<?= $ticket->party_id ?>&ticketID=<?= $ticket->ticket_id ?>">
                <?= $button ?>
            </a>
        </div>
    </div>

    <?php
}

function displayTickets($ticketsAvailable, $ticketsExpiredOrSoldOut) {
    ?>
    <div class="uk-container-large uk-margin-xlarge-left uk-margin-xlarge-right uk-margin-top-large">
        <form action="middleware-ticket-buy.php?partyID=<?= $ticketsAvailable[0]->party_id ?>" method="post">
            <div class="uk-child-width-1-2@s uk-child-width-1-3@m" uk-grid
                 uk-scrollspy="cls: uk-animation-fade; target: > div > .uk-card; delay: 300; repeat: false">
                <?php

                for ($i = 0; $i < count($ticketsAvailable); $i++)
                    displayTicketAvailable($ticketsAvailable[$i], $i);

                if(isset($_SESSION['account']))
                    for ($i = 0; $i < count($ticketsExpiredOrSoldOut); $i++)
                        displayTicketExpiredOrSoldOut($ticketsExpiredOrSoldOut[$i]);

                ?>
            </div>
            <div class="uk-margin-medium-top">
                <?php

                displayButton(count($ticketsAvailable))

                ?>
            </div>
        </form>
    </div>
    <?php
}

?>

<div uk-grid>
    <div class="uk-width-2-3 uk-margin-xlarge-left uk-margin-medium-top">
        <div class="uk-width-1-1">
            <div id="ticket-section" class="customized-festival-title">
                Tickets
            </div>
        </div>
        <div class="uk-width-1-1">
            <p>Koop hier snel en gemakkelijk jouw ticket zonder extra kosten</p>
        </div>
    </div>
</div>

<?php

if (count($ticketsExpiredOrSoldOut) + count($ticketsAvailable) >= 1)
    displayTickets($ticketsAvailable, $ticketsExpiredOrSoldOut);
?>
