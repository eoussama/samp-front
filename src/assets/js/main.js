$(document).ready(() => {
    const config = {
        /**
         * The auto scroll's speed in milliseconds.
         */
        scrollSpeed: 500,

        /**
         * The live stats update interval in milliseconds.
         */
        liveUpdateInterval: 10000
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
            scrollTop: $('#live-stats').offset().top - 50
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
        $serverStats = $('#server-stats-content'),
        $playersStats = $('#player-stats-content'),
        $playerCount = $('#player-count');

    setInterval(() => {
        fetch('utils/live-update.php')
        .then(response => response.json())
        .then(data => {
            if (!data.hasOwnProperty('error')) {
                // Updating the server's info.
                $serverStats.html(`
                    <tr>
                        <td class="collapsing">
                            <i class="star icon"></i> Host name
                        </td>
                        <td>${ data.info.hostname }</td>
                    </tr>

                    <tr>
                        <td class="collapsing">
                            <i class="circle icon"></i> Version
                        </td>
                        <td>${ data.rules.version }</td>
                    </tr>

                    <tr>
                        <td class="collapsing">
                            <i class="play icon"></i> Game-mode
                        </td>
                        <td>${ data.info.gamemode }</td>
                    </tr>

                    <tr>
                        <td class="collapsing">
                            <i class="map icon"></i> Map
                        </td>
                        <td>${ data.rules.mapname }</td>
                    </tr>

                    <tr>
                        <td class="collapsing">
                            <i class="globe icon"></i> Language
                        </td>
                        <td>${ data.info.mapname }</td>
                    </tr>

                    <tr>
                        <td class="collapsing">
                            <i class="user icon"></i> Players
                        </td>
                        <td>${ data.info.players } / ${ data.info.maxplayers }</td>
                    </tr>

                    <tr>
                        <td class="collapsing">
                            <i class="lock icon"></i> Password
                        </td>
                        <td>${ data.info.password ? "Yes" : "No" }</td>
                    </tr>
                `);

                // Updating the player count.
                $playerCount.text(`${ data.players.length } / ${ data.info.maxplayers }`);

                // Updating the players' list.
                $playersStats.text("");
                $.each(data.players, (i, v) => {
                    $playersStats.append(`
                        <tr>
                            <td>${ v.playerid }</td>
                            <td>${ v.nickname }</td>
                            <td>${ v.score }</td>
                            <td>${ v.ping}</td>
                        </tr>
                    `);
                });
            }

            console.log('updated');
        });
    }, config['liveUpdateInterval']);

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