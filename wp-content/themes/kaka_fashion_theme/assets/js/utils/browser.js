// Create cross browser requestAnimationFrame method:
window.requestAnimationFrame = window.requestAnimationFrame || window.mozRequestAnimationFrame || window.webkitRequestAnimationFrame || window.msRequestAnimationFrame || function (f) {
    setTimeout(f, 1000 / 60)
};

//Page functions
var browser = {
    _csrf: null,
    _width: 0,
    _height: 0,
    _header_height: 0,
    _filter_position: 0,
    _position: 0,
    _isotope: null,
    _coords: [],
    setup: function (init) {
        this._width = $(window).width();
        this._height = $(window).height();

        if (init === 1) {
            //Code that should be executed only once goes here
        }

        //Code that should execute on window resize goes here
    },
    scrollEvent: function (init) {
        requestAnimationFrame(function () {
            //Add layer behind sticky menu
            var st = $(window).scrollTop();
            if (st >= 100)
                $('html').addClass('has-scrolled');
            else
                $('html').removeClass('has-scrolled');

            //Pause or play Slideshows based on visibility
            browser.playVisibleEvents();
        });
    },
    pauseAllIntensiveEvents: function () {
        //All slideshow/videos that needs to be paused should be written here
        $('.cycle').each(function () {
            $(this).cycle('pause');
        });
    },
    playVisibleEvents: function () {
        //Slideshow/videos that needs to be paused when out of view should be written here
        $('.cycle').each(function () {
            var slider = $(this);
            if (slider.is(':in-viewport'))
                slider.cycle('resume');
            else
                slider.cycle('pause');
        });
    },
    get: function (key, default_) {
        //Function to get the value of url parameters
        if (default_ == null)
            default_ = "";
        key = key.replace(/[\[]/, "\\\[").replace(/[\]]/, "\\\]");
        var regex = new RegExp("[\\?&]" + key + "=([^&#]*)");
        var qs = regex.exec(window.location.href);
        if (qs == null)
            return default_;
        else
            return qs[1];
    }
};
