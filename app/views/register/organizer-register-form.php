<?php

if(!isset($_SESSION['account'])) {
    Handle::redirect("login.php");
}

?>

<div class="uk-container-large uk-margin-xlarge-left uk-margin-xlarge-right">
    <div class="uk-child-width-1-2@m uk-child-width-1-3@l" uk-grid>
        <div>
            <div class="uk-card uk-card-default uk-card-hover uk-margin-xlarge-top uk-margin-medium-bottom">
                <div class="uk-card-body">
                    <h3 class="uk-card-title customized-home-title uk-text-center">Registreren</h3>
                    <form name="organizer-register-form"
                          class="uk-grid-small"
                          action="middleware-organizer-register.php"
                          onsubmit="return isValidForm('organizer-register-form', ['text', 'phone', 'email']);"
                          method="POST"
                          uk-grid >
                        <div class="uk-width-1-1">
                            <div class="uk-margin uk-inline uk-margin-remove-top">
                                <span class="uk-form-icon" uk-icon="icon: file-text"></span>
                                <input name="organizerName" id="organizerName" class="uk-input uk-form-width-large" type="text" placeholder="Organisator Naam">
                            </div>
                        </div>
                        <div class="uk-width-1-1">
                            <div class="uk-margin uk-inline uk-margin-remove-top">
                                <span class="uk-form-icon" uk-icon="icon: receiver"></span>
                                <input name="phone" id="phone" class="uk-input uk-form-width-large" type="text" placeholder="Zakelijke Telefoon">
                            </div>
                        </div>
                        <div class="uk-width-1-1">
                            <div class="uk-margin uk-inline uk-margin-remove-top">
                                <span class="uk-form-icon" uk-icon="icon: mail"></span>
                                <input name="email" id="email" class="uk-input uk-form-width-large" type="text" placeholder="Zakelijke E-mail">
                            </div>
                        </div>

                        <div class="uk-width-1-1@s">
                            <a class="uk-link-reset" href="./login.php">Heb je al een account?</a>
                        </div>
                        <div class="uk-width-1-1 uk-text-center">
                            <input name="register-submitted" type="submit" value="Ga verder"
                                   class="uk-button uk-button-secondary">
                        </div>
                    </form>
                </div>

            </div>
        </div>
    </div>
