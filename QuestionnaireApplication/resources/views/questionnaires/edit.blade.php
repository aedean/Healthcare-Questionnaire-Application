@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-heading">Edit Questionnaire</div>
                <div class="panel-body">
                    <a href="<?php echo url('/') . '/questionnaires' ?>" class="btn btn-default">Back</a>
                    {!! Form::open(['action' => ['QuestionnairesController@update', $questionnaire->id], 'method' => 'PUT', 'class' => 'form-horizontal', 'enctype' => 'multipart/form-data']) !!}
                    <div class="form-group{{ $errors->has('name') ? ' has-error' : '' }}">
                        <label for="name" class="col-md-4 control-label">Name</label>

                        <div class="col-md-6">
                            <input id="name" type="text" class="form-control" name="name" value="{{ old('name', $questionnaire->name) }}" required autofocus>

                            @if ($errors->has('name'))
                                <span class="help-block">
                                    <strong>{{ $errors->first('name') }}</strong>
                                </span>
                            @endif
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="col-md-4 control-label">Image</label>
                        <div class="col-md-12">
                            <img src="<?php echo url('/') . Storage::url($questionnaire->questionnaireimage); ?>" />
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="questionnaireimage" class="col-md-4 control-label">New Image</label>

                        <div class="col-md-6">
                            <?php echo Form::file('file', array('name'=>'questionnaireimage')); ?>
                        </div>
                    </div>

                    <div class="form-group{{ $errors->has('languages') ? ' has-error' : '' }}">
                        <label for="languages" class="col-md-4 control-label">Languages</label>

                        <div class="col-md-6">
                            {!! $languages !!}
                            @if ($errors->has('languages'))
                                <span class="help-block">
                                    <strong>{{ $errors->first('languages') }}</strong>
                                </span>
                            @endif
                        </div>
                    </div>

                    <div class="form-group{{ $errors->has('tags') ? ' has-error' : '' }}">
                        <label for="tags" class="col-md-4 control-label">Tags</label>

                        <div class="col-md-6">
                            {!! $tags !!}
                            @if ($errors->has('tags'))
                                <span class="help-block">
                                    <strong>{{ $errors->first('tags') }}</strong>
                                </span>
                            @endif
                        </div>
                    </div>

                    <div class="form-group">
                        <div class="col-md-8 col-md-offset-4">
                        {!! Form::submit('Update Questionnaire', ['class' => 'btn']) !!}
                        </div>
                    </div>
                    {!! Form::close() !!}
                </div>
                <div class="panel-body">
                <!-- Get all questions -->
                <div class="panel-heading"></div>
                    <div class="panel-body">
                        <table class="table">
                            <thead>
                                <th scope="col">Question Id</th>
                                <th scope="col">Question Number</th>
                                <th scope="col">Question</th>
                                <th scope="col">Language</th>
                                <th scope="col">Answer Type</th>
                                <th scope="col">Edit</th>
                                <th scope="col">Delete</th>
                            </thead>
                            <tbody>
                                <?php foreach($questions as $question): ?>
                                    <tr>
                                        <td scope="row"><?php echo $question->questionid; ?></td>
                                        <td><?php echo $question->questionnumber; ?></td>
                                        <td><?php echo $question->question; ?></td>
                                        <td><?php echo $question->languageid; ?></td>
                                        <td><?php echo $question->answertype; ?></td>
                                        <td><a href="{{url('/')}}/question/{{ $question->questionid }}/edit">Edit<a></td>
                                        <td>
                                            {!! Form::open(['action' => ['QuestionsController@destroy', $question->questionid], 'method' => 'POST']) !!}
                                                {!! Form::hidden('_method', 'DELETE') !!}
                                                {!! Form::submit('Delete', ['class' => 'btn']) !!}
                                            {!! Form::close() !!}
                                        </td>
                                    </tr>
                                <?php endforeach; ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
