@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
            <div class="panel-heading"><h3>Patients</h3></div>
                <div class="panel-body">
                    <table class="table">
                        <thead>
                            <th scope="col"><h4>Patient ID</h4></th>
                            <th scope="col"><h4>Username</h4></th>
                            <th scope="col"><h4>Name</h4></th>
                            <th scope="col"><h4>Date of Birth</h4></th>
                            <th scope="col"><h4>Gender</h4></th>
                            <th scope="col"><h4>Edit</h4></th>
                            <th scope="col"><h4>Delete</h4></th>
                        </thead>
                        <tbody>
                            <?php foreach($patients as $patient): ?>
                                <tr>
                                    <td><h4><?php echo $patient->id ?></h4></td>
                                    <td><h4><?php echo $patient->username; ?></h4></td>
                                    <td><h4><?php echo $patient->title . ' ' . $patient->firstname . ' ' . $patient->lastname; ?></h4></td>
                                    <td><h4><?php echo $patient->dob; ?></h4></td>
                                    <td><h4><?php echo $patient->gender; ?></h4></td>
                                    <td><h4><a href="{{url('/')}}/patients/{{ $patient->id }}/edit" class="btn btn-secondary btn-lg btn-default">Edit<a></td>
                                    <td>
                                        {!! Form::open(['action' => ['PatientsController@destroy', $patient->id], 'method' => 'POST']) !!}
                                            {!! Form::hidden('_method', 'DELETE') !!}
                                            {!! Form::submit('Delete', ['class' => 'btn btn-secondary btn-lg btn-default']) !!}
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
