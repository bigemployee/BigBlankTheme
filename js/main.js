; /* Let's make sure all functions close before we start writing our JS code */
(function($, window, document) {
    //'use strict'; // I ♥ JS

    // check devices with device.js
    var isMobile, isTablet;
    if (typeof device === 'object') {
        isMobile = device.mobile();
        isTablet = device.tablet();
    }

    // jQuery stuff goes here

    /**
     * Handlers for navigation, accessibility
     */
    (function() {
        var nav = $('#nav'), button, menu;
        if (!nav) {
            return;
        }

        button = nav.find('#menu-toggle');
        if (!button) {
            return;
        }

        // Hide button if menu is missing or empty.
        menu = nav.find('#menu');
        if (!menu || !menu.children().length) {
            button.hide();
            return;
        }

        button.on('click', function() {
            nav.toggleClass('toggled-on');
        });
        
        // Accessible Menu
        menu.find('a').on('focus blur', function() {
            $(this).parents().toggleClass('focus');
        });
    })();

    /*
     * Makes "skip to content" link work correctly in IE9 and Chrome for better
     * accessibility.
     *
     * @link http://www.nczonline.net/blog/2013/01/15/fixing-skip-to-content-links/
     */
    $(window).on('hashchange', function() {
        var element = document.getElementById(location.hash.substring(1));

        if (element) {
            if (!/^(?:a|select|input|button|textarea)$/i.test(element.tagName)) {
                element.tabIndex = -1;
            }
            element.focus();
        }
    });

    
    // Resonsive Videos via Fluidvids v2.2.0 
    fluidvids.init({
      selector: 'iframe',
      players: ['www.youtube.com', 'player.vimeo.com', 'youtu.be']
    });

    $(document).on('keydown', function(e) {
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


})(window.jQuery, window, window.document);