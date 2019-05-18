const url = ('http://localhost/QuestionnaireApplication/QuestionnaireApplication/public/api/questionnaire');
jQuery.getJSON(url, function(data) {
    var request = window.indexedDB.open("questionnaires");
    request.onupgradeneeded = function() {
        var db = event.target.result;
        var store = db.createObjectStore("questionnaires", {keyPath: "id"});
        for(var i = 0; i < data['data'].length; i++) {
            var questionnaireid = data['data'][i]['questionnaire']['id'];
            var myobject = {id: questionnaireid, questionnaire: data['data'][i]};  
            store.put(myobject);
        }
    };   
});

//current position
var currentlat = 0;
var currentlong = 0;
navigator.geolocation.getCurrentPosition(showPosition);
function showPosition(position) {
    currentlat = position.coords.latitude; 
    currentlong = position.coords.longitude; 
}

//closest healthcare workers based on current location
var healthcarecontactsarray = [];
const healthcarecontactsurl = ('http://localhost/QuestionnaireApplication/QuestionnaireApplication/public/api/healthcarecontacts');
let postcodeurl = ('https://api.postcodes.io/postcodes/');
jQuery.getJSON(healthcarecontactsurl, function(contactdata) {
    for(var i = 0; i < contactdata['data'].length; i++) {
        var contact = contactdata['data'];
        var count = 0;
        jQuery.getJSON(postcodeurl + contactdata['data'][i][1][0]['postcode'], function(postcodedata) {
            var lat1 = currentlat;
            var lon1 = currentlong;
            var lat2 = postcodedata['result']['latitude'];
            var lon2 = postcodedata['result']['longitude'];
            var R = 6371; // km (change this constant to get miles)
            var dLat = (lat2-lat1) * Math.PI / 180;
            var dLon = (lon2-lon1) * Math.PI / 180;
            var a = Math.sin(dLat/2) * Math.sin(dLat/2) +
                Math.cos(lat1 * Math.PI / 180 ) * Math.cos(lat2 * Math.PI / 180 ) *
                Math.sin(dLon/2) * Math.sin(dLon/2);
            var c = 2 * Math.atan2(Math.sqrt(a), Math.sqrt(1-a));
            var d = R * c;
            if (d>1) d = Math.round(d)+"km";
            else if (d<=1) d = Math.round(d*1000)+"m";
            if(d.replace(/[0-9]/g, '') == 'km' && parseInt(d) <= 40){
                healthcarecontactsarray.push(contact[count]);
            } else if(d.replace(/[0-9]/g, '') == 'm') {
                healthcarecontactsarray.push(contact[count]);
            }
            count++;
        });
    }
});

//save contacts
setTimeout(saveContacts, 3000);

function saveContacts() {
    var healthcarecontactrequest = window.indexedDB.open("healthcarecontacts");
    healthcarecontactrequest.onupgradeneeded = function() {
        var db = event.target.result;
        var store = db.createObjectStore("healthcarecontacts", {keyPath: "id"});
        for(var i = 0; i < healthcarecontactsarray.length; i++) {
            var myobject = {id: i, contact: healthcarecontactsarray[i]}; 
            store.put(myobject);
        }
    }; 
}

localStorage.setItem('app-name', jQuery('.app-name').text());
localStorage.setItem('app-logo', jQuery('.app-logo').attr('src'));