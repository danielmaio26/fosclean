$(function() {

    "use strict";

    /* ================================================
           affix Navbar fixed 
    ================================================ */

    var toggleAffix = function(affixElement, scrollElement, wrapper) {

        var height = affixElement.outerHeight(),
            top = wrapper.offset().top;

        if (scrollElement.scrollTop() >= top) {
            wrapper.height(height);
            affixElement.addClass("affix");
        } else {
            affixElement.removeClass("affix");
            wrapper.height('auto');
        }

    };


    $('[data-toggle="affix"]').each(function() {
        var ele = $(this),
            wrapper = $('<div></div>');

        ele.before(wrapper);
        $(window).on('scroll', function() {
            toggleAffix(ele, $(this), wrapper);
        });

        // init
        toggleAffix(ele, $(window), wrapper);
    });

    /* ================================================
           Tooltip 
    ================================================ */
    $('[data-toggle="tooltip"]').tooltip()


    /*-----------------------------------
     * ONE PAGE SCROLLING
     *-----------------------------------*/
    // Select all links with hashes
    $('a[href*="#"]').not('[href="#"]').not('[href="#0"]').on('click', function(event) {
        // On-page links
        if (location.pathname.replace(/^\//, '') == this.pathname.replace(/^\//, '') && location.hostname == this.hostname) {
            // Figure out element to scroll to
            var target = $(this.hash);
            target = target.length ? target : $('[name=' + this.hash.slice(1) + ']');
            // Does a scroll target exist?
            if (target.length) {
                // Only prevent default if animation is actually gonna happen
                event.preventDefault();
                $('html, body').animate({
                    scrollTop: target.offset().top -150
                }, 1000, function() {
                    // Callback after animation
                    // Must change focus!
                    var $target = $(target);
                    $target.focus();
                    if ($target.is(":focus")) { // Checking if the target was focused
                        return false;
                    } else {
                        $target.attr('tabindex', '-15'); // Adding tabindex for elements not focusable
                        $target.focus(); // Set focus again
                    };
                });
            }
        }
    });

    /* ================================================
           Date Picker
    ================================================ */

    if ($('#datePicker').length) {
        $('#datePicker').datepicker({
            format: 'mm/dd/yyyy'
        })
    }


}); // End $fn



document.addEventListener('click', function chnageCount(evt) {
    var counterBtn = evt.target;

    if (!counterBtn.closest('.js-counter-btn')) return;

    var counterInput = counterBtn.closest('.js-counter').querySelector('.js-counter-value');

    switch (counterBtn.getAttribute('data-action')) {
        case 'plus':
            counterInput.value = Number(counterInput.value) + 1;
            break;
        case 'minus':
            counterInput.value = Number(counterInput.value) - 1;
            break;
    }
});
/************reCaptcha *************/
function onSubmit(token) {
    document.getElementById("demo-form").submit();
  }


    