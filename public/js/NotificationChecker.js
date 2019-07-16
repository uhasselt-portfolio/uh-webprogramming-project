/**
 * External library
 * Using the AJAX from jQuery
 */

$(document).ready(function() {
    setInterval(checkNotifications, 3000);
});

function checkNotifications() {
    $.ajax({
        type: "GET",
        url: "middleware-notification-checker.php",
        success: function(data){
            console.log(data);
            if(data.count.count >= 1)
                $("#notification-counter").html("<span class=\"uk-badge uk-background-secondary\">"+ data.count.count +"</span>");
            else
                $("#notification-counter").html("");
        }
    });
}