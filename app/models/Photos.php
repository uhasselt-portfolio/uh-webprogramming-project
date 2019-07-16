<?php

require_once "./app/core/Database.php";

class Photos {

    public static function getPhotos($partyID) {
        return Database::query("SELECT * FROM party_photo WHERE party_id = ?;", [$partyID]);
    }
}

?>