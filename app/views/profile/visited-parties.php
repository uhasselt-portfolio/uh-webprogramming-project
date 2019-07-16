<?php

function displayPartyCard($party) {
    ?>

    <div>
        <div class="uk-card uk-card-default uk-card-body">
            <div class="uk-width-expand">
                <h3 class="uk-card-title uk-margin-remove-bottom"><?= $party->name ?></h3>
                <p class="uk-text-meta uk-margin-remove-top"><?= date('d/m/Y h:i', strtotime($party->start_time_party)) ?></p>
            </div>
            <div class="uk-width-auto">
                <p><?= $party->description ?></p>
                <a href="./party.php?party=<?= $party->party_id ?>"><button class="uk-button uk-button-secondary">Bezoek Pagina</button></a>
            </div>
        </div>
    </div>

    <?php
}

?>

<h3>Recent Bezochten Fuiven</h3>
<div class="uk-grid-match uk-child-width-expand@m" uk-grid>
    <?php
    if(count($parties) == 0) {
        ?>

        <div>
            Nog geen fuiven bezocht...
        </div>

        <?php
    } else {
        for($i = 0; $i < count($parties); $i++)
            displayPartyCard($parties[$i]);
    }

    ?>
</div>