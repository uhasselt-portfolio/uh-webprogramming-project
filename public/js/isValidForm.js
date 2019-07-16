function isNotValidEmail(email) {
    var regex = /^(([^<>()[\]\\.,;:\s@\"]+(\.[^<>()[\]\\.,;:\s@\"]+)*)|(\".+\"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/;
    return !regex.test(email);
}

function isNotValidPhone(phone) {
    var regex = /^[\\+]?[(]?[0-9]{3}[)]?[-\\s\\.]?[0-9]{3}[-\\s\\.]?[0-9]{4,6}$/im;
    return !regex.test(phone);
}

// Copied from stackoverflow https://stackoverflow.com/questions/5717093/check-if-a-javascript-string-is-a-url
function isNotValidURL(url) {
    var res = url.match(/(http(s)?:\/\/.)?(www\.)?[-a-zA-Z0-9@:%._\+~#=]{2,256}\.[a-z]{2,6}\b([-a-zA-Z0-9@:%_\+.~#?&//=]*)/g);
    return res === null
}

function showNotification(message) {
    UIkit.notification({
        message: message,
        status: 'danger',
        pos: 'bottom-left',
        timeout: 4000
    });
    return false;
}

function checkInputType(input, type) {
    let valid = true;
    switch (type) {
        case 'text':
        case 'file':
        case 'date':
            if (!input.value)
                valid = showNotification("Vul de verplichte velden in.");
            return valid;
        case 'number':
            if (isNaN(input.value))
                valid = showNotification("Je invoer mag alleen uit nummers bestaan!");
            return valid;
        case 'phone':
            if (isNotValidPhone(input.value))
                valid = showNotification("Dit is geen geldig telefoon nummer!");
            return valid;
        case 'email':
            if (isNotValidEmail(input.value))
                valid = showNotification("Dit is geen email!");
            return valid;
        case 'url':
            if (input.value) {
                if (isNotValidURL(input.value)) {
                    valid = showNotification("Dit is geen url!");
                }
            } else {
                valid = showNotification("Vul de verplichte velden in.");
            }
            return valid;
        case 'not-required':
            return valid;
    }
}

function checkPassword(firstPasswordValue, secondPasswordValue) {
    if (firstPasswordValue !== secondPasswordValue) {
        showNotification("Wachtwoorden zijn niet gelijk aan elkaar.");
        return false;
    }
    return true;
}

function isValidForm(name, types) {
    // Close all the existing notifications
    UIkit.notification.closeAll();
    var id_array = document.forms[name];
    var isValid = true;
    var firstPassword = true;
    for (var i = 0; i < id_array.length; i++) {
        var value = id_array[i].value;
        var id = id_array[i].attributes.id;

        if (id) {
            var input = document.forms[name][i];
            var valid = null;

            if (types[i] === 'password') {
                if (firstPassword) {
                    valid = checkPassword(value, id_array[i + 1].value);
                    firstPassword = false;

                    if (valid && value) {
                        if (document.getElementById(id.value).classList.contains('uk-form-width-large')) {
                            document.getElementById(id.value).classList = 'uk-input uk-form-width-large uk-form-success';
                            document.getElementById(id_array[i + 1].attributes.id.value).classList = 'uk-input uk-form-width-large uk-form-success';
                        } else {
                            document.getElementById(id.value).classList = 'uk-input uk-form-width-medium uk-form-success';
                            document.getElementById(id_array[i + 1].attributes.id.value).classList = 'uk-input uk-form-width-medium uk-form-success';
                        }
                    } else {
                        if (document.getElementById(id.value).classList.contains('uk-form-width-large')) {
                            document.getElementById(id.value).classList = 'uk-input uk-form-width-large uk-form-danger';
                            document.getElementById(id_array[i + 1].attributes.id.value).classList = 'uk-input uk-form-width-large uk-form-danger';
                        } else {
                            document.getElementById(id.value).classList = 'uk-input uk-form-width-medium uk-form-danger';
                            document.getElementById(id_array[i + 1].attributes.id.value).classList = 'uk-input uk-form-width-medium uk-form-danger';
                        }
                        isValid = false;
                    }
                }
            } else {

                valid = checkInputType(input, types[i]);
                if ((valid && value) || valid && types[i] === "not-required") {
                    if (document.getElementById(id.value).classList.contains('uk-form-width-large'))
                        document.getElementById(id.value).classList = 'uk-input uk-form-width-large uk-form-success';
                    else
                        document.getElementById(id.value).classList = 'uk-input uk-form-width-medium uk-form-success';
                } else {
                    if (document.getElementById(id.value).classList.contains('uk-form-width-large'))
                        document.getElementById(id.value).classList = 'uk-input uk-form-width-large uk-form-danger';
                    else {
                        document.getElementById(id.value).classList = 'uk-input uk-form-width-medium uk-form-danger';
                    }
                    isValid = false;
                }
            }
        }
    }
return isValid;
}