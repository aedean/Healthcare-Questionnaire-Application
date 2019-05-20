@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-heading"><h3>System Configuration</h3></div>
                <div class="panel-body">
                    <a href="{{ URL::previous() }}" class="btn btn-default btn-secondary btn-lg">Back</a>
                    <table class="table">
                        <thead>
                            <th scope="col"><h4>No.</h4></th>
                            <th scope="col"><h4>Attribute Name</h4></th>
                            <th scope="col"><h4>Edit</h4></th>
                        </thead>
                        <tbody>
                            <?php $configCount = 1; ?>
                            <?php foreach($attributes as $attribute): ?>
                                <tr>
                                    <td scope="row"><h4><?php echo $configCount++; ?></h4></td>
                                    <td><h4><?php echo $attribute->attributename; ?></h4></td>
                                    <td><a href="<?php echo url('/') ?>/systemconfiguration/{{ $attribute->id }}/edit" class="btn btn-secondary btn-lg btn-default">Edit<a></td>
                                </tr>
                            <?php endforeach; ?>
                            <tr>
                                <td><h4><?php echo $configCount++; ?></td>
                                <td><h4>Languages</h4></td>
                                <td><a href="<?php echo url('/') . '/languages'; ?>" class="btn btn-default btn-secondary btn-lg">Edit<a></td>
                            </tr>
                            <tr>
                                <td><h4><?php echo $configCount++; ?></h4></td>
                                <td><h4>Tags</h4></td>
                                <td><a href="<?php echo url('/') . '/tags'; ?>" class="btn btn-default btn-secondary btn-lg">Edit<a></td>
                            </tr>
                            <tr>
                                <td><h4><?php echo $configCount++; ?></h4></td>
                                <td><h4>Users Permissions</h4></td>
                                <td><a href="<?php echo url('/') . '/usertypes'; ?>" class="btn btn-default btn-secondary btn-lg">Edit<a></td>
                            </tr>
                            <tr>
                                <td><h4><?php echo $configCount++; ?></h4></td>
                                <td><h4>Healthcare Contacts</h4></td>
                                <td><a href="<?php echo url('/') . '/healthcarecontacts'; ?>" class="btn btn-default btn-secondary btn-lg">Edit<a></td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection