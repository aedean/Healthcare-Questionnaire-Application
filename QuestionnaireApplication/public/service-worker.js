
var CACHE_NAME = 'questionnaire-cache';

var urlsToCache = [
'css/app.css',
'css/customstyles.scss',
'css/bootstrap.css',
'js/getQuestion.js',
'js/offline/getResults.js',
'js/notes.js',
'js/offline/getHealthcareContacts.js',
'js/getQuestionnaires.js',
'js/getQuestionnaire.js',
'js/app.js',
'offline/questionnaires.html',
'offline/questionnaire.html',
'offline/question.html',
'offline/notes.html',
'offline/healthcarecontacts.html',
'offline/results.html',
'storage/questionnaires/1/yunZQ3aABHG9klwzZMHHG5U6EUwO2Uo4g1sLYGaG.jpeg','storage/questionnaires/2/SrwRt07NVNbyhrmVODCO5yfFiVDNQuZjD4IfaqfL.jpeg','storage/questionnaires/4/RpiafKL3sMr3rJQZtnSE8e58WrnDI3wEYbuEA3tv.jpeg','storage/questionnaires/5/ZVaTLJKPRwpexez01cIPu0WTKV0cAYvOsQm4Nw5M.png','storage/questionnaires/6/mgBT1cW5y4KBNQeRqA3FjA0GaRSGRlFLkgPFpFyx.jpeg','storage/questionnaires/7/yf526lQUOzxpSAj04pLWRgWuBUdRJJZtolAefcwV.jpeg','storage/answers/4/10/12/EcYefR4TTu8IZErHFLbyIbQDPlVyz5dj2I6XjqJq.jpeg','storage/answers/4/10/11/9bH9jvmmKXPju0mD302c8uFtTNAVdPV5JC6SbQix.jpeg','storage/answers/4/10/10/jSCrLpHIFVs3FnphS6FQvTRSifzk77IpcLPNumUk.jpeg','storage/answers/4/9/8/zdlFnpFXZ4gR6sXVKZdfhhPEMt69XI415oNOzAtx.jpeg','storage/answers/4/9/7/AyVI4tOSlfIu8nVokeKcDWbPqDsDdjsHQWHNJzZb.jpeg'
];

self.addEventListener('install', event => {
    event.waitUntil(
        caches.open(CACHE_NAME)
        .then(cache => {
            console.log(urlsToCache);
            return cache.addAll(urlsToCache);
        })
    );
});

var offlineUrl = 'offline/questionnaires.html';

self.addEventListener('fetch', event => {
    event.respondWith(
        caches.match(event.request).then(response => {
            return response || fetch(event.request);
        }).catch(() => {
            return caches.match('/offline/questionnaires.html');
        })
    );
});
