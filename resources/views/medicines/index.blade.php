{{-- resources/views/medicines/index.blade.php --}}
@extends('layouts.main')

@section('content')
    <section class="mx-8">  
        <h1 class="text-center text-3xl mx-4 mt-6">
            Medicine Stock
        </h1>
        <form action="{{ route('medicines.index') }}" method="GET" class="ml-12">
            <input type="text" name="search" placeholder="Enter your search here..." value="{{ old('search', $searchQuery) }}">
            <button type="submit">Search</button>
        </form>
        <div class="table-container">
            <table>
                <thead>
                <tr>
                    <th class="py-3 px-6">Scientific Name</th>
                    <th class="py-3 px-6">Medicine Name</th>
                    <th class="py-3 px-6">Buy Price (Baht)</th>
                    <th class="py-3 px-6">Sell Price (Baht)</th>
                    <th class="py-3 px-6">Stock</th>
                </tr>
                </thead>
                <tbody>
                @foreach ($medicines as $medicine)
                    <tr>
                        <td class="py-4 px-6">
                            <a href="{{ route('medicines.show', ['medicine' => $medicine->id]) }}">{{ $medicine->sci_name }}</a>
                        </td>
                        <td class="py-4 px-6">
                            <a href="{{ route('medicines.show', ['medicine' => $medicine->id]) }}">{{ $medicine->name }}</a>
                        </td>
                        <td class="py-4 px-6">{{ $medicine->buy_price }}</td>
                        <td class="py-4 px-6">{{ $medicine->sell_price }}</td>
                        <td class="py-4 px-6">{{ $medicine->stock }} </td>
                    </tr>
                @endforeach
                </tbody>
            </table>
        </div>
        &nbsp;
        <a href = "{{ route('medicines.create') }}">New Medicine</a>
    </section>
    


@endsection
