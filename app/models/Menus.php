<?php

require_once "./app/core/Database.php";

class Menus {

    public static function getMenuList($partyID) {
        return Database::query(
            "SELECT * FROM menu m  WHERE m.party_id = ? ORDER BY m.created_at ASC;", [$partyID]
        );
    }

    public static function addItem($partyID, $name, $age, $coupon) {
        return Database::query("INSERT INTO menu (party_id, name, price_in_coupons, age_restriction) VALUES (?,?,?,?)",
            [$partyID, $name, $coupon,$age]);
    }

    public static function deleteItem($menuID) {
        return Database::query("DELETE FROM menu WHERE menu_id = ?", [$menuID]);
    }

    public static function getMenuItem($menuID) {
        $results = Database::query("SELECT * FROM menu WHERE menu_id = ?", [$menuID]);
        if(count($results) == 1)
            return $results[0];
        return $results;
    }

}

?>