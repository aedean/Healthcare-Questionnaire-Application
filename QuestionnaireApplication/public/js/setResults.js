$(document).ready(function() {
    for (var key in localStorage){
        if(key.indexOf('result') == 0 && key != 'resultid') {
            var querystring = "";
            if(key.match(/^[a-zA-z]{6}[0-9]$/) != null) {
                var result = localStorage.getItem(key);
                result = JSON.parse(result);
                querystring += 'questionnaireid=' + result.questionnaireid;
                querystring += '&score=' + result.score;
                if(result.username != null) {
                    querystring += '&username=' + result.username;
                }
                var resultid = key.replace('result', '');
                var resultnotes = 'result' + resultid + 'notes';
                var note = localStorage.getItem(resultnotes);
                querystring += '&note=' + note;
                const keys = Object.keys(result)
                for (const key of keys) {
                    if(key.match(/[0-9]/) != null){
                        querystring += '&answer' + key + '=' + result[key];
                    }
                }
                console.log(querystring);
                localStorage.removeItem(key);
                localStorage.removeItem(resultnotes);
                querystring = 'http://localhost/QuestionnaireApplication/QuestionnaireApplication/public/api/questionnaireresults?' + querystring;
                jQuery.post(querystring, function(data) {  console.log(data); });
            }
        }
    }
});