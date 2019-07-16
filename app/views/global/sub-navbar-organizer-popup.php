<?php

function displayCollapsedStateSubNavbar() {
    if(isset($_SESSION['organizer'])) {
        ?>

        <li class="uk-parent">
            <a href="dashboard.php">
                <span uk-icon="icon: home"></span>
                <span class="uk-margin-small-left">Dashboard</span>
            </a>
        </li>
        <li class="uk-parent">
            <a href="party-edit.php">
                <span uk-icon="icon: info"></span>
                <span class="uk-margin-small-left">Fuif</span>
            </a>
        </li>

        <li class="uk-parent">
            <a href="ticket-overview.php">
                <span uk-icon="icon: file-text"></span>
                <span class="uk-margin-small-left">Tickets</span>
            </a>
        </li>

        <li class="uk-parent">
            <a href="line-up-overview.php">
                <span uk-icon="icon: users"></span>
                <span class="uk-margin-small-left">Line-up</span>
            </a>
        </li>

        <li class="uk-parent">
            <a href="media.php">
                <span uk-icon="icon: image"></span>
                <span class="uk-margin-small-left">Media</span>
            </a>
        </li>

        <li class="uk-parent">
            <a href="menu.php">
                <span uk-icon="icon: tag"></span>
                <span class="uk-margin-small-left">Menu</span>
            </a>
        </li>

        <li class="uk-parent">
            <a href="chat-dashboard.php">
                <span uk-icon="icon: comments"></span>
                <span class="uk-margin-small-left">Chat</span>
            </a>
        </li>


        <?php
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

<div id="sub-nav" uk-offcanvas="overlay: true">
    <div class="uk-offcanvas-bar uk-flex uk-flex-column">
        <ul class="uk-nav uk-nav-primary uk-nav-center uk-margin-auto-vertical">
            <?php displayCollapsedStateSubNavbar() ?>
        </ul>
    </div>
</div>
