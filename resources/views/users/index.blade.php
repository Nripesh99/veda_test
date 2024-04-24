@extends('layouts.app')

@section('content')
<div class="container mt-5">
    <h2  style="margin-top:7rem;">User List </h2>
<a href="{{route('users.add')}}" class="btn btn-primary">Add users</a>
    <table class="table table-striped">
        <thead>
            <tr>
                <th>ID</th>
                <th>Name</th>
                <th>Image</th>
                <th>Email</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($users as $users)
            <tr>
                <td>{{ $users->id }}</td>
                <td>{{ $users->name }}</td>
                <td><img class="img-fluid" src="{{ url('/images/' . $users->image) }}" alt="Image" style="width:100px; height100px;" /></td>
                <td>{{ $users->email }}</td>
                <td>
                    <a href="{{ route('users.edit', $users->id) }}" class="btn btn-primary btn-sm">Edit</a>
                    <form action="{{ route('users.destroy', $users->id) }}" method="POST" style="display: inline;">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Are you sure you want to delete?')">Delete</button>
                    </form>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection
