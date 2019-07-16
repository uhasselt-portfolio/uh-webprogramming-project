<?php

require_once "./app/core/Database.php";

class Organizer {

    public static function getPartyOrganizer($partyID) {
        $results = Database::query(
            "SELECT o.organisation_name, o.description, o.contact_phone, o.contact_email, o.avatar, o.verified, o.account_id FROM party p, organizer o WHERE p.party_id = ? AND p.organizer_id = o.organizer_id;",
            [$partyID]);
        if(count($results) == 1)
            return $results[0];
        return $results;
    }

    public static function getOrganizer($accountID) {
        $results = Database::query(
            "SELECT * FROM organizer o WHERE o.account_id = ?;",
            [$accountID]);
        if(count($results) == 1)
            return $results[0];
        return $results;
    }

    public static function getOrganizerViaOrganizerID($organizerID) {
        $results = Database::query(
            "SELECT * FROM organizer o WHERE o.organizer_id = ?;",
            [$organizerID]);
        if(count($results) == 1)
            return $results[0];
        return $results;
    }

    public static function register($accountID, $name, $phone, $email) {
        Database::query("INSERT INTO organizer (account_id, organisation_name, contact_phone, contact_email, verified) 
                                VALUES (?, ?, ?, ?, false)", [$accountID, $name, $phone, $email]);
    }

    public static function updateInformation($accountID, $organizerName, $description, $contactEmail, $contactPhone) {
        Database::query(
            "UPDATE organizer SET organisation_name = ?, description = ?, contact_email = ?, contact_phone = ? WHERE account_id = ?",
        [$organizerName, $description, $contactEmail, $contactPhone, $accountID]);
    }

    public static function updateAvatar($accountID, $path) {
        Database::query(
            "UPDATE organizer SET avatar = ? WHERE account_id = ?",
            [$path, $accountID]);
    }

    public static function getCreatedParties($organizerID) {
        return Database::query("SELECT * FROM party p, party_information pi WHERE p.party_id = pi.party_id AND p.organizer_id = ? ORDER BY pi.start_time_party DESC",
            [$organizerID]);
    }
}

?>