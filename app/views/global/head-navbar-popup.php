<?php

function displayDashboardRedirectShortcutCollapsedState() {
    if(isset($_SESSION['organizer'])) {
        ?>

        <li class="uk-parent">
            <a href="party-overview.php">
                <span uk-icon="grid"></span>
                <span class="uk-margin-small-left">Dashboard</span>
            </a>
        </li>

        <?php
    }
}

function displayAdminRedirectShortCutCollapsedState() {
    if(isset($_SESSION['account'])) {
        if($_SESSION['account']->admin) {
            ?>

            <li class="uk-parent">
                <a href="admin-panel.php">
                    <span uk-icon="cog"></span>
                    <span class="uk-margin-small-left">Beheerders Paneel</span>
                </a>
            </li>
            <?php
        }
    }
}

function displayCollapsedState() {
    if(isset($_SESSION['account'])) {
        if($_SESSION['account']->setup_process == 'FINISHED') {
            ?>

            <li class="uk-parent">
                <a href="">
                    <span uk-icon="icon: user"></span>
                    <span class="uk-margin-small-left">Welkom, <?= $_SESSION['account']->first_name ?></span>
                    <ul class="uk-nav-sub">
                        <li>
                            <a href="profile.php?account=<?=  $_SESSION['account']->account_id ?>&type=a">
                                <span uk-icon="user"></span>
                                <span class="uk-margin-small-left">Mijn Profiel</span>
                            </a>
                        </li>
                        <li>
                            <a href="tickets.php">
                                <span uk-icon="copy"></span>
                                <span class="uk-margin-small-left">Mijn Tickets</span>
                            </a>
                        </li>
                        <li>
                            <a href="settings.php">
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
            <li class="uk-parent">
                <a href="">
                    <span uk-icon="icon: bell"></span>
                    <span class="uk-margin-small-left">Meldingen</span>
                </a>
            </li>

            <?php
            displayDashboardRedirectShortcutCollapsedState();
            displayAdminRedirectShortCutCollapsedState();
        } else {
            ?>

            <li class="uk-parent">
                <a href="register.php">
                    <span uk-icon="settings"></span>
                    <span class="uk-margin-small-left">Setup account</span>
                </a>
            </li>
            <li class="uk-parent">
                <a href="middleware-logout.php">
                    <span uk-icon="sign-out"></span>
                    <span class="uk-margin-small-left">Log out</span>
                </a>
            </li>

            <?php
        }
    } else {
        ?>

        <li class="uk-parent">
            <a href="login.php">
                <span uk-icon="sign-in"></span>
                <span class="uk-margin-small-left">Aanmelden</span>
            </a>
        </li>
        <li class="uk-parent">
            <a href="register.php">
                <span uk-icon="user"></span>
                <span class="uk-margin-small-left">Registreren</span>
            </a>
        </li>

        <?php
    }
}
?>

<div id="offcanvas-nav" uk-offcanvas="overlay: true">
    <div class="uk-offcanvas-bar uk-flex uk-flex-column">
        <ul class="uk-nav uk-nav-primary uk-nav-center uk-margin-auto-vertical">
            <?php displayCollapsedState() ?>
        </ul>
    </div>
</div>
