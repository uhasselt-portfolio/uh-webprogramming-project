<?php

$ticket = Tickets::getTicket($_GET['ticketID']);

function getTime($date) {
    return date('h:i', strtotime($date));
}

function getTicketDate($date) {
    return date('Y-m-d', strtotime($date));
}

function getSelectedTicketOption($ticket) {
    if($ticket->refund) {
        echo "<option selected value=\"allowed\">Toegestaan</option>";
        echo "<option value=\"forbidden\">Verboden</option>";
    } else {
        echo "<option value=\"allowed\">Toegestaan</option>";
        echo "<option selected value=\"forbidden\">Verboden</option>";
    }
}

?>

<div class="uk-container-large uk-margin-xlarge-left uk-margin-xlarge-right uk-margin-medium-top ">
    <form name="ticket-setup-form"
          action="middleware-ticket-edit.php?ticketID=<?= $ticket->ticket_id ?>"
          onsubmit="return isValidForm('ticket-setup-form', ['text', 'text', 'number', 'number', 'date', 'date', 'text', 'text', 'text']);"
          method="POST">
        <div class="uk-child-width-1-3@m" uk-grid
             uk-scrollspy="cls: uk-animation-fade; target: > div > .uk-card; delay: 300; repeat: false">
            <div>
                <div class="uk-card uk-card-default uk-card-hover uk-margin-medium-bottom">
                    <div class="uk-card-header">
                        <h3 class="customized-dashboard-card-title">Ticket Instellingen</h3>
                    </div>
                    <div class="uk-card-body">
                        <h3 class="customized-dashboard-card-title">Ticket naam</h3>
                        <div class="uk-margin uk-inline uk-margin-remove-top">
                            <span class="uk-form-icon" uk-icon="icon: tag"></span>
                            <input value="<?= $ticket->name ?>" id="ticketName" name="ticketName" class="uk-input uk-form-width-medium" type="text" placeholder="Ticket naam">
                        </div>
                        <h3 class="customized-dashboard-card-title uk-margin-small-top">Beschrijving</h3>
                        <div class="uk-margin">
                                <textarea class="uk-textarea" id="description" name="description"
                                          placeholder="Beschrijving van het ticket met zijn voordelen.."><?= $ticket->description ?></textarea>
                        </div>
                        <h3 class="customized-dashboard-card-title uk-margin-small-top">Prijs</h3>
                        <div class="uk-margin uk-inline uk-margin-remove-top">
                            <span class="uk-form-icon" uk-icon="icon: credit-card"></span>
                            <input value="<?= $ticket->price ?>" id="price" name="price" class="uk-input uk-form-width-medium" type="text"
                                   placeholder="Ticket Prijs">
                        </div>
                        <h3 class="customized-dashboard-card-title uk-margin-small-top">Aantal tickets beschikbaar
                        </h3>
                        <div class="uk-margin uk-inline uk-margin-remove-top">
                            <span class="uk-form-icon" uk-icon="icon: album"></span>
                            <input value="<?= $ticket->total_quantity_available ?>" id="amount" name="amount" class="uk-input uk-form-width-medium" type="text"
                                   placeholder="Aantal tickets">
                        </div>
                    </div>

                </div>
            </div>
            <div>
                <div class="uk-card uk-card-default uk-card-hover  uk-margin-medium-bottom">
                    <div class="uk-card-header">
                        <h3 class="customized-dashboard-card-title">Verkoop Instellingen</h3>
                    </div>
                    <div class="uk-card-body">
                        <h3 class="customized-dashboard-card-title  uk-margin-remove-top">Start datum</h3>
                        <div class="uk-margin uk-inline uk-margin-remove-top">
                            <span class="uk-form-icon" uk-icon="icon: calendar"></span>
                            <input id="startDate" name="startDate" class="uk-input uk-form-width-medium" type="date"
                                   value="<?= getTicketDate($ticket->start_time_sale) ?>" placeholder="Kies een begin datum..">
                        </div>
                        <h3 class="customized-dashboard-card-title uk-margin-remove-top">Eind datum</h3>
                        <div class="uk-margin uk-inline uk-margin-remove-top">
                            <span class="uk-form-icon" uk-icon="icon: calendar"></span>
                            <input id="endDate" name="endDate" class="uk-input uk-form-width-medium" type="date"
                                   value="<?= getTicketDate($ticket->end_time_sale) ?>" placeholder="Kies een eind datum..">
                        </div>
                        <h3 class="customized-dashboard-card-title uk-margin-small-top">Start uur</h3>
                        <div class="uk-margin uk-inline uk-margin-remove-top">
                            <span class="uk-form-icon" uk-icon="icon: clock"></span>
                            <input id="startTime" name="startTime" class="uk-input uk-form-width-medium" type="time"
                                   value="<?= getTime($ticket->start_time_sale) ?>" placeholder="Kies een begin uur..">
                        </div>
                        <h3 class="customized-dashboard-card-title uk-margin-small-top">Eind uur</h3>
                        <div class="uk-margin uk-inline uk-margin-remove-top">
                            <span class="uk-form-icon" uk-icon="icon: clock"></span>
                            <input id="endTime" name="endTime" class="uk-input uk-form-width-medium" type="time"
                                   value="<?= getTime($ticket->end_time_sale) ?>" placeholder="Kies een eind uur..">
                        </div>
                    </div>
                </div>
            </div>
            <div>
                <div class="uk-card uk-card-default uk-card-hover uk-margin-medium-bottom">
                    <div class="uk-card-header">
                        <h3 class="customized-dashboard-card-title">Geavanceerde Instellingen</h3>
                    </div>
                    <div class="uk-card-body">
                        <h3 class="customized-dashboard-card-title  uk-margin-remove">Annuleren Ticket</h3>
                        <div class="uk-margin uk-inline">
                            <span class="uk-form-icon" uk-icon="icon: bookmark"></span>
                            <select id="cancelTicket" name="cancelTicket" class="uk-input uk-form-width-medium">
                                <?php getSelectedTicketOption($ticket) ?>
                            </select>
                        </div>
                        <button type="submit" class="uk-button uk-button-secondary"><span uk-icon="plus"></span> Bewaar Gegevens</button>
                    </div>
                </div>
            </div>
        </div>
    </form>
</div>