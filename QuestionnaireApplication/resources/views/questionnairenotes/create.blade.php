@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-body">
                {!! Form::open(['action' => 'QuestionnaireNotesController@store', 'method' => 'POST', 'class' => 'form-horizontal', 'enctype' => 'multipart/form-data']) !!}

                    <div class="form-group{{ $errors->has('note') ? ' has-error' : '' }}">
                        <label for="note" class="col-md-4 control-label">Note</label>

                        <div class="col-md-6">
                            <input id="note" type="text" class="form-control" note="note" required autofocus>

                            @if ($errors->has('note'))
                                <span class="help-block">
                                    <strong>{{ $errors->first('note') }}</strong>
                                </span>
                            @endif
                        </div>
                    </div>

                <div class="form-group">
                    <div class="col-md-8 col-md-offset-4">
                    {!! Form::submit('Back to all questionnaires', ['class' => 'btn']) !!}
                    </div>
                </div>
                {!! Form::close() !!}
                </div>
            </div>
        </div>
    </div>
</div>
<script src="{{ asset('js/setQuestionnaires.js') }}"></script>
@endsection