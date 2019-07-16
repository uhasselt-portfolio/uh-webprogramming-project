<?php

$recovery = AccountRecovery::getRecoveryViaCode($_GET['code']);

if(empty($recovery)) {
    Handle::setPopup(Popups::wrongParameters());
    Handle::redirect("recovery.php");
}

$_SESSION['recovery-info'] = Accounts::getAccountViaID($recovery->account_id);
$account = $_SESSION['recovery-info'];

?>

<div class="uk-container-large uk-margin-xlarge-left uk-margin-xlarge-right">
    <div class="uk-child-width-1-3@s" uk-grid>
        <div>
            <div class="uk-card uk-card-default uk-card-hover uk-margin-xlarge-top uk-margin-medium-bottom">
                <div class="uk-card-body">
                    <h3 class="uk-card-recovery customized-home-title uk-text-center">Account Herstel</h3>
                    <form name="password-recovery-form"
                          class="uk-grid-small"
                          action="middleware-password-recovery.php"
                          onsubmit="return isValidForm('password-recovery-form', ['password', 'password']);"
                          method="POST"
                          uk-grid >
                        <div class="uk-width-1-1">
                            <h4>Welkom <?= $account->first_name ?>,</h4>
                            Stel je nieuw wachtwoord in. Deze link vervalt automatisch na 1 uur.
                        </div>
                        <div class="uk-width-1-1">
                            <div class="uk-margin uk-inline uk-margin-remove-top">
                                <span class="uk-form-icon" uk-icon="icon: lock"></span>
                                <input name="password1" id="password1" class="uk-input uk-form-width-large" type="password" placeholder="Wachtwoord">
                            </div>
                        </div>
                        <div class="uk-width-1-1">
                            <div class="uk-margin uk-inline uk-margin-remove-top">
                                <span class="uk-form-icon" uk-icon="icon: lock"></span>
                                <input name="password2" id="password2" class="uk-input uk-form-width-large" type="password" placeholder="Herhaal Wachtwoord">
                            </div>
                        </div>
                        <div class="uk-width-1-1@s">
                            <a class="uk-link-reset" href="./login.php">Heb je al een account?</a>
                        </div>
                        <div class="uk-width-1-1 uk-text-center">
                            <input name="password-setup-submitted" type="submit" value="Ga verder"
                                   class="uk-button uk-button-secondary">
                        </div>
                    </form>
                </div>

            </div>
        </div>
    </div>
</div>