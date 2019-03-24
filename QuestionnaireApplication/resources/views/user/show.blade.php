<!-- Show -->
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
                        <?php echo $user->title . ' ' . $user->firstname . ' ' . $user->lastname; ?>
                    </li>
                    <li class="list-group-item">
                        <h5 class="attribute-title">Date of birth</h5>
                        <?php echo $user->dob; ?>
                    </li>
                    <li class="list-group-item">
                        <h5 class="attribute-title">Email</h5>
                        <?php echo $user->email; ?>
                    </li>
                    <li class="list-group-item">
                        <a href="<?php echo Request::url(); ?>/edit" type="button" class="btn btn-default">Edit Details</a>
                    </li>
                </ul>
                <?php $addressCount = 1; ?>
                <?php foreach($useraddresses as $address): ?>
                <ul class="list-group list-group-flush">
                    <li class="list-group-item">
                        <h5 class="attribute-title">Address Number <?php echo $addressCount; ?></h5>
                    </li>
                    <li class="list-group-item">
                        <h5 class="attribute-title">Address Line 1</h5>
                        <?php echo $address->addressline1; ?>
                    </li>
                    <li class="list-group-item">
                    <h5 class="attribute-title">Address Line 2</h5>
                        <?php echo $address->addressline2; ?>
                    </li>
                    <li class="list-group-item">
                        <h5 class="attribute-title">City</h5>
                        <?php echo $address->city; ?>
                    </li>
                    <li class="list-group-item">
                        <h5 class="attribute-title">County</h5>
                        <?php echo $address->county; ?>
                    </li>
                    <li class="list-group-item">
                        <h5 class="attribute-title">Country</h5>   
                        <?php echo $address->country; ?>
                    </li>
                    <li class="list-group-item">
                        <h5 class="attribute-title">Postcode</h5>
                        <?php echo $address->postcode; ?>
                    </li>
                    <?php $addressCount++; ?>
                    <li class="list-group-item links">
                        {!! Form::open(['action' => ['UserAddressController@destroy', $address->addressid], 'method' => 'POST']) !!}
                            {!! Form::hidden('_method', 'DELETE') !!}
                            {!! Form::submit('Delete', ['class' => 'btn']) !!}
                        {!! Form::close() !!}
                        <a href="<?php echo url('/'); ?>/address/{{ $address->addressid }}/edit" type="button" class="btn btn-default">Edit Address</a>
                    </li>
                </ul>
                <?php endforeach; ?>
                <a href="{{ URL::previous() }}" class="btn btn-default">Back</a>
                <a href="<?php echo url('/'); ?>/address/create" type="button" class="btn btn-default">Add Address</a>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
