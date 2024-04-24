@extends('layouts.app')
@section('content')
    <div class="container" style="margin-top:7rem;">
        <h2>Date Range Pickers</h2>
        <div class="row">
            <form action="{{ route('sales.dateFilter') }}" method="POST">
                @csrf
                <div class="col-md-4 mb-3">
                    <label for="startDate">Start Date:</label>
                    <input type="date" class="form-control" id="startDate" name="startDate">
                </div>
                <div class="col-md-4 mb-3">
                    <label for="endDate">End Date:</label>
                    <input type="date" class="form-control" id="endDate" name="endDate">
                </div>
                <div class="col-md-4 mb-3">
                <button type="submit" class="btn btn-primary">Submit</button>
                </div>
            </form>

        </div>
    </div>
@endsection
