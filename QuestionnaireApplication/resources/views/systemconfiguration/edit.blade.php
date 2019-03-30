@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-heading">Edit <?php echo $attribute->attributename; ?></div>
                <div class="panel-body">
                    <a href="{{ URL::previous() }}" class="btn btn-default">Back</a>     
                    {!! Form::open(['action' => ['SystemConfigController@update', $attribute->id], 'method' => 'POST', 'class' => 'form-horizontal']) !!}
                        <div class="form-group{{ $errors->has('attributevalue') ? ' has-error' : '' }}">
                            <label for="attributevalue" class="col-md-4 control-label">Value</label>

                            <div class="col-md-6">
                                <input id="attributevalue" type="text" class="form-control" name="attributevalue" value="{{ old('attributevalue', $attribute->attributevalue) }}" required autofocus>

                                @if ($errors->has('attributevalue'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('attributevalue') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="col-md-8 col-md-offset-4">
                            {{ Form::hidden('_method', 'PUT') }}
                            {!! Form::submit('Update', ['class' => 'btn']) !!}
                            </div>
                        </div>
                    {!! Form::close() !!}
                </div>
            </div>
        </div>
    </div>
</div>
@endsection