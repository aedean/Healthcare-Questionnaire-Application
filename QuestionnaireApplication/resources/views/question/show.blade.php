@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-body">
                    <div class="form-group">
                        <div class="col-md-6">
                            <?php echo $question->questionnumber ?>
                        </div>
                    </div>

                    <div class="">
                        <h1><?php echo $question->question; ?></h1>
                    </div>

                    <div class="form-group">
                        <div class="col-md-6">
                            <img src="<?php echo url('/') . Storage::url($question->questionimage); ?>" />
                        </div>
                    </div>

                    <div class="form-group">
                        <div class="col-md-6">
                            <?php echo $question->question ?>
                        </div>
                    </div>
                    
                    <div class="form-group">
                        <div class="col-md-6">
                            <?php if($question->answertype == 'input'): ?>
                                
                            <?php elseif($question->answertype == 'select'):
                                foreach($answers as $answer) {
                                    //create select input
                                    echo $answer->answer;
                                }
                            endif;
                            ?>
                        </div>
                    </div>
                    <?php if($nextislast == true): ?>
                            <a class="btn btn-default" href="<?php echo url('/'); ?>">Finish</a>
                    <?php endif; ?>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection