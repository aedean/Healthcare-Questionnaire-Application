@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-body">
                <a href="{{ URL::previous() }}" class="btn btn-default">Back</a>
                    <table class="table">
                        <thead>
                            <th scope="col">Result Id</th>
                            <th scope="col">Questionnaire Id</th>
                            <th scope="col">User Id</th>
                            <th scope="col">Score</th>
                            <th scope="col">View</th>
                            <th scope="col">Delete</th>
                        </thead>
                        <tbody>
                            <?php foreach($results as $result): ?>
                                <tr>
                                    <td scope="row"><?php echo $result->id; ?></td>
                                    <td><?php echo $result->questionnaireid; ?></td>
                                    <td><?php echo $result->userid; ?></td>
                                    <td><?php echo $result->score; ?></td>
                                    <td><a href="{{url('/')}}/questionnaireresults/{{ $result->id }}">View<a></td>
                                    <td>
                                        {!! Form::open(['action' => ['QuestionnaireResultsController@destroy', $result->id], 'method' => 'POST']) !!}
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
<script src="{{ asset('js/setQuestionnaires.js') }}"></script>
<script src="{{ asset('js/setResults.js') }}"></script>
@endsection