@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-heading">Healthcare Contacts</div>
                <div class="panel-body">
                    <table class="table">
                        <thead>
                            <th scope="col">Name</th>
                            <th scope="col">Mobile</th>
                            <th scope="col">Landline</th>
                            <th scope="col">Company</th>
                        </thead>
                        <tbody>
                            <?php $configCount = 1; ?>
                            <?php foreach($healthcarecontacts as $healthcarecontact): ?>
                                <tr>
                                    <td><?php echo $healthcarecontact->name; ?></td>
                                    <td><?php echo $healthcarecontact->mobile; ?></td>
                                    <td><?php echo $healthcarecontact->landline; ?></td>
                                    <td><?php echo $healthcarecontact->company; ?></td>
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