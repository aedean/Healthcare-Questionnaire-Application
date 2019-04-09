@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-heading">Healthcare Workers</div>
                <div class="panel-body">
                    <table class="table">
                        <thead>
                            <th scope="col">No.</th>
                            <th scope="col">Name</th>
                            <th scope="col">Gender</th>
                            <th scope="col">Mobile</th>
                            <th scope="col">Landline</th>
                            <th scope="col">Company</th>
                        </thead>
                        <tbody>
                            <?php $configCount = 1; ?>
                            <?php foreach($healthcareWorkers as $healthcareWorker): ?>
                                <tr>
                                    <td><?php echo $configCount++; ?></td>
                                    <td><?php echo $healthcareWorker->title . ' ' . $healthcareWorker->firstname . ' ' . $healthcareWorker->lastname; ?></td>
                                    <td><?php echo $healthcareWorker->gender; ?></td>
                                    <td><?php echo $healthcareWorker->mobile; ?></td>
                                    <td><?php echo $healthcareWorker->landline; ?></td>
                                    <td><?php echo $healthcareWorker->company; ?></td>
                                </tr>
                            <?php endforeach; ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection