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

                    <div class="form-group">
                        <div class="col-md-6">
                            <img src="<?php echo asset('storage/public/uploads/questionnaires/questions/tick.PNG'); ?>" />
                        </div>
                    </div>

                    <div class="form-group">
                        <div class="col-md-6">
                            <?php echo $question->question ?>
                        </div>
                    </div>
                    
                    <div class="form-group">
                        <div class="col-md-6">
                            <?php
                                if($question->answertype == 'input') {
                                    //create text input
                                } elseif($question->answertype == 'select') {
                                    foreach($answers as $answer) {
                                        //create select input
                                        echo $answer->answer;
                                    }
                                } 
                            ?>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection