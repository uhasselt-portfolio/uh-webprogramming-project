<?php

require_once "./app/core/Database.php";

class Accounts {

    public static function isValidLogin($email, $password) {
        $results = Database::query("SELECT * FROM account WHERE email = ? AND password = ?", [$email, $password]);
        return count($results) > 0;
    }

    public static function getAccount($email) {
        $results = Database::query("SELECT * FROM account WHERE email = ?", [$email]);
        if(count($results) >= 1)
            $results = $results[0];
        return $results;
    }

    public static function getAccountViaID($accountID) {
        $results = Database::query("SELECT * FROM account WHERE account_id = ?", [$accountID]);
        if(count($results) >= 1)
            $results = $results[0];
        return $results;
    }

    public static function isEmailTaken($email) {
        $results = Database::query("SELECT * FROM account WHERE email = ?", [$email]);
        return count($results) > 0;
    }

    public static function addNewAccount($firstName, $lastName, $email, $password) {
        Database::query(
            "INSERT INTO account(first_name, last_name, email, password, birth_date, city, phone, avatar) 
                    VALUES (?, ?, ?, ?, null, null, null, null)", [$firstName, $lastName, $email, $password]);
    }

    public static function updateFirstName($accountID, $value) {
        Database::query("UPDATE account SET first_name = ? WHERE account_id = ?", [$value, $accountID]);
    }

    public static function updateLastName($accountID, $value) {
        Database::query("UPDATE account SET last_name = ? WHERE account_id = ?", [$value, $accountID]);
    }

    public static function updateEmail($accountID, $value) {
        Database::query("UPDATE account SET email = ? WHERE account_id = ?", [$value, $accountID]);
    }

    public static function updatePhone($accountID, $value) {
        Database::query("UPDATE account SET phone = ? WHERE account_id = ?", [$value, $accountID]);
    }

    public static function updateCity($accountID, $value) {
        Database::query("UPDATE account SET city = ? WHERE account_id = ?", [$value, $accountID]);
    }

    public static function updateBirthday($accountID, $value) {
        Database::query("UPDATE account SET birth_date = ? WHERE account_id = ?", [$value, $accountID]);
    }

    public static function updateAvatar($path, $accountID) {
        Database::query("UPDATE account SET avatar = ? WHERE account_id = ?", [$path, $accountID]);
    }

    public static function updatePassword($password, $accountID) {
        return Database::query("UPDATE account SET password = ? WHERE account_id = ?", [$password, $accountID]);
    }

    public static function updateSetupProcess($accountID, $process) {
        Database::query("UPDATE account SET setup_process = ? WHERE account_id = ?", [$process, $accountID]);
    }

    public static function updateAdditionalInformation($dob, $city, $phone, $accountID) {
        Database::query("UPDATE account SET birth_date = ?, city = ?, phone = ? WHERE account_id = ?", [$dob, $city, $phone, $accountID]);
    }

    public static function isOrganizer($accountID) {
        $results = Database::query("SELECT * FROM organizer WHERE account_id = ?", [$accountID]);
        return count($results) > 0;
    }
}

?>