//get instance
var questionnaireid = localStorage.getItem("questionnaireid");
var resultid = localStorage.getItem('resultid');
var request = window.indexedDB.open("questionnaires");

request.onsuccess = function() {
    db = request.result;
    var tx = db.transaction("questionnaires", "readonly");
    var store = tx.objectStore("questionnaires");
    
    store.openCursor().onsuccess = function(event) {
        var cursor = event.target.result;
        if(cursor) {
            var id = cursor['value']['questionnaire']['questionnaire']['id'];
            if(id == localStorage.getItem('questionnaireid')){
                var questionnumber = localStorage.getItem("questionnumber");
                if(questionnumber == null) {
                    localStorage.setItem("questionnumber", 1);
                    var questions = cursor['value']['questionnaire']['question'];
                    questionnumber = 1;
                    for(var i = 0; i < questions.length; i++) {
                        questions[i]['questionnumber']
                        if(questions[i]['questionnumber'] == questionnumber) {    
                            var question = questions[i]['question'];
                            var image = questions[i]['questionimage'];
                            image = getImageURL(image);
                            var answers = cursor['value']['questionnaire']['answer'];
                            var answersHTML = getAnswersHTML(answers, questions[i]['questionid']);
                            var btn = '<div class="btn next">Next</div>';
                            for(var i = 0; i < questions.length; i++) {
                                console.log(questions[i]['questionnumber']);
                                if(questions[i]['questionnumber'] == questions.length && questions[i]['questionnumber'] == questionnumber) {
                                    btn = '<div class="btn finish">Finish</div>';
                                }
                            }
                            jQuery(".question-container").append(`
                                    <p>${question}</p>
                                    <img src=${image} alt="questionimage"/>
                                    ${answersHTML}
                                    ${btn}`);
                        }
                    }
                } else {
                    var questions = cursor['value']['questionnaire']['question'];
                    for(var i = 0; i < questions.length; i++) {
                        questions[i]['questionnumber']
                        if(questions[i]['questionnumber'] == questionnumber) {
                            var question = questions[i]['question'];
                            var image = questions[i]['questionimage'];
                            image = getImageURL(image);
                            var answers = cursor['value']['questionnaire']['answer'];
                            var answersHTML = getAnswersHTML(answers, questions[i]['questionid']);
                            //btn
                                var btn = '<div class="btn next">Next</div>';
                                for(var i = 0; i < questions.length; i++) {
                                    console.log(questions[i]['questionnumber']);
                                    if(questions[i]['questionnumber'] == questions.length && questions[i]['questionnumber'] == questionnumber) {
                                        btn = '<div class="btn finish">Finish</div>';
                                    }
                                }
                            jQuery(".question-container").append(`
                                    <p>${question}</p>
                                    <img src=${image} alt="questionimage"/>
                                    ${answersHTML}
                                    ${btn}`);
                        }
                    }
                }
            }
            cursor.continue();
        }
    };
};

function getImageURL(image)
{
    var url = window.location.href;
    var length = url.length;
    var offlineindex = url.indexOf('/offline');
    url = url.replace(url.substr(offlineindex, length), '') + '/storage/' + image;
    return url;
}

function getAnswersHTML(answers, questionid)
{
    var answersHTML = '<div class="container text-center">';
    for(var i = 0; i < answers.length; i++) {
        if(answers[i]['questionid'] == questionid) {
            var answer = answers[i]['answer'];
            var answerimage = answers[i]['answerimage'];
            answerimage = getImageURL(answerimage);
            answersHTML += `<div class="col-xs-4 col-sm-3 col-md-2 nopad text-center">
                                <p>${answer}</p>
                                <label class="image-checkbox">
                                <img class="img-responsive" src="${answerimage}" />
                                <input type="checkbox" name="answer" class="answer" value="${answer}" />
                                </label>
                            </div>`;
        }
    }
    if(answersHTML == '<div class="container text-center">') {
        answersHTML += 'Answer: <input name="answer" type="text" class="answerinput">';
    }
    answersHTML += '</div>';
    return answersHTML;
}

jQuery(document).on('click', '.next', function(event) { 
    var questionnumber = localStorage.getItem("questionnumber");
    var questionnaireid = localStorage.getItem("questionnaireid");
    if(jQuery('.answerinput').length != 0) {
        var answernumber = "result" + resultid + "question" + questionnumber + "questionnaireid" + questionnaireid; 
        localStorage.setItem(answernumber, jQuery('.answerinput').val());
    } else {
        var answers = jQuery('.answer');
        for(var i = 0; i < answers.length; i++) {
            if(jQuery(answers[i]).prop("checked")) {
                var answernumber = "result" + resultid + "question" + questionnumber + "questionnaireid" + questionnaireid;  
                localStorage.setItem(answernumber, jQuery(answers[i]).val());
            }
        }
    }
    questionnumber = parseInt(questionnumber) + 1;
    localStorage.setItem("questionnumber", questionnumber);
    document.location.href = "http://localhost/QuestionnaireApplication/QuestionnaireApplication/public/offline/question.html";
});

jQuery(document).on('click', '.finish', function(event) { 
    var questionnumber = localStorage.getItem("questionnumber");
    var questionnaireid = localStorage.getItem("questionnaireid");
    if(jQuery('.answerinput').length != 0) {
        var answernumber = "result" + resultid + "question" + questionnumber + "questionnaireid" + questionnaireid; 
        localStorage.setItem(answernumber, jQuery('.answerinput').val());
    } else {
        var answers = jQuery('.answer');
        for(var i = 0; i < answers.length; i++) {
            if(jQuery(answers[i]).prop("checked")) {
                var answernumber = "result" + resultid + "question" + questionnumber + "questionnaireid" + questionnaireid; 
                localStorage.setItem(answernumber, jQuery(answers[i]).val());
            }
        }
    }
    document.location.href = "http://localhost/QuestionnaireApplication/QuestionnaireApplication/public/offline/results.html";
});