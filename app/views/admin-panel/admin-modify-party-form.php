<form name="admin-modify-party"
      action="middleware-admin-modify-party.php?partyID=<?= $_GET['partyID'] ?>"
      onsubmit="return isValidForm('admin-modify-party', ['text', 'text']);"
      method="POST">
    <h3 class="customized-dashboard-card-title uk-margin-remove-bottom uk-margin-small-top">Actie</h3>
    <p class="uk-article-meta uk-margin-remove-top">De actie die je wilt dat er uitgevoerd word op de fuif.</p>
    <div class="uk-margin uk-inline uk-margin-remove-top">
        <span class="uk-form-icon" uk-icon="icon: bolt"></span>
        <select name="action" id="action" class="uk-input uk-form-width-medium">
            <option value="1">Inactief</option>
            <option value="2">Verwijder</option>
        </select>
    </div>
    <h3 class="customized-dashboard-card-title uk-margin-remove-bottom uk-margin-small-top">Reden</h3>
    <p class="uk-article-meta uk-margin-remove-top">Geef de reden op van de bovenstaande actie. Gebruiker zal dit zien.</p>
    <div class="uk-margin uk-inline uk-margin-remove-top">
        <span class="uk-form-icon" uk-icon="icon: file-text"></span>
        <input id="reason" name="reason" class="uk-input uk-form-width-large" type="text" placeholder="Reden van actie">
    </div>
    <div class="uk-margin-small-top">
        <button type="submit" class="uk-button uk-button-secondary">Verzend</button>
    </div>
</form>