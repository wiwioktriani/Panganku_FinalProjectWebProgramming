@extends('layouts.app')

@section('content')
<div class="py-12">
    <div class="max-w-6xl mx-auto sm:px-6 lg:px-8">
        <div class="bg-white shadow sm:rounded-lg p-6">

            {{-- Header --}}
            <div class="flex items-center justify-between mb-6">
                <h1 class="text-2xl font-bold text-gray-800">
                    All Users
                </h1>

                <a href="{{ route('users.create') }}"
                   class="inline-flex items-center px-4 py-2 bg-indigo-600
                          border border-transparent rounded-md font-semibold
                          text-sm text-white hover:bg-indigo-700
                          focus:outline-none focus:ring-2 focus:ring-indigo-500">
                    + Add New User
                </a>
            </div>

            {{-- Success Message --}}
            @if(session('success'))
                <div class="mb-6 rounded-md bg-green-100 p-4 text-sm text-green-700">
                    {{ session('success') }}
                </div>
            @endif

            {{-- Table --}}
            <div class="overflow-x-auto">
                <table class="min-w-full divide-y divide-gray-200">
                    <thead class="bg-gray-50">
                        <tr>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">
                                Name
                            </th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">
                                Email
                            </th>
                            <th class="px-6 py-3 text-center text-xs font-medium text-gray-500 uppercase">
                                Actions
                            </th>
                        </tr>
                    </thead>

                    <tbody class="bg-white divide-y divide-gray-200">
                        @forelse($users as $user)
                            <tr>
                                <td class="px-6 py-4 text-sm text-gray-900">
                                    {{ $user->name }}
                                </td>
                                <td class="px-6 py-4 text-sm text-gray-700">
                                    {{ $user->email }}
                                </td>
                                <td class="px-6 py-4 text-sm text-center space-x-2">

                                    {{-- Edit --}}
                                    <a href="{{ route('users.edit', $user) }}"
                                       class="inline-flex items-center px-3 py-1.5
                                              bg-yellow-500 text-white text-xs font-semibold
                                              rounded hover:bg-yellow-600">
                                        Edit
                                    </a>

                                    {{-- Delete --}}
                                    <form action="{{ route('users.destroy', $user) }}"
                                          method="POST"
                                          class="inline"
                                          onsubmit="return confirm('Delete this user?')">
                                        @csrf
                                        @method('DELETE')

                                        <button type="submit"
                                                class="inline-flex items-center px-3 py-1.5
                                                       bg-red-600 text-white text-xs font-semibold
                                                       rounded hover:bg-red-700">
                                            Delete
                                        </button>
                                    </form>

                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="3"
                                    class="px-6 py-4 text-center text-sm text-gray-500">
                                    No users found
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>

        </div>
    </div>
</div>
@endsection
