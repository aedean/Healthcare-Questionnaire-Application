//Create extra answer inputs for users
$(document).ready(function() {
    $("#inputtype").change(function(){
        var inputtype = $(this).children("option:selected").val();
        if(inputtype == 'select') {
            $(".answercontainer").after(`<hr id="element1">
                                        <div class="top additionalanswercontainer" id="element1">
                                                <div class="form-group">
                                                    <label for="answer1" class="col-md-4 control-label">Answer</label>
                                                    <div class="col-md-6">
                                                        <input id="answer1" type="text" class="form-control" name="answer1" required autofocus>
                                                    </div>
                                                </div>
                                                <div class="form-group">
                                                    <label for="answerimage1" class="col-md-4 control-label">Answer Image</label>
                                                    <div class="col-md-6">
                                                        <input name="answerimage1" type="file">
                                                    </div>
                                                </div>
                                                <div class="form-group question-create-answers-btns">
                                                    <div class="col-md-8 col-md-offset-4">
                                                        <div class="btn btn-default addanswer" id="element1">Add another</div>
                                                        <div class="btn btn-default deleteanswer" id="element1">Delete</div>
                                                    </div>
                                                </div>
                                        </div>`);
        } 
        else if(inputtype == 'input') {
            $('.additionalanswercontainer').remove();
            $('hr').remove();
        }
    });

    $(document).on('click', '.addanswer', function(event){
        event.preventDefault();
        var element = getAnswerContainer(event.target.id);
        var elementno = $('.additionalanswercontainer').length;
        elementno++;
        $('.addanswer').remove();
        if(element != '') {
            $(element).after(`<hr id="element${elementno}">
                                <div class="additionalanswercontainer" id="element${elementno}">
                                    <div class="form-group">
                                        <label for="answer${elementno}" class="col-md-4 control-label">Answer</label>
                                        <div class="col-md-6">
                                            <input id="answer${elementno}" type="text" class="form-control" name="answer${elementno}" required autofocus>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label for="answerimage${elementno}" class="col-md-4 control-label">Answer Image</label>
                                        <div class="col-md-6">
                                            <input name="answerimage${elementno}" type="file">
                                        </div>
                                    </div>
                                    <div class="form-group question-create-answers-btns">
                                        <div class="col-md-8 col-md-offset-4">
                                            <div class="btn btn-default addanswer" id="element${elementno}">Add another</div>
                                            <div class="btn btn-default deleteanswer" id="element${elementno}">Delete</div>
                                        </div>
                                    </div>
                                </div>`);
        }
    });

    $(document).on('click', '.deleteanswer', function(event){
        var element = getAnswerContainer(event.target.id);
        $(element).remove();
        var hrs = $('hr');
        for(var i = 0; i < hrs.length; i++){
            if($(hrs[i]).attr('id') == event.target.id) {
                $(hrs[i]).remove();
            }
        }
        $(element).closest('hr').remove();
    });

    function getAnswerContainer(id){
        var element = '';
        var containers = $('.additionalanswercontainer');
        for(var i = 0; i < containers.length; i++){
            if($(containers[i]).attr('id') == id) {
                element = containers[i];
            }
        }
        return element;
    }
});