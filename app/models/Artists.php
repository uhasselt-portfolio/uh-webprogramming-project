<?php

require_once "./app/core/Database.php";

class Artists {

    public static function getArtistsPerforming($partyID) {
        return Database::query(
            "SELECT * FROM artist a, booking b WHERE b.party_id = ? AND a.artist_id = b.artist_id  ORDER BY b.start_time_performance ASC;", [$partyID]
        );
    }

    public static function getArtist($artistID, $partyID) {
        $results = Database::query("SELECT * FROM artist a, booking b WHERE a.artist_id = ? AND b.party_id = ? AND a.artist_id = b.artist_id", [$artistID, $partyID]);
        if(count($results) == 1)
            return $results[0];
        return $results;
    }

    public static function addArtist($artistName, $genreID) {
        return Database::insert("INSERT INTO artist (genre_id, name, avatar) VALUES (?,?,?);", [$genreID, $artistName, null]);
    }

    public static function uploadArtistPhoto($artistID, $path) {
        return Database::query("UPDATE artist SET avatar = ? WHERE artist_id = ?", [$path, $artistID]);
    }

    public static function addBooking($artistID, $partyID, $startTime, $endTime) {
        return Database::insert("INSERT INTO booking (artist_id, party_id, start_time_performance, end_time_performance) VALUES (?,?, ?, ?)",
            [$artistID, $partyID, $startTime, $endTime]);
    }

    public static function deleteArtist($artistID) {
        Database::query("DELETE FROM booking WHERE artist_id = ?", [$artistID]);
        return Database::query("DELETE FROM artist WHERE artist_id = ?", [$artistID]);
    }

    public static function updateArtist($aristName, $genreID, $startTime, $endTime, $artistID) {
        Database::query("UPDATE artist SET name = ?, genre_id = ? WHERE artist_id=?", [$aristName, $genreID, $artistID]);
        return Database::query("UPDATE booking SET start_time_performance = ?, end_time_performance = ? WHERE artist_id=?", [$startTime, $endTime, $artistID]);
    }

}

?>