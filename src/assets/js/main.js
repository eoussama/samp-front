$(document).ready(() => {
    // Scroll down button press.
    $('#scroll-down-btn').on('click', () => {
        $('html').animate({
            scrollTop: ($('header').outerHeight() + $('nav').outerHeight()) + 1
        }, 500, 'swing');
    });
});

$(document).on('scroll', (e) => {
    if ($(window).scrollTop() > ($('header').outerHeight() + $('nav').outerHeight())) {
        $('nav').addClass('sticky');
    } else {
        $('nav').removeClass('sticky');
    }
});
