{{-- resources/views/medicines/create.blade.php --}}
@extends('layouts.main')

@section('content')
    <div class="max-w-2xl mx-auto mt-10 bg-white p-8 rounded-lg shadow-md">
        <h1 class="text-3xl font-semibold text-center text-violet-700 mb-8">
            Create New Medicine
        </h1>

        <form action="{{ route('medicines.store') }}" method="post" class="space-y-6">
            @csrf

            {{-- Medicine Name --}}
            <div>
                <label for="name" class="block text-sm font-medium text-gray-700 mb-1">Medicine Name</label>
                <input 
                    type="text" 
                    id="name" 
                    name="name" 
                    required 
                    placeholder="Enter Medicine Name"
                    class="w-full px-4 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-2 focus:ring-violet-500"
                >
            </div>

            {{-- Scientific Name --}}
            <div>
                <label for="sci_name" class="block text-sm font-medium text-gray-700 mb-1">Scientific Name</label>
                <input 
                    type="text" 
                    id="sci_name" 
                    name="sci_name" 
                    required 
                    placeholder="Enter Scientific Name"
                    class="w-full px-4 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-2 focus:ring-violet-500"
                >
            </div>

            {{-- Buy Price --}}
            <div>
                <label for="buy_price" class="block text-sm font-medium text-gray-700 mb-1">Buy Price</label>
                <input 
                    type="number" 
                    id="buy_price" 
                    name="buy_price" 
                    min="0"
                    placeholder="Enter Buy Price"
                    class="w-full px-4 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-2 focus:ring-violet-500"
                >
            </div>

            {{-- Sell Price --}}
            <div>
                <label for="sell_price" class="block text-sm font-medium text-gray-700 mb-1">Sell Price</label>
                <input 
                    type="number" 
                    id="sell_price" 
                    name="sell_price" 
                    min="0"
                    placeholder="Enter Sell Price"
                    class="w-full px-4 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-2 focus:ring-violet-500"
                >
            </div>

            {{-- Submit Button --}}
            <div class="text-center pt-4">
                <button 
                    type="submit" 
                    class="bg-violet-600 text-white px-6 py-2 rounded-md hover:bg-violet-700 transition duration-200"
                >
                    Create
                </button>
            </div>
        </form>
    </div>
@endsection