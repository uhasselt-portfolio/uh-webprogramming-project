<nav class="uk-navbar-container" uk-navbar>
    <div class="uk-navbar-left uk-margin-xlarge-left">
        <ul class="uk-navbar-nav">
            <li>
                <a class="uk-link-reset uk-padding-remove-left" href="party-overview.php">
                    <span class="uk-margin-small-right" uk-icon="arrow-left"></span>
                    <span class="customized-dashboard-card-title"><?= $_SESSION['party-manager']->name ?></span>
                </a>
            </li>
        </ul>
    </div>
    <div class="uk-navbar-right  uk-margin-xlarge-right">
        <div class="uk-visible@l">
            <ul class="uk-navbar-nav">
                <li>
                    <a class="uk-padding-remove-left" href="dashboard.php">
                        <span uk-icon="home"></span>
                        <span class="uk-margin-small-left">Dashboard</span>
                    </a>
                </li>
                <li>
                    <a href="party-edit.php">
                        <span uk-icon="info"></span>
                        <span class="uk-margin-small-left">Fuif</span>
                    </a>
                </li>
                <li>
                    <a href="ticket-overview.php">
                        <span uk-icon="file-text"></span>
                        <span class="uk-margin-small-left">Tickets</span>
                    </a>
                </li>
                <li>
                    <a href="line-up-overview.php">
                        <span uk-icon="users"></span>
                        <span class="uk-margin-small-left">Line-up</span>
                    </a>
                </li>
                <li>
                    <a href="media.php">
                        <span uk-icon="image"></span>
                        <span class="uk-margin-small-left">Media</span>
                    </a>
                </li>
                <li>
                    <a href="menu.php">
                        <span uk-icon="tag"></span>
                        <span class="uk-margin-small-left">Menu</span>
                    </a>
                </li>
                <li>
                    <a href="chat-dashboard.php">
                        <span uk-icon="comments"></span>
                        <span class="uk-margin-small-left">Chat</span>
                    </a>
                </li>
            </ul>
        </div>
    </div>
    <div class="uk-hidden@l">
        <ul class="uk-navbar-nav">
            <li>
                <a class="uk-navbar-toggle" uk-toggle="target: #sub-nav">
                    <span uk-navbar-toggle-icon></span> <span class="uk-margin-small-left"></span>
                </a>
            </li>
        </ul>
    </div>
</nav>