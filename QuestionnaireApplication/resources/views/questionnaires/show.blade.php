@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-6 col-md-offset-2 center-block">
            <a href="<?php echo url('/') . '/questionnaires' ?>" class="btn btn-secondary btn-lg">Back</a>
            <h1><?php echo $questionnaire->name; ?></h1>
            <img class="img-fluid img-full-width" src="<?php echo url('/') . Storage::url($questionnaire->questionnaireimage); ?>" />

            <div class="questionnaire-show-center col-md-12">
                <!-- language selection -->
                <div class="form-group">
                    <label for="language" class="col-md-4 control-label">Languages</label>

                    <div class="col-md-6">
                        <select name="language" class="language form-control">
                            <?php foreach($languages as $language): ?>
                                <option value="<?php echo $language; ?>"><?php echo $language; ?></option>
                            <?php endforeach; ?>
                        </select>
                    </div>
                </div>

                <!-- save selection -->
                <div class="form-group savetypes">
                    <label for="savetype" class="col-md-4 control-label">Save Option</label>

                    <div class="col-md-6">
                        <select name="savetype" class="savetype form-control">
                            <option value="nosave">Do not save questionnaire results</option>
                            <option value="annoymoussave">Save Questionnaire Results Annoymously</option>
                            <option value="patientsave">Save my results</option>
                            <option value="patientsave">Save on behalf of patient</option>
                        </select>
                    </div>
                </div>

                <div class="form-group username-container">
                    <label for="username" class="col-md-4 control-label">User Name</label>

                    <div class="col-md-6">
                        <input type="text" class="username form-control" oninput="myFunction()">
                    </div>
                </div>
                <a href="<?php echo url('/') . '/question/' . $firstquestionid; ?>" class="btn btn-secondary btn-lg questionnaire-btns take-q-btn">Take Questionnaire</a>
            </div>
        </div>
    </div>
</div>
<script src="{{ asset('js/getResults.js') }}"></script>
<script>
    function myFunction() {
        if(jQuery('.username').length != 0) { 
            localStorage.setItem('username', jQuery('.username').val());
        }
    }
</script>
@endsection