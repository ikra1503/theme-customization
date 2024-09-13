jQuery(document).ready(function ($) {

    //  Get header height and set padding top to body

    const headerHeight = () => {
        if ($("#header").length) {
            var headerHeight = Math.floor($("#header").outerHeight());
            document.documentElement.style.setProperty('--headerHeight', (headerHeight + 'px'));
        }
    };

    var winWid = $(window).width();
    window.addEventListener('resize', () => {
        if ($(window).width() !== winWid) {
            winWid = $(window).width();
            headerHeight(); // Call headerHeight() when the window is resized
        }
    });

    headerHeight(); // Call headerHeight() initially


    function syncCheckboxes() {
        // Clear all checkboxes in the form
        $('input[name="ServiceCheckboxes[]"]').prop('checked', false);

        // Log values from .radio-tile-group checkboxes
        var selectedValues = [];
        $('.radio-tile-group input[type="checkbox"]').each(function () {
            if ($(this).is(':checked')) {
                var value = $(this).val();
                selectedValues.push(value);
            }
        });
        console.log("Selected values:", selectedValues);

        // Loop through each checkbox in the form and check it if its value is in selectedValues
        $('input[name="ServiceCheckboxes[]"]').each(function () {
            var value = $(this).val();
            if (selectedValues.includes(value)) {
                $(this).prop('checked', true);
            }
        });

        // Log values from form checkboxes
        var formValues = [];
        $('input[name="ServiceCheckboxes[]"]:checked').each(function () {
            var value = $(this).val();
            formValues.push(value);
        });
        console.log("Form values:", formValues);
    }

    // Checkbox click event handler
    $('.checkbox-button').click(function () {
        // Synchronize checkboxes
        syncCheckboxes();
    });

    // Initial synchronization on page load
    syncCheckboxes();

    $('.menu-panel__navigation li a').on('click', function () {
        $('.site-wrapper').removeClass("site-wrapper--has-menu-overlay");
        $('body').removeClass("vertical-scroll--off");
    });

    $('.mobile-nav li a').on('click', function () {
        $('.site-wrapper').removeClass("site-wrapper--has-menu-overlay");
        $('.header-menu-toggle').removeClass("toggled");
        $('body').removeClass("vertical-scroll--off");
    });

    $('#dl-menu li a').on('click', function () {
        // Remove 'active' class from previously active item
        $('#dl-menu li.active').removeClass('active');

        // Add 'active' class to the clicked item
        $(this).closest('li').addClass('active');

        // Additional actions if needed
        $('.site-wrapper').removeClass("site-wrapper--has-menu-overlay");
        $('.header-menu-toggle').removeClass("toggled");
        $('body').removeClass("vertical-scroll--off");
    });



    // Add active class on scroll
    $(window).scroll(function () {
        var scrollTop = $(window).scrollTop();

        $('.main-nav a').each(function () {
            var targetId = $(this).attr('href');
            var targetTop = $(targetId).offset().top - 20;
            var targetHeight = $(targetId).outerHeight();

            if (targetTop <= scrollTop && (targetTop + targetHeight) > scrollTop) {
                $('.main-nav li').removeClass('active');
                $(this).closest('li').addClass('active');
            }
        });
    });

    // Add active class on click
    $('.main-nav a').click(function (event) {
        event.preventDefault();
        $('.main-nav li').removeClass('active');
        $(this).find('li').addClass('active');

        // Scroll to the clicked section
        var targetId = $(this).attr('href');
        var targetOffset = $(targetId).offset().top;
        // var targetOffset = $(targetId).offset().top + 20;
        $('html, body').animate({ scrollTop: targetOffset }, 500);
    });


    


});