var request = window.indexedDB.open("healthcarecontacts");

request.onsuccess = function() {
    db = request.result;
    var tx = db.transaction("healthcarecontacts", "readonly");
    var store = tx.objectStore("healthcarecontacts");

    store.openCursor().onsuccess = function(event) {
        var cursor = event.target.result;
        if(cursor) {
            var company = cursor['value']['contact'][0]['company'];
            var landline = cursor['value']['contact'][0]['landline'];
            var mobile = cursor['value']['contact'][0]['mobile'];
            var name = cursor['value']['contact'][0]['name'];
            var postcode = cursor['value']['contact'][1][0]['postcode'];
            jQuery(".contacts-container").after(`
                <p>Name: ${name}</p>
                <p>Company: ${company}</p>
                <p>Mobile: ${mobile}</p>
                <p>Landline: ${landline}</p>
                <p>Postcode: ${postcode}</p>`);
            cursor.continue();
        }
    };
};

jQuery(document).on('click', '.notes', function(event){ 
    document.location.href = "http://localhost/QuestionnaireApplication/QuestionnaireApplication/public/offline/notes.html";
});