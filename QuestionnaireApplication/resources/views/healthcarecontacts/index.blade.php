@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-heading">Healthcare Conacts</div>
                <div class="panel-body">
                    <a href="<?php echo url('/') . '/systemconfiguration'; ?>" class="btn btn-default">Back</a>
                    <a href="<?php echo url('/') . '/healthcarecontacts/create'; ?>" class="btn btn-default">Create<a>
                    <table class="table">
                        <thead>
                            <th scope="col">No.</th>
                            <th scope="col">Name</th>
                            <th scope="col">Mobile</th>
                            <th scope="col">Landline</th>
                            <th scope="col">Company</th>
                            <th scope="col">Edit</th>
                            <th scope="col">Delete</th>
                        </thead>
                        <tbody>
                            <?php $configCount = 1; ?>
                            <?php foreach($healthcarecontacts as $healthcarecontact): ?>
                                <tr>
                                    <td><?php echo $configCount++; ?></td>
                                    <td><?php echo $healthcarecontact->name ?></td>
                                    <td><?php echo $healthcarecontact->mobile; ?></td>
                                    <td><?php echo $healthcarecontact->landline; ?></td>
                                    <td><?php echo $healthcarecontact->company; ?></td>
                                    <td><a href="<?php echo url('/') . '/healthcarecontacts/' . $healthcarecontact->id . '/edit'; ?>" class="btn btn-default">Edit<a></td>
                                    <td>
                                        {!! Form::open(['action' => ['HealthcareContactsController@destroy', $healthcarecontact->id], 'method' => 'POST']) !!}
                                        {{ csrf_field() }}
                                            {!! Form::hidden('_method', 'DELETE') !!}
                                            {!! Form::submit('Delete', ['class' => 'btn']) !!}
                                        {!! Form::close() !!}
                                    </td>
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