<?php

namespace App\Helpers;

use App\Questionnaires;
use App\Questions;
use App\QuestionAnswers;
use Cookie;

class SetImagesCookie
{
    public function createServiceWorker()
    {
        $imagesstring = $this->getAllImages();
        $script= "
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
            " . $imagesstring . "
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
            $imagePaths[] = '\'storage/' . $questionnaire->questionnaireimage . '\'';
        }

        foreach($questions as $question){
            $imagePaths[] = '\'storage/' . $question->questionimage . '\'';
        }

        foreach($answers as $answer){
            $imagePaths[] = '\'storage/' . $answer->answerimage . '\'';
        }

        return implode(',', $imagePaths);
    }
}