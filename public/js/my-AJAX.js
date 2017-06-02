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
                option += '<option>'+listRepos[i]+'</option>';
            }

            $('#list-'+input).html(option);

        },

        error: function (jqXHR, textStatus, errorThrown) {
            console.log("AJAX error: " + textStatus + ' : ' + errorThrown);
        }
    });
}

function getDataRepos() {

    var token       = $('meta[name="csrf-token"]').attr('content');

    var login1      = $("input[name='login1']").val();
    var repository1 = $("#list-login1").val();
    var login2      = $("input[name='login2']").val();
    var repository2 = $("#list-login2").val();

    alert(login1 + ': ' + repository1 + ' ' + login2 + ': ' + repository2);
   /* $.ajax({

        url: '/get-data-repository',
        method: 'POST',
        data: {
            token: token,
            login1: login1,
            repository1: repository1,
            login2: login2,
            repository2: repository2
        },

        success: function (listRepos) {



        },
        error: function (jqXHR, textStatus, errorThrown) {
            console.log("AJAX error: " + textStatus + ' : ' + errorThrown);

    });
    }*/
}
