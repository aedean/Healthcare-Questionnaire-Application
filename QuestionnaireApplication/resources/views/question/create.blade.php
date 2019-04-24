@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-heading">Create Questionnaire</div>
                <div class="panel-body">
                    <a href="{{ URL::previous() }}" class="btn btn-default">Back</a>

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
                                <?php echo Form::file('file', array('name'=>'questionimage')); ?>
                            </div>
                        </div>

                        <div class="form-group{{ $errors->has('answertype') ? ' has-error' : '' }} answercontainer">
                            <label for="answertype" class="col-md-4 control-label">Answer Type</label>

                            <div class="col-md-6">
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
                        {!! Form::submit('Add Another Question', ['class' => 'btn', 'name' => 'submit']) !!}
                        </div>
                    </div>

                    <div class="form-group">
                        <div class="col-md-8 col-md-offset-4">
                        {!! Form::submit('Create Boundaries', ['class' => 'btn', 'name' => 'boundaries']) !!}
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