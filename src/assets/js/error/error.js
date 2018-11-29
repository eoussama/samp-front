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