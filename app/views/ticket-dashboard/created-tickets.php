<?php

function displayCreatedTicket($ticket) {
    ?>

    <tr>
        <td><?= ucfirst($ticket->name) ?></td>
        <td><?= ucfirst($ticket->price) ?></td>
        <td><?= ucfirst($ticket->total_quantity_available) ?></td>
        <td>
            <?= date('d/m/Y H:i', strtotime($ticket->start_time_sale))?> -
            <?= date('d/m/Y H:i', strtotime($ticket->end_time_sale))?>
        </td>
        <td>
            <button class="uk-icon-button" uk-icon="more-vertical"></button>
            <div uk-dropdown="mode: click">
                <ul class="uk-nav uk-dropdown-nav">
                    <li class="uk-nav-header">Opties</li>
                    <li>
                        <a href="./ticket-edit.php?ticketID=<?= $ticket->ticket_id ?>" class="uk-margin-small-right">
                            <span uk-icon="file-edit"></span> Beheer
                        </a>
                    </li>
                    <li>
                        <a href="./middleware-ticket-delete.php?ticketID=<?= $ticket->ticket_id ?>&partyID=<?= $ticket->party_id ?>" class="uk-margin-small-right">
                            <span uk-icon="trash"></span> Verwijder
                        </a>
                    </li>
                </ul>
            </div>
        </td>
    </tr>

    <?php
}

function displayCreatedTickets($tickets) {
    ?>

    <table class="uk-table uk-table-divider ">
        <thead>
        <tr>
            <th class="uk-width-small">Naam</th>
            <th class="uk-width-small">Prijs</th>
            <th class="uk-width-small">Aantal</th>
            <th class="uk-text-truncate">Verkoop Start & Einde</th>
            <th class="uk-width-small">Opties</th>
        </tr>
        </thead>
        <tbody>
        <?php

        for ($i = 0; $i < count($tickets); $i++) {
            displayCreatedTicket($tickets[$i]);
        }

        ?>
        </tbody>
    </table>

    <?php
}

$partyID = $_SESSION['party-manager']->party_id;

$tickets = Tickets::getTickets($partyID);

if(count($tickets) == 0) {
    ?>

    <div class="uk-text-center uk-margin-medium-bottom">
        <div class="uk-width-1-1">
            <img src="./public/images/empty-box.png" alt="Empty box picture" width="5%" height="5%">
        </div>
        <div class="uk-width-1-1">
            U heeft op dit moment geen tickets om te beheren
        </div>
    </div>

    <?php
} else {
    displayCreatedTickets($tickets);
}

?>

