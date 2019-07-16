<?php

$account = $_SESSION['account'];
?>

<div class="uk-container uk-margin-xlarge-left">
    <!-- Account -->
    <h3 class="customized-festival-title ">
        Account
    </h3>
    <h4 class="uk-margin-small-top uk-margin-remove-bottom">Gebruikersnaam</h4>
    <p class="uk-article-meta uk-margin-remove-top">
        Deze naam zien gebruikers binnen onze website.
    </p>
    <div class="uk-width-1-1">
        <form action="">
            <div class="uk-width-1-1">
                <div class="uk-margin uk-inline uk-margin-remove-top">
                    <span class="uk-form-icon" uk-icon="icon: user"></span>
                    <input value="<?= $account->first_name ?>" name="firstName" id="firstName" class="uk-input uk-form-width-medium" type="text" placeholder="Voornaam">
                </div>
                <div class="uk-margin uk-inline uk-margin-remove-top">
                    <span class="uk-form-icon" uk-icon="icon: user"></span>
                    <input value="<?= $account->last_name ?>" name="lastName" id="lastName" class="uk-input uk-form-width-medium" type="text" placeholder="Achternaam">
                </div>
            </div>
        </form>
    </div>
    <!-- Email -->
    <h4 class="uk-margin-small-top uk-margin-remove-bottom">E-mail</h4>
    <p class="uk-article-meta uk-margin-remove-top">
        Gebruikers hebben geen toegang om je e-mail te zien.
    </p>
    <div class="uk-width-1-1">
        <form action="">
            <div class="uk-width-1-1">
                <div class="uk-margin uk-inline uk-margin-remove-top">
                    <span class="uk-form-icon" uk-icon="icon: mail"></span>
                    <input value="<?= $account->email ?>" name="email" id="email" class="uk-input uk-form-width-medium" type="email" placeholder="Email" disabled>
                </div>
            </div>
        </form>
    </div>
    <!-- Locatie -->
    <h4 class="uk-margin-small-top uk-margin-remove-bottom">Locatie</h4>
    <p class="uk-article-meta uk-margin-remove-top">
        Gebruikers hebben geen toegang om je woonplaats te zien.
    </p>
    <div class="uk-width-1-1">
        <form action="">
            <div class="uk-width-1-1">
                <div class="uk-margin uk-inline uk-margin-remove-top">
                    <span class="uk-form-icon" uk-icon="icon: home"></span>
                    <input value="<?= $account->city ?>" name="city" id="city" class="uk-input uk-form-width-medium" type="text" placeholder="Stad">
                </div>
            </div>
        </form>
    </div>
    <!-- Information -->
    <h4 class="uk-margin-small-top uk-margin-remove-bottom">Informatie</h4>
    <p class="uk-article-meta uk-margin-remove-top">
        Gebruikers hebben geen toegang tot deze gegevens.
    </p>
    <div class="uk-width-1-1">
        <form action="">
            <div class="uk-width-1-1">
                <div class="uk-margin uk-inline uk-margin-remove-top">
                    <span class="uk-form-icon" uk-icon="icon: calendar"></span>
                    <input value="<?= $account->birth_date ?>" name="dob" id="dob" class="uk-input uk-form-width-medium" type="date" placeholder="">
                </div>
                <div class="uk-margin uk-inline uk-margin-remove-top">
                    <span class="uk-form-icon" uk-icon="icon: receiver"></span>
                    <input value="<?= $account->phone ?>" name="phone" id="phone" class="uk-input uk-form-width-medium" type="text" placeholder="Telefoonnummer">
                </div>
            </div>
        </form>
    </div>
</div>