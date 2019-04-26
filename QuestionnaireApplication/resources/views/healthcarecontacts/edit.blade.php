@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-heading">Healthcare Contact</div>
                <div class="panel-body">
                    <a href="<?php echo url('/') . '/healthcarecontacts'; ?>" class="btn btn-default">Back</a>
                    {!! Form::open(['action' => ['HealthcareContactsController@update', $healthcarecontact->id], 'method' => 'PUT', 'class' => 'form-horizontal']) !!}
                    {{ csrf_field() }}

                        <div class="form-group{{ $errors->has('name') ? ' has-error' : '' }}">
                            <label for="name" class="col-md-4 control-label">Name</label>

                            <div class="col-md-6">
                                <input id="name" type="text" class="form-control" name="name" value="{{ old('name', $healthcarecontact->name) }}" required autofocus>

                                @if ($errors->has('name'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('name') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group{{ $errors->has('mobile') ? ' has-error' : '' }}">
                            <label for="mobile" class="col-md-4 control-label">Mobile</label>

                            <div class="col-md-6">
                                <input id="mobile" type="text" class="form-control" name="mobile" value="{{ old('mobile', $healthcarecontact->mobile) }}" required autofocus>

                                @if ($errors->has('mobile'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('mobile') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group{{ $errors->has('landline') ? ' has-error' : '' }}">
                            <label for="landline" class="col-md-4 control-label">Landline</label>

                            <div class="col-md-6">
                                <input id="landline" type="text" class="form-control" name="landline" value="{{ old('landline', $healthcarecontact->landline) }}" required autofocus>

                                @if ($errors->has('landline'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('landline') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group{{ $errors->has('company') ? ' has-error' : '' }}">
                            <label for="company" class="col-md-4 control-label">Company</label>

                            <div class="col-md-6">
                                <input id="company" type="text" class="form-control" name="company" value="{{ old('company', $healthcarecontact->company) }}" required autofocus>

                                @if ($errors->has('company'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('company') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <!-- User Address -->
                        <?php if($useraddress->addressid): ?>
                        <div class="form-group{{ $errors->has('addressline1') ? ' has-error' : '' }}">
                        <label for="addressline1" class="col-md-4 control-label">Address Line 1</label>

                            <div class="col-md-6">
                                <input id="addressline1" type="text" class="form-control" name="addressline1" value="{{ old('addressline1', $useraddress->addressline1) }}" required autofocus>

                                @if ($errors->has('addressline1'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('addressline1') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group{{ $errors->has('addressline2') ? ' has-error' : '' }}">
                            <label for="addressline2" class="col-md-4 control-label">Address Line 2</label>

                            <div class="col-md-6">
                                <input id="addressline2" type="text" class="form-control" name="addressline2" value="{{ old('addressline2', $useraddress->addressline2) }}"required autofocus>

                                @if ($errors->has('addressline2'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('addressline2') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group{{ $errors->has('city') ? ' has-error' : '' }}">
                            <label for="city" class="col-md-4 control-label">City/ Town</label>

                            <div class="col-md-6">
                                <input id="city" type="text" class="form-control" name="city" value="{{ old('city', $useraddress->city) }}" required autofocus>

                                @if ($errors->has('city'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('city') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group{{ $errors->has('county') ? ' has-error' : '' }}">
                            <label for="county" class="col-md-4 control-label">County</label>

                            <div class="col-md-6">
                                <input id="county" type="text" class="form-control" name="county" value="{{ old('county', $useraddress->county) }}" required>

                                @if ($errors->has('county'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('county') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group{{ $errors->has('country') ? ' has-error' : '' }}">
                            <label for="country" class="col-md-4 control-label">Country</label>

                            <div class="col-md-6">
                                <input id="country" type="text" class="form-control" name="country" value="{{ old('country', $useraddress->country) }}" required>

                                @if ($errors->has('country'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('country') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group{{ $errors->has('postcode') ? ' has-error' : '' }}">
                            <label for="postcode" class="col-md-4 control-label">Postcode</label>

                            <div class="col-md-6">
                                <input id="postcode" type="text" class="form-control" name="postcode" value="{{ old('postcode', $useraddress->postcode) }}"required>

                                @if ($errors->has('postcode'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('postcode') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>
                        <?php endif; ?>

                    <div class="form-group">
                        <div class="col-md-8 col-md-offset-4">
                        {!! Form::submit('Update Healthcare Worker', ['class' => 'btn']) !!}
                        </div>
                    </div>
                    {!! Form::close() !!}
                </div>
            </div>
        </div>
    </div>
</div>
@endsection