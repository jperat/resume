var $ = require('jquery');
import('@fortawesome/fontawesome-free/js/all.js');
import 'bootstrap';
import('jquery.easing');

(function ($) {
    "use strict"; // Start of use strict
    // Smooth scrolling using jQuery easing
    $('a.js-scroll-trigger[href*="#"]:not([href="#"])').click(function () {
        if (location.pathname.replace(/^\//, '') == this.pathname.replace(/^\//, '') && location.hostname == this.hostname) {
            var target = $(this.hash);
            target = target.length ? target : $('[name=' + this.hash.slice(1) + ']');
            if (target.length) {
                $('html, body').animate({
                    scrollTop: (target.offset().top)
                }, 1000, "easeInOutExpo");
                return false;
            }
        }
    });

    // Closes responsive menu when a scroll trigger link is clicked
    $('.js-scroll-trigger').click(function () {
        $('.navbar-collapse').collapse('hide');
    });
    $(document).on('submit', '.contact-form', function (e) {
        e.preventDefault();
        $.ajax({
            method: 'POST',
            url: Routing.generate('home_contact'),
            data: $(this).serialize(),
            success: function (data) {
                $('.contact-form').replaceWith(data);
            }
        })
    })

    // Activate scrollspy to add active class to navbar items on scroll
    $('body').scrollspy({
        target: '#sideNav'
    });

})(jQuery); // End of use strict