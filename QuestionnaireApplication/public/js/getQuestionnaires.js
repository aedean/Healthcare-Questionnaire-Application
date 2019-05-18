//if online
var request = window.indexedDB.open("questionnaires");

request.onsuccess = function() {
    db = request.result;
    var tx = db.transaction("questionnaires", "readonly");
    var store = tx.objectStore("questionnaires");
    store.openCursor().onsuccess = function(event) {
        var cursor = event.target.result;
        if(cursor) {
            var name = cursor['value']['questionnaire']['questionnaire']['name'];
            var id = cursor['value']['questionnaire']['questionnaire']['id'];
            var image = cursor['value']['questionnaire']['questionnaire']['questionnaireimage'];
            var languages = cursor['value']['questionnaire']['languages'].toString();
            var tags = cursor['value']['questionnaire']['tags'].toString();
            image = getImageURL(image);
            jQuery(".questionnaires-container").after(`<div class="card">
                    <img src="${image}" alt="questionnaireimg" />
                    <div class="card-body">
                        <h3 class="card-title">${name}</h3>
                    </div>
                    <div class="card-footer">
                        <h4>Languages</h4>
                        <h3>${languages}</h3>
                    </div>
                    <div class="card-footer">
                        <h4>Tags</h4>
                        <h3>${tags}</h3>
                    </div>
                    <div class="btn btn-secondary btn-lg questionnaire-btns take-questionnaire" id="questionnairebtn${id}">Take</div>
                </div>`);
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

jQuery(document).on('click', '.take-questionnaire', function(event){ 
    var questionnaireid = event.target.id.replace ( /[^\d.]/g, '' );
    localStorage.setItem("questionnaireid", questionnaireid);
    document.location.href = "http://localhost/QuestionnaireApplication/QuestionnaireApplication/public/offline/questionnaire.html";
});