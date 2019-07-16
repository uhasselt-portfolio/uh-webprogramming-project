<?php
require_once "./app/core/Pop-ups.php";

class Handle {

    public static function redirect($page) {
        header('Location: ' . $page);
        exit();
    }

    public static function authentication($sessionValue, $popup, $redirect) {
        if($sessionValue == NULL) {
            $_SESSION[$popup->type] = $popup->message;
            self::redirect($redirect);
        } else {
            if(!isset($_SESSION[$sessionValue])) {
                $_SESSION[$popup->type] = $popup->message;
                self::redirect($redirect);
            }
        }
    }

    public static function requiredParameters($fields, $popup, $redirect) {
        foreach($fields as $field) {
            if(!isset($field) || empty($field)) {
                if($field != 0 || empty($field)) {
                    $_SESSION[$popup->type] = $popup->message;
                    self::redirect($redirect);
                }
            }
        }
    }

    public static function setPopup($popup) {
        $_SESSION[$popup->type] = $popup->message;
    }

    public static function displayPopups() {
        if(isset($_SESSION['notification-warning'])) {
            self::handleWarningAlert($_SESSION['notification-warning']);
            unset($_SESSION['notification-warning']);
        }

        if(isset($_SESSION['notification-success'])) {
            self::handleSuccessAlert($_SESSION['notification-success']);
            unset($_SESSION['notification-success']);
        }
    }

    public static function mustBeOrganizer() {
        if(!empty($_SESSION['organizer']))
            self::redirect('dashboard.php');
    }

    public static function mustBeAdmin() {
        if(empty($_SESSION['account'])) {
            self::setPopup(Popups::noPermission());
            self::redirect('index.php');
        } else {
            if(!$_SESSION['account']->admin) {
                self::setPopup(Popups::noPermission());
                self::redirect('index.php');
            }
        }
    }

    public static function handleWarningAlert($message) {
        ?>
        <script>
            var message = <?= json_encode($message) ?>;
            displayAlert(message);
        </script>
        <?php
    }

    public static function handleSuccessAlert($message) {
        ?>
        <script>
            var message = <?= json_encode($message) ?>;
            displaySuccess(message);
        </script>
        <?php
    }

    public static function accountSetupProcess($currentProcess) {
        if(isset($_SESSION['account'])) {
            $setupProcess = $_SESSION['account']->setup_process;
            if($setupProcess != $currentProcess) {
                switch($setupProcess) {
                    case 'EMAIL_VERIFICATION':
                        Handle::redirect("email-verification.php");
                        break;
                    case 'INFORMATION_SETUP':
                        Handle::redirect("information-setup.php");
                        break;
                    case 'AVATAR_SETUP':
                        Handle::redirect("avatar-setup.php");
                        break;
                    case 'FINISHED':
                        Handle::redirect("index.php");
                        break;
                }
            }
        }
    }

    public static function handleCommercialAuthentication() {
        if(!isset($_SESSION['organizer']))
            Handle::redirect("organizer-register.php");
    }

    public static function hasManageAuthority() {
        if(!isset($_SESSION['party-manager']))
            Handle::redirect("party-overview.php");
    }
}

?>