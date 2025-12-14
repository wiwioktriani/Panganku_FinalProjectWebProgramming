@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Food Categories</h1>

    <a href="{{ route('categories.create') }}" class="btn btn-primary mb-3">
        Add Category
    </a>

    {{-- Flash messages --}}
    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    @if(session('error'))
        <div class="alert alert-danger">{{ session('error') }}</div>
    @endif

    <table class="table table-striped table-hover">
        <thead>
            <tr>
                <th>Name</th>
                <th>Description</th>
                <th width="150">Actions</th>
            </tr>
        </thead>
        <tbody>
            @forelse($categories as $category)
                <tr>
                    <td>{{ $category->name }}</td>
                    <td>{{ $category->description ?? '-' }}</td>
                    <td>
                        <a href="{{ route('categories.edit', $category) }}"
                           class="btn btn-warning btn-sm">Edit</a>

                        <form action="{{ route('categories.destroy', $category) }}"
                              method="POST"
                              style="display:inline;"
                              onsubmit="return confirm('Delete this category?')">
                            @csrf
                            @method('DELETE')
                            <button class="btn btn-danger btn-sm">Delete</button>
                        </form>
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="3" class="text-center">
                        No categories found
                    </td>
                </tr>
            @endforelse
        </tbody>
    </table>
</div>
@endsection
