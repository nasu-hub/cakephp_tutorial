$(document).ready(function() {
    $('input[type=file]').after('<span class="img_pre"></span>');

    $('input[type=file]').change(function() {
        $('span').html('');
        var file = $(this).prop('files');
        var img_count = 1;
        $(file).each(function(i) {
            var reader = new FileReader();
            reader.onload = function() {
                var img_src = $('<img>').attr('src', reader.result);
                $('.img_pre').append(img_src);
            }
            reader.readAsDataURL(file[i]);

            img_count = img_count + 1;
        });
     });
});