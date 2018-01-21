(function($){
    // $('.portfolio').isotope({
    //     // options
    //     itemSelector: '.portfolio-item',
    //     layoutMode: 'fitRows'
    // });

    // init Isotope with imagesLoaded
    var $grid = $('.portfolio').isotope({
        // options
        itemSelector: '.portfolio-item',
        // layoutMode: 'fitRows'
        percentPosition: true,
        masonry: {
            // use element for option
            columnWidth: '.portfolio-sizer'
        }
    });
    // layout Isotope after each image loads
    $grid.imagesLoaded().progress( function() {
      $grid.isotope('layout');
    });


    // filter items on button click
    $('#filters').on( 'click', 'li a', function() {
        var filterValue = $(this).attr('data-filter');
        $grid.isotope({ filter: filterValue });
    });

} ) ( jQuery );