@extends('layouts.app')
@section('content')

<div class="container mt-5">
    <h2>Date Range Pickers</h2>
    <div class="row">
        <form action="{{ route('sales.dateFilter') }}" method="POST" class="row g-3">
            @csrf
            <div class="col-md-4 mb-3">
                <label for="startDate" class="form-label">Start Date:</label>
                <input type="date" class="form-control" id="startDate" name="startDate">
            </div>
            <div class="col-md-4 mb-3">
                <label for="endDate" class="form-label">End Date:</label>
                <input type="date" class="form-control" id="endDate" name="endDate">
            </div>
            <div class="col-md-4 mb-3">
                <button type="submit" class="btn btn-primary">Submit</button>
            </div>
        </form>
       
    </div>
</div>

<div class="container mt-5">
    <h1>Sales Table </h1>
    <div class="col-md-4 mb-3">
        <a href="{{route('sales.index')}}" class="btn btn-primary">Show All</a>
    </div>
    <table class="table">
        <thead>
            <tr>
                <th scope="col">SN</th>
                <th scope="col">User</th>
                <th scope="col">Amount</th>
                <th scope="col">Commission</th>
            </tr>
        </thead>
        <tbody>
            @php $sn = 1 @endphp
            @foreach($sales as $sale)
            <tr>
                <th scope="row">{{$sn}}</th>
                <td>{{$sale["user_name"]}}</td>
                <td>{{$sale["total"]}}</td>
                <td>{{$sale["commission"]}}</td>
                @php $sn++ @endphp
            </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection
