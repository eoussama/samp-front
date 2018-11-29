$(document).ready(() => {
    /*$('aside#sidebar').sidebar({
        context: $('#context')
    }).sidebar('attach events', '#sidebar-btn');*/

    $('#sidebar').sidebar({
        context: $('#context')
    }).sidebar('attach events', '#burger-btn');
});