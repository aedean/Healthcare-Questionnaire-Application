var request = window.indexedDB.open("healthcarecontacts");

request.onsuccess = function() {
    db = request.result;
    var tx = db.transaction("healthcarecontacts", "readonly");
    var store = tx.objectStore("healthcarecontacts");

    let contactshtml = `<table class="table">
    <thead>
        <th scope="col"><h4>Name</h4></th>
        <th scope="col"><h4>Mobile</h4></th>
        <th scope="col"><h4>Landline</h4></th>
        <th scope="col"><h4>Company</h4></th>
        <th scope="col"><h4>Postcode</h4></th>
    </thead>
    <tbody>`;
    store.openCursor().onsuccess = function(event) {
        var cursor = event.target.result;
        if(cursor) {
            console.log(cursor['value']);
            var company = cursor['value']['contact'][0]['company'];
            var landline = cursor['value']['contact'][0]['landline'];
            var mobile = cursor['value']['contact'][0]['mobile'];
            var name = cursor['value']['contact'][0]['name'];
            var postcode = cursor['value']['contact'][1][0]['postcode'];
            contactshtml += `<tr>
                        <td><h4>${name}</h4></td>
                        <td><h4>${mobile}</h4></td>
                        <td><h4>${landline}</h4></td>
                        <td><h4>${company}</h4></td>
                        <td><h4>${postcode}</h4></td>
                        </tr>`;
            cursor.continue();
        }
        console.log(contactshtml);
    };
    setTimeout(function(){ 
  
        contactshtml += `</tbody></table>`;
        jQuery(".contacts-container").after(contactshtml);
    }, 1000);
};

jQuery(document).on('click', '.notes', function(event){ 
    document.location.href = "http://localhost/QuestionnaireApplication/QuestionnaireApplication/public/offline/notes.html";
});