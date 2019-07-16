function showOldNotifications() {
    console.log('clicked');
    var oldNotificationSection = document.getElementById("oldNotificationSection");
    var oldNotificationButton = document.getElementById("oldNotificationButton");
    if(oldNotificationSection.style.display === "none") {
        oldNotificationSection.style.display = "block";
        oldNotificationButton.innerHTML = "Verberg oude meldingen";
    }
    else {
        oldNotificationSection.style.display = "none";
        oldNotificationButton.innerHTML = "Toon oude meldingen";
    }
}

// Didn't use CSS to hide the old notifications because
// when the js is disabled it will be automatically shown (fallback).
function hideOldNotifications() {
    var oldNotificationSection = document.getElementById("oldNotificationSection");
    oldNotificationSection.style.display = "none";
}