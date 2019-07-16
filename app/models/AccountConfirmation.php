<?php

require_once "./app/core/Database.php";

class AccountConfirmation {

    public static function isValidCode($accountID, $code) {
        $results = Database::query("SELECT * FROM account_confirmation WHERE account_id = ? AND confirmation_code = ? AND expires_at > now()", [$accountID, $code]);
        return !empty($results);
    }

    public static function isExpired($accountID) {
        $results = Database::query("SELECT * FROM account_confirmation WHERE account_id = ? AND expires_at > now()", [$accountID]);
        return empty($results);
    }

    public static function createNewCode($accountID) {
        $randomCode = rand(1000000, 9999999);
        Database::query("INSERT INTO account_confirmation(account_id, confirmation_code) VALUES (?, ?)", [$accountID, $randomCode]);
    }

    public static function deleteCode($accountID) {
        Database::query("DELETE FROM account_confirmation WHERE account_id = ?", [$accountID]);
    }

    public static function getConfirmation($accountID) {
        $results = Database::query("SELECT * FROM account_confirmation WHERE account_id = ?", [$accountID]);
        if(count($results) >= 1)
            $results = $results[0];
        return $results;
    }
}

?>