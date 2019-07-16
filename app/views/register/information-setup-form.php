<div class="uk-container-large uk-margin-xlarge-left uk-margin-xlarge-right">
    <div class="uk-child-width-1-2@m uk-child-width-1-3@l" uk-grid>
        <div>
            <div class="uk-card uk-card-default uk-card-hover uk-margin-xlarge-top uk-margin-medium-bottom">
                <div class="uk-card-body">
                    <h3 class="uk-card-title customized-home-title uk-text-center">Informatie</h3>
                    <form name="information-setup-form"
                          class="uk-grid-small"
                          action="middleware-information-setup.php"
                          onsubmit="return isValidForm('information-setup-form', ['date', 'text', 'phone']);"
                          method="POST"
                          uk-grid >

                        <div class="uk-width-1-1">
                            We hebben je geboortedatum, stad en telefoonnummer nodig.
                            <div class="uk-margin uk-inline uk-margin-remove-top">
                                <span class="uk-form-icon" uk-icon="icon: calendar"></span>
                                <input name="dob" id="dob" class="uk-input uk-form-width-large" type="date" placeholder="Geboortedatum">
                            </div>
                        </div>
                        <div class="uk-width-1-1">
                            <div class="uk-margin uk-inline uk-margin-remove-top">
                                <span class="uk-form-icon" uk-icon="icon: home"></span>
                                <input name="city" id="city" class="uk-input uk-form-width-large" type="text" placeholder="Stad">
                            </div>
                        </div>
                        <div class="uk-width-1-1">
                            <div class="uk-margin uk-inline uk-margin-remove-top">
                                <span class="uk-form-icon" uk-icon="icon: receiver"></span>
                                <input name="phone" id="phone" class="uk-input uk-form-width-large" type="text" placeholder="Telefoonnummer">
                            </div>
                        </div>
                        <div class="uk-width-1-1@s">
                            <a class="uk-link-reset" href="./login.php">Heb je al een account?</a>
                        </div>
                        <div class="uk-width-1-1 uk-text-center">
                            <input name="information-setup-submitted" type="submit" value="Ga verder"
                                   class="uk-button uk-button-secondary">
                        </div>
                    </form>
                </div>

            </div>
        </div>
    </div>
</div>