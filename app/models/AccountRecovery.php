<?php

require_once "./app/core/Database.php";

class AccountRecovery {

    public static function addRecovery($accountID) {
        $randomCode = rand(1000000, 9999999);
        Database::query("INSERT INTO account_recovery (account_id, recovery_code) VALUES (?, ?);", [$accountID, $randomCode]);
    }

    public static function deleteCode($accountID) {
        Database::query("DELETE FROM account_recovery WHERE account_id = ?", [$accountID]);
    }

    public static function getRecoveryViaAccountID($accountID) {
        $results = Database::query("SELECT * FROM account_recovery WHERE account_id = ? AND expires_at > now()", [$accountID]);
        if(count($results) >= 1)
            $results = $results[0];
        return $results;
    }

    public static function getRecoveryViaCode($code) {
        $results = Database::query("SELECT * FROM account_recovery WHERE recovery_code = ? AND expires_at > now()", [$code]);
        if(count($results) >= 1)
            $results = $results[0];
        return $results;
    }
}

?>