<h2 class="navbar text-2xl mt-6 font-semibold text-gray-800">
    <nav class="flex flex-wrap items-center justify-start space-x-6 ml-12">
        <a href="{{ route('patients.index') }}" class="text-blue-600 hover:text-blue-800 transition duration-200">Patients List</a>
        <span class="text-gray-400">|</span>
        <a href="{{ route('medicines.index') }}" class="text-blue-600 hover:text-blue-800 transition duration-200">Medicines Stock</a>
        <span class="text-gray-400">|</span>
        <a href="{{ url('/calendar') }}" class="text-blue-600 hover:text-blue-800 transition duration-200">Calendar</a>
    </nav>
</h2>