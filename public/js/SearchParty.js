$(document).ready(function() {
    var thread = null;
    $('#search').keyup(function(e) {
        clearTimeout(thread);
        var $this = $(this);
        if($this[0].value === "")
            return;

        thread = setTimeout(() => {
            $("#search-result").load("middleware-party-search.php", {
                value: $this[0].value
            });
        }, 250);
    });
});