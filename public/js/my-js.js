// Setting DataTable (jquery):
$(document).ready(function() {
    $('#result').DataTable();
} );


// Setting button search login for battle
$("#login1").on("keyup", function (event) {
    if (event.keyCode==13 && $("#login1").val() != '') {
        $("#button-login1").get(0).click();
    }
});
$("#login2").on("keyup", function (event) {
    if (event.keyCode==13 && $("#login2").val() != '') {
        $("#button-login2").get(0).click();
    }
});


// Setting form search repository in Github
$("#search-input").on("keyup", function (event) {
    if (event.keyCode==13 && $("#search-input").val() != '') {
        $("#search").submit();
    }
});
$("#lang-input").on("keyup", function (event) {
    if (event.keyCode==13 && $("#search-input").val() != '') {
        $("#search").submit();
    }
});
