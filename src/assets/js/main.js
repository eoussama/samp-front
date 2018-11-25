$(document).ready(() => {
    const config = {
        // The auto scroll's speed in milliseconds.
        scrollSpeed: 500
    };

    // #region Scroll down button press.
    $('#scroll-down-btn').on('click', () => {
        $('html').animate({
            scrollTop: ($('header').outerHeight() + $('nav').outerHeight()) + 1
        }, config['scrollSpeed']);
    });
    // #endregion

    // #region Scroll to about
    $('#about-btn').on('click', () => {
        $('html').animate({
            scrollTop: $('footer').offset().top
        }, config['scrollSpeed']);
    });
    // #endregion

    // #region Scroll to live stats
    $('#live-stats-btn').on('click', () => {
        $('html').animate({
            scrollTop: $('#live-stats').offset().top - 100
        }, config['scrollSpeed']);
    });
    // #endregion

    // #region Scroll to top
    $('#scroll-top').on('click', () => {
        $('html').animate({
            scrollTop: 0
        }, config['scrollSpeed']);
    });
    // #endregion
});

$(document).on('scroll', (e) => {
    if ($(window).scrollTop() > ($('header').outerHeight() + $('nav').outerHeight())) {

        // Sticking the navbar.
        $('nav').addClass('sticky');

        // Adding some margin top to the header.
        $('header').addClass('sticky');

        // Displaying the back to top button.
        $('#scroll-top').css('display', 'block');
    } else {

        // Fixing the navbar.
        $('nav').removeClass('sticky');

        // Removing the extra margin top from the header.
        $('header').removeClass('sticky');

        // Hidding the back to top button.
        $('#scroll-top').css('display', 'none');
    }
});

window.addEventListener('beforeunload', () => {
    window.scrollTo(0, 0);
});