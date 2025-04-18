{{-- resources/views/patients/edit.blade.php --}}
@extends('layouts.main')

@section('content')
    <div class="max-w-2xl mx-auto mt-10 bg-white p-8 rounded-lg shadow-md">
        <h1 class="text-3xl font-semibold text-center text-violet-700 mb-8">
            Edit Patient
        </h1>

        {{-- Success Message --}}
        @if (session('success'))
            <div class="mb-4 text-green-600 bg-green-100 p-3 rounded-md">
                {{ session('success') }}
            </div>
        @endif

        {{-- Validation Errors --}}
        @if ($errors->any())
            <div class="mb-4 text-red-600 bg-red-100 p-3 rounded-md">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form action="{{ route('patients.update', ['patient' => $patient->id]) }}" method="post" class="space-y-6">
            @csrf
            @method('PUT')

            {{-- Name --}}
            <div>
                <label for="name" class="block text-sm font-medium text-gray-700 mb-1">Patient Name</label>
                <input 
                    type="text" 
                    id="name" 
                    name="name" 
                    value="{{ old('name', $patient->name) }}" 
                    placeholder="Enter Name" 
                    required 
                    class="w-full px-4 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-violet-500"
                >
            </div>

            {{-- Nickname --}}
            <div>
                <label for="nickname" class="block text-sm font-medium text-gray-700 mb-1">Nickname</label>
                <input 
                    type="text" 
                    id="nickname" 
                    name="nickname" 
                    value="{{ old('nickname', $patient->nickname) }}" 
                    placeholder="Enter Nickname" 
                    required 
                    class="w-full px-4 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-violet-500"
                >
            </div>

            {{-- Birthdate --}}
            <div>
                <label for="birthdate" class="block text-sm font-medium text-gray-700 mb-1">Birthday</label>
                <input 
                    type="date" 
                    id="birthdate" 
                    name="birthdate" 
                    value="{{ old('birthdate', $patient->birthdate) }}" 
                    required 
                    class="w-full px-4 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-violet-500"
                >
            </div>

            {{-- Address --}}
            <div>
                <label for="address" class="block text-sm font-medium text-gray-700 mb-1">Address</label>
                <input 
                    type="text" 
                    id="address" 
                    name="address" 
                    value="{{ old('address', $patient->address) }}" 
                    placeholder="Enter Address"
                    class="w-full px-4 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-violet-500"
                >
            </div>

            {{-- Drug Allergy --}}
            <div>
                <label for="allergy" class="block text-sm font-medium text-gray-700 mb-1">Drug Allergy</label>
                <input 
                    type="text" 
                    id="allergy" 
                    name="allergy" 
                    value="{{ old('allergy', $patient->allergy) }}" 
                    placeholder="Enter Drug Allergies"
                    class="w-full px-4 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-violet-500"
                >
            </div>

            {{-- Occupation --}}
            <div>
                <label for="occupation" class="block text-sm font-medium text-gray-700 mb-1">Occupation</label>
                <input 
                    type="text" 
                    id="occupation" 
                    name="occupation" 
                    value="{{ old('occupation', $patient->occupation) }}" 
                    placeholder="Enter Occupation"
                    class="w-full px-4 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-violet-500"
                >
            </div>

            {{-- Phone --}}
            <div>
                <label for="phone" class="block text-sm font-medium text-gray-700 mb-1">Phone Number</label>
                <input 
                    type="text" 
                    id="phone" 
                    name="phone" 
                    value="{{ old('phone', $patient->phone) }}" 
                    placeholder="Enter Phone Number"
                    class="w-full px-4 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-violet-500"
                >
            </div>

            {{-- Email --}}
            <div>
                <label for="email" class="block text-sm font-medium text-gray-700 mb-1">Email</label>
                <input 
                    type="text" 
                    id="email" 
                    name="email" 
                    value="{{ old('email', $patient->email) }}" 
                    placeholder="Enter Email"
                    class="w-full px-4 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-violet-500"
                >
            </div>

            {{-- Submit --}}
            <div class="text-center pt-4">
                <button 
                    type="submit" 
                    class="bg-violet-600 text-white px-6 py-2 rounded-md hover:bg-violet-700 transition duration-200"
                >
                    Update
                </button>
            </div>
        </form>
    </div>
@endsection

