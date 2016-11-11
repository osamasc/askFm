$(document).ready(function(){
    $('.like').on('click', function(){
       
        var id  = $('.options').data("id"),
             is_liked = $('.options').data('liked'),
             button = $('.like'),
             options = $('.options');
        
        if (is_liked == 0){
            
            button.text('Unlike');
            options.data('liked', 1);

            $.ajax({
                method: 'POST',
                url: urlLike,
                data: {answer_id: id, _token: token, isliked: 0} 
            });
        } if ( is_liked == 1) {
            button.text('like');
            options.data('liked', 0);

            $.ajax({
                method: 'POST',
                url: urlLike,
                data: {answer_id: id, _token: token, isliked: 1} 
            });

        }
        

    });

    $('textarea.txt').keyup(function(){
        
        var input = $('textarea.txt').val().length;
        var span  = $('span.counter');
        
        span.text(140 - input);
        

      if (span.text() < 0){
            span.css('color', 'red');
            $('input:submit').attr('disabled', 'disabled');
        } else {
            span.css('color', 'black');
            $('input:submit').removeAttr('disabled');
        }
    });

    $('.search').children('input:text').keyup(function(){
        var input = $(this).val();
        
      //  $('<div></div>', {
       //     class: 'output',
        //}).appendTo('.search');

        $.ajax({
            method: 'POST',
            url: urlSearch,
            data: { content: input, _token: _token},
            success: function(data){
                $('div.output').html(data);
            },
        });

    });
});