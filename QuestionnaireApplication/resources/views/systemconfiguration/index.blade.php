@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-heading">System Configuration</div>
                <div class="panel-body">
                    <a href="{{ URL::previous() }}" class="btn btn-default">Back</a>
                    <table>
                        <thead>
                            <th>No.</th>
                            <th>Attribute Name</th>
                            <th>Edit</th>
                            <th>Delete</th>
                        </thead>
                        <tbody>
                            <?php $configCount = 1; ?>
                            <?php foreach($attributes as $attribute): ?>
                                <tr>
                                    <td><?php echo $configCount++; ?></td>
                                    <td><?php echo $attribute->attributename; ?></td>
                                    <td><a href="/{{ $attribute->id }}/edit">Edit<a></td>
                                </tr>
                            <?php endforeach; ?>
                            <tr>
                                <td><?php echo $configCount++; ?></td>
                                <td>Languages</td>
                                <td><a href="/langauges/">Edit<a></td>
                            </tr>
                            <tr>
                                <td><?php echo $configCount++; ?></td>
                                <td>Tags</td>
                                <td><a href="/tags/">Edit<a></td>
                            </tr>
                            <tr>
                                <td><?php echo $configCount++; ?></td>
                                <td>Users</td>
                                <td><a href="systemconfiguration/{{ $attribute->id }}/show">Edit<a></td>
                            </tr>
                            <tr>
                                <td><?php echo $configCount++; ?></td>
                                <td>Healthcare Workers</td>
                                <td><a href="systemconfiguration/{{ $attribute->id }}/show">Edit<a></td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection