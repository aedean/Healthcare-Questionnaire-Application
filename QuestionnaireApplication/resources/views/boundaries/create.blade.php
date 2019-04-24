@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-heading">Create Questionnaire</div>
                <div class="panel-body">
                    <a href="{{ URL::previous() }}" class="btn btn-default">Back</a>
                    {!! Form::open(['action' => 'QuestionnaireBoundariesController@store', 'method' => 'POST', 'class' => 'form-horizontal', 'enctype' => 'multipart/form-data']) !!}
                    
                        <div class="boundary-container" id="boundary1">
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

                            <div class="form-group create-boundary-btns">
                                <div class="col-md-8 col-md-offset-4">
                                    <div class="btn btn-default addboundary" id="boundary1">Add another</div>
                                </div>
                            </div>
                        </div>

                        <div class="form-group">
                            <div class="col-md-8 col-md-offset-4">
                            {!! Form::submit('Finish', ['class' => 'btn', 'name' => 'submit']) !!}
                            </div>
                        </div>
                    {!! Form::close() !!}
                </div>
            </div>
        </div>
    </div>
</div>
<script src="{{ asset('js/AddBoundary.js') }}"></script>
@endsection