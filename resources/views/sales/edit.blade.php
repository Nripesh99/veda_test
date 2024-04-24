@extends('layouts.app')

@section('content')
<div class="container mt-5">
    <h1 class="" style="margin-top:7rem;">Edit Amount</h1>
    <form method="POST" action="{{ route('sales.update', $sale->id) }}" class="row g-3">
        @csrf
        @method('PUT')
        <div class="col-md-6">
            <label for="userSelect" class="form-label">User</label>
            <input type="text" class="form-control" id="userSelect" value="{{ $sale->user->name }}" readonly>
        </div>
        <div class="col-md-6">
            <label for="amountInput" class="form-label">Amount</label>
            <input type="text" class="form-control" id="amountInput" name="amount" value="{{ $sale->amount }}" placeholder="Enter amount">
        </div>
        <div class="col-12">
            <button type="submit" class="btn btn-primary">Update Amount</button>
        </div>
    </form>
</div>
@endsection
