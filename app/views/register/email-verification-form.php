<?php
    $account = $_SESSION['account'];
    $isExpired = AccountConfirmation::isExpired($account->account_id);

    if($isExpired) {
        AccountConfirmation::deleteCode($account->account_id);
        AccountConfirmation::createNewCode($account->account_id);
    }

?>

<div class="uk-container-large uk-margin-xlarge-left uk-margin-xlarge-right">
    <div class="uk-child-width-1-2@m uk-child-width-1-3@l" uk-grid>
        <div>
            <div class="uk-card uk-card-default uk-card-hover uk-margin-xlarge-top uk-margin-medium-bottom">
                <div class="uk-card-body">
                    <h3 class="uk-card-title customized-home-title uk-text-center">Email Verificatie</h3>
                    <form name="email-verification-form"
                          class="uk-grid-small"
                          action="middleware-email-verification.php"
                          onsubmit="return isValidForm('email-verification-form', ['number']);"
                          method="POST"
                          uk-grid >
                        <div class="uk-width-1-1@s">
                            <h4>Welkom <?= $account->first_name ?>,</h4>
                            We hebben een verificatie code gestuurd naar <strong><?= $account->email ?></strong> om te checken of deze e-mail van jouw is!
                        </div>
                        <div class="uk-width-1-1">
                            <div class="uk-margin uk-inline uk-margin-remove-top">
                                <span class="uk-form-icon" uk-icon="icon: lock"></span>
                                <input name="code" id="code" class="uk-input uk-form-width-large" type="text" placeholder="Verificatie Code">
                            </div>
                        </div>
                        <div class="uk-width-1-1@s">
                            <a class="uk-link-reset" href="./login.php">Heb je al een account?</a>
                        </div>
                        <div class="uk-width-1-1 uk-text-center">
                            <button class="uk-button uk-button-secondary">Ga verder</button>
                        </div>
                    </form>
                </div>

            </div>
        </div>
    </div>
</div>