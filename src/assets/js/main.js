$(document).ready(() => {
    fetch('./config/config.php?q')
    .then(response => response.json())
    .then(response => {
        const config = {
            liveUpdateInterval: response.liveUpdateInterval,
            scrollSpeed: response.scrollSpeed
        }
        
        return config;
    })
    .then(config => {
        $('#loader').removeClass('active');
        $('body').css('overflow-y', 'auto');

        // #region Carousel
        $('#gallery-carousel').slick({
            autoplay: true,
            autoplaySpeed: 5000,
            dots: true
        });
        // #endregion

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
                scrollTop: $('#live-stats').offset().top - 80
            }, config['scrollSpeed']);
        });
        // #endregion
    
        // #region Scroll to news
        $('#news-btn').on('click', () => {
            $('html').animate({
                scrollTop: $('#news').offset().top - 100
            }, config['scrollSpeed']);
        });
        // #endregion

        // #region Scroll to gallery
        $('#gallery-btn').on('click', () => {
            $('html').animate({
                scrollTop: $('#gallery').offset().top - 90
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
            fetch('./utils/live-update.php')
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
                        $serverInfo["players"].text(`${ data.players.length } / ${ data.info.maxplayers }`);
                        $serverInfo["password"].text(`${ data.info.password ? "Yes" : "No" }`);
                        
                        // Updating the player count.
                        $playersInfo["count"].text(`${ data.players.length } / ${ data.info.maxplayers }`);
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
                                    <td>${ v.playerid }</td>
                                    <td>${ v.nickname }</td>
                                    <td>${ v.score }</td>
                                    <td>${ v.ping }</td>
                                </tr>
                            `);
                        });
                    }
                } else {
                    throw `[error] - ${ data.error }`;
                }
    
                console.info('Samp Front: Server stats updated.');
            })
            .catch(err => {
                if (err == "The server is currently offline") {
                    $serverInfo["section"].addClass('offline');
                    $playersInfo["section"].addClass('offline');
                }
    
                console.error(`Samp Front: ${ err }.`);
            });
        }, config['liveUpdateInterval']);
        // #endregion
    
        // #region News

        $('#news-list div.item').on('click', (e) => {
            console.log(e);
        });

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