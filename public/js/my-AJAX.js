function getListRepos(input) {

    var value = $("input[name='" + input + "']").val();
    var token = $('meta[name="csrf-token"]').attr('content');

    $.ajax({

        url: '/get-repository',
        method: 'POST',
        data: {_token: token, login: value},

        success: function (listRepos) {

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
}

