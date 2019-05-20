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
                <h1>${name}</h1>
                <img src="${image}" alt="questionnaireimage" class="img-fluid img-full-width" />
                <div class="questionnaire-show-center col-md-12">
                    ${languagesHTML}
                    <div class="form-group savetypes save-types-container">
                        <label for="savetype" class="col-md-4 control-label">Save Option</label>

                        <div class="col-md-6">
                            <div class="questionnaire-user-types">
                                <select name="savetype" class=" form-control">
                                    <option name="nosave" value="nosave">Annoymous no data saved</option>
                                    <option name="annoymoussave" value="annoymoussave">Annoymous save data</option>
                                    <option name="save" value="save">Healthcare professional on behald of user patient</option>
                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="btn btn-secondary btn-lg questionnaire-btns take-q-btn take-questionnaire">Take Questionnaire</div> 
                </div>
                `);
                
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
    var selectHTML = '<div class="form-group"><label for="language" class="col-md-4 control-label">Languages</label><div class="col-md-6">';
    selectHTML += '<select id="language" name="language" class="language form-control">';
    for(var i = 0; i < languages.length; i++) {
        selectHTML += `<option value="${languages[i]}">${languages[i]}</option>`;
    }
    selectHTML += '</select></div></div>';
    return selectHTML;
}

jQuery(document).on('change', 'select', function(event) {
    console.log('heerrreee');
    savetype = jQuery(this).children("option:selected").val();
    if(savetype == 'save') {
        jQuery('.save-types-container').append(`<div class="form-group username-container" style="display: block;"><label for="username" class="col-md-4 control-label">User Name</label> <div class="col-md-6"><input type="text" class="username form-control"></div></div>`);
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