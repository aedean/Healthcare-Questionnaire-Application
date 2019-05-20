//questionnaire page
var savetype = '';
if(localStorage.getItem('savetype') === null){   
    savetype = localStorage.setItem('savetype', 'nosave');
} else {
    savetype = localStorage.getItem('savetype')
}

var questionnaireid = window.location.href.replace('http://localhost/QuestionnaireApplication/QuestionnaireApplication/public/questionnaires/', '');
questionnaireid = parseInt(questionnaireid, 10);
if(localStorage.getItem('questionnaireid') === null || Number.isInteger(questionnaireid) && questionnaireid != localStorage.getItem('questionnaireid')){
    localStorage.setItem('questionnaireid', questionnaireid);
} else {
    questionnaireid = localStorage.getItem('questionnaireid');
}

jQuery(document).ready(function() {
    console.log('here');
    if(window.location.href === "http://localhost/QuestionnaireApplication/QuestionnaireApplication/public/healthcarecontacts/1") {
        if(savetype === "nosave") {
            jQuery('.healthcontacts-btn').text('Back to all questionnaires')
        }
    }

    var questionnumber = jQuery('.questionno').text();

    jQuery('.answer').change(function(event) {
        jQuery(event.target).closest('div').toggleClass('answer-selected');
        var answernumber = "question" + questionnumber + "questionnaireid" + questionnaireid; 
        localStorage.setItem(answernumber, event.target.value);
    });

    jQuery('.savetype').change(function(event) {
        if (event.target.value == 'patientsave') {
            jQuery('.username-container').toggle();
        } else {
            jQuery('.username-container').toggle();
        }
        localStorage.setItem('savetype', event.target.value);
    });

    jQuery('.finish').click(function(event) {
        document.location.href = "http://localhost/QuestionnaireApplication/QuestionnaireApplication/public/result";
    });

    jQuery('.results-next-btn').click(function(event) {
        document.location.href = "http://localhost/QuestionnaireApplication/QuestionnaireApplication/public/healthcarecontacts/1";
    });

    jQuery('.healthcontacts-btn').click(function(event) {
        if(savetype === "nosave") {
            localStorage.removeItem("questionnaireid");
            localStorage.removeItem("savetype");
            document.location.href = "http://localhost/QuestionnaireApplication/QuestionnaireApplication/public/questionnaires";
        } else {
            //save results
            document.location.href = "http://localhost/QuestionnaireApplication/QuestionnaireApplication/public/questionnairenotes/create";
        }
    });

    jQuery('.answerinput').keyup(function(event) { 
        if(jQuery('.answerinput').length != 0) {
            var answernumber = "question" + questionnumber + "questionnaireid" + questionnaireid; 
            localStorage.setItem(answernumber, jQuery('.answerinput').val());
        }
    });

});

if(window.location.href === "http://localhost/QuestionnaireApplication/QuestionnaireApplication/public/result") {
    const url = ('http://localhost/QuestionnaireApplication/QuestionnaireApplication/public/api/questionnaire');
    jQuery.getJSON(url, function(data) {
        for(var i = 0; i < data['data'].length; i++) {
            var responsequestionnaireid = data['data'][i]['questionnaire']['id'];
            if(responsequestionnaireid == questionnaireid) {
                let questions = data['data'][i]['question'];
                let answers = data['data'][i]['answer'];
                let score = getSavedResultsScore(questions, answers);
                let boundary = getBoundary(score, data['data'][i]['boundaries']);

                jQuery(".results-container").append(`
                <h4>${score}</h4>
                <h5>${boundary['notes']}</h5>`);
                if(savetype == 'nosave') {
                    annoymousSaveDeletes(questions, answers);
                } else {
                    reformatSaveResult(questions, answers, score);
                }
            }
        }  
    });
}

function annoymousSaveDeletes(questions, answers)
{
    localStorage.removeItem('questionnumber');
    for(var i = 0; i < questions.length; i++) {
        var answername = "question" + questions[i]['questionnumber'] + "questionnaireid" + questionnaireid;
        localStorage.removeItem(answername);
    }
}

function reformatSaveResult(questions, answers, score)
{
    questionnaireid = parseInt(questionnaireid);
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
        var answername = "question" + questions[i]['questionnumber'] + "questionnaireid" + questionnaireid;
        var answer = localStorage.getItem(answername);
        result[questions[i]['questionnumber']] = answer;
        localStorage.removeItem(answername);
    }
    localStorage.setItem('result', JSON.stringify(result));
    localStorage.removeItem('savetype');
}

function getSavedResultsScore(questions, answers)
{
    var score = 0;
    for(var i = 0; i < questions.length; i++) {
        var answername = "question" + questions[i]['questionnumber'] + "questionnaireid" + questionnaireid;
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
