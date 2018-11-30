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
        // #endregion

        // #region Scroll to news
        const newsSection = $('section#news');

        $('#news-btn').on('click', () => {
            $('html').animate({
                scrollTop: newsSection.offset().top
            }, config['scrollSpeed']);
        });
        // #endregion
    
        // #region CRUD
        const newsList = $('#news-list');

        $('#add-btn').on('click', () => {
            console.log('Adding...');
        });

        $('#select-btn').on('click', () => {
            $('input[type="checkbox"]').prop('checked', true);
        });

        $('#unselect-btn').on('click', () => {
            $('input[type="checkbox"]').prop('checked', false);
        });

        $('#delete-btn').on('click', () => {
            if ($('input[type="checkbox"]:checked').length === 0) {
                alert("No news articles are selected!");
            } else {
                console.log('Deleting...');
            }
        });
        // #endregion
    });
});