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
    
        // #region Quill
        const quill = new Quill('#editor', {
            theme: 'snow'
        });
        // #endregion

        // #region CRUD
        const editorForm = $('#editor-form');

        $('#add-btn').on('click', () => {
            $('#text-editor-create')
            .modal({
                onApprove: () => {
                    $(editorForm).trigger('submit');
                }
            })
            .modal('show');

            $(editorForm).find('input[name="title"]').val('');
            quill.deleteText(0, quill.getLength());
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

        $(editorForm).on('submit', (e) => {
            e.preventDefault();

            if ($(editorForm).find('input[name="title"]').val().length == 0) {
                alert('Make sure provide a valid title for the news article.');
            } else {
                $.post('../controllers/news/create.php', {
                    title: $(editorForm).find('input[name="title"]').val(),
                    body: quill.root.innerHTML
                })
                .done((data) => {
                    console.log(data);
                    if (!data.hasOwnProperty('error')) {
                        alert(`A new news article was created.`);
                    } else {
                        alert(`Error: ${ data.error }`);
                    }

                    window.location.reload();
                });
            }
        });
        // #endregion
    });
});