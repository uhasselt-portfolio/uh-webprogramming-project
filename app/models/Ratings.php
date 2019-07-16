<?php

require_once "./app/core/Database.php";

class Ratings {

    public static function getRatingViaOrganizer($organizerID, $limit) {
        return Database::query(
            "SELECT a.first_name, r.title, r.anonymous, a.avatar, r.rating, r.comment, r.created_at, r.account_id  FROM rating r, account a WHERE r.account_id = a.account_id AND organizer_id = ? LIMIT ?",
            [$organizerID, $limit]
        );
    }

    public static function getRatingViaParty($partyID) {
        return Database::query("SELECT a.first_name, r.title, r.anonymous, a.avatar, r.rating, r.comment, r.created_at, r.account_id
                                      FROM rating r, account a WHERE r.party_id = ? AND r.account_id = a.account_id", [$partyID]);
    }

    public static function addRating($title, $message, $rating, $organizerID, $accountID, $partyID) {
        return Database::insert("INSERT INTO rating (party_id, organizer_id, account_id, rating, title, comment, anonymous) VALUES 
                                      (?,?,?,?,?,?,?);", [$partyID, $organizerID, $accountID, $rating, $title, $message, 0]);
    }

    public static function isPartyRatedByAccount($partyID, $accountID) {
        $results = Database::query("SELECT * FROM rating WHERE party_id = ? AND account_id = ?", [$partyID, $accountID]);
        if(count($results) >= 1)
            return true;
        return false;
    }
}

?>