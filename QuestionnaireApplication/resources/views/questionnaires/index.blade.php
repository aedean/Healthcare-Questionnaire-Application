@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-body">
                    <a href="{{ URL::previous() }}" class="btn btn-default">Back</a>
                    <a href="<?php echo url('/') . '/questionnaires/create' ?>" class="btn btn-default">Create New</a>
                    <table class="table">
                        <thead>
                            <th scope="col">Questionnaire Id</th>
                            <th scope="col">Name</th>
                            <th scope="col">Languages</th>
                            <th scope="col">Tags</th>
                            <th scope="col">Take</th>
                            <th scope="col">Edit</th>
                            <th scope="col">Delete</th>
                        </thead>
                        <tbody>
                            <?php foreach($questionnaires as $questionnaire): ?>
                                <tr>
                                    <td scope="row"><?php echo $questionnaire->id; ?></td> <!-- ID -->
                                    <td><?php echo $questionnaire->name; ?></td> <!-- Name -->
                                    <td><?php echo $questionnaire->questionnaire; ?></td> <!-- Languages -->
                                    <td><?php echo $questionnaire->languageid; ?></td> <!-- Tags -->
                                    <td><a href="{{url('/')}}/questionnaires/{{ $questionnaire->id }}">Take<a></td>
                                    <td><a href="{{url('/')}}/questionnaires/{{ $questionnaire->id }}/edit">Edit<a></td>
                                    <td>
                                        {!! Form::open(['action' => ['QuestionnairesController@destroy', $questionnaire->id], 'method' => 'POST']) !!}
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
@endsection
