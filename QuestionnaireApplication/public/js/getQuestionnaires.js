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
            jQuery(".card-deck").after(`<div class="card">
                    <div class="card-body">
                        <h5 class="card-title">${name}</h5>
                    </div>
                    <div class="card-footer">
                        <img src="${image}" alt="questionnaireimg" />
                        <small class="text-muted">Tags: ${tags}</small>
                        <small class="text-muted">Languages: ${languages}</small>
                        <div class="btn take-questionnaire" id="questionnairebtn${id}">Take</div>
                    </div>
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