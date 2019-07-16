<?php

$organizerName = $_SESSION['organizer']->organisation_name;
$description = $_SESSION['organizer']->description;
$contactEmail = $_SESSION['organizer']->contact_email;
$contactPhone = $_SESSION['organizer']->contact_phone;

if(isset($_SESSION['organizer-information-failed'])) {
    if($_SESSION['organizer-information-failed'] == 'REQUIRED') {
        Handle::handleWarningAlert("Vul de verplichte velden in.");
    }
    unset($_SESSION['organizer-information-failed']);
}

if(isset($_SESSION['organizer-information-success'])) {
    Handle::handleSuccessAlert("Informatie opgeslagen!");
    unset($_SESSION['organizer-information-success']);
}

if(isset($_SESSION['organizer-avatar-upload-success'])) {
    Handle::handleSuccessAlert("Informatie opgeslagen!");
    unset($_SESSION['organizer-avatar-upload-success']);
}

?>

<div>
    <div class="uk-card uk-card-default uk-card-hover uk-card-body uk-margin-medium-bottom">
        <form name="organizer-information-form"
              action="middleware-organizer-information.php"
              onsubmit="return isValidForm('organizer-information-form', ['text', 'text', 'email', 'phone']);"
              method="POST">
            <h3 class="customized-dashboard-card-title uk-margin-remove-bottom">Naam Organisator</h3>
            <p class="uk-article-meta uk-margin-remove-top">Publiek zichtbaar</p>
            <div class="uk-margin uk-inline uk-margin-remove-top">
                <span class="uk-form-icon" uk-icon="icon: tag"></span>
                <input id="organizerName" name="organizerName" value="<?= $organizerName ?>" class="uk-input uk-form-width-medium" type="text" placeholder="Organisatie naam">
            </div>
            <h3 class="customized-dashboard-card-title uk-margin-small-top uk-margin-remove-bottom">Beschrijving</h3>
            <p class="uk-article-meta uk-margin-remove-top">Publiek zichtbaar</p>
            <div class="uk-margin">
                <textarea id="description" name="description" class="uk-textarea" placeholder="Beschrijving van uw activiteiten als organisatie.."><?= $description ?></textarea>
            </div>
            <h3 class="customized-dashboard-card-title uk-margin-small-top uk-margin-remove-bottom">Contact</h3>
            <p class="uk-article-meta uk-margin-remove-top">Publiek zichtbaar</p>
            <div class="uk-margin uk-inline uk-margin-remove-top">
                <span class="uk-form-icon" uk-icon="icon: mail"></span>
                <input id="contactEmail" name="contactEmail" value="<?= $contactEmail ?>" class="uk-input uk-form-width-medium uk-margin-small-right" type="text"
                       placeholder="E-mail addres">
            </div>
            <div class="uk-margin uk-inline uk-margin-remove-top">
                <span class="uk-form-icon" uk-icon="icon: receiver"></span>
                <input id="contactPhone" name="contactPhone" value="<?= $contactPhone ?>" class="uk-input uk-form-width-medium" type="text" placeholder="Telefoon nummer">
            </div>
            <button type="submit" class="uk-button uk-button-secondary">Bewaar gegevens</button>
        </form>
    </div>
</div>