<?php

include_once './app/core/Database.php';

class Media {

    public static function getPartyPhotos($partyID) {
        return Database::query("SELECT * FROM party_photo WHERE party_id = ?", [$partyID]);
    }

    public static function addPhoto($partyID, $path) {
        return Database::query("INSERT INTO party_photo (party_id, path) VALUES (?,?);", [$partyID, $path]);
    }

    public static function getNumberOfPhotos($partyID) {
        $results = Database::query("SELECT count(*) FROM party_photo WHERE party_id = ?", [$partyID]);
        return $results[0];
    }

    public static function getPhoto($photoID) {
        $results = Database::query("SELECT * FROM party_photo WHERE party_photo_id = ?", [$photoID]);
        if(count($results) == 1)
            return $results[0];
        return $results;
    }

    public static function deletePhoto($photoID) {
        return Database::query("DELETE FROM party_photo WHERE party_photo_id = ?", [$photoID]);
    }
}

?>