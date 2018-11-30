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
            const $checkedArticles = $('input[type="checkbox"]:checked');

            if ($checkedArticles.length === 0) {
                alert("No news articles are selected!");
            } else {
                let articleIds = [];

                $($checkedArticles).each((i) => {
                    articleIds.push($($($checkedArticles).get(i).closest('.item')).data('id'));
                });

                if (confirm(`Are you sure you want to delete ${ (articleIds.length > 1 ? `these ${ articleIds.length }` : 'this') } news article(s)?`)) {
                    $.post( "../controllers/news/delete.php", { ids: articleIds })
                    .done((data) => {
                        data = $.parseJSON(data);

                        alert(`${ data.deleted } out of ${ articleIds.length } news article(s) were successfully deleted!`);
                        window.location.reload();
                    });
                }
            }
        });
        // #endregion
    });
});