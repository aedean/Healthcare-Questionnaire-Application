@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
            <div class="panel-heading"><h3>Notes</h3></div>
                <div class="panel-body">
                    <h4 class="col-md-4 control-label">Note</h4>
                    <div class="form-group">

                        <div class="col-md-6 note">
                            <input id="note" type="text" class="form-control" name="note" required autofocus>
                        </div>
                    </div>
              
                    <div class="col-md-8 col-md-offset-4 row-padding">
                        <div class="btn questionnaires-back btn-lg btn-secondary questionnaire-continue">Back to all questionnaires</div>
                    </div>       
                </div>
            </div>
        </div>
    </div>
</div>
<script src="{{ asset('js/setNote.js') }}"></script>
@endsection