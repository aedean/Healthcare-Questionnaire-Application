@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-heading">Languages</div>
                <div class="panel-body">
                    <a href="{{ URL::previous() }}" class="btn btn-default">Back</a>
                    <table>
                        <thead>
                            <th>No.</th>
                            <th>Language</th>
                            <th>Edit</th>
                            <th>Delete</th>
                        </thead>
                        <tbody>
                            <?php $configCount = 1; ?>
                            <?php foreach($languages as $language): ?>
                                <tr>
                                    <td><?php echo $configCount++; ?></td>
                                    <td><?php echo $language->language; ?></td>
                                    <td>
                                        {!! Form::open(['action' => ['LanguagesController@update', $language->id], 'method' => 'POST', 'class' => 'form-horizontal']) !!}
                                        {{ csrf_field() }}
                                        <div class="form-group{{ $errors->has('colour') ? ' has-error' : '' }}">
                                            <label for="colour" class="col-md-4 control-label">colour</label>

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
                                            {!! Form::submit('Update', ['class' => 'btn']) !!}
                                            </div>
                                        </div>
                                    {!! Form::close() !!}
                                    </td>
                                    <td>
                                        {!! Form::open(['action' => ['LanguagesController@destroy', $language->id], 'method' => 'POST']) !!}
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
                        {!! Form::submit('Add Language', ['class' => 'btn']) !!}
                        </div>
                    </div>
                    {!! Form::close() !!}
                </div>
            </div>
        </div>
    </div>
</div>
@endsection