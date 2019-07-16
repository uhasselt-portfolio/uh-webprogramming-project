<!-- Security -->
<h3 class="customized-festival-title uk-margin-medium-top">
    Veiligheid
</h3>
<h4 class="uk-margin-small-top uk-margin-remove-bottom">Wachtwoord</h4>
<p class="uk-article-meta uk-margin-remove-top">
    Verander het wachtwoord van je account.
</p>
<div class="uk-width-1-1">
    <form name="security-settings-form"
          class="uk-grid-small"
          action="middleware-security-settings.php"
          onsubmit="return isValidForm('security-settings-form', ['password', 'password']);"
          method="POST"
          uk-grid >
        <div class="uk-width-1-1">
            <div class="uk-margin uk-inline uk-margin-remove-bottom">
                <span class="uk-form-icon" uk-icon="icon: lock"></span>
                <input name="password1" id="password1" class="uk-input uk-form-width-medium" type="password" placeholder="Nieuw Wachtwoord">
            </div>
            <div class="uk-margin uk-inline uk-margin-remove-top">
                <span class="uk-form-icon" uk-icon="icon: lock"></span>
                <input name="password2" id="password2" class="uk-input uk-form-width-medium" type="password" placeholder="Herhaal Wachtwoord">
            </div>
        </div>
        <div class="uk-width-1-1">
            <button class="uk-button uk-button-secondary" type="submit">Update wachtwoord</button>
        </div>
    </form>
</div>