$(document).ready(() => {
    // Scroll down button press.
    $('#scroll-down-btn').on('click', () => {
        $('html').animate({
            scrollTop: ($('header').outerHeight() + $('nav').outerHeight())
        }, 500, 'swing');
    });
});