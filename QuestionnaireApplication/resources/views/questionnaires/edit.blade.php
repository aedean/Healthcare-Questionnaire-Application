@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-heading"><h3>Edit Questionnaire</h3></div>
                <div class="panel-body">
                    <a href="<?php echo url('/') . '/questionnaires' ?>" class="btn btn-default btn-secondary btn-lg">Back</a>
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
                                <div class="col-md-12 text-center">
                                    <img class="img-fluid edit-img " src="<?php echo url('/') . Storage::url($questionnaire->questionnaireimage); ?>" />
                                </div>
                            </div>

                            <div class="form-group">
                                <label for="questionnaireimage" class="col-md-4 control-label">New Image</label>

                                <div class="col-md-6">
                                    <div class="custom-file">
                                        <input type="file" class="custom-file-input" id="validatedCustomFile" name="questionnaireimage" required>
                                        <label class="custom-file-label" for="validatedCustomFile">Choose file...</label>
                                    </div>
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
                                {!! Form::submit('Update Questionnaire', ['class' => 'btn btn-secondary btn-lg']) !!}
                                </div>
                            </div>
                        {!! Form::close() !!}

                    <h3>Add Boundary</h3>
                        {!! Form::open(['action' => 'QuestionnaireBoundariesController@store', 'method' => 'POST', 'class' => 'form-horizontal', 'enctype' => 'multipart/form-data']) !!}
                            <div class="form-group{{ $errors->has('boundaryname') ? ' has-error' : '' }}">
                                <label for="boundaryname" class="col-md-4 control-label">Boundary Name</label>

                                <div class="col-md-6">
                                    <input id="boundaryname" type="text" class="form-control" name="boundaryname1" required autofocus>

                                    @if ($errors->has('boundaryname'))
                                        <span class="help-block">
                                            <strong>{{ $errors->first('boundaryname') }}</strong>
                                        </span>
                                    @endif
                                </div>
                            </div>

                            <div class="form-group{{ $errors->has('lowerboundary') ? ' has-error' : '' }}">
                                <label for="lowerboundary" class="col-md-4 control-label">Lower Boundary</label>

                                <div class="col-md-6">
                                    <input id="lowerboundary" type="text" class="form-control" name="lowerboundary1" required autofocus>

                                    @if ($errors->has('lowerboundary'))
                                        <span class="help-block">
                                            <strong>{{ $errors->first('lowerboundary') }}</strong>
                                        </span>
                                    @endif
                                </div>
                            </div>

                            <div class="form-group{{ $errors->has('higherboundary') ? ' has-error' : '' }}">
                                <label for="higherboundary" class="col-md-4 control-label">Higher Boundary</label>

                                <div class="col-md-6">
                                    <input id="higherboundary" type="text" class="form-control" name="higherboundary1" required autofocus>

                                    @if ($errors->has('higherboundary'))
                                        <span class="help-block">
                                            <strong>{{ $errors->first('higherboundary') }}</strong>
                                        </span>
                                    @endif
                                </div>
                            </div>

                            <div class="form-group{{ $errors->has('notes') ? ' has-error' : '' }}">
                                <label for="notes" class="col-md-4 control-label">Notes</label>

                                <div class="col-md-6">
                                    <input id="notes" type="text" class="form-control" name="notes1" required autofocus>

                                    @if ($errors->has('notes'))
                                        <span class="help-block">
                                            <strong>{{ $errors->first('notes') }}</strong>
                                        </span>
                                    @endif
                                </div>
                            </div>

                            <div class="form-group">
                                <div class="col-md-8 col-md-offset-4">
                                {!! Form::submit('Add Boundary', ['class' => 'btn btn-secondary btn-lg', 'name' => 'submit']) !!}
                                </div>
                            </div>
                        {!! Form::close() !!}

                    <h3>Update Boundaires</h3>
                        <table class="table boundaries-table">
                            <thead>
                                <th scope="col"><h4>No</h4></th>
                                <th scope="col"><h4>Edit</h4></th>
                                <th scope="col"><h4>Delete</h4></th>
                            </thead>
                            <tbody>
                                <?php foreach($boundaries as $boundary): ?>
                                    <tr>
                                        <td scope="row"><h4><?php echo $boundary->id; ?></h4></td>
                                        <td>
                                            {!! Form::open(['action' => ['QuestionnaireBoundariesController@update', $boundary->id], 'method' => 'PUT', 'class' => 'form-horizontal', 'enctype' => 'multipart/form-data']) !!}
                                                
                                                <div class="form-group{{ $errors->has('boundaryname') ? ' has-error' : '' }}">
                                                    <label for="boundaryname" class="col-md-4 control-label">Boundary Name</label>

                                                    <div class="col-md-6">
                                                        <input id="boundaryname" type="text" class="form-control" name="boundaryname" value="{{ old('boundaryname', $boundary->boundaryname) }}" required autofocus>

                                                        @if ($errors->has('boundaryname'))
                                                            <span class="help-block">
                                                                <strong>{{ $errors->first('boundaryname') }}</strong>
                                                            </span>
                                                        @endif
                                                    </div>
                                                </div>

                                                <div class="form-group{{ $errors->has('lowerboundary') ? ' has-error' : '' }}">
                                                    <label for="lowerboundary" class="col-md-4 control-label">Lower Boundary</label>

                                                    <div class="col-md-6">
                                                        <input id="lowerboundary" type="text" class="form-control" name="lowerboundary" value="{{ old('lowerboundary', $boundary->lowerboundary) }}" required autofocus>

                                                        @if ($errors->has('lowerboundary'))
                                                            <span class="help-block">
                                                                <strong>{{ $errors->first('lowerboundary') }}</strong>
                                                            </span>
                                                        @endif
                                                    </div>
                                                </div>

                                                <div class="form-group{{ $errors->has('higherboundary') ? ' has-error' : '' }}">
                                                    <label for="higherboundary" class="col-md-4 control-label">Higher Boundary</label>

                                                    <div class="col-md-6">
                                                        <input id="higherboundary" type="text" class="form-control" name="higherboundary" value="{{ old('higherboundary', $boundary->higherboundary) }}" required autofocus>

                                                        @if ($errors->has('higherboundary'))
                                                            <span class="help-block">
                                                                <strong>{{ $errors->first('higherboundary') }}</strong>
                                                            </span>
                                                        @endif
                                                    </div>
                                                </div>

                                                <div class="form-group{{ $errors->has('notes') ? ' has-error' : '' }}">
                                                    <label for="notes" class="col-md-4 control-label">Notes</label>

                                                    <div class="col-md-6">
                                                        <input id="notes" type="text" class="form-control" name="notes" value="{{ old('notes', $boundary->notes) }}" required autofocus>

                                                        @if ($errors->has('notes'))
                                                            <span class="help-block">
                                                                <strong>{{ $errors->first('notes') }}</strong>
                                                            </span>
                                                        @endif
                                                    </div>
                                                </div>

                                                <div class="form-group">
                                                    <div class="col-md-8 col-md-offset-4">
                                                    {!! Form::submit('Update', ['class' => 'btn btn-secondary btn-lg', 'name' => 'update']) !!}
                                                    </div>
                                                </div>
                                            {!! Form::close() !!}
                                        </td>
                                        <td>
                                            {!! Form::open(['action' => ['QuestionnaireBoundariesController@destroy', $boundary->id], 'method' => 'POST', 'enctype' => 'multipart/form-data']) !!}
                                                {!! Form::hidden('_method', 'DELETE') !!}
                                                {!! Form::submit('Delete', ['class' => 'btn btn-secondary btn-lg']) !!}
                                            {!! Form::close() !!}
                                        </td>
                                    </tr>
                                <?php endforeach; ?>
                            </tbody>
                        </table>
                        <h3>Questions</h3>
                        <table class="table">
                </div>
                            <thead>
                                <th scope="col"><h4>Question Id</h4></th>
                                <th scope="col"><h4>Question Number</h4></th>
                                <th scope="col"><h4>Question</h4></th>
                                <th scope="col"><h4>Language</h4></th>
                                <th scope="col"><h4>Answer Type</h4></th>
                                <th scope="col"><h4>Edit</h4></th>
                                <th scope="col"><h4>Delete</h4></th>
                            </thead>
                            <tbody>
                                <?php foreach($questions as $question): ?>
                                    <tr>
                                        <td scope="row"><h4><?php echo $question->questionid; ?></h4></td>
                                        <td><h4><?php echo $question->questionnumber; ?></h4></td>
                                        <td><h4><?php echo $question->question; ?></h4></td>
                                        <td><h4><?php echo $question->languageid; ?></h4></td>
                                        <td><h4><?php echo $question->answertype; ?></h4></td>
                                        <td><a class="btn-secondary btn-lg btn" href="{{url('/')}}/question/{{ $question->questionid }}/edit">Edit<a></td>
                                        <td>
                                            {!! Form::open(['action' => ['QuestionsController@destroy', $question->questionid], 'method' => 'POST']) !!}
                                                {!! Form::hidden('_method', 'DELETE') !!}
                                                {!! Form::submit('Delete', ['class' => 'btn btn-secondary btn-lg']) !!}
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
@endsection
