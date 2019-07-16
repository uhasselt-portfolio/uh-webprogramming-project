<?php

include_once './app/core/Database.php';

class Genres {

    public static function getPopularPartyGenres($limit) {
        return Database::query(
            "SELECT name, background_image 
                   FROM genre 
                   ORDER BY popularity DESC 
                   LIMIT ?", [$limit]);
    }

    public static function getAllGenres() {
        return Database::query(
            "SELECT * FROM genre"
        );
    }

}