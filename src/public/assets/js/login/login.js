/**
* @name:       Samp Front
* @version:    0.5.0
* @author:     EOussama (eoussama.github.io)
* @license     MIT
* @source:     github.com/EOussama/samp-front
*/

$(document).ready(() => {
    // #region Closing the message popup.
    $('.message .close').on('click', function() {
        $(this).closest('.message').transition('fade');
    });
    // #endregion
});