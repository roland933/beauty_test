$(function () {
    $('[data-toggle="tooltip"]').tooltip()
})

$(function(){
    // active class
    var current = location.pathname.split('/')[2];

    $('.navbar-nav .nav-link').each(function(){
        var $this = $(this);
        if($this.attr('href').indexOf(current) !== -1){
            $this.addClass('active');
        }
    })
})