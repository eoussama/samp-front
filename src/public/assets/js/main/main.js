/**
 * @name:       Samp Front
 * @version:    0.5.0
 * @author:     EOussama (eoussama.github.io)
 * @license     MIT
 * @source:     github.com/EOussama/samp-front
 *
 * This javascript file is what gives the souless page the
 * energy needed to feel dynamic, for instance, auto scrolling
 * and live updates for the server's stats.
 */


$(document).ready(() => {

    fetch('./../config/config.php?q')
        .then(response => response.json())
        .then(response => {

            const config = {
                path: {
                    controllers: response.path.controllers,
                    site: response.path.site,
                    process: response.path.process,
                },
                website: {
                    liveUpdateInterval: response.website.liveUpdateInterval,
                    scrollSpeed: response.website.scrollSpeed
                }
            }

            return config;
        })
        .then(config => {

            $('#loader').removeClass('active');
            $('body').css('overflow-y', 'auto');

            // #region Carousel
            $('#gallery-carousel').slick({
                arrows: false,
                autoplay: true,
                autoplaySpeed: 5000,
                dots: true
            });

            const fullscreenDimmer = {
                dimmer: $('#fullscreen-container'),
                image: $('#fullscreen-container img')
            }

            $('i#fullscreen-btn').on('click', () => {

                let
                    currentIndex = $('#gallery-carousel').slick('slickCurrentSlide'),
                    currentImage = $('#gallery-carousel img').eq(currentIndex + 1)[0];

                fullscreenDimmer["image"].attr('src', currentImage.src);
                fullscreenDimmer["image"].attr('alt', currentImage.alt);
                fullscreenDimmer["dimmer"].addClass('active');
                $('body').css('overflow-y', 'hidden');
            });

            $('i#fullscreen-close-btn').on('click', () => {

                fullscreenDimmer["dimmer"].removeClass('active');
                $('body').css('overflow-y', 'auto');
            });
            // #endregion

            // #region Scroll down button press.
            $('#scroll-down-btn').on('click', () => {

                $('html').animate({
                    scrollTop: ($('header').outerHeight() + $('nav').outerHeight()) + 1
                }, config['website']['scrollSpeed']);
            });
            // #endregion

            // #region Scroll to about
            $('#about-btn').on('click', () => {
                
                $('html').animate({
                    scrollTop: $('footer').offset().top
                }, config['website']['scrollSpeed']);
            });
            // #endregion

            // #region Scroll to live stats
            $('#live-stats-btn').on('click', () => {

                $('html').animate({
                    scrollTop: $('#live-stats').offset().top - 80
                }, config['website']['scrollSpeed']);
            });
            // #endregion

            // #region Scroll to news
            $('#news-btn').on('click', () => {

                $('html').animate({
                    scrollTop: $('#news').offset().top - 100
                }, config['website']['scrollSpeed']);
            });
            // #endregion

            // #region Scroll to gallery
            $('#gallery-btn').on('click', () => {

                $('html').animate({
                    scrollTop: $('#gallery').offset().top - 90
                }, config['website']['scrollSpeed']);
            });
            // #endregion

            // #region Scroll to top
            $('#scroll-top').on('click', () => {

                $('html').animate({
                    scrollTop: 0
                }, config['website']['scrollSpeed']);
            });
            // #endregion

            // #region Live update
            const
                $serverInfo = {
                    "section": $('#server-live-stats'),
                    "hostname": $('#server-hostname'),
                    "version": $('#server-version'),
                    "gamemode": $('#server-gamemode'),
                    "mapname": $('#server-mapname'),
                    "language": $('#server-language'),
                    "players": $('#server-players'),
                    "password": $('#server-password')
                },
                $playersInfo = {
                    "section": $('#players-stats'),
                    "stats": $('#player-stats-content'),
                    "count": $('#player-count')
                };

            setInterval(() => {

                fetch(`${config['path']['site']}${config['path']['process']}live-update.php`)
                    .then(response => response.json())
                    .then(data => {

                        if (data.error === undefined) {

                            $serverInfo["section"].removeClass('offline');
                            $playersInfo["section"].removeClass('offline');

                            if (data.info !== null) {

                                // Updating the server's info.
                                $serverInfo["hostname"].text(data.info.hostname);
                                $serverInfo["language"].text(data.info.mapname);
                                $serverInfo["gamemode"].text(data.info.gamemode);
                                $serverInfo["players"].text(`${data.players.length} / ${data.info.maxplayers}`);
                                $serverInfo["password"].text(`${data.info.password ? "Yes" : "No"}`);

                                // Updating the player count.
                                $playersInfo["count"].text(`${data.players.length} / ${data.info.maxplayers}`);
                            }

                            if (data.rules !== null) {

                                // Updating the server's info.
                                $serverInfo["version"].text(data.rules.version);
                                $serverInfo["mapname"].text(data.rules.mapname);
                            }

                            // Updating the players' list.
                            if (data.players !== null) {

                                $playersInfo["stats"].text("");
                                $.each(data.players, (i, v) => {

                                    $playersInfo["stats"].append(`
                                        <tr>
                                            <td>${ v.playerid}</td>
                                            <td>${ v.nickname}</td>
                                            <td>${ v.score}</td>
                                            <td>${ v.ping}</td>
                                        </tr>
                                    `);
                                });
                            }
                        } else {

                            throw `[error] - ${data.error}`;
                        }

                        console.info('Samp Front: Server stats updated.');
                    })
                    .catch(err => {
                        
                        if (err == "The server is currently offline") {

                            $serverInfo["section"].addClass('offline');
                            $playersInfo["section"].addClass('offline');
                        }

                        console.error(`Samp Front: ${err}.`);
                    });
            }, config['website']['liveUpdateInterval']);
            // #endregion

            // #region News
            const $news = {
                section: $('#news-content'),
                title: $('#news-title'),
                date: $('#news-date'),
                body: $('#news-body')
            };

            $('#news-list div.item').on('click', (e) => {

                const id = $(e.target).closest('div.item').data('id');

                $('#news-list div.item').removeClass('active');
                $(e.target).closest('div.item').addClass('active');

                fetch(`${config['path']['site']}${config['path']['controllers']}news/read_single.php?id=${id}`)
                    .then(response => response.json())
                    .then(article => {

                        $($news['title']).text(article.title);
                        $($news['date']).text(article.created_at);
                        $($news['body']).html($.parseHTML(article.body));
                    });
            });

            $('#news-list div.item:first-of-type').trigger('click');
            // #endregion
        });
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
