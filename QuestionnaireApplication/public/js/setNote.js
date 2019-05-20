
$(document).ready(function() {    
    jQuery('.questionnaires-back').click(function(event) {
        document.location.href = "http://localhost/QuestionnaireApplication/QuestionnaireApplication/public/questionnaires";
    });

    jQuery('#note').keyup(function(event) { 
        if(jQuery('#note').length != 0) {
            localStorage.setItem('note', jQuery('#note').val());
        }
    });
});
