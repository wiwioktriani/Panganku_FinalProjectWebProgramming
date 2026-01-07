@extends('layouts.app')

@section('content')
<div class="py-12">
    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
        <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
            <div class="p-6 text-gray-900">
                <h1 class="text-3xl font-bold mb-4">{{ __('Selamat Datang, :name!', ['name' => auth()->user()->name]) }}</h1>
                <p class="text-lg text-gray-600 mb-8">Kelola donasi dan permintaan makanan di Panganku.</p>

                <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                    <!-- Donasi -->
                    <div class="bg-white border border-gray-200 rounded-lg p-6 hover:shadow-md transition-shadow">
                        <h3 class="text-xl font-semibold mb-2">{{ __('Donasi Makanan') }}</h3>
                        <p class="text-gray-600 mb-4">Kelola donasi makanan yang tersedia.</p>
                        <a href="{{ route('donations.index') }}" class="text-indigo-600 hover:text-indigo-800 font-medium">
                            Lihat Donasi →
                        </a>
                    </div>

                    <!-- Permintaan -->
                    <div class="bg-white border border-gray-200 rounded-lg p-6 hover:shadow-md transition-shadow">
                        <h3 class="text-xl font-semibold mb-2">{{ __('Permintaan Makanan') }}</h3>
                        <p class="text-gray-600 mb-4">Lihat dan kelola permintaan makanan.</p>
                        <a href="{{ route('requests.index') }}" class="text-indigo-600 hover:text-indigo-800 font-medium">
                            Lihat Permintaan →
                        </a>
                    </div>

                    <!-- Kategori (Admin Only) -->
                    @if(auth()->user()->role === 'admin')
                    <div class="bg-white border border-gray-200 rounded-lg p-6 hover:shadow-md transition-shadow">
                        <h3 class="text-xl font-semibold mb-2">{{ __('Kategori Makanan') }}</h3>
                        <p class="text-gray-600 mb-4">Kelola kategori untuk organisasi lebih baik.</p>
                        <a href="{{ route('categories.index') }}" class="text-indigo-600 hover:text-indigo-800 font-medium">
                            Lihat Kategori →
                        </a>
                    </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>
@endsection