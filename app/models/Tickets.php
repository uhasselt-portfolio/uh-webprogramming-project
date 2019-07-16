<?php

require_once "./app/core/Database.php";

class Tickets {

    public static function getTickets($partyID) {
        return Database::query(
            "SELECT * FROM ticket WHERE party_id = ? ORDER BY price ASC", [$partyID]
        );
    }

    public static function getTicketsAvailable($partyID) {
        return Database::query(
            "SELECT * FROM ticket WHERE party_id = ? AND end_time_sale >= now() AND (end_time_sale >= now() AND quantity_available > 0) ORDER BY price ASC", [$partyID]
        );
    }

    public static function getTicketsExpiredOrSoldOut($partyID) {
        return Database::query("SELECT * FROM ticket WHERE party_id = ? AND (end_time_sale < now() OR quantity_available <= 0) ORDER BY price ASC", [$partyID]);
    }

    public static function addTicket($partyID, $name, $description, $amount, $price, $start, $end, $refund) {
        return Database::query("INSERT INTO ticket (party_id, name, description, total_quantity_available, quantity_available, price, start_time_sale, end_time_sale, refund) VALUES 
                              (?,?,?,?,?,?,?,?,?);", [$partyID, $name, $description, $amount, $amount, $price, $start, $end, $refund]);
    }

    public static function getTicket($ticketID) {
        $results = Database::query(
            "SELECT * FROM ticket WHERE ticket_id = ?", [$ticketID]);
        if(count($results) >= 1)
            $results = $results[0];
        return $results;
    }

    public static function deleteTicket($ticketID) {
         return Database::query(
            "DELETE FROM ticket WHERE ticket_id = ?", [$ticketID]);
    }
    
    public static function updateTicket($ticketID, $name, $description, $amount, $price, $start, $end, $refund) {
        return Database::query("UPDATE ticket SET name=?, description=?, quantity_available = ?, total_quantity_available=?, price=?, start_time_sale=?, end_time_sale=?, refund=? WHERE ticket_id=?",
            [$name, $description, $amount, $amount, $price, $start, $end, $refund, $ticketID]);
    }

    public static function buyTicket($ticketID, $amount, $accountID) {
        Database::query("UPDATE ticket SET quantity_available = quantity_available - ? WHERE ticket_id = ?", [$amount, $ticketID]);
        return Database::insert("INSERT INTO purchase (account_id, ticket_id, quantity) VALUES (?,?,?);", [$accountID, $ticketID, $amount]);
    }

    public static function boughtTickets($accountID) {
        return Database::query("SELECT t.refund as refund, pu.quantity as quantity, pu.purchase_id as purchase_id, pa.party_id as party_id, pa.card_image as avatar, pa.name as party_name, pi.start_time_party as start_time, t.name as name, t.price as price
                                      FROM purchase pu, party pa, ticket t , party_information pi
                                      WHERE pu.ticket_id = t.ticket_id AND t.party_id = pa.party_id  AND pu.ticket_id = t.ticket_id AND pi.party_id = pa.party_id AND account_id = ? AND pu.deleted = false ORDER BY pu.created_at DESC", [$accountID]);
    }

    public static function getPurchase($purchaseID) {
        $results = Database::query("SELECT * FROM purchase p, ticket t WHERE p.ticket_id = t.ticket_id AND purchase_id = ?;", [$purchaseID]);
        if(count($results) == 0)
            return $results;
        return $results[0];
    }

    public static function cancelPurchase($purchaseID) {
        return Database::query("UPDATE purchase SET deleted = true WHERE purchase_id = ?;", [$purchaseID]);
    }

    public static function updateQuantityAvailable($ticketID, $quantity) {
        return Database::query("UPDATE ticket SET quantity_available = quantity_available + ? WHERE ticket_id = ?", [$quantity, $ticketID]);
    }

    public static function getUsersWhoBoughtTicket($ticketID) {
        return Database::query("SELECT * FROM purchase WHERE ticket_id = ?", [$ticketID]);
    }
}

?>