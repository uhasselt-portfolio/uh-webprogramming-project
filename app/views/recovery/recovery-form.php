<div class="uk-container-large uk-margin-xlarge-left uk-margin-xlarge-right">
    <div class="uk-child-width-1-3@s" uk-grid>
        <div>
            <div class="uk-card uk-card-default uk-card-hover uk-margin-xlarge-top uk-margin-medium-bottom">
                <div class="uk-card-body">
                    <h3 class="uk-card-title customized-home-title uk-text-center">Account Herstel</h3>
                    <form name="recovery-form"
                          class="uk-grid-small"
                          action="middleware-recovery.php"
                          onsubmit="return isValidForm('recovery-form', ['email']);"
                          method="POST"
                          uk-grid >

                        <div class="uk-width-1-1">
                            Ben jij je wachtwoord vergeten van je account? Vul je e-mail in en we sturen je de instructies!
                            <div class="uk-margin uk-inline uk-margin-small-top">
                                <span class="uk-form-icon" uk-icon="icon: mail"></span>
                                <input name="email" id="email" class="uk-input uk-form-width-large" type="text" placeholder="Account e-mail">
                            </div>
                        </div>
                        <div class="uk-width-1-1@s">
                            <a class="uk-link-reset" href="./login.php">
                                <span class="uk-margin-small-right" uk-icon="arrow-left"></span>
                                Terug naar aanmelden
                            </a>
                        </div>
                        <div class="uk-width-1-1 uk-text-center">
                            <input name="information-setup-submitted" type="submit" value="Stuur email"
                                   class="uk-button uk-button-secondary">
                        </div>
                    </form>
                </div>

            </div>
        </div>
    </div>
</div>