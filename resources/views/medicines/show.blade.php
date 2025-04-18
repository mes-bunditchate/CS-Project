{{-- resources/views/medicines/show.blade.php --}}
@extends('layouts.main')

@section('content')
    <div class="max-w-3xl mx-auto mt-10 bg-white p-8 rounded-lg shadow-md">
        {{-- Header --}}
        <h1 class="text-3xl font-semibold text-center text-violet-700 mb-6">
            {{ $medicine->name }}
        </h1>

        {{-- Medicine Info --}}
        <div class="space-y-4 mb-6">
            <div>
                <label class="block text-sm font-medium text-gray-700">Medicine Name</label>
                <p class="text-lg text-gray-800">{{ $medicine->name }}</p>
            </div>
            <div>
                <label class="block text-sm font-medium text-gray-700">Scientific Name</label>
                <p class="text-lg text-gray-800">{{ $medicine->sci_name }}</p>
            </div>
            <div>
                <a 
                    href="{{ route('medicines.edit', ['medicine' => $medicine->id]) }}"
                    class="inline-block mt-4 px-4 py-2 bg-yellow-500 text-white rounded hover:bg-yellow-600 transition duration-200"
                >
                    Edit
                </a>
            </div>
        </div>

        <hr class="my-8 border-gray-300">

        {{-- Add Stock Form --}}
        <h2 class="text-2xl font-semibold text-violet-600 mb-4">Add Stock</h2>

        <form action="{{ route('medicines.addStock', ['medicine' => $medicine->id]) }}" method="post" class="space-y-6">
            @csrf

            {{-- Purchase Date --}}
            <div>
                <label for="record_date" class="block text-sm font-medium text-gray-700 mb-1">Purchase Date</label>
                <input 
                    type="date" 
                    id="record_date" 
                    name="record_date" 
                    value="{{ \Carbon\Carbon::now()->toDateString() }}"
                    required 
                    class="w-full px-4 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-violet-500"
                >
            </div>

            {{-- Purchase Amount --}}
            <div>
                <label for="purchase_amount" class="block text-sm font-medium text-gray-700 mb-1">Quantity</label>
                <input 
                    type="number" 
                    id="purchase_amount" 
                    name="purchase_amount" 
                    step="1" 
                    required 
                    placeholder="จำนวน"
                    class="w-full px-4 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-violet-500"
                >
            </div>

            {{-- Expiration Date --}}
            <div>
                <label for="expiration_date" class="block text-sm font-medium text-gray-700 mb-1">Expiration Date</label>
                <input 
                    type="date" 
                    id="expiration_date" 
                    name="expiration_date" 
                    required 
                    class="w-full px-4 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-violet-500"
                >
            </div>

            {{-- Purchase Price --}}
            <div>
                <label for="purchase_price" class="block text-sm font-medium text-gray-700 mb-1">Price (Baht)</label>
                <input 
                    type="number" 
                    id="purchase_price" 
                    name="purchase_price" 
                    step="1" 
                    required 
                    placeholder="ราคา"
                    class="w-full px-4 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-violet-500"
                >
            </div>

            {{-- Submit --}}
            <div class="text-center pt-2">
                <button 
                    type="submit" 
                    class="bg-violet-600 text-white px-6 py-2 rounded hover:bg-violet-700 transition duration-200"
                >
                    Add Stock
                </button>
            </div>
        </form>
    </div>
@endsection
