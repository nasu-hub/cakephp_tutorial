$(document).ready(function() {
    $(".icon-search").on('click', function() {
        if ($(this).hasClass('active')) {
            $(this).removeClass('active');
            $("i", this).removeClass("fa-times")
            $("i", this).addClass("fa-search")
            $(".search-box").slideUp();
        } else {
            $(this).addClass('active');
            $("i", this).removeClass("fa-search")
            $("i", this).addClass("fa-times")
            $(".search-box").slideDown();
        }
    });


    $(".btn-reset").on('click', function() {
        console.log(this.form);
        clearForm(this.form);
    });

    function clearForm(form){
        $(form).prop("selected", false);
    }
})