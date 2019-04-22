@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-heading">UserTypes</div>
                <div class="panel-body">
                    <a href="<?php echo url('/') . '/systemconfiguration'; ?>" class="btn btn-default">Back</a>
                    <table class="table table-bordered">
                        <thead>
                            <th scope="col">No.</th>
                            <th scope="col">Id</th>
                            <th scope="col">Name</th>
                            <th scope="col">Edit</th>
                            <th scope="col">Delete</th>
                        </thead>
                        <tbody>
                            <?php $usertypeCount = 1; ?>
                            <?php foreach($usertypes as $usertype): ?>
                                <tr>
                                    <th scope="row"><?php echo $usertypeCount++; ?></th>
                                    <td><?php echo $usertype->usertypeid; ?></td>
                                    <td><?php echo $usertype->usertypename; ?></td>
                                    <td><a href="<?php echo url('/') . '/usertypes/' . $usertype->usertypeid . '/edit'; ?>" class="btn btn-default">Edit<a></td>
                                    <td class="table-dark">
                                        {!! Form::open(['action' => ['UserTypesController@destroy', $usertype->usertypeid], 'method' => 'POST']) !!}
                                        {{ csrf_field() }}
                                            {!! Form::hidden('_method', 'DELETE') !!}
                                            {!! Form::submit('Delete', ['class' => 'btn']) !!}
                                        {!! Form::close() !!}
                                    </td>
                                </tr>
                            <?php endforeach; ?>
                        </tbody>
                    </table>
                    <a href="<?php echo url('/') . '/usertypes/create'; ?>" class="btn btn-success" role="button">Create</a>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection