$(document).ready(function(){
    

    // like system 

    $('.like').on('click', function(){
       
        var id  = $('.like').parent('.options').data("id"),
             is_liked = $(this).parent('.options').data('liked'),
             button = $(this),
             options = $(this).parent('.options');
        if (is_liked == 0){
            
            button.text('Unlike');
            button.css('color', '#FF5656')
            options.data('liked', 1);

            $.ajax({
                method: 'POST',
                url: urlLike,
                data: {question_id: id, _token: token, isliked: 0} // zero is not working
            });
        } if ( is_liked == 1) {
            button.text('like');
            button.css('color', '#4B4F56')
            options.data('liked', 0);

            $.ajax({
                method: 'POST',
                url: urlLike,
                data: {question_id: id, _token: token, isliked: 1} 
            });

        }
        console.log($('.options').data('liked')); 
        

    });

    // count text area and make it less thank 140 character

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

    // friends search system 

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

    // follow system
    // there is a bug here must be solved !!
    $('div.relation').children('button').on('click', function(){
        var id = $(this).data('id'),
            is_followed = $(this).data('followed'),
            button = $(this);
        $.ajax({
            url: relationUrl,
            method: "POST",
            data: {followed_id: id, is_followed: is_followed, _token: token}
        });

        if (is_followed == 1){
            button.data('followed', 0);  
            button.text('Unfollow');
        }

        else if (is_followed == 0){
            button.data('followed', 1);  
            button.text('Follow');
        }

    });


    // delete a question 

    $('.remove').on('click', function(){
        var question_id = $(this).parent('.controllers').data('id');
        $.ajax({
            url: urlDelete,
            method: "POST",
            data: {question_id: question_id, _token: token},
            success: function(){
                $(document).ajaxStop(function(){
                window.location.reload();
                });
            }
        });

    });

    // update user pic 

        $('.profile').find('i').on('click', function(){
        $('#profile-modal').modal();
      });

        $('.cover').find('i').on('click', function(){
        $('#cover-modal').modal();
    });

});