$(document).ready(() => {
    fetch('./../config/config.php?q')
    .then(response => response.json())
    .then(response => {
        const config = {
            scrollSpeed: response.scrollSpeed
        }

        return config;
    })
    .then(config => {
        $('#loader').removeClass('active');
        $('body').css('overflow-y', 'auto');

        // #region Sidebar
        $('#sidebar').sidebar({
            context: $('#context')
        }).sidebar('attach events', '#burger-btn');
        // #enregion

        // #region Scroll to news
        const newsSection = $('section#news');

        $('#news-btn').on('click', () => {
            $('html').animate({
                scrollTop: newsSection.offset().top
            }, config['scrollSpeed']);
        });
        // #endregion
    });
});