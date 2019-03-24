@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-heading">Dashboard</div>

                <div class="panel-body">
                    @if (session('status'))
                        <div class="alert alert-success">
                            {{ session('status') }}
                        </div>
                    @endif
                    <p>Welcome back {{ Auth::user()->firstname }} {{ Auth::user()->lastname }}</p>
                    <a href="user/{{ Auth::user()->id }}" type="button" class="btn btn-default">Account Details</a>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
