//if online
var resultid = localStorage.getItem('resultid');
if(resultid == null) {
    localStorage.setItem('resultid', 1);
} else {
    resultid = parseInt(resultid) + 1;
    localStorage.setItem('resultid', resultid);
}

var request = window.indexedDB.open("questionnaires");
var savetype = 'nosave';
request.onsuccess = function() {
    db = request.result;
    var tx = db.transaction("questionnaires", "readonly");
    var store = tx.objectStore("questionnaires");
    
    store.openCursor().onsuccess = function(event) {
        var cursor = event.target.result;
        if(cursor) {
            var id = cursor['value']['questionnaire']['questionnaire']['id'];
            if(id == localStorage.getItem('questionnaireid')){
                var name = cursor['value']['questionnaire']['questionnaire']['name'];
                var id = cursor['value']['questionnaire']['questionnaire']['id'];
                var image = cursor['value']['questionnaire']['questionnaire']['questionnaireimage'];
                image = getImageURL(image);
                var languages = cursor['value']['questionnaire']['languages'];
                var languagesHTML = getLanguagesSelect(languages);
                jQuery(".questionnaire-container").append(`
                        <p>${name}</p>
                        <img src="${image}" alt="questionnaireimage" />
                        ${languagesHTML}`);
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

function getLanguagesSelect(languages)
{
    var selectHTML = '<select id="language" name="language">'
    for(var i = 0; i < languages.length; i++) {
        selectHTML += `<option value="${languages[i]}">${languages[i]}</option>`;
    }
    selectHTML += '</select>';
    return selectHTML;
}

jQuery("select.savetype").change(function(){
    savetype = jQuery(this).children("option:selected").val();
    if(savetype == 'save') {
        jQuery('.questionnaire-user-types').append(`User Name: <input type="text" class="username" />`);
    }
});

jQuery(document).on('click', '.take-questionnaire', function(event) { 
    var language = jQuery('#language option:selected');
    language = language.html();
    localStorage.setItem("questionnairelanguage", language);
    localStorage.setItem("savetype", savetype);
    if(savetype == 'save') {
        var username = jQuery('.username').val();
        localStorage.setItem("username", username);
    }
    document.location.href = "http://localhost/QuestionnaireApplication/QuestionnaireApplication/public/offline/question.html";
});