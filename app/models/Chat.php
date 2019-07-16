<?php

require_once "./app/core/Database.php";

class Chat {

    public static function getAllMessages($organizerID, $accountID, $currentChatFrame) {
        if($currentChatFrame == $accountID) {
            $results = Database::query("SELECT * FROM chat WHERE (organizer_id = ? AND account_id = ? AND seen=true) OR (seen=false AND account_id = ?) ORDER BY created_at", [$organizerID, $accountID, $accountID]);

        } else {
            $results = Database::query("SELECT * FROM chat WHERE (organizer_id = ? AND account_id = ? AND seen=true) OR (seen=false AND organizer_id = ?) ORDER BY created_at", [$organizerID, $accountID, $organizerID]);
        }
        Database::query("UPDATE chat SET seen=true WHERE seen=false AND account_id = ? AND organizer_id = ?", [accountID, $organizerID]);
        return $results;
    }

    public static function getNewMessages($organizerID, $accountID, $sentByOrganizer) {
        return Database::query("SELECT * FROM chat WHERE account_id = ? AND organizer_id = ? AND seen=false AND sent_by_organizer = ?", [$accountID, $organizerID, $sentByOrganizer]);
    }

    public static function setSeen($organizerID, $accountID, $sentByOrganizer) {
        Database::query("UPDATE chat SET seen=true WHERE seen=false AND account_id = ? AND organizer_id = ?", [$accountID, $organizerID]);
    }

    public static function sentMessage($organizerID, $accountID, $sentByOrganizer, $message) {
        return Database::insert("INSERT INTO chat (account_id, organizer_id, sent_by_organizer, message) VALUES (?,?,?,?);",
            [$accountID, $organizerID, $sentByOrganizer, $message]);
    }

    public static function getConversations($organizerID) {
        return Database::query("SELECT account_id FROM chat WHERE organizer_id = ? GROUP BY account_id", [$organizerID]);
    }

}

?>