/**
 * Big Blank keyboard support for image navigation.
 */
(function($) {
    $(document).on('keydown.bigblank', function(e) {
        var url = false;

        // Left arrow key code.
        if (e.which === 37) {
            url = $('.previous-image').parent().attr('href');

            // Right arrow key code.
        } else if (e.which === 39) {
            url = $('.next-image').parent().attr('href');
        }

        if (url && (!$('textarea, input').is(':focus'))) {
            window.location = url;
        }
    });
})(jQuery);