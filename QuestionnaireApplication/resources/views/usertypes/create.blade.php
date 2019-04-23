@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-heading">Create User Type</div>
                <div class="panel-body">
                    <a href="<?php echo url('/') . '/usertypes'; ?>" class="btn btn-default">Back</a>
                    {!! Form::open(['action' => 'UserTypesController@store', 'method' => 'POST', 'class' => 'form-horizontal']) !!}
                    {{ csrf_field() }}

                        <div class="form-group{{ $errors->has('usertypename') ? ' has-error' : '' }}">
                            <label for="usertypename" class="col-md-4 control-label">User Type Name</label>

                            <div class="col-md-6">
                                <input id="usertypename" type="text" class="form-control" name="usertypename" required autofocus>

                                @if ($errors->has('usertypename'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('usertypename') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group{{ $errors->has('usertypename') ? ' has-error' : '' }}">
                            <label for="usertypename" class="col-md-4 control-label">User Type Name</label>

                            <div class="col-md-6">
                                {!! $applicationAccess !!}
                                @if ($errors->has('usertypename'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('usertypename') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                    <div class="form-group">
                        <div class="col-md-8 col-md-offset-4">
                        {!! Form::submit('Create User Type', ['class' => 'btn']) !!}
                        </div>
                    </div>
                    {!! Form::close() !!}
                </div>
            </div>
        </div>
    </div>
</div>
@endsection