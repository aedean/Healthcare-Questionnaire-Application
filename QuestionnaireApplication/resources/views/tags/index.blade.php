@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-heading">Tags</div>
                <div class="panel-body">
                    <a href="{{ URL::previous() }}" class="btn btn-default">Back</a>
                    <table>
                        <thead>
                            <th>No.</th>
                            <th>Edit</th>
                            <th>Delete</th>
                        </thead>
                        <tbody>
                            <?php $configCount = 1; ?>
                            <?php foreach($tags as $tag): ?>
                                <tr>
                                    <td><?php echo $configCount++; ?></td>
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
                                            {!! Form::submit('Update', ['class' => 'btn']) !!}
                                            </div>
                                        </div>
                                    {!! Form::close() !!}
                                    </td>
                                    <td>
                                        {!! Form::open(['action' => ['TagsController@destroy', $tag->id], 'method' => 'POST']) !!}
                                        {{ csrf_field() }}
                                            {!! Form::hidden('_method', 'DELETE') !!}
                                            {!! Form::submit('Delete', ['class' => 'btn']) !!}
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
                        {!! Form::submit('Add Tag', ['class' => 'btn']) !!}
                        </div>
                    </div>
                    {!! Form::close() !!}
                </div>
            </div>
        </div>
    </div>
</div>
@endsection