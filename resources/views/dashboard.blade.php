@extends('layouts.app')

@section('content')
<div class="py-12">
    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">

        {{-- Flash messages --}}
        @if(session('success'))
            <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded mb-4">
                {{ session('success') }}
            </div>
        @endif

        @if(session('error'))
            <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded mb-4">
                {{ session('error') }}
            </div>
        @endif

        <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-6">
                <h5 class="text-lg font-semibold mb-2">Food Donations</h5>
                <p class="mb-4">Manage all food donations.</p>
                <a href="{{ route('donations.index') }}" class="inline-block bg-blue-600 text-white px-4 py-2 rounded hover:bg-blue-700">View Donations</a>
            </div>

            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-6">
                <h5 class="text-lg font-semibold mb-2">Food Requests</h5>
                <p class="mb-4">Check and manage your food requests.</p>
                <a href="{{ route('requests.index') }}" class="inline-block bg-blue-600 text-white px-4 py-2 rounded hover:bg-blue-700">View Requests</a>
            </div>

            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-6">
                <h5 class="text-lg font-semibold mb-2">Food Categories</h5>
                <p class="mb-4">Manage food categories.</p>
                <a href="{{ route('categories.index') }}" class="inline-block bg-blue-600 text-white px-4 py-2 rounded hover:bg-blue-700">View Categories</a>
            </div>
        </div>

    </div>
</div>
@endsection
