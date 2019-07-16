<?php

function displayUserProfilePage($account, $accountID) {
    $parties = Parties::getParties($accountID, 2);
    /** Profile header **/
    require_once "./app/views/profile/user-profile-header.php";

    /** Recently visited parties **/
    require_once "./app/views/profile/visited-parties.php";
}

function displayOrganizerProfilePage($organizer, $accountID) {
    $ratings = Ratings::getRatingViaOrganizer($organizer->organizer_id, 6);
    /** Organizer header **/
    require_once "./app/views/profile/organizer-profile-header.php";

    require_once "./app/views/profile/organizer-ratings.php";
}

if($type == 'o')
    displayOrganizerProfilePage($account, $accountID);
else
    displayUserProfilePage($account, $accountID);

?>