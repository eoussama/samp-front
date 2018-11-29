$(document).ready(() => {
    $('#sidebar').sidebar({
        context: $('#context')
    }).sidebar('attach events', '#burger-btn');
});