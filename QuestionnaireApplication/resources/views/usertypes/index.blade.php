@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-heading">UserTypes</div>
                <div class="panel-body">
                    <a href="<?php echo url('/') . '/systemconfiguration'; ?>" class="btn btn-default">Back</a>
                    <table>
                        <thead>
                            <th>No.</th>
                            <th>Id</th>
                            <th>Name</th>
                            <th>Edit</th>
                            <th>Delete</th>
                        </thead>
                        <tbody>
                            <?php $usertypeCount = 1; ?>
                            <?php foreach($usertypes as $usertype): ?>
                                <tr>
                                    <td><?php echo $usertypeCount++; ?></td>
                                    <td><?php echo $usertype->usertypeid; ?></td>
                                    <td><?php echo $usertype->usertypename; ?></td>
                                    <td><a href="<?php echo url('/') . '/usertypes/' . $usertype->usertypeid . '/edit'; ?>" class="btn btn-default">Edit<a></td>
                                    <td>
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
                    <a href="<?php echo url('/') . '/usertypes/create'; ?>" class="btn btn-default">Create</a>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection