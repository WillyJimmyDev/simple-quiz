$(function(){
    $('#updater').fadeIn('slow').delay(2000).fadeOut('slow');
    var context = $('#contextual');
    var context2 = $('#contextual2');
    var addanswer = $('#addanswer');
    var addquestion = $('#addquestion');
    var addquiz = $('#addquiz');
    var questionaddform = $('#questionadd');
    var aform = $('form#answeredit');
    var saveprompt = "<div class=\"alert alert-warning\">Click 'Save' to make the changes permanent.</div>";
    
    $('table#newanswers').on('click', '.remove', function() {
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
        
        var questionid = $(this).attr("data-question-id");
        var quizid = $(this).attr("data-quiz-id");
        
        if (window.confirm("This can't be undone. OK?") ) {
            
            var parenttr = $(this).parents('tr.question');
           
            parenttr.find('td').html('<img src="/images/ajax-loader.gif" />');

            $.ajax({
                url: location.pathname,
                type: "POST",
                cache: false,
                data : {'_METHOD' : 'DELETE', quizid : quizid, questionid : questionid},
                dataType: "json",
                success: function(response) {
                    if (typeof response.success !== 'undefined') {
                
                        parenttr.fadeOut('slow').remove();
                        $.each( $('tr.question:visible'), function(index, value) {
                            $(this).find('.edit').attr("data-question-id",index);
                            $(this).find('.remove').attr("data-question-id",index);
                            var regex = /question\/\d+\/edit/;
                            index++;
                            var oldhref = $(this).find('.answerlink').attr("href");
                            var newhref = oldhref.replace(regex, "question/" + index + "/edit");
                            $(this).find('.answerlink').attr("href", newhref);
                            
                        });
                        // flash success message
                        $('#ajaxupdater').addClass("alert-success").html(response.success).show('slow').delay(2000).hide('slow');
                    } else {
                        $('#ajaxupdater').addClass("alert-danger").html(response.error).show('slow').delay(2000).hide('slow');
                    }
                }
            });          
        }
        

    });
    
    $('table#questions').on('click', 'button.edit', function() {
        var id = $(this).attr("data-question-id");
        var q = $(this).parents('tr').find('td.question').text();
        $('#questioninput').val(q);
        $('#questionid').val(id);
        $('#qmodal').modal();
        
    });
    
    $('table#quizzes').on('click', '.remove', function() {
        
        //console.log('http://' + location.hostname + '/admin/quiz/');
        //console.log(location.pathname + 'quiz/');
        //console.log(location.pathname);
        var quizid = $(this).attr("data-quiz-id");
        
        if (window.confirm("This can't be undone. OK?") ) {
            
            var parenttr = $(this).parents('tr.quiz');
           
            parenttr.find('td').html('<img src="/images/ajax-loader.gif" />');

            $.ajax({
                url: location.pathname + 'quiz/',
                type: "POST",
                cache: false,
                data : {'_METHOD' : 'DELETE', quizid : quizid},
                dataType: "json",
                success: function(response) {
                    if (typeof response.success !== 'undefined') {
                
                        parenttr.fadeOut('slow').remove();
                        // flash success message
                        $('#ajaxupdater').addClass("alert-success").html(response.success).show('slow').delay(2000).hide('slow');
                    } else {
                        $('#ajaxupdater').addClass("alert-danger").html(response.error).show('slow').delay(2000).hide('slow');
                    }
                }
            });          
        }
        

    });
    
    // the 'save changes' button inside the modal
    $('#questionedit').on('submit', function(e) {
        if ($('#questioninput').val() === '') {
          e.preventDefault();
          $('#questionedit .helper').fadeIn('slow').delay(2000).fadeOut('slow');
        }
    });
    
    //the button to add another answer for this question
    addanswer.on('click', function() {
        $.each( $('.answer-row:visible'), function(index, value) {
            $(this).find('.correct').val(index);
            
        });
        var numanswers = $('.answer-row:visible').length;
        var newansweritem = $('tr.template').clone().removeClass('template');
        newansweritem.find('.answerinput').attr('name', 'answer[]');
        newansweritem.find('.correct').val(numanswers);
        
        $('tbody').append(newansweritem);
        newansweritem.fadeIn(800);
        context.html(saveprompt);
        context.fadeIn();
    });
    
    //the button to add another question for this quiz
    addquestion.on('click', function() {
        $('#q-add-modal').modal();
    });
    
    //the button to add another question for this quiz
    addquiz.on('click', function() {
        $('#quiz-add-modal').modal();
    });
    
    // on answer form submission
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
    
    //add a new question modal
    questionaddform.on('submit', function(e) {
        // if question text is empty
        if ($('#newquestioninput').val() === '') {
          e.preventDefault();
          $('#questionadd .helper').fadeIn('slow').delay(2000).fadeOut('slow');
        }
        //if any of the answers is empty
        $.each( $('#newanswers .answer-row:visible'), function(index, value) {
            if ( $(this).find("input[type='text']").val() === '' ) {
                console.log("empty input");
                e.preventDefault();
            }
            
        });
    });
    
    
    $('#editquiz').on('click', function() {
        $('#quiz-edit-modal').modal();
    })
    
});