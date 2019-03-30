@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-heading">Healthcare Workers</div>
                <div class="panel-body">
                    <a href="<?php echo url('/') . '/systemconfiguration'; ?>" class="btn btn-default">Back</a>
                    <table>
                        <thead>
                            <th>No.</th>
                            <th>Name</th>
                            <th>Gender</th>
                            <th>Mobile</th>
                            <th>Landline</th>
                            <th>Company</th>
                            <th>Edit</th>
                            <th>Delete</th>
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
                                    <td><a href="<?php echo url('/') . '/healthcareworkers/' . $healthcareWorker->id . '/edit'; ?>" class="btn btn-default">Edit<a></td>
                                    <td>
                                        {!! Form::open(['action' => ['HealthcareWorkersController@destroy', $healthcareWorker->id], 'method' => 'POST']) !!}
                                        {{ csrf_field() }}
                                            {!! Form::hidden('_method', 'DELETE') !!}
                                            {!! Form::submit('Delete', ['class' => 'btn']) !!}
                                        {!! Form::close() !!}
                                    </td>
                                </tr>
                            <?php endforeach; ?>
                        </tbody>
                    </table>
                    <a href="<?php echo url('/') . '/healthcareworkers/create'; ?>" class="btn btn-default">Create<a>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection