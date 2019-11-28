$(document).ready(function() {
    var page = 0;
    var lastPage = parseInt($("#slide img").length-1);

    if (lastPage > 0) {
        $("#slide img").css("display", "none");
        $("#slide img").eq(page).css("display", "block");

        function changePage() {
            $("#slide img").fadeOut(1000);
            $("#slide img").eq(page).fadeIn(1000);
        }

        var Timer;
        function startTimer() {
        Timer = setInterval(function(){
                if (page === lastPage) {
                    page = 0;
                    changePage();
                } else {
                    page++;
                    changePage();
                };
            }, 5000);
        }

        function stopTimer() {
            clearInterval(Timer);
        }

        startTimer();
    }

    $(document).on('click', '#nav-l a', function() {
        stopTimer();
        startTimer();

        if (page === 0) {
            page = lastPage;
            changePage();
        } else {
            page--;
            changePage();
        };
    });

    $(document).on('click', '#nav-r a', function() {
        stopTimer();
        startTimer();

        if (page === lastPage){
            page = 0;
            changePage();
        } else {
            page++;
            changePage();
        };
    });

    $(".modal-open").on('click', function() {
        $('.modal').fadeIn();
        return false;
    });
    $(".modal-close").on('click', function() {
        $(".modal").fadeOut();
        return false;
    })
});