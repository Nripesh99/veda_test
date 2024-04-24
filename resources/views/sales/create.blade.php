@extends('layouts.app')
@section('content')
<h1 class="mt-5">Add Amount</h1>
<form method="POST" action="{{route('sales.store')}}">
    @csrf
    <div class="mb-3">
        <label for="userSelect" class="form-label">Select User</label>
        <select class="form-select" id="userSelect" name="user">
            <option selected disabled>Select User</option>
            @foreach($user as $users)
            <option value={{$users->id}}>{{$users->name}}</option>
            @endforeach
            <!-- Add more options as needed -->
        </select>
    </div>
    <div class="mb-3">
        <label for="amountInput" class="form-label">Amount</label>
        <input type="text" class="form-control" id="amountInput" name="amount" placeholder="Enter amount">
    </div>
    <button type="submit" class="btn btn-primary">Add Amount</button>
</form>
@endsection 