$(document).ready(function() {
    // $('input[type=file]').after('<span class="img_pre"></span>');

    // $('input[type=file]').change(function() {
    //     $('span').html('');
    //     var file = $(this).prop('files');
    //     var img_count = 1;
    //     $(file).each(function(i) {
    //         var reader = new FileReader();
    //         reader.onload = function() {
    //             var img_src = $('<img>').attr('src', reader.result);
    //             $('.img_pre').append(img_src);
    //         }
    //         reader.readAsDataURL(file[i]);

    //         img_count = img_count + 1;
    //     });
    //  });

    $(".btn-plus").on('click', function() {
        $("#file-list").append('<div class="wrapper-img"><div class="form-group"><input type="file" name="data[Post][Images][]" class="form-control-file file-input" accept="image/*" multiple="multiple" id="PostImages"></div></div>')
    });

    $(".icon-clear").on('click', function() {
        // $(".wrapper-img").addClass("target");
        if (!confirm('このファイルを削除してよろしいですか？')) {
            return false;
        } else {
            $(".target").css("display", "none");
        }
    });
});