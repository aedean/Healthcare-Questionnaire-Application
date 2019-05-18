@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-heading"><h3>User Types</h3></div>
                <div class="panel-body">
                    <a href="<?php echo url('/') . '/systemconfiguration'; ?>" class="btn btn-default btn-secondary btn-lg">Back</a>
                    <a href="<?php echo url('/') . '/usertypes/create'; ?>" class="btn btn-secondary btn-lg" role="button">Create</a>
                    <table class="table">
                        <thead>
                            <th scope="col"><h4>No.</h4></th>
                            <th scope="col"><h4>Id</h4></th>
                            <th scope="col"><h4>Name</h4></th>
                            <th scope="col"><h4>Edit</h4></th>
                            <th scope="col"><h4>Delete</h4></th>
                        </thead>
                        <tbody>
                            <?php $usertypeCount = 1; ?>
                            <?php foreach($usertypes as $usertype): ?>
                                <tr>
                                    <th scope="row"><h4><?php echo $usertypeCount++; ?></h4></th>
                                    <td><h4><?php echo $usertype->usertypeid; ?></h4></td>
                                    <td><h4><?php echo $usertype->usertypename; ?></h4></td>
                                    <td><a href="<?php echo url('/') . '/usertypes/' . $usertype->usertypeid . '/edit'; ?>" class="btn btn-default btn-secondary btn-lg">Edit<a></td>
                                    <td>
                                        {!! Form::open(['action' => ['UserTypesController@destroy', $usertype->usertypeid], 'method' => 'POST']) !!}
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
@endsection