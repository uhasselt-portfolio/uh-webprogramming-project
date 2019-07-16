<?php

function showOptions() {
    $party = $_SESSION['party-manager'];
    if($party->active) {
        echo "<option selected value=\"visible\">Zichtbaar</option>";
        echo "<option value=\"invisible\">Onzichtbaar</option>";
    } else {
        echo "<option selected value=\"invisible\">Onzichtbaar</option>";
        echo "<option value=\"visible\">Zichtbaar</option>";

    }
}

?>

<div>
    <div class="uk-card uk-card-default uk-card-hover uk-card-body">
        <form name="activate-party-form"
              action="middleware-activate-party.php"
              onsubmit="return isValidForm('activate-party-form', ['text']);"
              method="POST">
            <h3 class="customized-dashboard-card-title uk-margin-small-top uk-margin-remove-bottom">Activeer Pagina</h3>
            <p class="uk-article-meta uk-margin-remove-top ">De huidige status van je pagina</p>
            <div class="uk-margin uk-inline uk-margin-remove-top">
                <span class="uk-form-icon" uk-icon="icon: bell"></span>
                <select id="status" name="status" class="uk-input uk-form-width-medium">
                    <?php showOptions() ?>
                </select>
            </div>
            <button type="submit" class="uk-button uk-button-secondary"><span uk-icon="plus"></span>Bewaar instelling</button>
        </form>
    </div>
</div>