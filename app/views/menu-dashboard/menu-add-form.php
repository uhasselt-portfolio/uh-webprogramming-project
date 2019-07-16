<?php

function calculateCouponPrice() {
    $party = $_SESSION['party-manager'];
    $couponPrice = $party->coupon_price;
    $couponAmount = $party->coupon_amount_buy_in;
    return $couponPrice / $couponAmount;
}

?>

<div class="uk-width-1-2@s uk-width-1-3@m">
    <div class="uk-card uk-card-default uk-card-hover">
        <div class="uk-card-header">
            <h3 class="customized-dashboard-card-title">Menu Toevoegen</h3>
        </div>
        <div class="uk-card-body">
            <form name="menu-add-form"
                  action="middleware-menu-add.php"
                  onsubmit="return isValidForm('menu-add-form', ['text', 'number', 'text']);"
                  method="POST"
                  enctype="multipart/form-data">
                <h3 class="customized-dashboard-card-title uk-margin-remove-bottom">Naam</h3>
                <p class="uk-article-meta uk-margin-remove-top">Naam van het item dat je op de menu wilt zetten</p>
                <div class="uk-margin uk-inline uk-margin-remove-top">
                    <span class="uk-form-icon" uk-icon="icon: file-text"></span>
                    <input id="name" name="name" class="uk-input uk-form-width-medium" type="text" placeholder="Naam">
                </div>
                <h3 class="customized-dashboard-card-title uk-margin-remove-bottom uk-margin-small-top">Prijs</h3>
                <p class="uk-article-meta uk-margin-remove-top">De prijs in bonnetjes, 1 bonnetje = <?= number_format( calculateCouponPrice(), 2) ?> euro</p>
                <div class="uk-margin uk-inline uk-margin-remove-top">
                    <span class="uk-form-icon" uk-icon="icon: tag"></span>
                    <input id="coupon" name="coupon" class="uk-input uk-form-width-medium" type="text" placeholder="Aantal bonnen">
                </div>
                <h3 class="customized-dashboard-card-title uk-margin-remove-bottom uk-margin-small-top">Leeftijds Beperking</h3>
                <div class="uk-margin uk-inline uk-margin-remove-top">
                    <span class="uk-form-icon" uk-icon="icon: bookmark"></span>
                    <select id="age" name="age" class="uk-input uk-form-width-medium">
                        <option value="6">Geen beperking</option>
                        <option value="12">12+</option>
                        <option value="16">16+</option>
                        <option value="18">18+</option>
                    </select>
                </div>
                <button type="submit" class="uk-button uk-button-secondary">
                    <span class="uk-margin-small-right" uk-icon="plus"></span>
                    Bewaar gegevens
                </button>
            </form>
        </div>
    </div>
</div>