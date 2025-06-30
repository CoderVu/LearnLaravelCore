@extends('layouts.app')

@section('content')
<div class="d-flex justify-content-between align-items-center mb-4">
    <h1>Users</h1>
    <a href="{{ route('users.create') }}" class="btn btn-primary">Add New User</a>
</div>

<div class="card">
    <div class="card-body">
        <table class="table table-striped">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Name</th>
                    <th>Email</th>
                    <th>Created At</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                @foreach($users as $userData)
                <tr>
                    <td>{{ $userData['id'] }}</td>
                    <td>{{ $userData['name'] }}</td>
                    <td>{{ $userData['email'] }}</td>
                    <td>{{ $userData['created_at'] }}</td>
                    <td>
                        <a href="{{ route('users.show', $userData['original']->id) }}" class="btn btn-sm btn-info">View</a>
                        <a href="{{ route('users.edit', $userData['original']->id) }}" class="btn btn-sm btn-warning">Edit</a>
                        <form action="{{ route('users.destroy', $userData['original']->id) }}" method="POST" class="d-inline">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-sm btn-danger" onclick="return confirm('Are you sure?')">Delete</button>
                        </form>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>
@endsection