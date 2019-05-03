@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-heading">Healthcare Contacts</div>
                <div class="panel-body">
                    <div class="contacts-container">
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<script src="{{ asset('js/getHealthcareContacts.js') }}"></script>
@endsection