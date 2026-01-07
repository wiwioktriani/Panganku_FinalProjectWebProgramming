@extends('layouts.app')

@section('content')
<div class="py-12">
    <div class="max-w-2xl mx-auto sm:px-6 lg:px-8">
        <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
            <div class="p-6 text-gray-900">
                <h2 class="text-2xl font-bold mb-6">{{ __('Tambah Donasi Baru') }}</h2>

                <form method="POST" action="{{ route('donations.store') }}" class="space-y-6">
                    @csrf

                    <div>
                        <x-input-label for="food_name" :value="__('Nama Makanan')" />
                        <x-text-input id="food_name" name="food_name" type="text" class="mt-1 block w-full" :value="old('food_name')" required autofocus />
                        <x-input-error :messages="$errors->get('food_name')" class="mt-2" />
                    </div>

                    <div>
                        <x-input-label for="food_category_id" :value="__('Kategori')" />
                        <select id="food_category_id" name="food_category_id" class="mt-1 block w-full border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm" required>
                            <option value="">{{ __('Pilih Kategori') }}</option>
                            @foreach ($categories as $category)
                                <option value="{{ $category->id }}" {{ old('food_category_id') == $category->id ? 'selected' : '' }}>
                                    {{ $category->name }}
                                </option>
                            @endforeach
                        </select>
                        <x-input-error :messages="$errors->get('food_category_id')" class="mt-2" />
                    </div>

                    <div>
                        <x-input-label for="quantity" :value="__('Jumlah')" />
                        <x-text-input id="quantity" name="quantity" type="number" min="1" class="mt-1 block w-full" :value="old('quantity')" required />
                        <x-input-error :messages="$errors->get('quantity')" class="mt-2" />
                    </div>

                    <div>
                        <x-input-label for="expired_at" :value="__('Tanggal Kadaluarsa')" />
                        <x-text-input id="expired_at" name="expired_at" type="date" class="mt-1 block w-full" :value="old('expired_at')" required />
                        <x-input-error :messages="$errors->get('expired_at')" class="mt-2" />
                    </div>

                    <div>
                        <x-input-label for="description" :value="__('Deskripsi')" />
                        <textarea id="description" name="description" rows="4" class="mt-1 block w-full border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm">{{ old('description') }}</textarea>
                        <x-input-error :messages="$errors->get('description')" class="mt-2" />
                    </div>

                    <div class="flex items-center gap-4">
                        <x-primary-button>{{ __('Simpan') }}</x-primary-button>
                        <a href="{{ route('donations.index') }}" class="text-sm text-gray-600 hover:text-gray-900">{{ __('Batal') }}</a>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection