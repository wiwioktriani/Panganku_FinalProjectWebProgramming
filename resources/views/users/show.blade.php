@extends('layouts.app')

@section('content')
<div class="py-12">
    <div class="max-w-4xl mx-auto sm:px-6 lg:px-8">
        <div class="bg-white shadow sm:rounded-lg p-6">

            {{-- Title --}}
            <h1 class="text-2xl font-bold text-gray-800 mb-6">
                User Details
            </h1>

            {{-- User Card --}}
            <div class="border border-gray-200 rounded-lg p-6 mb-6">
                <div class="space-y-3">
                    <div>
                        <p class="text-sm text-gray-500">Name</p>
                        <p class="text-lg font-semibold text-gray-800">
                            {{ $user->name }}
                        </p>
                    </div>

                    <div>
                        <p class="text-sm text-gray-500">Email</p>
                        <p class="text-gray-700">
                            {{ $user->email }}
                        </p>
                    </div>

                    <div>
                        <p class="text-sm text-gray-500">Created At</p>
                        <p class="text-gray-700">
                            {{ $user->created_at->format('d M Y H:i') }}
                        </p>
                    </div>

                    <div>
                        <p class="text-sm text-gray-500">Updated At</p>
                        <p class="text-gray-700">
                            {{ $user->updated_at->format('d M Y H:i') }}
                        </p>
                    </div>
                </div>
            </div>

            {{-- Actions --}}
            <div class="flex items-center space-x-3">
                <a href="{{ route('users.index') }}"
                   class="inline-flex items-center px-4 py-2
                          bg-gray-300 text-gray-800 text-sm font-semibold
                          rounded-md hover:bg-gray-400">
                    Back to Users
                </a>

                <a href="{{ route('users.edit', $user) }}"
                   class="inline-flex items-center px-4 py-2
                          bg-indigo-600 text-white text-sm font-semibold
                          rounded-md hover:bg-indigo-700">
                    Edit User
                </a>
            </div>

        </div>
    </div>
</div>
@endsection