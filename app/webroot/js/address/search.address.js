$(document).ready(function() {

    $('#zip').keyup(function() {
        var data = {request : $('#zip').val()};

        if (data.request.length === 7 && !(isNaN(data.request))) {
            $.ajax({
                type: "GET",
                url: "/addresses/search",
                data: {
                    param: $(this).val(),
                },
                dataType: 'json'
            })
            .done(function(data) {
                console.log(data);
                if (data.Address) {
                    $("#UserCity option").val(data.Address.city_name);
                    $("#UserPrefecture").val(data.Address.ken_name).change();
                }
            })
            .fail(function(XMLHttpRequest, textStatus, errorThrown) {
                console.log(XMLHttpRequest.status);
                console.log(textStatus);
                console.log(errorThrown);
            })
        } else {
            $("#UserPrefecture").val("");
            $("#UserCity").val("");
        }
    });

    $("#UserPrefecture").change(function() {
        var cityName = $("#UserCity").val();

        $.ajax({
            type: "GET",
            url: "/addresses/settingCity",
            data: {
                param: $(this).val(),
            },
            dataType: 'json'
        })
        .done(function(data) {
            $("#UserCity").html("<option value=''>選択してください</option>");
            data.forEach(function (value) {
                var isSelected = (cityName == value.Address.city_name) ? "selected" : "";
                $("#UserCity").append(`<option value="${value.Address.city_name}" ${isSelected}>${value.Address.city_name}</option>`);
            });
        })
        .fail(function(XMLHttpRequest, textStatus, errorThrown) {
            console.log(XMLHttpRequest.status);
            console.log(textStatus);
            console.log(errorThrown);
        })
    });
});