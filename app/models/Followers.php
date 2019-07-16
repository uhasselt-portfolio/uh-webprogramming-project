<?php

require_once "./app/core/Database.php";

class Followers {

    public static function getFollowers($accountID) {
        return Database::query(
            "SELECT a.account_id, a.first_name, a.last_name, f.created_at, a.avatar FROM following f, account a WHERE following_account_id = ? AND a.account_id = f.follower_account_id"
        , [$accountID]);
    }

    public static function unfollow($accountID, $accountToFollowID) {
        return Database::query("DELETE FROM following WHERE follower_account_id = ? AND following_account_id = ?"
        , [$accountID, $accountToFollowID]);
    }

    public static function follow($accountID, $accountToFollowID) {
        return Database::query(
            "INSERT INTO following (follower_account_id, following_account_id, following_party_id) VALUES (?, ?, null)"
            , [$accountID, $accountToFollowID]);
    }

    public static function isFollowing($accountID, $followingID) {
        $result =Database::query("SELECT * FROM following WHERE follower_account_id =? AND following_account_id = ?", [$accountID, $followingID]);
        return count($result) >= 1;
    }

}

?>