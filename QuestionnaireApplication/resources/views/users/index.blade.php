@extends('layouts.app')
<style>
table {
  font-family: arial, sans-serif;
  border-collapse: collapse;
  width: 100%;
}

td, th {
  border: 1px solid #dddddd;
  text-align: left;
  padding: 8px;
}

tr:nth-child(even) {
  background-color: #dddddd;
}
</style>
@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-heading">Users</div>
                <form action="<?php echo Request::url(); ?>/search" method="get" id="name">
                    <div class="input-group">
                        <input type="search" name="search" id="firstname" class="form-control">
                        <span class="input-group-prepend">
                            <button type="submit" class="btn">Search</button>
                        </span>
                    </div>
                </form>
                <div class="panel-body">
                    <a href="{{ URL::previous() }}" class="btn btn-default">Back</a>
                    <table>
                        <thead>
                            <th>User Type</th>
                            <th>Title</th>
                            <th>First Name</th>
                            <th>Last Name</th>
                            <th>Date of Birth</th>
                            <th>Email</th>
                            <th>Edit</th>
                            <th>Delete</th>
                        </thead>
                        <tbody>
                            <?php foreach($users as $user): ?>
                                <tr>
                                    <td><?php echo $user->usertypeid; ?></td>
                                    <td><?php echo $user->title; ?></td>
                                    <td><?php echo $user->firstname; ?></td>
                                    <td><?php echo $user->lastname; ?></td>
                                    <td><?php echo $user->dob; ?></td>
                                    <td><?php echo $user->email; ?></td>
                                    <td><a href="users/{{ $user->id }}/edit">Edit<a></td>
                                    <td>
                                        {!! Form::open(['action' => ['UsersController@destroy', $user->id], 'method' => 'POST']) !!}
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
