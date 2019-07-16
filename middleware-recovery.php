<?php

require_once "./app/models/Accounts.php";
require_once "./app/models/AccountRecovery.php";
require_once "./app/core/Handle.php";
require_once "./mail-util.php";

session_start();

Handle::requiredParameters([$_POST['email']], Popups::requiredField(), "recovery.php");

$account = Accounts::getAccount($_POST['email']);
if (empty($account)) {
    Handle::setPopup(Popups::emailNotFound());
} else {
    AccountRecovery::deleteCode($account->account_id);
    AccountRecovery::addRecovery($account->account_id);
    $recovery = AccountRecovery::getRecoveryViaAccountID($account->account_id);

    sendEmail($account->email, $account->first_name, "Fuiver - Hertel Account", "Ga naar deze url om je wachtwoord te veranderen: http://didactiek1.edm.uhasselt.be/~michielswaanen/project/password-recovery.php?code=" . $recovery->recovery_code);

    Handle::setPopup(Popups::successfulSendEmail());
}
Handle::redirect("recovery.php");

?>