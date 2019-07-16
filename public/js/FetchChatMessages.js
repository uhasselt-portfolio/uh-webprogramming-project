/**
 * External library
 * Using the AJAX from jQuery
 */

function showMessage(msg){
    $("#messages").append(
        "<div class='uk-background-secondary uk-border-rounded uk-padding-small uk-text-left uk-text-muted uk-margin-medium-top'>"+ msg +"</div>"
    );
}

function formatDate(milliseconds) {
    let date = new Date(milliseconds);
    let month = date.getMonth() + 1;
    return date.getFullYear() + "-" + month + "-" + date.getDate() + " " + date.getHours() + ":" + date.getMinutes() + ":" + date.getUTCSeconds();
}

function fetchNewMessages(account_id, organizer_id, sent_by_organizer) {
    console.log('Fetching messages..', account_id, organizer_id, sent_by_organizer);

    $.ajax({
        type: "POST",
        url: "middleware-chat-fetch.php",
        data: {accountID: account_id, organizerID: organizer_id, sentByOrganizer: sent_by_organizer},
        async: true,

        success: function(data){
            console.log(data);
            for (var i = 0; i < data['new-messages'].length; i++) {
                showMessage(data['new-messages'][i]['message']);
            }

            setTimeout(function(){
                fetchNewMessages(account_id, organizer_id, sent_by_organizer);}, 2000)
        }
    });
}