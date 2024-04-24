@extends('layouts.app')
@section('content')
<style>
</style>
<div class="container-fluid mt-5">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <h1 class="text-center">Edit User</h1>
                <div class="card-body">
                    <form method="POST" action="{{ route('users.update', $user->id) }}">
                        <h1>Edit user</h1>
                        @csrf
                        @method('PUT')

                        <!-- Name -->
                        <div class="mb-3">
                            <label for="name" class="form-label">{{ __('Name') }}</label>
                            <input id="name" type="text" class="form-control" name="name" value="{{ $user->name }}" required autofocus autocomplete="name">
                            @error('name')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                            @enderror
                        </div>

                        <!-- Email Address -->
                        <div class="mb-3">
                            <label for="email" class="form-label">{{ __('Email') }}</label>
                            <input id="email" type="email" class="form-control" name="email" value="{{ $user->email }}" required autocomplete="email">
                            @error('email')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                            @enderror
                        </div>

                        <!-- Parent ID -->
                        <input type="hidden" name="parent_id" value="{{ $user->parent_id }}">

                        <div class="d-flex justify-content-center">
                            <button class="btn btn-primary" type="submit">Update</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
