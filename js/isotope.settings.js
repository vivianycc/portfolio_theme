jQuery(document).ready(function($){

    var $container = $('.works-index').imagesLoaded( function() {
        // init
        $container.isotope({
          // options
          itemSelector: '.works-item',
          layoutMode: 'fitRows'
        });
    });

        
    // Clear all checkboxes
    $('.filter-clear a').click(function () {
        $('.filter-boxes input:checked').removeAttr('checked');
        var clear = '*';
        $container.isotope({ filter: clear });
        $('.tag-stack li:has(input:checkbox:not(:checked))').removeClass('active');
        return false;
    });
    
    $checkboxes = $('.filter-boxes input');//id of div that contains all check boxes
    
    $checkboxes.change(function () {
        var filters = [];
        // get checked checkboxes values
        $checkboxes.filter(':checked').each(function () {
            filters.push(this.value);
        });

        filters = filters.join('');
        $container.isotope({ filter: filters });
    });   
    
    // Highlight currently checked boxes    
    $('.tax-stack input:checkbox').click(function () {
        $('.tax-stack li:has(input:checkbox:checked)').addClass('active');
    $('.tax-stack li:has(input:checkbox:not(:checked))').removeClass('active');
    });

    var $container = $('#main').isotope({
      // main isotope options
      itemSelector: 'article',
      layoutMode: 'fitColumns',
      // options for cellsByRow layout mode
      fitColumns: {
        columnWidth: 200,
        rowHeight: 150
      },
      // options for masonry layout mode
      
})


});
