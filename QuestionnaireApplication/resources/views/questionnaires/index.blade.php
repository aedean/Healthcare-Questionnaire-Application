@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="bd-example">
            <h1>Questionnaires</h2>
            <div class="card-columns">
                <?php foreach($questionnaires as $questionnaire): ?>
                    <div class="card">
                        <img src="<?php echo url('/') . Storage::url($questionnaire['questionnaire']['questionnaireimage']); ?>" class="card-img-top" alt="...">
                        <div class="card-body">
                            <h3 class="card-title"><?php echo $questionnaire['questionnaire']['name'] ?></h3>
                        </div>
                        <div class="card-footer">
                            <h4>Languages</h4>
                            <h3><?php echo implode($questionnaire['languages'], ', ' ); ?></h3>
                        </div>

                        <div class="card-footer">
                            <h4>Tags</h4>
                            <h3><?php echo implode($questionnaire['tags'], ', ' ); ?></h3>
                        </div>
                        <div class="card-footer">
                            <div class="questionnaire-delete questionnaire-btns"> 
                                {!! Form::open(['action' => ['QuestionnairesController@destroy', $questionnaire['questionnaire']['id']], 'method' => 'POST']) !!}
                                    {!! Form::hidden('_method', 'DELETE') !!}
                                    {!! Form::submit('Delete', ['class' => 'btn btn-secondary btn-lg']) !!}
                                {!! Form::close() !!}
                            </div>
                            <a href="{{url('/')}}/questionnaires/<?php echo $questionnaire['questionnaire']['id'] ?>" class="btn btn-secondary btn-lg questionnaire-btns">Take</a>
                            <a href="{{url('/')}}/questionnaires/<?php echo $questionnaire['questionnaire']['id'] ?>/edit" class="btn btn-secondary btn-lg questionnaire-btns">Edit</a>
                        </div>
                    </div>
                <?php endforeach; ?>
            </div>
        </div>
    </div>
</div>
<script src="{{ asset('js/setQuestionnaires.js') }}"></script>
<script src="{{ asset('js/setResults.js') }}"></script>
@endsection