//if online
const url = ('http://localhost/QuestionnaireApplication/QuestionnaireApplication/public/api/questionnaires');

jQuery.getJSON(url, function(data) {
    console.log(data);
});
//if offline