<?php

require_once "./app/core/Handle.php";
require_once "./app/models/Accounts.php";

session_start();

header('Content-type: application/json');
$response_array = [];

Handle::authentication("account", Popups::mustBeAuthenticated(), "login.php");

Handle::requiredParameters([$_POST['id'], $_POST['value']], Popups::requiredField(), "settings.php");

if(empty($_POST['id']) || empty($_POST['value']) || empty($_SESSION['account'])) {
    if(empty($_POST['value']) && isset($_POST['id'])) {
        switch($_POST['id']) {
            case 'firstName':
                $response_array['oldValue'] = $_SESSION['account']->first_name;
                break;
            case 'lastName':
                $response_array['oldValue'] = $_SESSION['account']->last_name;
                break;
            case 'city':
                $response_array['oldValue'] = $_SESSION['account']->city;
                break;
            case 'dob':
                $response_array['oldValue'] = $_SESSION['account']->birth_date;
                break;
            case 'phone':
                $response_array['oldValue'] = $_SESSION['account']->phone;
                break;
        }
        $response_array['status'] = 'empty';
    } else{
        $response_array['status'] = 'error';
    }
} else {
    $accountID = $_SESSION['account']->account_id;
    switch($_POST['id']) {
        case 'firstName':
            Accounts::updateFirstName($accountID, $_POST['value']);
            break;
        case 'lastName':
            Accounts::updateLastName($accountID, $_POST['value']);
            break;
        case 'city':
            Accounts::updateCity($accountID, $_POST['value']);
            break;
        case 'dob':
            Accounts::updateBirthday($accountID, $_POST['value']);
            break;
        case 'phone':
            Accounts::updatePhone($accountID, $_POST['value']);
            break;
    }
    $response_array['status'] = 'success';
    $_SESSION['account'] = Accounts::getAccountViaID($accountID);
}

echo json_encode($response_array);

?>