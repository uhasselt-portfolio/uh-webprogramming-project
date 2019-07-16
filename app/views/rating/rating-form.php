<div class="uk-card-header">
    <h3 class="customized-dashboard-card-title">Mijn Mening over <?= $party->name ?></h3>
</div>
<div class="uk-card-body">
    <form name="rating-form"
          action="middleware-rating-add.php?purchaseID=<?= $_GET['purchaseID'] ?>"
          onsubmit="return isValidForm('rating-form', ['text', 'text', 'text']);"
          method="POST">
        <h3 class="customized-dashboard-card-title uk-margin-small-top uk-margin-remove-bottom">Titel</h3>
        <p class="uk-article-meta uk-margin-remove-top ">Een korte titel voor je rating.</p>
        <div class="uk-margin uk-inline uk-margin-remove-top">
            <span class="uk-form-icon" uk-icon="icon: comment"></span>
            <input id="title" name="title" class="uk-input uk-form-width-medium" type="text"
                   placeholder="Titel">
        </div>
        <h3 class="customized-dashboard-card-title uk-margin-small-top uk-margin-remove-bottom">Bericht</h3>
        <p class="uk-article-meta uk-margin-remove-top ">Waarom geef je deze rating?</p>
        <div class="uk-margin uk-margin-remove-top">
        <textarea id="message" name="message" class="uk-textarea"
                  placeholder="Leg de bovenstaande titel iets beter uit..."></textarea>
        </div>
        <h3 class="customized-dashboard-card-title uk-margin-small-top uk-margin-remove-bottom">Rating</h3>
        <p class="uk-article-meta uk-margin-remove-top ">Geef een score op 10.</p>
        <div class="uk-margin uk-inline uk-margin-remove-top">
            <span class="uk-form-icon" uk-icon="icon: star"></span>
            <select name="rating" id="rating" class="uk-input uk-form-width-medium">
                <option value="0">0</option>
                <option value="1">1</option>
                <option value="2">2</option>
                <option value="3">3</option>
                <option value="4">4</option>
                <option value="5">5</option>
                <option value="6">6</option>
                <option value="7">7</option>
                <option selected value="8">8</option>
                <option value="9">9</option>
                <option value="10">10</option>
            </select>
        </div>
        <div>
            <button type="submit" class="uk-button uk-button-secondary">Verstuur rating</button>
        </div>
    </form>
</div>

