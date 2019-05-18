@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-heading"><h3>Home</h3></div>

                <div class="panel-body">
                    @if (session('status'))
                        <div class="alert alert-success">
                            {{ session('status') }}
                        </div>
                    @endif
                    <h4>Welcome back {{ Auth::user()->firstname }} {{ Auth::user()->lastname }}</h4>
                    <a href="user/{{ Auth::user()->id }}" class="btn btn-secondary btn-lg btn-default">Account Details</a>

            <a href="{{ url('/logout') }}" class="btn btn-secondary btn-lg btn-default"
                onclick="event.preventDefault();
                document.getElementById('logout-form').submit();">
                Logout
            </a>
                <form id="logout-form" 
                        action="{{ url('/logout') }}" 
                    method="POST" 
                    style="display: none;">
                                {{ csrf_field() }}
                </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
