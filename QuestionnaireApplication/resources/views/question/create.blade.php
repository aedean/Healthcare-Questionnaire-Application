@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-heading"><h3>Create Questionnaire</h3></div>
                <div class="panel-body">
                    {!! Form::open(['action' => 'QuestionsController@store', 'method' => 'POST', 'class' => 'form-horizontal', 'enctype' => 'multipart/form-data']) !!}
                        
                        <div class="form-group{{ $errors->has('questionnumber') ? ' has-error' : '' }}">
                            <label for="questionnumber" class="col-md-4 control-label">Question Number</label>

                            <div class="col-md-6">
                                <input id="questionnumber" type="number" class="form-control" name="questionnumber" required autofocus>

                                @if ($errors->has('questionnumber'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('questionnumber') }}</strong>
                                    </span>
                                @endif
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

                        <div class="form-group{{ $errors->has('question') ? ' has-error' : '' }}">
                            <label for="question" class="col-md-4 control-label">Question</label>

                            <div class="col-md-6">
                                <input id="question" type="text" class="form-control" name="question" required autofocus>

                                @if ($errors->has('question'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('question') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="questionimage" class="col-md-4 control-label">Image</label>

                            
                        <div class="col-md-6">
                            <div class="custom-file">
                                <input type="file" class="custom-file-input" id="validatedCustomFile" name="questionimage" required>
                                <label class="custom-file-label" for="validatedCustomFile">Choose file...</label>
                            </div>
                        </div>
                        </div>

                        <div class="form-group{{ $errors->has('answertype') ? ' has-error' : '' }} answercontainer">
                            <label for="answertype" class="col-md-4 control-label">Answer Type</label>
                            
                            <div class="col-md-6">
                                <p>An answer type is what response a user can give. Prefined answers are select, written answer is input. </p>
                                <select name="answertype" class="form-control" id="inputtype">
                                    <option value="input">Input</option>
                                    <option value="select">Select</option>
                                </select>

                                @if ($errors->has('answertype'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('answertype') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                    <div class="form-group">
                        <div class="col-md-8 col-md-offset-4">
                        {!! Form::submit('Add Another Question', ['class' => 'btn btn-secondary btn-lg', 'name' => 'submit']) !!}
                        </div>
                    </div>

                    <div class="form-group">
                        <div class="col-md-8 col-md-offset-4">
                        {!! Form::submit('Create Boundaries', ['class' => 'btn btn-secondary btn-lg', 'name' => 'boundaries']) !!}
                        </div>
                    </div>
                    {!! Form::close() !!}
                </div>
            </div>
        </div>
    </div>
</div>
<script src="{{ asset('js/AddAnswer.js') }}"></script>
@endsection