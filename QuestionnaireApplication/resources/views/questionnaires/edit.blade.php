@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-heading">Create Questionnaire</div>
                <div class="panel-body">
                    <a href="{{ URL::previous() }}" class="btn btn-default">Back</a>

                    {!! Form::open(['action' => 'QuestionnairesController@store', 'method' => 'POST', 'class' => 'form-horizontal']) !!}

                    <div class="form-group{{ $errors->has('name') ? ' has-error' : '' }}">
                        <label for="name" class="col-md-4 control-label">Name</label>

                        <div class="col-md-6">
                            <input id="name" type="text" class="form-control" name="name" required autofocus>

                            @if ($errors->has('name'))
                                <span class="help-block">
                                    <strong>{{ $errors->first('name') }}</strong>
                                </span>
                            @endif
                        </div>
                    </div>

                    <div class="form-group">
                        <div class="col-md-8 col-md-offset-4">
                        {!! Form::submit('Continue Creation', ['class' => 'btn']) !!}
                        </div>
                    </div>
                    {!! Form::close() !!}
                </div>
                <div class="panel-body">
                    <!-- Get all questions -->
                <div class="panel-heading"></div>
                    <div class="panel-body">
                        <table>
                            <thead>
                                <th>Question Id</th>
                                <th>Question Number</th>
                                <th>Question</th>
                                <th>Language</th>
                                <th>Answer Type</th>
                                <th>Edit</th>
                                <th>Delete</th>
                            </thead>
                            <tbody>
                                <?php foreach($questions as $question): ?>
                                    <tr>
                                        <td><?php echo $question->questionid; ?></td>
                                        <td><?php echo $question->questionnumber; ?></td>
                                        <td><?php echo $question->question; ?></td>
                                        <td><?php echo $question->languageid; ?></td>
                                        <td><?php echo $question->answertype; ?></td>
                                        <td><a href="question/{{ $question->questionid }}/edit">Edit<a></td>
                                        <td>
                                            {!! Form::open(['action' => ['QuestionsController@destroy', $question->id], 'method' => 'POST']) !!}
                                                {!! Form::hidden('_method', 'DELETE') !!}
                                                {!! Form::submit('Delete', ['class' => 'btn']) !!}
                                            {!! Form::close() !!}
                                        </td>
                                    </tr>
                                <?php endforeach; ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
