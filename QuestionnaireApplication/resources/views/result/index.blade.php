@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
            <div class="panel-heading"><h3>Results</h3></div>
                <div class="panel-body">
                    <div class="results-container">
                        <h3>You scored: </h3>

                    </div>
                    <div class="btn btn-secondary btn-lg questionnaire-btns results-next-btn questionnaire-continue">Continue</div>
                </div>
            </div>
        </div>
    </div>
</div>
<script src="{{ asset('js/getResults.js') }}"></script>
@endsection