<?php

function displayDashboardRedirectShortcut() {
    if(isset($_SESSION['organizer'])) {
        ?>

        <li>
            <a href="./party-overview.php">
                <span uk-icon="grid"></span>
                <span class="uk-margin-small-left">Dashboard</span>
            </a>
        </li>

        <?php
    }
}

function displayAdminRedirectShortCut() {
    if(isset($_SESSION['account'])) {
        if($_SESSION['account']->admin) {
            ?>

            <li>
                <a href="./admin-panel.php">
                    <span uk-icon="cog"></span>
                    <span class="uk-margin-small-left">Beheerders Paneel</span>
                </a>
            </li>

            <?php
        }
    }
}

function displayState() {
    if(isset($_SESSION['account'])) {
        if($_SESSION['account']->setup_process == 'FINISHED') {
            ?>
            <!-- Import functionality only when navbar is loaded -->
            <script type="text/javascript" src="./public/js/NotificationChecker.js"></script>
            <li>
                <a >
                    <span uk-icon="icon: user"></span>
                    <span class="uk-margin-small-left">Welkom, <?= $_SESSION['account']->first_name ?></span>
                    <span uk-icon="icon:  triangle-down"></span>
                </a>
                <div uk-dropdown="mode: click;">
                    <ul class="uk-nav uk-dropdown-nav">
                        <li class="uk-nav-header">Account</li>
                        <li>
                            <a href="./profile.php?account=<?=  $_SESSION['account']->account_id ?>&type=a">
                                <span uk-icon="user"></span>
                                <span class="uk-margin-small-left">Mijn Profiel</span>
                            </a>
                        </li>
                        <li>
                            <a href="./tickets.php">
                                <span uk-icon="copy"></span>
                                <span class="uk-margin-small-left">Mijn Tickets</span>
                            </a>
                        </li>
                        <li>
                            <a href="./settings.php">
                                <span uk-icon="settings"></span>
                                <span class="uk-margin-small-left">Instellingen</span>
                            </a>
                        </li>
                        <li>
                            <a href="./middleware-logout.php">
                                <span uk-icon="sign-out"></span>
                                <span class="uk-margin-small-left">Afmelden</span>
                            </a>
                        </li>
                    </ul>
                </div>
            </li>
            <li>
                <a href="./notifications.php">
                    <span uk-icon="icon: bell"></span>
                    <span class="uk-margin-small-left uk-margin-small-right">Meldingen</span>
                    <div id="notification-counter"></div>
                </a>
            </li>
            <?php
            displayDashboardRedirectShortcut();
            displayAdminRedirectShortCut();
        } else {
            ?>

            <li>
                <a href="./register.php">
                    <span uk-icon="settings"></span>
                    <span class="uk-margin-small-left">setup account</span>
                </a>
            </li>
            <li>
                <a class="uk-padding-remove-right" href="./middleware-logout.php">
                    <span uk-icon="sign-out"></span>
                    <span class="uk-margin-small-left">Log out</span>
                </a>
            </li>

            <?php
        }
    } else {
        ?>

        <li>
            <a href="./login.php">
                <span uk-icon="sign-in"></span>
                <span class="uk-margin-small-left">Aanmelden</span>
            </a>
        </li>
        <li>
            <a class=" uk-padding-remove-right" href="./register.php">
                <span uk-icon="user"></span>
                <span class="uk-margin-small-left">Registreren</span>
            </a>
        </li>

        <?php
    }
}

?>

<nav class="uk-navbar-container customized-nav-top" uk-navbar>
    <div class="uk-navbar-left uk-margin-xlarge-left">
        <a href="./" class="uk-navbar-item uk-logo uk-padding-remove-left">
            <img src="./public/images/logo.png" alt="Logo" style="max-width: 130px;">
        </a>
    </div>

    <div class="uk-navbar-right uk-margin-xlarge-right">
        <div class="uk-visible@m">
            <ul class="uk-navbar-nav">
                <?php displayState() ?>
            </ul>
        </div>
        <div class="uk-hidden@m">
            <ul class="uk-navbar-nav">
                <li>
                    <a class="uk-navbar-toggle" uk-toggle="target: #offcanvas-nav">
                        <span uk-navbar-toggle-icon></span> <span class="uk-margin-small-left"></span>
                    </a>
                </li>
            </ul>
        </div>
    </div>
</nav>