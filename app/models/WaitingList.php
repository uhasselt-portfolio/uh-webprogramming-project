<?php

require_once "./app/core/Database.php";

class WaitingList {

    public static function add($accountID, $ticketID) {
        return Database::query("INSERT INTO waiting_list (account_id, ticket_id) VALUES (?,?)", [$accountID, $ticketID]);
    }

    public static function getWaiters($ticketID) {
        return Database::query("SELECT * FROM waiting_list WHERE ticket_id = ?", [$ticketID]);
    }

    public static function isWaiting($accountID, $ticketID) {
        $result = Database::query("SELECT * FROM waiting_list WHERE account_id = ? AND ticket_id = ?", [$accountID, $ticketID]);
        return count($result) >= 1;
    }

    public static function deleteWaiter($accountID, $ticketID) {
        return Database::query("DELETE FROM waiting_list WHERE account_id = ? AND ticket_id = ?", [$accountID, $ticketID]);
    }

}


?>