jQuery(document).on('click', '.save', function(event) { 
    var resultid = localStorage.getItem('resultid');
    var notes = jQuery('.notes').val();
    var questionnaireid = localStorage.getItem("questionnaireid");
    var notesname = "result" + resultid + "notes";
    localStorage.setItem(notesname, notes);
    document.location.href = "http://localhost/QuestionnaireApplication/QuestionnaireApplication/public/offline/questionnaires.html";
});