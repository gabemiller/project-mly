$(document).ready(function () {


    /**
     *
     * @type Number|@call;$@call;height
     */
    var height = 0;

    $('.gallery').find('.gallery-item').each(function(){

        if($(this).height()>height)
            height = $(this).height();

    });


    $('.gallery').find('.gallery-item').each(function(){

        $(this).height((height+20)+'px');

    });

});