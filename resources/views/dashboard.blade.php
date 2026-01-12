@extends('layouts.app')

@section('content')
<div class="py-12">
    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
        <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
            <div class="p-6 text-gray-900">

                <h1 class="text-3xl font-bold mb-4">
                    {{ __('Selamat Datang, :name!', ['name' => auth()->user()->name]) }}
                </h1>

                @php
                    // Hitung jumlah permintaan baru untuk donasi milik user login
                    $pendingCount = \App\Models\FoodRequest::whereHas('foodDonation', function ($q) {
                        $q->where('user_id', auth()->id());
                    })->where('status', 'pending')->count();
                @endphp

                @if($pendingCount > 0)
                    <p class="text-red-600 font-bold mb-4">
                        🔔 {{ $pendingCount }} permintaan baru untuk donasi Anda
                    </p>
                @endif

                <p class="text-lg text-gray-600 mb-8">
                    Kelola donasi dan permintaan makanan di Panganku.
                </p>

                <div class="grid grid-cols-1 md:grid-cols-3 gap-6">

                    <!-- Donasi -->
                    <div class="bg-green-50 border border-green-200 rounded-xl p-6
                                hover:shadow-lg transition">
                        <div class="flex items-center justify-between mb-4">
                            <h3 class="text-xl font-semibold text-green-800">
                                Donasi Makanan
                            </h3>
                            <div class="p-3 bg-green-100 rounded-lg">
                                <!-- Icon: Gift -->
                                <svg xmlns="http://www.w3.org/2000/svg"
                                     class="h-6 w-6 text-green-700"
                                     fill="currentColor"
                                     viewBox="0 0 24 24">
                                    <path d="M2.25 7.5A.75.75 0 013 6.75h18a.75.75 0 01.75.75v2.25a.75.75 0 01-.75.75h-.75v8.25a2.25 2.25 0 01-2.25 2.25H6a2.25 2.25 0 01-2.25-2.25V10.5H3a.75.75 0 01-.75-.75V7.5z"/>
                                    <path d="M12 6.75c-.72 0-1.39-.38-1.77-.99-.38-.62-.41-1.38-.08-2.02.33-.64.98-1.04 1.69-1.04s1.36.4 1.69 1.04c.33.64.3 1.4-.08 2.02-.38.61-1.05.99-1.77.99z"/>
                                </svg>
                            </div>
                        </div>

                        <p class="text-green-700 mb-4">
                            Kelola donasi makanan yang tersedia.
                        </p>

                        <a href="{{ route('donations.index') }}"
                           class="text-green-700 font-medium hover:underline">
                            Lihat Donasi →
                        </a>
                    </div>

                    <!-- Permintaan -->
                    <div class="bg-blue-50 border border-blue-200 rounded-xl p-6
                                hover:shadow-lg transition">
                        <div class="flex items-center justify-between mb-4">
                            <h3 class="text-xl font-semibold text-blue-800">
                                Permintaan Makanan
                            </h3>
                            <div class="p-3 bg-blue-100 rounded-lg">
                                <!-- Icon: Clipboard -->
                                <svg xmlns="http://www.w3.org/2000/svg"
                                     class="h-6 w-6 text-blue-700"
                                     fill="currentColor"
                                     viewBox="0 0 24 24">
                                    <path d="M9 2.25a.75.75 0 00-.75.75v.75H6a2.25 2.25 0 00-2.25 2.25v13.5A2.25 2.25 0 006 21.75h12A2.25 2.25 0 0020.25 19.5V6A2.25 2.25 0 0018 3.75h-2.25V3a.75.75 0 00-.75-.75H9z"/>
                                </svg>
                            </div>
                        </div>

                        <p class="text-blue-700 mb-4">
                            Pantau status permintaan makanan.
                        </p>

                        <a href="{{ route('requests.index') }}"
                           class="text-blue-700 font-medium hover:underline">
                            Lihat Permintaan →
                        </a>
                    </div>

                    <!-- Kategori -->
                    @if(auth()->user()->role === 'admin')
                    <div class="bg-purple-50 border border-purple-200 rounded-xl p-6
                                hover:shadow-lg transition">
                        <div class="flex items-center justify-between mb-4">
                            <h3 class="text-xl font-semibold text-purple-800">
                                Kategori Makanan
                            </h3>
                            <div class="p-3 bg-purple-100 rounded-lg">
                                <!-- Icon: Tag -->
                                <svg xmlns="http://www.w3.org/2000/svg"
                                     class="h-6 w-6 text-purple-700"
                                     fill="currentColor"
                                     viewBox="0 0 24 24">
                                    <path d="M2.25 6a.75.75 0 01.75-.75h6.75a.75.75 0 01.53.22l10.5 10.5a.75.75 0 010 1.06l-4.5 4.5a.75.75 0 01-1.06 0L4.72 11.03a.75.75 0 01-.22-.53V6z"/>
                                </svg>
                            </div>
                        </div>

                        <p class="text-purple-700 mb-4">
                            Kelola kategori makanan.
                        </p>

                        <a href="{{ route('categories.index') }}"
                           class="text-purple-700 font-medium hover:underline">
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