/**
 * @name:       Samp Front
 * @version:    0.5.1
 * @author:     EOussama (eoussama.github.io)
 * @license     MIT
 * @source:     github.com/EOussama/samp-front
 * 
 * What sets up the scroll reveal.
 */

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

    // #region Gallery
    ScrollReveal().reveal('#gallery', {
        delay: 300,
        distance: '20px',
        origin: 'left'
    });
    // #endregion

    // #region Discord
    ScrollReveal().reveal('#discord', {
        delay: 300,
        distance: '20px',
        origin: 'right'
    });
    // #endregion

    // #region News
    ScrollReveal().reveal('#news', {
        delay: 300,
        distance: '20px',
        origin: 'bottom'
    });

    ScrollReveal().reveal('#news-content', {
        delay: 300,
        distance: '20px',
        origin: 'left'
    });

    ScrollReveal().reveal('#news-list', {
        delay: 300,
        distance: '20px',
        origin: 'right'
    });
    // #endregion
});
