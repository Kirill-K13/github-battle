function getListRepos(input) {

    var value = $("input[name='" + input + "']").val();
    var token = $('meta[name="csrf-token"]').attr('content');

    $.ajax({

        url: '/get-repository',
        method: 'POST',
        data: {_token: token, login: value},

        success: function (listRepos) {

            $(".fakeloader").removeAttr( 'style' ).html('');

            if (listRepos == 'ERROR: user not found!') {
                $('#help-'+input).html('<strong>ERROR: user not found!</strong>');
                return;
            }

            listRepos = JSON.parse(listRepos);

            var option = '';
            for (var i = 0; i < listRepos.length; i++) {
                option += '<option>' + listRepos[i] + '</option>';
            }

            $('#list-' + input).html(option);

        },

        error: function (jqXHR, textStatus, errorThrown) {
            console.log("AJAX error: " + textStatus + ' : ' + errorThrown);
        }
    });

    $(".fakeloader").removeAttr( 'style' ).html('').fakeLoader({
        timeToHide: 15000,
        bgColor: "#1e1e1e",
        spinner: "spinner2"
        // OR spinner:"spinner1" - "spinner7"
        // OR imagePath:"img/favicon.ico"
    });
}

