@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-heading"><h3>Healthcare Contacts</h3></div>
                <div class="panel-body">
                    <div class="contacts-container">
                    </div>
                    <div class="healthcontacts-btn questionnaire-continue btn-secondary btn-lg">Continue</div>
                </div>
            </div>
        </div>
    </div>
</div>
<script src="{{ asset('js/getHealthcareContacts.js') }}"></script>
<script src="{{ asset('js/getResults.js') }}"></script>
@endsection