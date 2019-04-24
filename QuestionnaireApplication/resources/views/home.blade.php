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

                    <h4>Your Patients</h4>
                    <table class="table">
                        <thead>
                            <th scope="col">ID</th>
                            <th scope="col">Name</th>
                            <th scope="col">Gender</th>
                            <th scope="col">Age</th>
                            <th scope="col">Edit</th>
                            <th scope="col">Delete</th>
                        </thead>
                        <tbody>
                        </tbody>
                    </table>

                    <h4>Your Saved Questionnaires</h4>
                    <table class="table">
                        <thead>
                            <th scope="col">ID</th>
                            <th scope="col">Name</th>
                            <th scope="col">Languages</th>
                            <th scope="col">Tags</th>
                            <th scope="col">Edit</th>
                            <th scope="col">Delete</th>
                        </thead>
                        <tbody>
                        </tbody>
                    </table>

                    <h4>Your Results</h4>
                    <table class="table">
                        <thead>
                            <th scope="col">ID</th>
                            <th scope="col">Questionnaire ID</th>
                            <th scope="col">Question ID</th>
                            <th scope="col">Answer</th>
                        </thead>
                        <tbody>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
