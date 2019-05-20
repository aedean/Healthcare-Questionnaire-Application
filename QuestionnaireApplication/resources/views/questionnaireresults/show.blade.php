@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-body">
                <a href="{{ URL::previous() }}" class="btn btn-secondary btn-lg btn-default" style="margin-bottom: 10px;" >Back</a>
                    <?php if($results->userid): ?>
                    <h3>User</h3>
                        <table class="table table-bordered">
                            <tbody>
                                <tr>
                                    <td>User ID</td>
                                    <td><?php echo $patient->id ?></td>
                                </tr>
                                <tr>
                                    <td>Username</td>
                                    <td><?php echo $patient->username ?></td>
                                </tr>
                                <tr>
                                    <td>Name</td>
                                    <td><?php echo $patient->title . ' ' . $patient->firstname . ' ' . $patient->lastname; ?></td>
                                </tr>
                                <tr>
                                    <td>Date of Birth</td>
                                    <td><?php echo $patient->dob ?></td>
                                </tr>
                                <tr>
                                    <td>Gender</td>
                                    <td><?php echo $patient->gender; ?></td>
                                </tr>
                            </tbody>
                        </table>
                    <?php endif; ?>
                    
                    <?php if($resultnote): ?>
                        <h3>Notes</h3>
                        <p><?php echo $resultnote->note; ?></p>
                        <hr>
                    <?php endif; ?>

                    <table class="table">
                        <thead>
                            <th scope="col"><h4>Question Number</h4></th>
                            <th scope="col"><h4>Question</h4></th>
                            <th scope="col"><h4>Answer</h4></th>
                        </thead>
                        <tbody>
                            <?php $questioncount = 1; ?>
                            <?php foreach($answers as $answer): ?>
                                <tr>
                                    <td scope="row"><h4><?php echo $questioncount; ?></h4></td>
                                    <td><h4><?php echo $answer->answer; ?></h4></td>
                                </tr>
                                <?php $questioncount++; ?>
                            <?php endforeach; ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
<script src="{{ asset('js/setQuestionnaires.js') }}"></script>
<script src="{{ asset('js/setResults.js') }}"></script>
@endsection