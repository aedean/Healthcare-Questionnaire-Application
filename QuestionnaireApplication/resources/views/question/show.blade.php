@extends('layouts.app')

@section('content')
<div class="container bd-example">
    <div class="row">
        <div class="col-md-2 mx-auto">
            <h3 class="number-right">No <span class="questionno"><?php echo $question->questionnumber; ?></span></h3>
        </div>
        <div class="col-md-10 mx-auto">
            <h3 class="question"><?php echo $question->question; ?></h3>
        </div>
    </div>
    <div class="row row-padding">
        <div class="col-sm-8 mx-auto">
            <img src="<?php echo url('/') . Storage::url($question->questionimage); ?>" alt="questionimage" class="img-fluid question-image" />
        </div> 
    </div>

    <?php if($question->answertype == 'select'): ?>
        <div class="row row-padding">
            <div class="col-md-12 mx-auto">
                <?php foreach($answers as $answer): ?>
                    <div class="col-xs-3 nopad text-center">
                        <h4><?php echo $answer->answer ?></h4>
                        <label class="image-checkbox">
                        <img class="img-responsive" src="<?php echo url('/') . Storage::url($answer->answerimage); ?>" />
                        <input type="checkbox" name="answer" class="answer answercheckbox" value="<?php echo $answer->answer ?>" />
                        </label>
                    </div>
                <?php endforeach; ?>
            </div>
        </div>
    <?php else: ?>
        <div class="question-show-center col-md-12">
            <div class="form-group question-input">
            <label class="col-sm-2 col-form-label">Answer</label>
                <div class="col-md-6">
                    <input name="answer" type="text" class="answerinput form-control">
                </div>
            </div>
        </div>
    <?php endif ?>

    <div class="row col-md-12 <?php if($question->answertype == 'select'){echo "row-padding";}?>">
        <div class="mx-auto">
            <?php if($last): ?>
                <input name="finish" type="finish" value="Finish" class="custom-btn btn finish btn-secondary btn-lg">
            <?php else: ?>
                <a href="<?php echo $nexturl ?>" class="custom-btn btn-secondary btn-lg">Next</a>
            <?php endif ?>
        </div>
    </div>
</div>
<script src="{{ asset('js/getResults.js') }}"></script>
<script src="{{ asset('js/getLanguage.js') }}"></script>
@endsection
