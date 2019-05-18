//if online
var questionnaireid = localStorage.getItem('questionnaireid');
var resultid = localStorage.getItem('resultid');
var savetype = localStorage.getItem('savetype');
var request = window.indexedDB.open("questionnaires");

request.onsuccess = function() {
    db = request.result;
    var tx = db.transaction("questionnaires", "readonly");
    var store = tx.objectStore("questionnaires");
    
    store.openCursor().onsuccess = function(event) {
        var cursor = event.target.result;
        if(cursor) {
            var id = cursor['value']['questionnaire']['questionnaire']['id'];
            if(id == questionnaireid){
                var boundaries = cursor['value']['questionnaire']['boundaries'];
                var questions = cursor['value']['questionnaire']['question'];
                var answers = cursor['value']['questionnaire']['answer'];
                var score = getSavedResultsScore(questions, answers);
                var boundary = getBoundary(score, boundaries);
                if(savetype == 'annoymoussave' || savetype == 'save') {
                    reformatSaveResult(questions, answers, score);
                } else {
                    annoymousSaveDeletes(questions, answers);
                }
                jQuery(".results-container").append(`
                    <p>${score}</p>
                    <p>${boundary['notes']}</p>`);
            }
            cursor.continue();
        }
    };
};

function annoymousSaveDeletes(questions, answers)
{
    localStorage.removeItem('questionnumber');
    for(var i = 0; i < questions.length; i++) {
        var answername = "result" + resultid + "question" + questions[i]['questionnumber'] + "questionnaireid" + questionnaireid;
        localStorage.removeItem(answername);
    }
}

function reformatSaveResult(questions, answers, score)
{
    localStorage.removeItem('questionnumber');
    var username = localStorage.getItem('username');
    localStorage.removeItem('username');
    if(username){
        var result = {
            questionnaireid: questionnaireid,
            score: score,
            username: username
        };
    } else {
        var result = {
            questionnaireid: questionnaireid,
            score: score
        };
    }
    for(var i = 0; i < questions.length; i++) {
        var answername = "result" + resultid + "question" + questions[i]['questionnumber'] + "questionnaireid" + questionnaireid;
        var answer = localStorage.getItem(answername);
        result[questions[i]['questionnumber']] = answer;
        localStorage.removeItem(answername);
    }
    localStorage.setItem('result' + resultid, JSON.stringify(result));
    localStorage.removeItem('savetype');
}

function getSavedResultsScore(questions, answers)
{
    var score = 0;
    for(var i = 0; i < questions.length; i++) {
        var answername = "result" + resultid + "question" + questions[i]['questionnumber'] + "questionnaireid" + questionnaireid;
        var answer = localStorage.getItem(answername);
        for(var q = 0; q < answers.length; q++) {
            if(answers[q]['questionid'] === questions[i]['questionid']) {
                if(answers[q]['answer'] === answer) {
                    score = score + answers[q]['score'];
                }
            }
        }
    }
    return score;
}

function getBoundary(score, boundaries)
{
    for(var i = 0; i < boundaries.length; i++) {
        if(score >= boundaries[i]['lowerboundary'] && score <= boundaries[i]['higherboundary']){
            return boundaries[i];
        }
    }
}

jQuery(document).on('click', '.contacts', function(event) { 
    document.location.href = "http://localhost/QuestionnaireApplication/QuestionnaireApplication/public/offline/healthcarecontacts.html";
});
