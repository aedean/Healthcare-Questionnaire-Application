@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-heading"><h3>Healthcare Contacts</h3></div>
                <div class="panel-body">
                    <a href="<?php echo url('/') . '/systemconfiguration'; ?>" class="btn btn-default btn-secondary btn-lg">Back</a>
                    <a href="<?php echo url('/') . '/healthcarecontacts/create'; ?>" class="btn btn-default btn-secondary btn-lg">Create<a>
                    <table class="table">
                        <thead>
                            <th scope="col"><h4>No.</h4></th>
                            <th scope="col"><h4>Name</h4></th>
                            <th scope="col"><h4>Mobile</h4></th>
                            <th scope="col"><h4>Landline</h4></th>
                            <th scope="col"><h4>Company</h4></th>
                            <th scope="col"><h4>Edit</h4></th>
                            <th scope="col"><h4>Delete</h4></th>
                        </thead>
                        <tbody>
                            <?php $configCount = 1; ?>
                            <?php foreach($healthcarecontacts as $healthcarecontact): ?>
                                <tr>
                                    <td><h4><?php echo $configCount++; ?></h4></td>
                                    <td><h4><?php echo $healthcarecontact->name ?></h4></td>
                                    <td><h4><?php echo $healthcarecontact->mobile; ?></h4></td>
                                    <td><h4><?php echo $healthcarecontact->landline; ?></h4></td>
                                    <td><h4><?php echo $healthcarecontact->company; ?></h4></td>
                                    <td><a href="<?php echo url('/') . '/healthcarecontacts/' . $healthcarecontact->id . '/edit'; ?>" class="btn btn-default btn-secondary btn-lg">Edit<a></td>
                                    <td>
                                        {!! Form::open(['action' => ['HealthcareContactsController@destroy', $healthcarecontact->id], 'method' => 'POST']) !!}
                                        {{ csrf_field() }}
                                            {!! Form::hidden('_method', 'DELETE') !!}
                                            {!! Form::submit('Delete', ['class' => 'btn btn-secondary btn-lg']) !!}
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
<script src="{{ asset('js/getResults.js') }}"></script>
@endsection