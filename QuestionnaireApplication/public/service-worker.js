
            var CACHE_NAME = 'static-cache';

            var urlsToCache = [
            'css/app.css',
            'css/customstyles.css',
            'js/getQuestion.js',
            'js/getResults.js',
            'js/notes.js',
            'js/offline/getHealthcareContacts.js',
            'js/getQuestionnaires.js',
            'js/getQuestionnaire.js',
            'js/app.js',
            'storage/application/logo/ClLGaX5mVgwnq6rkokHMAmuRweOILd3QfonaktSP.jpeg',
            'offline/questionnaires.html',
            'offline/questionnaire.html',
            'offline/question.html',
            'offline/notes.html',
            'offline/healthcarecontacts.html',
            'offline/results.html',
            'storage/questionnaires/1/yunZQ3aABHG9klwzZMHHG5U6EUwO2Uo4g1sLYGaG.jpeg','storage/questionnaires/2/SrwRt07NVNbyhrmVODCO5yfFiVDNQuZjD4IfaqfL.jpeg','storage/questionnaires/3/fYEICZABkPYEUmWIUbjByAXM40yEvFZ2c4DdBzfN.jpeg','storage/questions/1/1/F8J6LCEWRrBvzKwiNcphXUhbMBdSBvpiH4lEPa2p.jpeg','storage/questions/1/2/fqqf3Vhp41m3zmXFTzIaeUL02Tya1Km5Vv9PkL5l.jpeg','storage/questions/2/3/J05mndFX2ZCTc0LFGConswBpp4CuFpVO1OL40Mj5.jpeg','storage/questions/3/4/ayVZTT6yWcaMoWwa2o1KjrQIWtKKKgJund29AezB.jpeg','storage/questions/3/5/0yhi7KWcznwyktXWeOCONba4w4dCD5ONszZjVnbU.jpeg','storage/questions/3/7/qEqVVs7TN6bZ02BrIW4TVlZNOrYK8psnHM1fmwcP.jpeg','storage/answers/3/5/1/DN6jJPBeC8tczpOMLSEFFoa9gljJlxsEzxkhQtS2.jpeg','storage/answers/3/5/2/Ogos5r2wyQ74W1vRThXJ0gxJ8s3uQcOwmuuzKBTx.jpeg','storage/answers/3/5/3/gGjs2UltHewMz5cfncagnCFmKa47hqGXOoaSsjJs.jpeg','storage/answers/3/7/4/WkAYS0IMnsVaKGMGxiVFBgn089nSJ5Fmgv6rPz63.jpeg','storage/answers/3/7/5/UT1JJnEKn9N1Haxw51nfG4AJGtJXo65GsxgqJDbu.jpeg','storage/answers/3/5/6/kgC5NStgI0i2qzX2Xz2YQ5e7aAWwE9XdNk6HmTsC.jpeg'
            ];

            self.addEventListener('install', function(event) {
                event.waitUntil(
                    caches.open(CACHE_NAME)
                    .then(function(cache) {
                        //console.log(urlsToCache);
                        return cache.addAll(urlsToCache);
                    })
                );
            });

            var offlineUrl = 'offline/questionnaires.html';

            self.addEventListener('fetch', function(event) {
            
                event.respondWith(
                caches.match(event.request).then(function(response) {
                    return response || fetch(event.request);
                })
                );
            });
        