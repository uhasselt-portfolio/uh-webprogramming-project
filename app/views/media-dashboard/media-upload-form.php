<form name="media-upload-form"
      action="middleware-media-upload.php"
      onsubmit="return isValidForm('media-upload-form', ['file']);"
      method="POST"
      enctype="multipart/form-data">
    <input name="media" id="media" class="uk-input uk-form-width-medium uk-margin-small-top" type="file" accept="image/x-png,image/jpeg" >
    <button type="submit" class="uk-button uk-button-secondary uk-margin-small-top"><span uk-icon="plus"></span>Bewaar foto</button>
</form>