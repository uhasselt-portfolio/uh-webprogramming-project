<?php

class Popup {

    public $type;
    public $message;

    public function __construct($type, $message) {
        $this->type = $type;
        $this->message = $message;
    }
}

class Popups {

    public static function mustBeAuthenticated() {
        return new Popup("notification-warning", "Je moet ingelogd zijn om deze pagina te zien!");
    }

    public static function noPermission() {
        return new Popup("notification-warning", "Je hebt geen toestemming om deze pagina te zien!");
    }

    public static function requiredField() {
        return new Popup("notification-warning", "Gelieve alle verplichte velden in te vullen!");
    }

    public static function wrongLoginCredentials() {
        return new Popup("notification-warning", "Je e-mail of wachtwoord is fout, probeer opnieuw!");
    }

    public static function modifiedPassword() {
        return new Popup("notification-success", "Je nieuw wachtwoord is succesvol opgeslagen!");
    }

    public static function passwordsNotEqual() {
        return new Popup("notification-warning", "Wachtwoorden zijn niet gelijk, probeer opnieuw!");
    }

    public static function verificationCode() {
        return new Popup("notification-warning", "Foute verificatie code, probeer opnieuw!");
    }

    public static function failedToSendEmail() {
        return new Popup("notification-warning", "E-mail kon niet verzonden worden!");
    }

    public static function successfulSendEmail() {
        return new Popup("notification-success", "E-mail verzonden, check je inbox!");
    }

    public static function imageToLarge() {
        return new Popup("notification-warning", "Afbeelding is te groot, probeer een andere afbeelding!");
    }

    public static function emailTaken() {
        return new Popup("notification-warning", "Dit e-mail is bezet, kies een andere e-mail!");
    }

    public static function wrongFileType() {
        return new Popup("notification-warning", "Het geüpload bestand is geen foto, alleen .jpg of .png!");
    }

    public static function wrongParameters() {
        return new Popup("notification-warning", "Foute code meegegeven in url!");
    }

    public static function emailNotFound() {
        return new Popup("notification-warning", "Dit e-mail is geen account!");
    }

    public static function settingsSaved() {
        return new Popup("notification-success", "Instellingen opgeslagen!");
    }

    public static function imageUploadSuccess() {
        return new Popup("notification-success", "Afbeelding opgeslagen!");
    }

    public static function noUserFound() {
        return new Popup("notification-warning", "Geen gebruiker gevonden met de meegegeven parameters");
    }

    public static function settingsNotSaved() {
        return new Popup("notification-warning", "Instellingen niet opgeslagen, iets ging fout!");
    }

    public static function noIDGiven() {
        return new Popup("notification-warning", "Er is iets fout gegaan, probeer opnieuw!");
    }

    public static function noEditPermissions() {
        return new Popup("notification-warning", "Jij hebt geen rechten om dit aan te passen!");
    }

    public static function newPartyAdded() {
        return new Popup("notification-success", "Nieuwe fuif toegevoegd!");
    }

    public static function ticketAdded() {
        return new Popup("notification-success", "Nieuw ticket toegevoegd!");
    }

    public static function artistAdded() {
        return new Popup("notification-success", "Nieuwe artiest toegevoegd!");
    }

    public static function photoAdded() {
        return new Popup("notification-success", "Nieuwe foto toegevoegd!");
    }

    public static function menuAdded() {
        return new Popup("notification-success", "Nieuwe item toegevoegd aan menu!");
    }

    public static function menuDeleted() {
        return new Popup("notification-success", "Menu item verwijderd van menu!");
    }

    public static function ticketsBought() {
        return new Popup("notification-success", "Aankoop succesvol afgerond!");
    }

    public static function ticketCanceled() {
        return new Popup("notification-success", "Ticket is succesvol geannuleerd!");
    }

    public static function partyInactive() {
        return new Popup("notification-warning", "Fuif pagina is op dit moment inactief gezet!");
    }

    public static function noPartyFound() {
        return new Popup("notification-warning", "Fuif pagina niet gevonden!");
    }

    public static function followingSuccess() {
        return new Popup("notification-success", "Je volgt nu deze persoon!");
    }

    public static function unfollowingSuccess() {
        return new Popup("notification-success", "Je hebt deze persoon ontvolgt!");
    }

    public static function addedToWaitingList() {
        return new Popup("notification-success", "Je bent ingeschreven op deze wachtlijst!");
    }

    public static function deletedFromWaitingList() {
        return new Popup("notification-success", "Je bent uitgeschreven van deze wachtlijst!");
    }

    public static function addedRating() {
        return new Popup("notification-success", "Bedankt voor je rating!");
    }

    public static function partyAlreadyRated() {
        return new Popup("notification-warning", "U heeft deze fuif al beoordeeld!");
    }

    public static function organizerNotFound() {
        return new Popup("notification-warning", "Organisator niet gevonde!");
    }

    public static function cannotChatWithYourself() {
        return new Popup("notification-warning", "Hoe eenzaam je ook bent, je kan geen berichten sturen naar je eigen!");
    }
}

?>