@extends('layouts.app')

@section('content')
<div class="py-12">
    <div class="max-w-3xl mx-auto sm:px-6 lg:px-8">
        <div class="bg-white shadow sm:rounded-lg p-6">

            <h1 class="text-2xl font-bold text-gray-800 mb-6">
                Edit User
            </h1>

            {{-- Error Messages --}}
            @if ($errors->any())
                <div class="mb-6 rounded-md bg-red-100 p-4">
                    <ul class="list-disc list-inside text-sm text-red-700">
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <form action="{{ route('users.update', $user) }}" method="POST" class="space-y-4">
                @csrf
                @method('PUT')

                {{-- Name --}}
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1">
                        Name
                    </label>
                    <input type="text"
                           name="name"
                           value="{{ old('name', $user->name) }}"
                           required
                           class="w-full rounded-md border-gray-300 shadow-sm
                                  focus:border-indigo-500 focus:ring-indigo-500">
                </div>

                {{-- Email --}}
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1">
                        Email
                    </label>
                    <input type="email"
                           name="email"
                           value="{{ old('email', $user->email) }}"
                           required
                           class="w-full rounded-md border-gray-300 shadow-sm
                                  focus:border-indigo-500 focus:ring-indigo-500">
                </div>

                {{-- Password --}}
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1">
                        Password
                        <span class="text-xs text-gray-500">
                            (Leave blank if not changing)
                        </span>
                    </label>
                    <input type="password"
                           name="password"
                           class="w-full rounded-md border-gray-300 shadow-sm
                                  focus:border-indigo-500 focus:ring-indigo-500">
                </div>

                {{-- Confirm Password --}}
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1">
                        Confirm Password
                    </label>
                    <input type="password"
                           name="password_confirmation"
                           class="w-full rounded-md border-gray-300 shadow-sm
                                  focus:border-indigo-500 focus:ring-indigo-500">
                </div>

                {{-- Buttons --}}
                <div class="flex items-center gap-4 pt-4">
                    <button type="submit"
                            class="inline-flex items-center px-4 py-2 bg-indigo-600
                                   border border-transparent rounded-md font-semibold
                                   text-sm text-white hover:bg-indigo-700
                                   focus:outline-none focus:ring-2 focus:ring-indigo-500">
                        Update User
                    </button>

                    <a href="{{ route('users.index') }}"
                       class="text-sm text-gray-600 hover:text-gray-900">
                        Back
                    </a>
                </div>
            </form>

        </div>
    </div>
</div>
@endsection