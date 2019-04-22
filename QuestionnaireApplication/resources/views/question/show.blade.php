@extends('layouts.app')

@section('content')
<div class="container">
    <h3>Question <?php echo $question->questionnumber ?></h3>
    
    <div class="row text-center">
        <div class="col-md-12 align-items-center">
            <h1><?php echo $question->question; ?></h1>
        </div>
                    
        <div class="col-md-12">
            <img src="<?php echo url('/') . Storage::url($question->questionimage); ?>" />
        </div>
    </div>

    {!! Form::open(['action' => 'QuestionnaireResultsController@store', 'method' => 'POST', 'class' => 'form-horizontal', 'enctype' => 'multipart/form-data']) !!}
    <div class="row center mx-auto">
        <?php if($question->answertype == 'input'): ?>
        <div class="container">
            <div class="col-md-6">
                <div class="form-group">
                    <label for="answer" class="col-md-4 control-label">Answer</label>

                    <div class="col-md-6">
                        <input id="answer" type="text" class="form-control" name="answer" required autofocus>
                    </div>
                </div>
            </div>
        </div>
        <?php elseif($question->answertype == 'select'): ?>
                <div class="container text-center">
                    <?php foreach($answers as $answer): ?>
                        <div class="col-xs-4 col-sm-3 col-md-2 nopad text-center">
                        <p><?php echo $answer->answer; ?></p>
                            <label class="image-checkbox">
                            <img class="img-responsive" src="<?php echo url('/') . Storage::url($answer->answerimage); ?>" />
                            <input type="checkbox" name="answer" value="<?php echo $answer->answer ?>" />
                            </label>
                        </div>
                    <?php endforeach; ?>
                </div>
        <?php endif; ?>
    </div>

    <div class="row pull-right">
        <?php if($nextislast == true): ?>
            <!-- Go to notes page -->
            <div class="form-group">
                <div class="col-md-8 col-md-offset-4">
                {!! Form::submit('Finish', ['class' => 'btn', 'name' => 'finish']) !!}
                </div>
            </div>
        <?php else: ?>
            <div class="form-group">
                <div class="col-md-8 col-md-offset-4">
                {!! Form::submit('Next', ['class' => 'btn', 'name' => 'next']) !!}
                </div>
            </div>
        {!! Form::close() !!}
        <?php endif; ?>
    </div>

</div>
<script type="text/javascript">
    $(document).ready(function() {
        var answered = false;
        $(".image-checkbox").each(function () {
            if ($(this).find('input[type="checkbox"]').first().attr("checked")) {
                $(this).addClass('image-checkbox-checked');
            } else {
                $(this).removeClass('image-checkbox-checked');
            }
        });

        $(".image-checkbox").on("click", function (e) {
            $('.image-checkbox').each(function() {
                if ($(this).hasClass('image-checkbox-checked')) {
                    $(this).toggleClass('image-checkbox-checked');
                    var $checkbox = $(this).find('input[type="checkbox"]');
                    $checkbox.prop("checked", false)
                    e.preventDefault();
                }
            });
            $(this).toggleClass('image-checkbox-checked');
            var $checkbox = $(this).find('input[type="checkbox"]');
            $checkbox.prop("checked",!$checkbox.prop("checked"))
            e.preventDefault();
        });
    });
</script>
@endsection