@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-heading"><h3>Languages</h3></div>
                <div class="panel-body">
                    <a href="<?php echo url('/') . '/systemconfiguration'; ?>" class="btn btn-default btn-secondary btn-lg">Back</a>
                    <table class="table">
                        <thead>
                            <th scope="col"><h4>No.</h4></th>
                            <th scope="col"><h4>Language</h4></th>
                            <th scope="col"><h4>Edit</h4></th>
                            <th scope="col"><h4>Delete</h4></th>
                        </thead>
                        <tbody>
                            <?php $configCount = 1; ?>
                            <?php foreach($languages as $language): ?>
                                <tr>
                                    <td scope="row"><h4><?php echo $configCount++; ?></h4></td>
                                    <td><h4><?php echo $language->language; ?></h4></td>
                                    <td>
                                        {!! Form::open(['action' => ['LanguagesController@update', $language->id], 'method' => 'POST', 'class' => 'form-horizontal']) !!}
                                        {{ csrf_field() }}
                                        <div class="form-group{{ $errors->has('colour') ? ' has-error' : '' }}">
                                            <label for="colour" class="col-md-4 control-label">Colour</label>

                                            <div class="col-md-6">
                                                <input id="colour" type="text" class="form-control" name="colour" value="{{ old('colour', $language->colour) }}" required autofocus>

                                                @if ($errors->has('colour'))
                                                    <span class="help-block">
                                                        <strong>{{ $errors->first('colour') }}</strong>
                                                    </span>
                                                @endif
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <div class="col-md-8 col-md-offset-4">
                                            {{ Form::hidden('_method', 'PUT') }}
                                            {!! Form::submit('Update', ['class' => 'btn btn-secondary btn-lg']) !!}
                                            </div>
                                        </div>
                                    {!! Form::close() !!}
                                    </td>
                                    <td>
                                        {!! Form::open(['action' => ['LanguagesController@destroy', $language->id], 'method' => 'POST']) !!}
                                        {{ csrf_field() }}
                                            {!! Form::hidden('_method', 'DELETE') !!}
                                            {!! Form::submit('Delete', ['class' => 'btn btn-secondary btn-lg']) !!}
                                        {!! Form::close() !!}
                                    </td>
                                </tr>
                            <?php endforeach; ?>
                        </tbody>
                    </table>
                    <!-- Create new -->
                    {!! Form::open(['action' => 'LanguagesController@store', 'method' => 'POST', 'class' => 'form-horizontal']) !!}
                    {{ csrf_field() }}
                        <div class="form-group{{ $errors->has('language') ? ' has-error' : '' }}">
                            <label for="language" class="col-md-4 control-label">Language</label>

                            <div class="col-md-6">
                                <input id="language" type="text" class="form-control" name="language" required autofocus>

                                @if ($errors->has('language'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('language') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group{{ $errors->has('colour') ? ' has-error' : '' }}">
                            <label for="colour" class="col-md-4 control-label">Colour</label>

                            <div class="col-md-6">
                                <input id="colour" type="text" class="form-control" name="colour" required autofocus>

                                @if ($errors->has('colour'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('colour') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                    <div class="form-group">
                        <div class="col-md-8 col-md-offset-4">
                        {!! Form::submit('Add Language', ['class' => 'btn btn-secondary btn-lg']) !!}
                        </div>
                    </div>
                    {!! Form::close() !!}
                </div>
            </div>
        </div>
    </div>
</div>
@endsection