$(".btn-refresh").click(function () {
    $.ajax({
        type: 'GET',
        url: 'refresh_captcha',
        _token: $('input[name="_token"]').val(),
        success: function (data) {
            $(".captcha span").html(data.captcha);
        }
    })
});

