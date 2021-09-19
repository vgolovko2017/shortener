function get_urls() {
    $.ajax({
        url: "/geturls",
        type: "get",
        dataType: "json",
        success: function (data) {
            let tmpl = "";
            for (var i in data) {
                tmpl += make_tmpl(data[i]['original_url'], document.location['origin']
                    + '/' + data[i]['short_url_id'], data[i]['short_url_id']);
            }
            $(".bd-e-row .bd-e").html(tmpl);

            $(".row").hover(function () {
                $(this).css("background-color", "lightgray");
            }, function () {
                $(this).css("background-color", "white");
            });

            $('.del-pointer').click(function () {
                $.ajax({
                    url: "/delbyid",
                    type: "post",
                    data: { id: $(this).attr('deltokenid') },
                    success: function () {
                        get_urls();
                    }
                })
            })
        },
        error: function () {
            console.log('Error in get_urls()');
        },
        fail: function () {
            console.log('Fail in get_urls()');
        }
    });
}

function make_tmpl(original, short, id) {
    return '<div class="container"><div class="row"><div class="col textellipsis" data-toggle="tooltip" title="'
        + original + '">' + original + '</div>' +
        '<div class="col textellipsis" data-toggle="tooltip" title="' + short + '">'
        + '<a href="' + short + '" target=”_blank”>' + short + '</a>'
        + '<span deltokenid="' + id + '" class="del-pointer"><svg xmlns="http://www.w3.org/2000/svg"'
        + ' width="26" height="26" fill="currentColor" class="bi bi-x" viewBox="0 0 16 16">'
        + ' <path d="M4.646 4.646a.5.5 0 0 1 .708 0L8 7.293l2.646-2.647a.5.5 0 0 1 .708.708L8.707 8l2.647 2.646a.5.5'
        + ' 0 0 1-.708.708L8 8.707l-2.646 2.647a.5.5 0 0 1-.708-.708L7.293 8 4.646 5.354a.5.5 0 0 1 0-.708z">'
        + ' </path></svg></span></div></div></div>';
}

function add_full_url(url) {
    $.ajax({
        url: "/addurl",
        type: "post",
        data: {
            url: url
        },
        dataType: "json",
        success: function (data) {
            if (data && ('ErrorCode' in data)) {
                if (data['ErrorCode'] == 10) {
                    $("#alreadyHaveURL").modal();
                } else {
                    $("#customError .modal-body").html(data['Message']);
                    $("#customError").modal();
                }
            } else {
                get_urls();
            }
        },
        error: function (request, status, error) {
            console.log('Error in add_full_url()');
        },
        fail: function () {
            console.log('Fail in add_full_url()');
        }
    });
}

function is_url_valid(userInput) {
    let res = userInput.match("^(https?://)?(www\\.)?([-a-z0-9]{1,63}\\.)*?[a-z0-9][-a-z0-9]{0,61}[a-z0-9]\\.[a-z]{2,20}(/[-\\w@\\+\\.~#\\?&/=%]*)?$");

    if (res == null) {
        return false;
    }

    return true;
}