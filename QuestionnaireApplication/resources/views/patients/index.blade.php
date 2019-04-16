@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-heading">Patients</div>
                <div class="panel-body">
                    <a href="" class="btn btn-default">Back</a>
                    <table class="table">
                        <thead class="thead-dark">
                            <th scope="col">No.</th>
                            <th scope="col">Username</th>
                            <th scope="col">Name</th>
                            <th scope="col">DOB</th>
                            <th scope="col">Gender</th>
                            <th scope="col">Edit</th>
                            <th scope="col">Delete</th>
                        </thead>
                        <tbody>
                            <?php $configCount = 1; ?>
                            <?php foreach($patients as $patient): ?>
                                <tr>
                                    <td scope="row"><?php echo $configCount++; ?></td>
                                    <td><?php echo $patient->username; ?></td>
                                    <td><?php echo $patient->title . ' ' . $patient->firstname . ' ' . $patient->lastname; ?></td>
                                    <td><?php echo $patient->dob; ?></td>
                                    <td><?php echo $patient->gender; ?></td>
                                    <td><a href="<?php echo url('/') . '/patients/' . $patient->id . '/edit'; ?>" class="btn btn-default">Edit<a></td>
                                    <td>
                                        {!! Form::open(['action' => ['PatientsController@destroy', $patient->id], 'method' => 'POST']) !!}
                                        {{ csrf_field() }}
                                            {!! Form::hidden('_method', 'DELETE') !!}
                                            {!! Form::submit('Delete', ['class' => 'btn']) !!}
                                        {!! Form::close() !!}
                                    </td>
                                </tr>
                            <?php endforeach; ?>
                        </tbody>
                    </table>
                    <a href="<?php echo url('/') . '/patients/create'; ?>" class="btn btn-default">Create<a>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection