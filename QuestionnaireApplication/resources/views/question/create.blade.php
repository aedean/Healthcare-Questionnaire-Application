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

                    <!-- <div class="form-group{{ $errors->has('languageid') ? ' has-error' : '' }}">
                        <label for="languageid" class="col-md-4 control-label">languageid</label>

                        <div class="col-md-6">
                            <input id="languageid" type="text" class="form-control" name="languageid" required autofocus>

                            @if ($errors->has('languageid'))
                                <span class="help-block">
                                    <strong>{{ $errors->first('languageid') }}</strong>
                                </span>
                            @endif
                        </div>
                    </div> -->

                    <div class="form-group{{ $errors->has('question') ? ' has-error' : '' }}">
                        <label for="question" class="col-md-4 control-label">question</label>

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
                        <label for="answer" class="col-md-4 control-label">Answer</label>

                        <div class="col-md-6">
                            <?php echo Form::file('file', array('name'=>'questionimage')); ?>
                        </div>
                    </div>

                    <div class="row">

                    <div class="col-md-6">
                        <input type="file" name="image" class="form-control">
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
<script>
    //if the answer type is select 
       // alert( "Handler for .change() called." );

    // let answerHtml = `<div class="form-group{{ $errors->has('answer') ? ' has-error' : '' }}">
    //     <label for="answer" class="col-md-4 control-label">Answer</label>

    //     <div class="col-md-6">
    //         <input id="answer" type="text" class="form-control" name="answer" required autofocus>

    //         @if ($errors->has('answer'))
    //             <span class="help-block">
    //                 <strong>{{ $errors->first('answer') }}</strong>
    //             </span>
    //         @endif
    //     </div>
    // </div>`;
    //create answer input and btn
    //if the add another answer btn is clicked
    //delete the current btn 
    //create answer input and btn
</script>
@endsection