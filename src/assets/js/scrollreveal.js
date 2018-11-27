$(document).ready(() => {
    // #region Intro
    ScrollReveal().reveal('section#intro', {
        delay: 300,
        distance: '20px',
        origin: 'left'
    });

    ScrollReveal().reveal('#intro-content', {
        delay: 500,
        distance: '20px',
        origin: 'left'
    });

    ScrollReveal().reveal('#fellas', {
        delay: 600,
        distance: '20px'
    });
    // #endregion

    // #region Live stats
    ScrollReveal().reveal('div#live-stats', {
        delay: 300,
        distance: '20px'
    });

    ScrollReveal().reveal('#server-live-stats', {
        delay: 500,
        distance: '20px',
        origin: 'left'
    });

    ScrollReveal().reveal('#office-tempany', {
        delay: 600,
        distance: '20px',
        origin: 'right'
    });
    // #endregion

    // #region Discord
    ScrollReveal().reveal('#discord', {
        delay: 300,
        distance: '20px',
        origin: 'right'
    });
    // #endregion
});