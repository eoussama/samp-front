/**
 * @name:       Samp Front
 * @version:    0.5.1
 * @author:     EOussama (eoussama.github.io)
 * @license     MIT
 * @source:     github.com/EOussama/samp-front
 * 
 * The script of the login page.
 */

$(document).ready(() => {
    // #region Closing the message popup.
    $('.message .close').on('click', function () {
        $(this).closest('.message').transition('fade');
    });
    // #endregion
});
