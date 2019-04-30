var CACHE_NAME = 'static-cache';

var urlsToCache = [
  'css/app.css',
  'css/customstyles.css',
  'js/getQuestionnaires.js',
  'js/app.js',
  'storage/application/logo/ClLGaX5mVgwnq6rkokHMAmuRweOILd3QfonaktSP.jpeg'
];

self.addEventListener('install', function(event) {
    console.log('installing');
    event.waitUntil(
        caches.open(CACHE_NAME)
        .then(function(cache) {
            console.log(urlsToCache);
            return cache.addAll(urlsToCache);
        })
    );
});

//var offlineUrl = 'offline/questionnaires/index.html';

// this.addEventListener('fetch', event => {
//     // request.mode = navigate isn't supported in all browsers
//     // so include a check for Accept: text/html header.
//     if (event.request.mode === 'navigate' || (event.request.method === 'GET' && event.request.headers.get('accept').includes('text/html'))) {
//           event.respondWith(
//             fetch(event.request.url).catch(error => {
//                 // Return the offline page
//                 return caches.match(offlineUrl);
//             })
//       );
//     }
//     else{
//           // Respond with everything else if we can
//           event.respondWith(caches.match(event.request)
//                           .then(function (response) {
//                           return response || fetch(event.request);
//                       })
//               );
//         }
// });