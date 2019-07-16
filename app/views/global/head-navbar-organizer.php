<?php

function displayState() {
    if (isset($_SESSION['organizer'])) {
        ?>

        <li>
            <a class="custimized-dashboard-nav-item">
                <span uk-icon="icon: user"></span>
                <span class="uk-margin-small-left">Welkom, <?= $_SESSION['account']->first_name ?></span>
                <span uk-icon="icon:  triangle-down"></span>
            </a>
            <div uk-dropdown="mode: click;">
                <ul class="uk-nav uk-dropdown-nav">
                    <li class="uk-nav-header">Account</li>
                    <li>
                        <a href="profile.php?account=<?= $_SESSION['account']->account_id ?>&type=o">
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
            </div>
        </li>

        <?php
    } else {
        ?>

        <li>
            <a class="custimized-dashboard-nav-item" href="login.php">
                <span uk-icon="arrow-left"></span>
                <span class="uk-margin-small-left">Terug naar fuiver</span>
            </a>
        </li>

        <?php
    }
}

?>

<nav class="uk-navbar-container customized-dashboard-nav" uk-navbar>
    <div class="uk-navbar-left uk-margin-xlarge-left">
        <a href="./dashboard.php" class="uk-navbar-item uk-logo uk-padding-remove-left">
            <img src="./public/images/logo-commercial.png" alt="Logo" style="max-width: 230px;">
        </a>
    </div>

    <div class="uk-navbar-right uk-margin-xlarge-right">
        <div class="uk-visible@s">
            <ul class="uk-navbar-nav">
                <?php displayState() ?>
            </ul>
        </div>
        <div class="uk-hidden@s">
            <ul class="uk-navbar-nav">
                <li>
                    <a class="uk-navbar-toggle uk-text-muted" uk-toggle="target: #head-nav">
                        <span uk-navbar-toggle-icon></span> <span class="uk-margin-small-left"></span>
                    </a>
                </li>
            </ul>
        </div>
    </div>
</nav>
