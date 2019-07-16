<?php

function displayItem($item) {
    $ageRestriction = $item->age_restriction == 6 ? "<span uk-icon=\"close\"></span>" : $item->age_restriction ."+";
    ?>

    <tr>
        <td><?= $item->name ?></td>
        <td><?= $item->price_in_coupons ?></td>
        <td><?= $ageRestriction ?></td>
    </tr>

    <?php
}

function displayMenu($menu) {
    ?>

    <table class="uk-table uk-table-responsive uk-table-divider">
        <thead>
        <tr>
            <th>Drank</th>
            <th>Bonnen</th>
            <th>Min. leeftijd</th>
        </tr>
        </thead>
        <tbody>
            <?php

            foreach($menu as $item)
                displayItem($item);

            ?>
        </tbody>
    </table>

    <?php
}

?>


<div uk-grid>
    <div class="uk-width-2-3 uk-margin-xlarge-left uk-margin-medium-top">
        <div class="uk-width-1-1">
            <div class="customized-festival-title">
                Dranken
            </div>
        </div>
        <div class="uk-width-1-1">
            <p>Bekijk hier de informatie over de dranken die worden geserveerd</p>
        </div>
    </div>
</div>

<?php

if(count($menu) == 0) {
    ?>

    <div class="uk-width-3-5@m uk-width-1-1@s">
        <div class="uk-container-large uk-margin-xlarge-left uk-margin-xlarge-right">
            <div class="uk-card uk-card-default uk-card-small uk-card-body uk-background-muted">
                <p>De organisator heeft geen menu toegevoegd, deze kunnen altijd later worden toegevoegd door de organisator.</p>
            </div>
        </div>
    </div>

    <?php
}
?>

<div class="uk-container-large uk-margin-xlarge-left uk-margin-xlarge-right">
    <div class="uk-child-width-1-2@s uk-child-width-1-3@m" uk-grid
         uk-scrollspy="cls: uk-animation-fade; target: > div > .uk-card; delay: 300; repeat: false">
        <div>
            <?php

             if(count($menu) >= 1)
                displayMenu($menu)

            ?>
        </div>
    </div>
</div>