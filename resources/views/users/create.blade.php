@extends('layouts.app')

@section('title', 'Create User')

@section('content')
<div class="container mt-4 ml-96" style="margin-left: 20%; width: 70%;">
    <h2>Create User</h2>

    <form action="{{ route('users.store') }}" method="POST">
        @csrf
        <div class="mb-3">
            <label for="name" class="form-label">Name</label>
            <input type="text" id="name" name="name" class="form-control" required>
        </div>
        <div class="mb-3">
            <label for="email" class="form-label">Email</label>
            <input type="email" id="email" name="email" class="form-control" required>
        </div>


        <div class="mb-3">
            <label for="password" class="form-label">Password</label>
            <input type="password" id="password" name="password" class="form-control" required>
        </div>
        
        <div class="mb-3">
            <label for="password_confirmation" class="form-label">Confirm Password</label>  
        <button type="submit" class="btn btn-primary">Create</button>
    </form>
</div>
@endsection
