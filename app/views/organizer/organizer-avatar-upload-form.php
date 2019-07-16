<div>
    <div class="uk-card uk-card-default uk-card-hover uk-card-body">
        <h3 class="customized-dashboard-card-title uk-margin-remove-bottom">Upload Avatar</h3>
        <p class="uk-article-meta uk-margin-remove-top">Publiek zichtbaar</p>
        <div class="uk-width1-1">
            <img data-src="<?= $_SESSION['organizer']->avatar ?>" width="150" height="150" alt="" uk-img>
        </div>
        <form name="organizer-avatar-upload-form"
              class="uk-grid-small"
              action="middleware-organizer-avatar-upload.php"
              onsubmit="return isValidForm('organizer-avatar-upload-form', ['file']);"
              method="POST"
              enctype="multipart/form-data"
              uk-grid >
            <div class="uk-width-1-1 uk-margin-small-top">
                <input name="avatar" id="avatar" class="uk-input uk-form-width-large" type="file" accept="image/x-png,image/jpeg">
            </div>
            <div class="uk-width-1-1">
                <button class="uk-button uk-button-secondary" type="submit">Upload</button>
            </div>
        </form>
    </div>
</div>