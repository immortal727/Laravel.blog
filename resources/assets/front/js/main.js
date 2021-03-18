$(function() {
    $(window).scroll(function(){
        if ($(this).scrollTop()>=100) {
            // длительность анимации - 'slow'
            // тип анимации -  'linear'
            $('#go-top').fadeIn('slow','linear');
        }
        else {
            // длительность анимации - 'fast'
            // тип анимации -  'swing'
            $('#go-top').fadeOut('fast','swing');
        }
    });
    $('#go-top').click(function(){
        $('html, body').animate({ scrollTop: 0 }, 600);
        return false;
    })
})

