@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-heading">Create Questionnaire</div>
                <div class="panel-body">
                    <a href="{{ URL::previous() }}" class="btn btn-default">Back</a>

                    {!! Form::open(['action' => 'QuestionsController@store', 'method' => 'POST', 'class' => 'form-horizontal', 'enctype' => 'multipart/form-data']) !!}

                    <div class="form-group{{ $errors->has('questionnumber') ? ' has-error' : '' }}">
                        <label for="questionnumber" class="col-md-4 control-label">Question Number</label>

                        <div class="col-md-6">
                            <input id="questionnumber" type="number" class="form-control" name="questionnumber" required autofocus>

                            @if ($errors->has('questionnumber'))
                                <span class="help-block">
                                    <strong>{{ $errors->first('questionnumber') }}</strong>
                                </span>
                            @endif
                        </div>
                    </div>

                    <div class="form-group{{ $errors->has('languages') ? ' has-error' : '' }}">
                        <label for="languages" class="col-md-4 control-label">Languages</label>

                        <div class="col-md-6">
                            {!! $languageSelectHTML !!}
                            @if ($errors->has('languages'))
                                <span class="help-block">
                                    <strong>{{ $errors->first('languages') }}</strong>
                                </span>
                            @endif
                        </div>
                    </div>

                    <div class="form-group{{ $errors->has('question') ? ' has-error' : '' }}">
                        <label for="question" class="col-md-4 control-label">Question</label>

                        <div class="col-md-6">
                            <input id="question" type="text" class="form-control" name="question" required autofocus>

                            @if ($errors->has('question'))
                                <span class="help-block">
                                    <strong>{{ $errors->first('question') }}</strong>
                                </span>
                            @endif
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="questionimage" class="col-md-4 control-label">Image</label>

                        <div class="col-md-6">
                            <?php echo Form::file('file', array('name'=>'questionimage')); ?>
                        </div>
                    </div>

                    <div class="form-group{{ $errors->has('answertype') ? ' has-error' : '' }}" class="answertype">
                        <label for="answertype" class="col-md-4 control-label">Answer Type</label>

                        <div class="col-md-6">
                            <select name="languageid" class="form-control" id="inputtype">
                                <option value="input">Input</option>
                                <option value="select">Select</option>
                            </select>

                            @if ($errors->has('answertype'))
                                <span class="help-block">
                                    <strong>{{ $errors->first('answertype') }}</strong>
                                </span>
                            @endif
                        </div>
                    </div>

                    <div class="form-group">
                        <div class="col-md-8 col-md-offset-4">
                        {!! Form::submit('Add Another Question', ['class' => 'btn', 'name' => 'submit']) !!}
                        </div>
                    </div>

                    <div class="form-group">
                        <div class="col-md-8 col-md-offset-4">
                        {!! Form::submit('Finish', ['class' => 'btn', 'name' => 'finish', 'value' => 'test']) !!}
                        </div>
                    </div>
                    {!! Form::close() !!}
                </div>
            </div>
        </div>
    </div>
</div>
<script type="text/javascript">
$(document).ready(function() {
var max_fields = 20; //maximum input boxes allowed
var wrapper = $("#items"); //Fields wrapper
var add_button = $(".add_field_button"); //Add button ID
 
var x = 1; //initlal text box count
$(add_button).click(function(e){ //on add input button click
e.preventDefault();
if(x < max_fields){ //max input box allowed
x++; //text box increment
$(wrapper).append('<div class="form-group"><label for="' + selectanswercount +'">Answers</label>' +
'<input class="form-control col-md-11" type="email" placeholder=""name="author"/>' +
'<a href="#" class="remove_field"><i class="fa fa-times"></a></div>'); //add input box
}
});
 
$(wrapper).on("click",".remove_field", function(e){ //user click on remove field
e.preventDefault(); $(this).parent('div').remove(); x--;
})
});

    $(document).ready(function() {
        $("#inputtype").change(function(){
            var inputtype = $(this).children("option:selected").val();
            if(inputtype == 'select') {
                $(".answertype").append('<input type="text" name="amount"/>');
            } 
            <div class="form-group">
                <label for="questionimage" class="col-md-4 control-label">Image</label>

                <div class="col-md-6">
                    <?php echo Form::file('file', array('name'=>'questionimage')); ?>
                </div>
            </div>
            // else {
            //     if() {
            //         //if there are ones of this id remove any inputs
            //     }
            // }
        });

        $("addanswer").click(function(){
            //create input
            //create delete buttn
            //create add another button
        });

        $("deleteanswer").click(function(){
            //delete input
            //delete delete button
            //delete add another button
        });
    });
</script>
@endsection