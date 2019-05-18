<?php

namespace App\Helpers;

use App\Questionnaires;
use App\Questions;
use App\QuestionAnswers;
use Cookie;
use Storage;

class SetImagesCookie
{
    public function createServiceWorker()
    {
        $imagesstring = $this->getAllImages();
        $script= "
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
" . $imagesstring . "
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
";
        $fileName = "service-worker.js";
        file_put_contents($fileName, $script);
    }

    public function getAllImages()
    {
        $imagePaths = array();
        $questionnaires = Questionnaires::all();
        $questions = Questions::all();
        $answers = QuestionAnswers::all();

        foreach($questionnaires as $questionnaire){
            if (Storage::disk('public')->has($questionnaire->questionnaireimage)) {
                if($questionnaire->questionnaireimage) {
                    $imagePaths[] = '\'storage/' . $questionnaire->questionnaireimage . '\'';
                }
            }
        }

        foreach($questions as $question){
            if (Storage::disk('public')->has($question->questionimage)) {
                if($question->questionimage) {
                   // $imagePaths[] = '\'storage/' . $question->questionimage . '\'';
                }
            }
        }

        foreach($answers as $answer){
            if (Storage::disk('public')->has($answer->answerimage)) {
                if($answer->answerimage) {
                    $imagePaths[] = '\'storage/' . $answer->answerimage . '\'';
                }
            }
        }

        return implode(',', $imagePaths);
    }
}