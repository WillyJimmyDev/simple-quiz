$(function(){
    
    var editquestion = $('#editor');
    var savetext = $('#savetext');
    var context = $('#contextual');
    var context2 = $('#contextual2');
    var add = $('#addanswer');
    
    $('table').on('click', '.remove', function() {
           var parenttr = $(this).parents('tr');
           if (parenttr.find('input.correct').is(':checked')) {
               //console.log("checked");
               context2.html('<div class="alert alert-dismissable alert-danger"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>You can\'t delete an answer if it is marked as correct.</div>');
               context2.show().delay( 2000 ).fadeOut( 400 );
           } else {
                parenttr.fadeOut(800);
                context.html("<div class=\"alert alert-warning\">Click 'Save' to make the changes permanent.</div>");
                context.fadeIn();
           }
        
    });
    
    editquestion.on('click', function(e) {
        e.preventDefault();
        var content = $('#questiontext').text();
        $('#questioninput').val(content);
        //show modal
        $('#qmodal').modal();
    });
    
    savetext.on('click', function(e) {
        var content = $('#questioninput').val();
        $('#questiontext').html(content);
        //show modal
        $('#qmodal').modal("hide");
        context.html("<div class=\"alert alert-warning\">Click 'Save' to make the changes permanent.</div>");
        context.fadeIn();
    });
    
    add.on('click', function() {
        var numanswers = $('.answer-row:visible').length + 1;
        var newansweritem = $('tr.template').clone().removeClass('template');
        newansweritem.find('.answerinput').attr('name', 'answer' + numanswers);
        console.log(numanswers);
        $('tbody').append(newansweritem);
        newansweritem.fadeIn(800);
        context.html("<div class=\"alert alert-warning\">Click 'Save' to make the changes permanent.</div>");
        context.fadeIn();
    });
    
});