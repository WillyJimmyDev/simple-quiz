$(function(){
    $('#updater').fadeIn('slow').delay(2000).fadeOut('slow');
//    var editquestion = $('#editor');
//    var savetext = $('#savetext');
    var context = $('#contextual');
    var context2 = $('#contextual2');
    var add = $('#addanswer');
    var aform = $('form#answeredit');
    var saveprompt = "<div class=\"alert alert-warning\">Click 'Save' to make the changes permanent.</div>";
    
    $('table#answers').on('click', '.remove', function() {
           var parenttr = $(this).parents('tr');
           if (parenttr.find('input.correct').is(':checked')) {
               context2.html('<div class="alert alert-dismissable alert-danger"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>You can\'t delete an answer if it is marked as correct.</div>');
               context2.show().delay( 2000 ).fadeOut( 400 );
           } else {
                parenttr.fadeOut(800).remove();
                $.each( $('.answer-row:visible'), function(index, value) {
                    $(this).find('.correct').val(index);
                    console.log(index + 1);
                });
                context.html(saveprompt);
                context.fadeIn();
           }
        
    });
    
    $('table#questions').on('click', '.remove', function() {
        var parenttr = $(this).parents('tr');
           
        parenttr.fadeOut(800).remove();
        $.each( $('.answer-row:visible'), function(index, value) {
            $(this).find('.correct').val(index);
            console.log(index + 1);
        });
        context.html(saveprompt);
        context.fadeIn();
    });
    
    $('table').on('click', 'button.edit', function() {
        var id = $(this).attr("data-question-id");
        var q = $(this).parents('tr').find('td.question').text();
        $('#questioninput').val(q);
        $('#questionid').val(id);
        $('#qmodal').modal();
        
    });
    
    //the pencil icon for editing the question text - 
//    $.each(editbuttons, function (index, value) {
//        $(this).on('click', function() {
//            
//            var content = $('#questiontext').text();
//            $('#questioninput').val(content);
//            //show modal
//            $('#qmodal').modal();
//        });
//    });
//
    
    // the 'save changes' button inside the modal
    $('#questionedit').on('submit', function(e) {
        if ($('#questioninput').val() === '') {
          e.preventDefault();
          $('#helper').fadeIn('slow').delay(2000).fadeOut('slow');
        }
    });
    
    //the button to add another answer for this question
    add.on('click', function() {
        $.each( $('.answer-row:visible'), function(index, value) {
            $(this).find('.correct').val(index);
            console.log(index + 1);
        });
        var numanswers = $('.answer-row:visible').length;
        var newansweritem = $('tr.template').clone().removeClass('template');
        newansweritem.find('.answerinput').attr('name', 'answer[]');
        newansweritem.find('.correct').val(numanswers);
        console.log("number of answers before adding this one " + numanswers);
        $('tbody').append(newansweritem);
        newansweritem.fadeIn(800);
        context.html(saveprompt);
        context.fadeIn();
    });
    
    // on form submission
    aform.on('submit', function(e) {
        
        $.each( $('.answer-row:visible'), function(index, value) {
            if ( $(this).find("input[type='text']").val() === '' ) {
                console.log("empty input");
                e.preventDefault();
                context2.html('<div class="alert alert-dismissable alert-danger"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>Answers can\'t be empty.</div>');
                context2.show().delay( 2000 ).fadeOut( 400 );
            }
            
        });
    });
    
});