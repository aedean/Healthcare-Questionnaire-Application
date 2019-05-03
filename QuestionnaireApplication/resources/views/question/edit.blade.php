@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-heading">Edit Question</div>
                <div class="panel-body">
                    <a href="<?php echo url('/') . '/questionnaires/' . $questionnaireId . '/edit' ?>" class="btn btn-default">Back</a>
                    {!! Form::open(['action' => ['QuestionsController@update', $question->questionid], 'method' => 'PUT', 'class' => 'form-horizontal', 'enctype' => 'multipart/form-data']) !!}
                    
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
                            {!! $languages !!}
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

                    <div class="form-group">
                        <label class="col-md-4 control-label">Image</label>
                        <div class="col-md-12">
                            <img src="<?php echo url('/') . Storage::url($question->questionimage); ?>" />
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="questionimage" class="col-md-4 control-label">New Image</label>

                        <div class="col-md-6">
                            <?php echo Form::file('file', array('name'=>'questionimage')); ?>
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

                    <h3>Create Answer</h3>
                    {!! Form::open(['action' => ['QuestionAnswersController@store'], 'method' => 'POST', 'class' => 'form-horizontal', 'enctype' => 'multipart/form-data']) !!}

                    <div class="form-group{{ $errors->has('answer') ? ' has-error' : '' }}">
                        <label for="answer" class="col-md-4 control-label">Answer</label>

                        <div class="col-md-6">
                            <input id="answer" type="text" class="form-control" name="answer" value="" required autofocus>

                            @if ($errors->has('answer'))
                                <span class="help-block">
                                    <strong>{{ $errors->first('answer') }}</strong>
                                </span>
                            @endif
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="answerimage" class="col-md-4 control-label">Image</label>

                        <div class="col-md-6">
                            <?php echo Form::file('file', array('name'=>'answerimage')); ?>
                        </div>
                    </div>

                    <div class="form-group{{ $errors->has('score') ? ' has-error' : '' }}">
                        <label for="score" class="col-md-4 control-label">Score</label>

                        <div class="col-md-6">
                            <input id="score" type="int" class="form-control" name="score" value="" required autofocus>

                            @if ($errors->has('score'))
                                <span class="help-block">
                                    <strong>{{ $errors->first('score') }}</strong>
                                </span>
                            @endif
                        </div>
                    </div>

                    <div class="form-group">
                        <div class="col-md-8 col-md-offset-4">
                        {!! Form::submit('Add Answer', ['class' => 'btn', 'name' => 'add']) !!}
                        </div>
                    </div>
                    {!! Form::close() !!}

                    <?php $answerCount = 0; ?>
                        <h3>Answers</h3>
                        <table class="table answers-table">
                            <thead>
                                <th scope="col">No</th>
                                <th scope="col">Edit</th>
                                <th scope="col">Delete</th>
                            </thead>
                            <tbody>
                                <?php foreach($answers as $answer): ?>
                                    <tr>
                                        <td scope="row"><?php echo $answer->answerid; ?></td>
                                        <td>
                                            {!! Form::open(['action' => ['QuestionAnswersController@update', $answer->answerid], 'method' => 'PUT', 'class' => 'form-horizontal', 'enctype' => 'multipart/form-data']) !!}
                                                <div class="form-group{{ $errors->has('answer') ? ' has-error' : '' }}">
                                                    <label for="answer" class="col-md-4 control-label">Answer</label>

                                                    <div class="col-md-6">
                                                        <input id="answer" type="text" class="form-control" name="answer" value="{{ old('answer', $answer->answer) }}" required autofocus>

                                                        @if ($errors->has('answer'))
                                                            <span class="help-block">
                                                                <strong>{{ $errors->first('answer') }}</strong>
                                                            </span>
                                                        @endif
                                                    </div>
                                                </div>

                                                <div class="form-group">
                                                    <label class="col-md-4 control-label">Image</label>
                                                    <div class="col-md-12">
                                                        <img src="<?php echo url('/') . Storage::url($answer->answerimage); ?>" />
                                                    </div>
                                                </div>

                                                <div class="form-group">
                                                    <label for="answerimage" class="col-md-4 control-label">New Image</label>

                                                    <div class="col-md-6">
                                                        <?php echo Form::file('file', array('name'=>'answerimage')); ?>
                                                    </div>
                                                </div>

                                                <div class="form-group{{ $errors->has('score') ? ' has-error' : '' }}">
                                                    <label for="score" class="col-md-4 control-label">Score</label>

                                                    <div class="col-md-6">
                                                        <input id="score" type="text" class="form-control" name="score" value="{{ old('score', $answer->score) }}" required autofocus>

                                                        @if ($errors->has('score'))
                                                            <span class="help-block">
                                                                <strong>{{ $errors->first('score') }}</strong>
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
                                        </td>
                                        <td>
                                            {!! Form::open(['action' => ['QuestionAnswersController@destroy', $answer->answerid], 'method' => 'POST', 'enctype' => 'multipart/form-data']) !!}
                                                {!! Form::hidden('_method', 'DELETE') !!}
                                                {!! Form::submit('Delete', ['class' => 'btn']) !!}
                                            {!! Form::close() !!}
                                        </td>
                                    </tr>
                                <?php endforeach; ?>
                            </tbody>
                        </table>
                    <a href="<?php echo url('/'); ?>/question/<?php echo $question->questionid + 1; ?>/edit" class="btn btn-default">Next Question</a>
                    <a href="<?php echo url('/'); ?>/question/<?php echo $question->questionid - 1; ?>/edit" class="btn btn-default">Previous Question</a>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection