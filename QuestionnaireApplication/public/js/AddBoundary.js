//Create extra boundary entries for user
$(document).ready(function() {
    $(document).on('click', '.addboundary', function(event){
        event.preventDefault();
        var element = getBoundaryContainer(event.target.id);
        var elementno = $('.boundary-container').length;
        elementno++;
        console.log(elementno);
        $('.addboundary').remove();
        if(element != '') {
            $(element).after(`<hr id="boundary${elementno}">
                            <div class="boundary-container" id="boundary${elementno}">
                                <div class="form-group">
                                    <label for="boundaryname" class="col-md-4 control-label">Boundary Name</label>

                                    <div class="col-md-6">
                                        <input id="boundaryname" type="text" class="form-control" name="boundaryname${elementno}" required autofocus>
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label for="lowerboundary" class="col-md-4 control-label">Lower Boundary</label>

                                    <div class="col-md-6">
                                        <input id="lowerboundary" type="text" class="form-control" name="lowerboundary${elementno}" required autofocus>
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label for="higherboundary" class="col-md-4 control-label">Higher Boundary</label>

                                    <div class="col-md-6">
                                        <input id="higherboundary" type="text" class="form-control" name="higherboundary${elementno}" required autofocus>
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label for="notes" class="col-md-4 control-label">Notes</label>

                                    <div class="col-md-6">
                                        <input id="notes" type="text" class="form-control" name="notes${elementno}" required autofocus>
                                    </div>
                                </div>

                                <div class="form-group create-boundary-btns">
                                    <div class="col-md-8 col-md-offset-4">
                                        <div class="btn btn-default btn-secondary btn-lg  addboundary" id="boundary${elementno}">Add another</div>
                                        <div class="btn btn-default  btn-secondary btn-lg deleteboundary" id="boundary${elementno}">Delete</div>
                                    </div>
                                </div>
                            </div>`);
        }
    });

    $(document).on('click', '.deleteboundary', function(event){
        var element = getBoundaryContainer(event.target.id);
        $(element).remove();
        var hrs = $('hr');
        for(var i = 0; i < hrs.length; i++){
            if($(hrs[i]).attr('id') == event.target.id) {
                $(hrs[i]).remove();
            }
        }
        $(element).closest('hr').remove();
    });

    function getBoundaryContainer(id){
        var element = '';
        var containers = $('.boundary-container');
        for(var i = 0; i < containers.length; i++){
            if($(containers[i]).attr('id') == id) {
                element = containers[i];
            }
        }
        return element;
    }
});