@extends('layouts.app')

@section('content')
    <div class="container">
        <a href="{{ URL::previous() }}" class="btn btn-default">Back</a>
        <a href="<?php echo url('/') . '/questionnaires/create' ?>" class="btn btn-default">Create New</a>
        <div class="row">
            <?php foreach($questionnaires as $questionnaire): ?>
                <div class="card col-sm-4 border-dark mb-3">
                    <div class="card-body">
                        <h5 class="card-header"><?php echo $questionnaire->id . ' ' . $questionnaire->name; ?></h5>
                        <img class="bd-placeholder-img card-img-top questionnaire-img-index" src="<?php echo url('/') . Storage::url($questionnaire->questionnaireimage); ?>" />
                        <ul class="list-group list-group-flush">
                            <li class="list-group-item"><?php //echo $questionnaire->questionnaire; ?>Tags</li>
                            <li class="list-group-item"><?php //echo $questionnaire->languageid; ?>Languages</li>
                            <li class="list-group-item"><a href="{{url('/')}}/questionnaires/{{ $questionnaire->id }}" class="btn btn-primary">Take</a></li>
                            <?php if(!Auth::guest()): ?>
                                <li class="list-group-item"><a href="{{url('/')}}/questionnaires/{{ $questionnaire->id }}/edit">Edit</a></li>
                                <li class="list-group-item">
                                    {!! Form::open(['action' => ['QuestionnairesController@destroy', $questionnaire->id], 'method' => 'POST']) !!}
                                    {!! Form::hidden('_method', 'DELETE') !!}
                                    {!! Form::submit('Delete', ['class' => 'btn']) !!}
                                    {!! Form::close() !!}
                                </li>
                            <?php endif; ?>
                        </ul>
                    </div>
                </div>
            <?php endforeach; ?>
        </div>
    </div>
@endsection
