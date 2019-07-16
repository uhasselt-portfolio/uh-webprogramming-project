function displayAlert(message) {
    UIkit.notification({message: message, status: 'danger', pos: 'bottom-left', timeout: 4000});
}

function displaySuccess(message) {
    UIkit.notification({message: message, status: 'success', pos: 'bottom-left', timeout: 4000});
}
