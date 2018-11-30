/**
* @name:       Samp Front
* @version:    0.5.0
* @author:     EOussama (eoussama.github.io)
* @license     MIT
* @source:     github.com/EOussama/samp-front
*/

$(document).ready(() => {

    // Redirect to the home page.
    $('#home-btn').on('click', () => {
        window.location.replace('./../index.php');
    });

    // Go back.
    $('#back-btn').on('click', () => {
        window.history.back();
    });
});