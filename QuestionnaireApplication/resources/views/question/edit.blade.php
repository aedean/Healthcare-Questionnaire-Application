@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-heading">Create Questionnaire</div>
                <div class="panel-body">
                    <a href="{{ URL::previous() }}" class="btn btn-default">Back</a>
                    {!! Form::open(['action' => ['QuestionsController@update', $question->questionid], 'method' => 'POST', 'class' => 'form-horizontal']) !!}
                    <div class="form-group{{ $errors->has('questionnumber') ? ' has-error' : '' }}">
                        <label for="questionnumber" class="col-md-4 control-label">Question Number</label>

                        <div class="col-md-6">
                            <input id="questionnumber" type="text" class="form-control" name="questionnumber" value="{{ old('questionnumber', $question->questionnumber) }}" required autofocus>

                            @if ($errors->has('questionnumber'))
                                <span class="help-block">
                                    <strong>{{ $errors->first('questionnumber') }}</strong>
                                </span>
                            @endif
                        </div>
                    </div>

                    <div class="form-group{{ $errors->has('languageid') ? ' has-error' : '' }}">
                        <label for="languageid" class="col-md-4 control-label">Language</label>

                        <div class="col-md-6">
                            <input id="languageid" type="text" class="form-control" name="languageid" value="{{ old('language', $question->language) }}" required autofocus>

                            @if ($errors->has('languageid'))
                                <span class="help-block">
                                    <strong>{{ $errors->first('languageid') }}</strong>
                                </span>
                            @endif
                        </div>
                    </div>

                    <div class="form-group{{ $errors->has('question') ? ' has-error' : '' }}">
                        <label for="question" class="col-md-4 control-label">Question</label>

                        <div class="col-md-6">
                            <input id="question" type="text" class="form-control" name="question" value="{{ old('question', $question->question) }}" required autofocus>

                            @if ($errors->has('question'))
                                <span class="help-block">
                                    <strong>{{ $errors->first('question') }}</strong>
                                </span>
                            @endif
                        </div>
                    </div>

                    <div class="form-group{{ $errors->has('questionimage') ? ' has-error' : '' }}">
                        <label for="questionimage" class="col-md-4 control-label">Question Image</label>

                        <div class="col-md-6">
                            <input id="questionimage" type="text" class="form-control" name="questionimage" value="{{ old('questionimage', $question->questionimage) }}" required autofocus>

                            @if ($errors->has('questionimage'))
                                <span class="help-block">
                                    <strong>{{ $errors->first('questionimage') }}</strong>
                                </span>
                            @endif
                        </div>
                    </div>

                    <div class="form-group{{ $errors->has('answertype') ? ' has-error' : '' }}">
                        <label for="answertype" class="col-md-4 control-label">Answer Type</label>

                        <div class="col-md-6">
                            <input id="answertype" type="text" class="form-control" name="answertype" value="{{ old('answertype', $question->answertype) }}" required autofocus>

                            @if ($errors->has('answertype'))
                                <span class="help-block">
                                    <strong>{{ $errors->first('answertype') }}</strong>
                                </span>
                            @endif
                        </div>
                    </div>

                    <div class="form-group">
                        <div class="col-md-8 col-md-offset-4">
                        {!! Form::submit('Update', ['class' => 'btn', 'name' => 'update']) !!}
                        </div>
                    </div>
                    {!! Form::close() !!}
                    <div class="btn">
                        <a href="{{ URL::previous() }}" class="btn btn-default">Back</a>
                    </div>
                    <div class="btn">
                        <a href="<?php echo url('/'); ?>/question/<?php echo $question->questionid + 1; ?>/edit" class="btn btn-default">Next Question</a>
                    </div>
                    <div class="btn">
                        <a href="<?php echo url('/'); ?>/question/<?php echo $question->questionid - 1; ?>/edit" class="btn btn-default">Previous Question</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

<script>
    //if the answer type is select 
    let answerHtml = `<div class="form-group{{ $errors->has('answer') ? ' has-error' : '' }}">
        <label for="answer" class="col-md-4 control-label">Answer</label>

        <div class="col-md-6">
            <input id="answer" type="text" class="form-control" name="answer" required autofocus>

            @if ($errors->has('answer'))
                <span class="help-block">
                    <strong>{{ $errors->first('answer') }}</strong>
                </span>
            @endif
        </div>
    </div>`;
    //create answer input and btn
    //if the add another answer btn is clicked
    //delete the current btn 
    //create answer input and btn
</script>