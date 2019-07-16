<?php

function displayCoupon($price) {
    if($price <= 0)
        echo "GRATIS";
    else if($price == 1)
        echo $price . " bon";
    else
        echo $price . " bonnen";
}

function displayItem($item) {
    ?>

    <tr>
        <td><?= $item->name ?></td>
        <td><?php displayCoupon($item->price_in_coupons) ?></td>
        <td><?= $item->age_restriction == 6 ? "<span uk-icon=\"close\"></span>" : $item->age_restriction ."+" ?></td>
        <td>
            <a class="uk-link-reset" href="./middleware-menu-delete.php?menuID=<?= $item->menu_id ?>">
                <span uk-icon="icon: trash"></span>
            </a>
        </td>
    </tr>

    <?php
}

function displayItems($menu) {
    ?>
    <table class="uk-table uk-table-divider">
        <thead>
            <th>Naam</th>
            <th>Prijs</th>
            <th class="uk-table-shrink">Beperking</th>
            <th>Verwijder</th>
        </thead>
        <tbody>
        <?php

        for ($i = 0; $i < count($menu); $i++)
            displayItem($menu[$i]);

        ?>
        </tbody>
    </table>
    <?php
}

function displayMenuOverview() {
    $party = $_SESSION['party-manager'];
    $menu = Menus::getMenuList($party->party_id);
    if(count($menu) == 0) {
        ?>
        <div class="uk-text-center uk-margin-medium-bottom">
            <div class="uk-width-1-1">
                <img src="./public/images/empty-box.png" alt="Empty box picture" width="5%" height="5%">
            </div>
            <div class="uk-width-1-1">
                U heeft op dit moment geen menu om te beheren.
            </div>
        </div>
        <?php
    } else {
        displayItems($menu);
    }
}

?>


<div class="uk-width-1-2@s uk-width-2-3@m">
    <div class="uk-card uk-card-default uk-card-hover">
        <div class="uk-card-header">
            <h3 class="customized-dashboard-card-title">Menu Overzicht</h3>
        </div>
        <div class="uk-card-body">
            <?php displayMenuOverview() ?>
        </div>
    </div>
</div>