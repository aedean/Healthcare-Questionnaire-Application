@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-body">
                <a href="{{ URL::previous() }}" class="btn btn-secondary btn-lg btn-default">Back</a>
                    <table class="table">
                        <thead>
                            <th scope="col"><h4>Result Id</h4></th>
                            <th scope="col"><h4>Questionnaire Id</h4></th>
                            <th scope="col"><h4>User Id</h4></th>
                            <th scope="col"><h4>Score</h4></th>
                            <th scope="col"><h4>View</h4></th>
                            <th scope="col"><h4>Delete</h4></th>
                        </thead>
                        <tbody>
                            <?php foreach($results as $result): ?>
                                <tr>
                                    <td scope="row"><h4><?php echo $result->id; ?></h4></td>
                                    <td><h4><?php echo $result->questionnaireid; ?></h4></td>
                                    <td><h4><?php echo $result->userid; ?></h4></td>
                                    <td><h4><?php echo $result->score; ?></h4></td>
                                    <td><h4><a href="{{url('/')}}/questionnaireresults/{{ $result->id }}" class="btn btn-secondary btn-lg btn-default">View<a></td>
                                    <td>
                                        {!! Form::open(['action' => ['QuestionnaireResultsController@destroy', $result->id], 'method' => 'POST']) !!}
                                            {!! Form::hidden('_method', 'DELETE') !!}
                                            {!! Form::submit('Delete', ['class' => 'btn btn-secondary btn-lg btn-default']) !!}
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