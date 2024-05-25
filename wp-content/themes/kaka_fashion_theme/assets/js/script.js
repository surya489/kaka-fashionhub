$(function () {
    /*********************
     ALL CLICKS
     *********************/
    $('body').on('click', 'a[data-scroll]', function (e) {
        e.preventDefault();
        var el = $(this),
                sel = el.data('scroll');
        $('html, body').animate({
            'scrollTop': $(sel).offset().top
        }, 1000);
    });

    //All the click events must go here

    /********************
     ONE TIME INIT
     *********************/
    browser.setup(1);

    $(window).resize(function () {
        browser.setup(0);
    });

    $(window).scroll(browser.scrollEvent);
});

$(window).load(function () {
    browser.scrollEvent();
});
