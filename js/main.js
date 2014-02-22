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

})(window.jQuery, window, window.document);