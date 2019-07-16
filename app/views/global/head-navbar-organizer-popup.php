<?php

function displayCollapsedStateHeadNavbar() {
    if(isset($_SESSION['organizer'])) {
            ?>

            <li class="uk-parent">
                <a href="">
                    <span uk-icon="icon: user"></span>
                    <span class="uk-margin-small-left">Welkom, <?= $_SESSION['account']->first_name ?></span>
                    <ul class="uk-nav-sub">
                        <li>
                            <a href="profile.php?account=<?=  $_SESSION['account']->account_id ?>&type=o">
                                <span uk-icon="user"></span>
                                <span class="uk-margin-small-left">Mijn Profiel</span>
                            </a>
                        </li>
                        <li>
                            <a href="index.php">
                                <span uk-icon="home"></span>
                                <span class="uk-margin-small-left">Fuiver</span>
                            </a>
                        </li>
                        <li>
                            <a href="settings-organizer.php">
                                <span uk-icon="settings"></span>
                                <span class="uk-margin-small-left">Instellingen</span>
                            </a>
                        </li>
                        <li>
                            <a href="middleware-logout.php">
                                <span uk-icon="sign-out"></span>
                                <span class="uk-margin-small-left">Afmelden</span>
                            </a>
                        </li>
                    </ul>
                </a>
            </li>

            <?php
    } else {
        ?>

        <li class="uk-parent">
            <a class="custimized-dashboard-nav-item" href="login.php">
                <span uk-icon="arrow-left"></span>
                <span class="uk-margin-small-left">Terug naar fuiver</span>
            </a>
        </li>

        <?php
    }
}

?>

<div id="head-nav" uk-offcanvas="overlay: true">
    <div class="uk-offcanvas-bar uk-flex uk-flex-column">
        <ul class="uk-nav uk-nav-primary uk-nav-center uk-margin-auto-vertical">
            <?php displayCollapsedStateHeadNavbar() ?>
        </ul>
    </div>
</div>