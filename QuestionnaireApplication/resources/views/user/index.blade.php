@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
        <div class="panel panel-default">
            <div class="panel-heading"><h3>Users</h3></div>
                <div class="panel-body">
                    <table class="table">
                        <thead>
                            <th scope="col"><h4>User ID</h4></th>
                            <th scope="col"><h4>Username</h4></th>
                            <th scope="col"><h4>Name</h4></th>
                            <th scope="col"><h4>Edit</h4></th>
                            <th scope="col"><h4>Delete</h4></th>
                        </thead>
                        <tbody>
                            <?php foreach($users as $user): ?>
                                <tr>
                                    <td><h4><?php echo $user->id ?></h4></td>
                                    <td><h4><?php echo $user->username; ?></h4></td>
                                    <td><h4><?php echo $user->title . ' ' . $user->firstname . ' ' . $user->lastname; ?></h4></td>
                                    <td><h4><a href="{{url('/')}}/user/{{ $user->id }}/edit" class="btn btn-secondary btn-lg btn-default">Edit<a></td>
                                    <td>
                                        {!! Form::open(['action' => ['UserController@destroy', $user->id], 'method' => 'POST']) !!}
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
