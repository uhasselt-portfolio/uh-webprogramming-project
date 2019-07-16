/**
 * External library
 * Using the AJAX from jQuery
 */

function saveSettings(input, thread) {
    $(input).keyup(function(e) {
        clearTimeout(thread);
        var $this = $(this);
        thread = setTimeout(() => {
            var request = $.ajax({
                url: 'middleware-account-settings.php',
                type: 'POST',
                data: {id: $this[0].id, value: $this[0].value},
            });

            request.done(function(data) {
                if(data.oldValue)
                    document.getElementById($this[0].id).value = data.oldValue;

                if(data.status === 'success')
                    UIkit.notification({message: 'Instellingen opgeslagen!', status: 'success', pos: 'bottom-left', timeout: 4000});
                else if(data.status === 'empty')
                    UIkit.notification({message: 'Deze velden zijn verplicht om ingevuld te blijven!', status: 'danger', pos: 'bottom-left', timeout: 4000});
                else if(data.status === 'error')
                    UIkit.notification({message: 'Iets ging fout, probeer het opnieuw.', status: 'danger', pos: 'bottom-left', timeout: 4000});
            });

        }, 1500);
    });
}

$(document).ready(function() {
    var thread = null;
    var inputs = ['#firstName', '#lastName', '#city', '#phone', '#dob'];
    for(var i = 0; i < inputs.length; i++) {
        saveSettings(inputs[i], thread);
    }
});

