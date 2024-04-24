@extends('layouts.app')
@section('content')
<div class="container mt-5">
    <h1 class="" style="margin-top:7rem;">Add Amount</h1>
    <form method="POST" action="{{route('sales.store')}}" class="row g-3">
        @csrf
        <div class="col-md-6">
            <label for="userSelect" class="form-label">Select User</label>
            <select class="form-select" id="userSelect" name="user" aria-label="Select User">
                <option selected disabled>Select User</option>
                @foreach($user as $users)
                <option value="{{$users->id}}">{{$users->name}}</option>
                @endforeach
                <!-- Add more options as needed -->
            </select>
        </div>
        <div class="col-md-6">
            <label for="amountInput" class="form-label">Amount</label>
            <input type="text" class="form-control" id="amountInput" name="amount" placeholder="Enter amount">
        </div>
        <div class="col-12">
            <button type="submit" class="btn btn-primary">Add Amount</button>
        </div>
    </form>
</div>
@endsection
