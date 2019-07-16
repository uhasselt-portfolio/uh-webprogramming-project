<!-- Avatar -->
<h3 class="customized-festival-title uk-margin-remove-top">
    Avatar
</h3>
<h4 class="uk-margin-small-top uk-margin-remove-bottom">Huidige profiel foto</h4>
<p class="uk-article-meta uk-margin-remove-top">
    Dit is je huidige profiel foto, gebruikers kunnen deze foto zien.
</p>
<div class="uk-width-1-1">
    <img data-src="<?= $account->avatar ?>" width="212" height="212" alt="" uk-img>
</div>
<div class="uk-width-1-1 uk-margin-small-top">
    <form name="avatar-settings-form"
          class="uk-grid-small"
          action="middleware-avatar-settings.php"
          onsubmit="return isValidForm('avatar-settings-form', ['file']);"
          method="POST"
          enctype="multipart/form-data"
          uk-grid >
        <div class="uk-width-1-1">
            <input name="avatar" id="avatar" class="uk-input uk-form-width-large" type="file" accept="image/x-png,image/jpeg">
        </div>
        <div class="uk-width-1-1">
            <button class="uk-button uk-button-secondary" type="submit">Upload</button>
        </div>
    </form>
</div>