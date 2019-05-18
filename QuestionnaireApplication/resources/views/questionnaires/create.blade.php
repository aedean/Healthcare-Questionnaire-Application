@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-heading"><h3>Create Questionnaire</h3></div>
                <div class="panel-body">
                    <a href="{{ URL::previous() }}" class="btn btn-default btn-secondary btn-lg">Back</a>

                    {!! Form::open(['action' => 'QuestionnairesController@store', 'method' => 'POST', 'class' => 'form-horizontal', 'enctype' => 'multipart/form-data']) !!}

                    <div class="form-group{{ $errors->has('name') ? ' has-error' : '' }}">
                        <label for="name" class="col-md-4 control-label">Name</label>

                        <div class="col-md-6">
                            <input id="name" type="text" class="form-control" name="name" required autofocus>

                            @if ($errors->has('name'))
                                <span class="help-block">
                                    <strong>{{ $errors->first('name') }}</strong>
                                </span>
                            @endif
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="questionnaireimage" class="col-md-4 control-label">Image</label>

                        <div class="col-md-6">
                            <div class="custom-file">
                                <input type="file" class="custom-file-input" id="validatedCustomFile" name="questionnaireimage" required>
                                <label class="custom-file-label" for="validatedCustomFile">Choose file...</label>
                            </div>
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

                    <div class="form-group">
                        <div class="col-md-8 col-md-offset-4">
                        {!! Form::submit('Continue Creation', ['class' => 'btn btn-secondary btn-lg']) !!}
                        </div>
                    </div>
                    {!! Form::close() !!}
            </div>
        </div>
    </div>
</div>
@endsection
