<?php

include_once './app/core/Database.php';

class Parties {

    public static function getNewParties($limit)  {
        return Database::query(
            "SELECT p.party_id, p.name, p.address, p.city, p.province, pi.start_time_party, t.price, p.card_image, p.background_image
                    FROM party p, ticket t, party_information pi,
                      (
                        SELECT party_id, min(price)
                        FROM ticket
                        GROUP BY party_id
                      ) as min_price
                    WHERE t.end_time_sale > now() AND p.party_id = pi.party_id AND p.party_id = t.party_id AND min_price.Party_ID = p.Party_ID AND min_price.min = t.price AND p.active = true
                    ORDER BY p.created_at ASC
                    LIMIT ?;", [$limit]
        );
    }

    public static function getPopularParties($limit) {
        return Database::query(
            "SELECT p.party_id, p.name, p.address, p.city, p.province, pi.start_time_party, t.price, p.card_image, p.background_image
                    FROM party p, ticket t, party_information pi,
                      (
                        SELECT party_id, min(price)
                        FROM ticket
                        GROUP BY party_id
                      ) as min_price
                    WHERE t.end_time_sale > now() AND p.party_id = pi.party_id AND p.party_id = t.party_id AND p.party_id IN
                      (
                        SELECT popular_tickets.party_id
                        FROM 
                          (SELECT t.party_id, sum(quantity)
                            FROM purchase p, ticket t
                            WHERE p.ticket_id = t.ticket_id AND t.end_time_sale > now()
                            GROUP BY p.ticket_id, t.party_id
                            ORDER BY sum(quantity) ASC
                          ) as popular_tickets
                        GROUP BY popular_tickets.party_id
                        ORDER BY sum(popular_tickets.sum)
                        LIMIT ?
                      ) AND min_price.party_id = p.party_id AND min_price.min = t.price AND p.active = true
                    ORDER BY p.created_at ASC;", [$limit]
        );
    }

    public static function getParty($partyID) {
        $results = Database::query(
            "SELECT * 
                   FROM party p, party_information pi 
                   WHERE p.party_id=? AND pi.party_id = p.party_id", [$partyID]
        );
        if(count($results) >= 1)
            $results = $results[0];
        return $results;
    }

    public static function searchParty($searchValue) {
        return Database::query(
            "SELECT p.name as name, p.party_id as party_id, pi.start_time_party as start_time_party, p.city as city, pi.age_restriction as age_restriction, p.description as description
                    FROM party p, party_information pi
                    WHERE pi.party_id = p.party_id AND p.active = true AND 
                          (p.name ILIKE ? OR p.city ILIKE ? OR p.province ILIKE ?) LIMIT 3
            ", [$searchValue . '%', $searchValue . '%', $searchValue . '%']
        );
    }

    public static function getParties($accountId, $limit) {
        return Database::query(
            "SELECT DISTINCT pa.party_id as party_id, pa.name as name, pi.start_time_party as start_time_party, pa.description as description
                    FROM party pa, party_information pi, purchase pu, ticket t
                    WHERE pu.account_id = ? AND pu.ticket_id = t.ticket_id AND t.party_id = pa.party_id AND pa.party_id = pi.party_id 
                    ORDER BY pi.start_time_party DESC LIMIT ?;",
        [$accountId, $limit]);
    }

    public static function advancedSearchParty($date, $genre, $location) {
        $beginDate = $date;
        $endDate = $date . ' 23:59:59';
        if($genre == null) {
            return Database::query(
                "SELECT DISTINCT p.party_id, p.name, p.address, p.city, p.province, pi.start_time_party, t.price, p.card_image, p.background_image
                    FROM party p, ticket t, party_information pi,
                      (
                        SELECT t.party_id, min(price)
                        FROM ticket t, party p
                        WHERE p.party_id = t.party_id
                        GROUP BY t.party_id
                      ) as min_price
                    WHERE p.party_id = pi.party_id AND t.party_id = p.party_id AND t.price = min_price.min
                      AND p.province ILIKE ? AND (pi.start_time_party BETWEEN ? AND ?) AND p.active = true;",
                [$location, $beginDate, $endDate]);
        } else {
            return Database::query(
                "SELECT DISTINCT p.party_id, p.name, p.address, p.city, p.province, pi.start_time_party, t.price, p.card_image, p.background_image
                    FROM party p, ticket t, party_information pi, genre g,
                      (
                        SELECT t.party_id, min(price)
                        FROM ticket t, party p
                        WHERE p.party_id = t.party_id
                        GROUP BY t.party_id
                      ) as min_price
                    WHERE p.party_id = pi.party_id AND p.genre_id = g.genre_id AND t.party_id = p.party_id AND t.price = min_price.min
                      AND p.province ILIKE ? AND (pi.start_time_party BETWEEN ? AND ?) AND g.name ILIKE ? AND p.active = true;",
                [$location, $beginDate, $endDate, $genre]);
        }

    }

