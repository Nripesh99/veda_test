@extends('layouts.app')
@section('content')
<div class="container mt-5">
    <h1 class="" style="margin-top:7rem;">Individual Sales</h1>
    <table class="table">
        <thead class="thead-dark">
            <tr>
                <th>ID</th>
                <th>Name</th>
                <th>Amount</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            @foreach($sales as $item)
            <tr>
                <td>{{ $item['id'] }}</td>
                <td>{{ $item['name'] }}</td>
                <td>Rs.{{ $item['amount'] }}</td>
                <td>
                    {{-- <a href="{{ route('sales.edit', ['id' => $item['id']]) }}" class="btn btn-primary">Edit</a> --}}
                    <form method="post" action="{{ route('sales.delete', ['id' => $item['id']]) }}" style="display: inline;">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-danger" onclick="return confirm('Are you sure you want to delete?')">Delete</button>
                    </form>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection