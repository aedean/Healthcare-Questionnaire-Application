@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-body align-items-center">
                    <div class="form-group">
                        <div class="">
                            <h3>Question <?php echo $question->questionnumber ?></h3>
                        </div>
                    </div>

                    <div class="col-md-12 align-items-center">
                        <h1><?php echo $question->question; ?></h1>
                    </div>

                    <div class="form-group">
                        <div class="col-md-12">
                            <img src="<?php echo url('/') . Storage::url($question->questionimage); ?>" />
                        </div>
                    </div>
                    
                    <div class="form-group">
                        <div class="col-md-6">
                            <?php if($question->answertype == 'input'): ?>
                            <div class="form-group">
                                <label for="answer" class="col-md-4 control-label">Answer</label>

                                <div class="col-md-6">
                                    <input id="answer" type="text" class="form-control" name="answer" required autofocus>
                                </div>
                            </div>
                            <?php elseif($question->answertype == 'select'):
                                foreach($answers as $answer) {
                                    //create select input
                                    echo $answer->answer;
                                }
                            endif;
                            ?>
                        </div>
                    </div>
                    <a class="btn btn-default" href="<?php echo url('/') . '/healthcareworkers/1000'; ?>">Next</a>
                    <?php if($nextislast == true): ?>
                            <a class="btn btn-default" href="<?php echo url('/'); ?>">Finish</a>
                    <?php endif; ?>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection