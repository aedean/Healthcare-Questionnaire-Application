@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-body">
                <a href="{{ URL::previous() }}" class="btn btn-default">Back</a>
                    <p><?php if($resultnote) { echo $resultnote->note; } ?></p>
                    <table class="table">
                        <thead>
                            <th scope="col">Question Number</th>
                            <th scope="col">Answer</th>
                        </thead>
                        <tbody>
                            <?php $questioncount = 1; ?>
                            <?php foreach($answers as $answer): ?>
                                <tr>
                                    <td scope="row"><?php echo $questioncount; ?></td>
                                    <td><?php echo $answer->answer; ?></td>
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