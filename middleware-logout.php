<?php

require_once "./app/core/Handle.php";

session_start();

if(isset($_SESSION['organizer']))
    unset($_SESSION['organizer']);

if(isset($_SESSION['account']))
    unset($_SESSION['account']);

if(isset($_SESSION['party-setup']))
    unset($_SESSION['party-setup']);

if(isset($_SESSION['party-manager']))
    unset($_SESSION['party-manager']);

Handle::redirect("index.php");


?>