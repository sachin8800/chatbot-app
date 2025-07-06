
@extends('layouts.app')

@section('content')
<div class="container">
    <h2 class="mb-4">Add New Customer</h2>

    @if($errors->any())
        <div class="alert alert-danger">
            <strong>Oops!</strong> Please fix the following issues:
            <ul>
                @foreach($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif                                                                                  

    <form action="{{ route('customers.store') }}" method="POST">
        @csrf

        <div class="row mb-3">
            <div class="col">
                <label>First Name</label>
                <input type="text" name="first_name" class="form-control" required>
            </div>
            <div class="col">
                <label>Last Name</label>
                <input type="text" name="last_name" class="form-control" required>
            </div>
        </div>

        <div class="row mb-3">
            <div class="col">
                <label>Age</label>
                <input type="number" name="age" class="form-control" required>
            </div>
            <div class="col">
                <label>Date of Birth</label>
                <input type="date" name="dob" class="form-control" required>
            </div>
        </div>

        <div class="mb-3">
            <label>Email</label>
            <input type="email" name="email" class="form-control" required>
        </div>

        <button class="btn btn-success">Save Customer</button>
        <a href="{{ route('customers.index') }}" class="btn btn-secondary">Back</a>
    </form>
</div>
@endsection
