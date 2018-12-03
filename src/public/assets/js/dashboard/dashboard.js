/**
* @name:       Samp Front
* @version:    0.5.0
* @author:     EOussama (eoussama.github.io)
* @license     MIT
* @source:     github.com/EOussama/samp-front
*
* The javascript file responsible on breathing life on the dashboard.php file
* and make it function the way it should.
*/

$(document).ready(() => {
    fetch('./../../config/config.php?q')
        .then(response => response.json())
        .then(response => {
            const config = {
                path: {
                    controllers: response.path.controllers,
                    site: response.path.site
                }
            }

            return config;
        })
        .then(config => {
            $('#loader').removeClass('active');
            $('body').css('overflow-y', 'auto');

            // #region Quill
            const
                quillCreate = new Quill('#editor-create', {
                    theme: 'snow'
                }),
                quillEdit = new Quill('#editor-edit', {
                    theme: 'snow'
                });
            // #endregion

            // #region CRUD
            const
                editorFormCreate = $('#editor-form-create'),
                editorFormEdit = $('#editor-form-edit');

            let articleToEdit = '';

            $('#add-btn').on('click', () => {
                $('#text-editor-create')
                    .modal({
                        onApprove: () => {
                            $(editorFormCreate).trigger('submit');
                        }
                    })
                    .modal('show');

                $(editorFormCreate).find('input[name="title"]').val('');
                quillCreate.deleteText(0, quillCreate.getLength());
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

                    if (confirm(`Are you sure you want to delete ${(articleIds.length > 1 ? `these ${articleIds.length}` : 'this')} news article(s)?`)) {
                        $.post(`${config['path']['site']}${config['path']['controllers']}news/delete.php`, { ids: articleIds })
                            .done((data) => {
                                alert(`${data.deleted} out of ${articleIds.length} news article(s) were successfully deleted!`);
                                window.location.reload();
                            });
                    }
                }
            });

            $('.edit-btn').on('click', (e) => {
                if (!$(e.target).hasClass('loading')) {
                    articleToEdit = $($(e.target).closest('.item')).data('id');

                    $(e.target).addClass('loading');

                    fetch(`${config['path']['site']}${config['path']['controllers']}news/read_single.php?id=${articleToEdit}`)
                        .then(response => response.json())
                        .then(article => {
                            $(editorFormEdit).find('input[name="title"]').val(article.title);
                            $(quillEdit.root).html($.parseHTML(article.body));
                        })
                        .then(() => {
                            $(e.target).removeClass('loading');

                            $('#text-editor-edit').modal({
                                onApprove: () => {
                                    $(editorFormEdit).trigger('submit');
                                }
                            }).modal('show');
                        });
                }
            });

            $(editorFormCreate).on('submit', (e) => {
                e.preventDefault();

                if ($(editorFormCreate).find('input[name="title"]').val().length == 0) {
                    alert('Make sure provide a valid title for the news article.');
                } else {
                    $.post(`${config['path']['site']}${config['path']['controllers']}news/create.php`, {
                        title: $(editorFormCreate).find('input[name="title"]').val(),
                        body: quillCreate.root.innerHTML
                    })
                        .done((data) => {
                            if (!data.hasOwnProperty('error')) {
                                alert(`A new news article was created.`);
                            } else {
                                alert(`Error: ${data.error}`);
                            }

                            window.location.reload();
                        });
                }
            });

            $(editorFormEdit).on('submit', (e) => {
                e.preventDefault();

                if ($(editorFormEdit).find('input[name="title"]').val().length == 0) {
                    alert('Make sure provide a valid title for the news article.');
                } else {
                    $.post(`${config['path']['site']}${config['path']['controllers']}news/update.php`, {
                        id: articleToEdit,
                        title: $(editorFormEdit).find('input[name="title"]').val(),
                        body: quillEdit.root.innerHTML
                    }).done((data) => {
                        if (!data.hasOwnProperty('error')) {
                            alert(`The news article was successfully edited.`);
                        } else {
                            alert(`Error: ${data.error}`);
                        }

                        window.location.reload();
                    });
                }
            });
        });
    // #endregion
});