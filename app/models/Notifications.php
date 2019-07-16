<?php

require_once "./app/core/Database.php";

class Notifications {

    public static function getUnreadNotifications($accountID) {
        return Database::query("SELECT n.Action, m.Type, n.Opened, m.Message, p.card_image as avatar, n.Created_At FROM notification n, message m, party p, organizer o
                                      WHERE n.message_id = m.message_id AND p.party_id = n.party_id AND p.organizer_id = o.organizer_id AND n.account_id = ? AND opened = false AND visible <= now();", [$accountID]);
    }

    public static function getUnreadNotificationCount($accountID) {
        $result = Database::query("SELECT count(*) FROM notification WHERE account_id = ? AND opened = false AND visible <= now()", [$accountID]);
        return $result[0];
    }

    public static function setAllNotificationsRead($accountID) {
        return Database::query("UPDATE notification SET opened = TRUE WHERE account_id = ? AND opened = FALSE AND visible <= now()", [$accountID]);
    }

    public static function createMessage($type, $message) {
        return Database::insert("INSERT INTO message (type, message) VALUES 
                                  (?,?)", [$type, $message]);
    }

    public static function addNotification($partyID, $accountID, $messageID, $action, $visible = null) {
        if(empty($visible))
            return Database::insert("INSERT INTO notification (party_id, message_id, account_id, action) VALUES 
                                  (?,?,?,?)", [$partyID, $messageID, $accountID, $action]);
        else
            return Database::insert("INSERT INTO notification (party_id, message_id, account_id, action, visible) VALUES 
                                  (?,?,?,?,?)", [$partyID, $messageID, $accountID, $action, $visible]);
    }

    public static function deleteNotification($partyID, $accountID) {
        return Database::query("DELETE FROM notification WHERE party_id = ? AND account_id = ? AND visible > now()", [$partyID, $accountID]);
    }

    public static function getReadNotifications($accountID) {
        return Database::query("SELECT n.Action, m.Type, n.Opened, m.Message, p.card_image as avatar, n.Created_At FROM notification n, message m, party p, organizer o
                                      WHERE n.message_id = m.message_id AND p.party_id = n.party_id AND p.organizer_id = o.organizer_id AND n.account_id = ? AND opened = true;", [$accountID]);
    }

}

?>