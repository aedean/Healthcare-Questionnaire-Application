@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-body">
                    <a href="{{ URL::previous() }}" class="btn btn-default">Back</a>
                    <span class="bd-content-title">
                        <?php echo $questionnaires->name; ?>
                    </span>
                    <a class="btn btn-default" href="<?php echo url('/') . '/question/' . $firstquestion->questionid; ?>">Take Questionnaire</a>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
