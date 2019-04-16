`@extends('layouts.app')

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

                    <div class="form-group{{ $errors->has('answertype') ? ' has-error' : '' }} answercontainer">
                        <label for="answertype" class="col-md-4 control-label">Answer Type</label>

                        <div class="col-md-6">
                            <select name="answertype" class="form-control" id="inputtype">
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

                    <!-- Answer Test --> 
                    <div class="form-group{{ $errors->has('answer1') ? ' has-error' : '' }}">
                        <label for="answer1" class="col-md-4 control-label">Answer</label>

                        <div class="col-md-6">
                            <input id="answer1" type="text" class="form-control" name="answer1" required autofocus>

                            @if ($errors->has('answer1'))
                                <span class="help-block">
                                    <strong>{{ $errors->first('answer1') }}</strong>
                                </span>
                            @endif
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="answerimage1" class="col-md-4 control-label">Answer Image</label>

                        <div class="col-md-6">
                            <?php echo Form::file('file', array('name'=>'answerimage1')); ?>
                        </div>
                    </div>
                    <!-- Answer Test --> 

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
<!-- <script type="text/javascript">
    $(document).ready(function() {
        $("#inputtype").change(function(){
            var inputtype = $(this).children("option:selected").val();
            //get count of answers
            if(inputtype == 'select') {
                $(".answercontainer").html(`<div class="form-group additionalanswercontainer">
                                            <label for="answertype" class="col-md-4 control-label">Answer</label>

                                            <div class="col-md-6">
                                                <input id="question" type="text" class="form-control" name="answer" required autofocus>
                                                <div class="btn btn-default addanswer">Add another</div>
                                                <button class="btn btn-default deleteanswer">Delete</button>
                                            </div>
                                        </div>`);
            } 
            else if(inputtype == 'input') {
                $('.additionalanswercontainer').remove();
            }
        });

        $(".addanswer").click(function(){
            console.log('adding another');
            // $(".answercontainer").append(`<div class="form-group answercontainer">
            //                                 <label for="answertype" class="col-md-4 control-label">Answer</label>

            //                                 <div class="col-md-6">
            //                                     <input id="question" type="text" class="form-control" name="answer" required autofocus>
            //                                     <button class="btn btn-default addanswer">Add another</button>
            //                                     <button class="btn btn-default">Delete</button>
            //                                 </div>
            //                             </div>`);
        });

        $(".deleteanswer").click(function(){
            //delete input
            //delete delete button
            //delete add another button
        });
    });
</script> -->
@endsection`