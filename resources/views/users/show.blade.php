@extends('layouts.app')

@section('content')
<div class="container">
    <h1>User Details</h1>

    <div class="card mb-3">
        <div class="card-body">
            <h5 class="card-title">{{ $user->name }}</h5>
            <p class="card-text"><strong>Email:</strong> {{ $user->email }}</p>
            <p class="card-text"><strong>Created At:</strong> {{ $user->created_at->format('d M Y H:i') }}</p>
            <p class="card-text"><strong>Updated At:</strong> {{ $user->updated_at->format('d M Y H:i') }}</p>
        </div>
    </div>

    <a href="{{ route('users.index') }}" class="btn btn-secondary">Back to Users</a>
    <a href="{{ route('users.edit', $user) }}" class="btn btn-primary">Edit User</a>
</div>
@endsection