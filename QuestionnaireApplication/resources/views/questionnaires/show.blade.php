@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-body">
                    <a href="<?php echo url('/') . '/questionnaires' ?>" class="btn btn-default">Back</a>
                    <h3>
                        Questionnaire:
                        <?php echo $questionnaires->name; ?>
                    </h3>
                    <div class="form-group{{ $errors->has('languages') ? ' has-error' : '' }}">
                        <label for="languages" class="col-md-4 control-label">Language Selection</label>

                        <div class="col-md-6">
                            {!! $createLanguagesHTML !!}
                        </div>
                    </div>
                    <a class="btn btn-default" href="<?php echo url('/') . '/question/' . $firstquestion->questionid; ?>">Take Questionnaire</a>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