    public static function createParty($genreID, $organizerID, $name, $description, $province, $city, $address) {
        return Database::insert("INSERT INTO party (genre_id, organizer_id, name, description, province, city, address) VALUES 
              (?, ?, ?, ?, ?, ?, ?);", [$genreID, $organizerID, $name, $description, $province, $city, $address]);
    }

    public static function addPartyInformation($partyID, $facebook, $twitter, $instagram, $startTimeParty, $endTimeParty, $ageRestriction, $couponPrice, $couponAmount, $cloakRoomPrice, $happyHourStartTime, $happyHourEndTime) {
        return Database::insert("INSERT INTO party_information (party_id, social_facebook, social_instagram, social_twitter, start_time_party, end_time_party, age_restriction, coupon_price, coupon_amount_buy_in, cloakroom_price, start_time_hh, end_time_hh) 
                                       VALUES (?,?,?,?,?,?,?,?,?,?,?,?)", [$partyID, $facebook, $instagram, $twitter, $startTimeParty, $endTimeParty, $ageRestriction, $couponPrice, $couponAmount, $cloakRoomPrice, $happyHourStartTime, $happyHourEndTime]);
    }

    public static function uploadCardPhoto($partyID, $cardImagePath) {
        return Database::query("UPDATE party SET card_image = ? WHERE party_id = ?", [$cardImagePath, $partyID]);
    }

    public static function uploadBackgroundPhoto($partyID, $backgroundImagePath) {
        return Database::query("UPDATE party SET background_image = ? WHERE party_id = ?", [$backgroundImagePath, $partyID]);
    }

    public static function uploadTrailerVideo($partyID, $trailerVideo) {
        return Database::query("UPDATE party SET trailer_video = ? WHERE party_id = ?", [$trailerVideo, $partyID]);
    }

    public static function updateParty($partyID, $genreID, $name, $description, $province, $city, $address) {
        return Database::insert("UPDATE party SET genre_id = ?, name=?, description=?, province=?, 
                 city=?, address=? WHERE party_id = ?", [$genreID, $name, $description, $province, $city, $address, $partyID]);
    }

    public static function updatePartyInformation($partyID, $facebook, $twitter, $instagram, $startTimeParty, $endTimeParty, $ageRestriction, $couponPrice, $couponAmount, $cloakRoomPrice, $happyHourStartTime, $happyHourEndTime) {
        return Database::query("UPDATE party_information SET social_facebook=?, social_twitter=?, social_instagram=?, start_time_party=?, end_time_party=?, age_restriction=?, coupon_price=?, coupon_amount_buy_in=?, cloakroom_price=?, start_time_hh=?, end_time_hh=? WHERE party_id = ?",
            [$facebook, $twitter, $instagram, $startTimeParty, $endTimeParty, $ageRestriction, $couponPrice, $couponAmount, $cloakRoomPrice, $happyHourStartTime, $happyHourEndTime, $partyID]);
    }

    public static function deleteParty($partyID) {
        Database::query("DELETE FROM party_information WHERE party_id=?", [$partyID]);
        return Database::query("DELETE FROM party WHERE party_id=?", [$partyID]);
    }

    public static function updatePageActivationStatus($status, $partyID) {
        return Database::query("UPDATE party SET active = ? WHERE party_id = ?", [$status, $partyID]);

    }

    public static function getAllParties() {
        return Database::query("SELECT * FROM party p, party_information pi WHERE p.party_id = pi.party_id ORDER BY pi.start_time_party DESC");
    }
}

?>