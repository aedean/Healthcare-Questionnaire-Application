@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-heading"><h3>Edit <?php echo $attribute->attributename; ?></h3></div>
                <div class="panel-body">
                    <a href="<?php echo url('/') ?>/systemconfiguration" class="btn btn-default btn-secondary btn-lg">Back</a>     
                    {!! Form::open(['action' => ['SystemConfigController@update', $attribute->id], 'method' => 'POST', 'class' => 'form-horizontal', 'enctype' => 'multipart/form-data']) !!}
                            <?php if($inputtype == 'input'): ?>
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
                            <?php else: ?>
                                <div class="form-group">
                                    <label class="col-md-4 control-label">Image</label>
                                    <div class="col-md-12 text-center">
                                        <?php if($attribute->attributevalue != null): ?>
                                            <img class="img-fluid edit-img" src="<?php echo url('/') . Storage::url($attribute->attributevalue); ?>" />
                                        <?php endif; ?>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="attributevalue" class="col-md-4 control-label">New Image</label>

                                    <div class="col-md-6">
                                        <div class="custom-file">
                                            <input type="file" class="custom-file-input" id="validatedCustomFile" name="image" required>
                                            <label class="custom-file-label" for="validatedCustomFile">Choose file...</label>
                                        </div>
                                    </div>
                                </div>
                            <?php endif; ?>
                        <div class="form-group">
                            <div class="col-md-8 col-md-offset-4">
                            {{ Form::hidden('_method', 'PUT') }}
                            {!! Form::submit('Update', ['class' => 'btn btn-secondary btn-lg']) !!}
                            </div>
                        </div>
                    {!! Form::close() !!}
                </div>
            </div>
        </div>
    </div>
</div>
@endsection