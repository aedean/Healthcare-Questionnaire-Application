@extends('layouts.app')
<style>
.attribute-title {
    font-weight: bold;
}
</style>
@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-heading">Update User</div>
                <div class="panel-body">
                <ul class="list-group list-group-flush">
                    <li class="list-group-item">
                        <h5 class="attribute-title">User Type</h5>
                        <?php echo $usertype->usertypename; ?>
                    </li>
                    <li class="list-group-item">
                        <h5 class="attribute-title">Name</h5>
                        <?php if($user->title == '' && $user->firstname == ''): ?>
                            <p>Not set</p>
                        <?php else: ?>
                            <?php echo $user->title . ' ' . $user->firstname . ' ' . $user->lastname; ?>
                        <?php endif; ?>
                    </li>
                    <li class="list-group-item">
                        <h5 class="attribute-title">Email</h5>
                        <?php if($user->email == ''): ?>
                            <p>Not set</p>
                        <?php else: ?>
                            <?php echo $user->email; ?>
                        <?php endif; ?>
                    </li>
                    <li class="list-group-item">
                        <a href="<?php echo Request::url(); ?>/edit" type="button" class="btn btn-default">Edit Details</a>
                    </li>
                </ul>
                <a href="{{ URL::previous() }}" class="btn btn-default">Back</a>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
