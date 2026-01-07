@extends('layouts.app')

@section('content')
<div class="container">
    <h1 class="mb-4">{{ __('app.food_donation_details') }}</h1>

    <div class="card shadow-sm mb-4">
        <div class="card-body">
            <h5 class="card-title">{{ $donation->food_name }}</h5>

            <p class="card-text">
                <strong>{{ __('app.category') }}:</strong> {{ $donation->category->name ?? '-' }}
            </p>

            <p class="card-text">
                <strong>{{ __('app.quantity') }}:</strong> {{ $donation->quantity }}
            </p>

            <p class="card-text">
                <strong>{{ __('app.expiration_date') }}:</strong>
                {{ $donation->expired_at->format('d M Y') }}
            </p>

            <p class="card-text">
                <strong>{{ __('app.status') }}:</strong>
                @if($donation->status === 'active')
                    <span class="text-green-600 font-semibold">{{ __('app.active') }}</span>
                @else
                    <span class="text-red-600 font-semibold">{{ __('app.inactive') }}</span>
                @endif
            </p>

            <p class="card-text">
                <strong>{{ __('app.description') }}:</strong> {{ $donation->description ?? '-' }}
            </p>

            <p class="card-text">
                <strong>{{ __('app.created_by') }}:</strong> {{ $donation->user->name ?? '-' }}
            </p>

            <p class="card-text">
                <strong>{{ __('app.created_at') }}:</strong>
                {{ $donation->created_at->format('d M Y H:i') }}
            </p>
        </div>
    </div>

    <div class="flex space-x-2">
        <a href="{{ route('donations.index') }}"
           class="bg-gray-500 hover:bg-gray-700 text-white font-bold py-2 px-4 rounded">
            {{ __('app.back_to_list') }}
        </a>

        @if($donation->user_id === auth()->id())
            <a href="{{ route('donations.edit', $donation->id) }}"
               class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">
                {{ __('app.edit') }}
            </a>

            <form action="{{ route('donations.destroy', $donation->id) }}" method="POST"
                  onsubmit="return confirm('{{ __('app.are_you_sure') }}');">
                @csrf
                @method('DELETE')
                <button type="submit"
                        class="bg-red-500 hover:bg-red-700 text-white font-bold py-2 px-4 rounded">
                    {{ __('app.delete') }}
                </button>
            </form>
        @endif
    </div>
</div>
@endsection