{{-- resources/views/patients/index.blade.php --}}
@extends('layouts.main')

@section('content')
    <section class="mx-8">  
        <h1 class="text-center text-3xl mx-4 mt-6">
            Patient List
        </h1>
        <form action="{{ route('patients.index') }}" method="GET" class="ml-12">
            <input type="text" name="search" placeholder="Enter your search here..." value="{{ old('search', $searchQuery) }}">
            <button type="submit">Search</button>
        </form>
        <div class="table-container">
            <table>
                <thead>
                <tr>
                    <th class="py-3 px-6">No.</th>
                    <th class="py-3 px-6">Name</th>
                    <th class="py-3 px-6">Nickname</th>
                    <th class="py-3 px-6">Contact Number</th>
                </tr>
                </thead>
                <tbody>
                    @forelse ($patients as $patient)
                        <tr>
                            <td class="py-4 px-6">
                                <a href="{{ route('patients.show', ['patient' => $patient->id]) }}">{{ $patient->id }}</a>
                            </td>
                            <td class="py-4 px-6">
                                <a href="{{ route('patients.show', ['patient' => $patient->id]) }}">{{ $patient->name }}</a>
                            </td>
                            <td class="py-4 px-6">{{ $patient->nickname }}</td>
                            <td class="py-4 px-6">{{ $patient->phone }}</td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="4">No patients found.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
        &nbsp;
        <a href = "{{ route('patients.create') }}">New Patients</a>
    </section>


@endsection
