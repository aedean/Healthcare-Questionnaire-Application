@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-heading"><h3>Tags</h3></div>
                <div class="panel-body">
                    <a href="<?php echo url('/') . '/systemconfiguration'; ?>" class="btn btn-default btn-secondary btn-lg">Back</a>
                    <table class="table">
                        <thead>
                            <th scope="col"><h4>No.</h4></th>
                            <th scope="col"><h4>Edit</h4></th>
                            <th scope="col"><h4>Delete</h4></th>
                        </thead>
                        <tbody>
                            <?php $configCount = 1; ?>
                            <?php foreach($tags as $tag): ?>
                                <tr>
                                    <td scope="row"><h4><?php echo $configCount++; ?></h4></td>
                                    <td>
                                        {!! Form::open(['action' => ['TagsController@update', $tag->id], 'method' => 'POST', 'class' => 'form-horizontal']) !!}
                                        {{ csrf_field() }}
                                        <div class="form-group{{ $errors->has('tagname') ? ' has-error' : '' }}">
                                            <label for="tagname" class="col-md-4 control-label">Tag Name</label>

                                            <div class="col-md-6">
                                                <input id="tagname" type="text" class="form-control" name="tagname" value="{{ old('tagname', $tag->tagname) }}" required autofocus>

                                                @if ($errors->has('tagname'))
                                                    <span class="help-block">
                                                        <strong>{{ $errors->first('tagname') }}</strong>
                                                    </span>
                                                @endif
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <div class="col-md-8 col-md-offset-4">
                                            {{ Form::hidden('_method', 'PUT') }}
                                            {!! Form::submit('Update', ['class' => 'btn btn-default btn-secondary btn-lg']) !!}
                                            </div>
                                        </div>
                                    {!! Form::close() !!}
                                    </td>
                                    <td>
                                        {!! Form::open(['action' => ['TagsController@destroy', $tag->id], 'method' => 'POST']) !!}
                                        {{ csrf_field() }}
                                            {!! Form::hidden('_method', 'DELETE') !!}
                                            {!! Form::submit('Delete', ['class' => 'btn btn-default btn-secondary btn-lg']) !!}
                                        {!! Form::close() !!}
                                    </td>
                                </tr>
                            <?php endforeach; ?>
                        </tbody>
                    </table>
                    <!-- Create new -->
                    {!! Form::open(['action' => 'TagsController@store', 'method' => 'POST', 'class' => 'form-horizontal']) !!}
                    {{ csrf_field() }}
                        <div class="form-group{{ $errors->has('tagname') ? ' has-error' : '' }}">
                            <label for="tagname" class="col-md-4 control-label">Tag Name</label>

                            <div class="col-md-6">
                                <input id="tagname" type="text" class="form-control" name="tagname" required autofocus>

                                @if ($errors->has('tagname'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('tagname') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                    <div class="form-group">
                        <div class="col-md-8 col-md-offset-4">
                        {!! Form::submit('Add Tag', ['class' => 'btn btn-default btn-secondary btn-lg']) !!}
                        </div>
                    </div>
                    {!! Form::close() !!}
                </div>
            </div>
        </div>
    </div>
</div>
@endsection