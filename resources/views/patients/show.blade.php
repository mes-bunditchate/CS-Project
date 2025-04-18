{{-- resources/views/patients/show.blade.php --}}
@extends('layouts.main')

@section('content')
    <header>
        <div class="d-flex justify-content-center align-items-center">
            <div class="text-center">
                <h1 class="text-3xl" >คลินิก</h1>
            </div>
            <div class="flex sm\:justify-between w-full ">
                <span class="text-left w-full ml-8">
                    <a class="app-button" href="{{ route('patients.edit', ['patient' => $patient->id]) }}">
                        &nbsp;Edit
                    </a>
                </span>
                <span class="text-right w-full mr-8">
                    <b>&nbsp;วันเกิด </b>
                    <a>&nbsp;{{ $patient->birthdate }}</a>
                    <b>&nbsp;No. </b>
                    <a>&nbsp;{{ $patient->id }}</a>
                </span>
            </div>
            <div class="flex sm\:justify-between w-full ">
                <span class="text-left w-full ml-8">
                    <b>&nbsp;ชื่อ-นามสกุล</b>
                    <a>&nbsp;{{ $patient->name }}</a>
                    <b>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;ชื่อเล่น</b>
                    <a>&nbsp;{{ $patient->nickname }}</a>
                </span>
                <span class="text-center w-full">
                    <b>&nbsp;อายุ</b>
                    <a>&nbsp;{{ $patient->age() }} ปี</a>
                </span>
                <span class="text-right w-full mr-8">
                    <b>&nbsp;ประวัติการแพ้ยา</b>
                    @if ($patient->allergies)
                        @foreach($patient->allergies as $allegy)
                            <a>&nbsp;{{ $allegy->allergy_name }}</a>
                        @endforeach
                    @endif 
                </span>
            </div>
            <div class="flex sm\:justify-between w-full ">
                <span class="text-left w-full ml-8">
                    <b>&nbsp;ที่อยู่</b>
                    <a>&nbsp;{{ $patient->address }}</a>
                </span>
                <span class="text-center w-full">
                    <b>&nbsp;อาชีพ</b>
                    <a>&nbsp;{{ $patient->occupation }}</a>
                </span>
                <span class="text-right w-full mr-8">
                    <b>&nbsp;โทรศัพท์</b>
                    <a>&nbsp;{{ $patient->phone }}</a>
                </span>
            </div>
        </div>
    </header>
    <hr> <!-- Horizontal line -->
    <main>
        <form action="{{ route('patients.records.store', ['patient' => $patient->id]) }}" method="post">
        @csrf
            <div class="grid-container">
                <div class="ml-4">
                    <p>
                        <b class="vertical-top">วันที่ </b>
                        <input class="ml-4" type="date" 
                        value="{{ \Carbon\Carbon::now()->toDateString() }}" 
                        name="record_date" id="record_date" required>
                    </p>
                    <p>
                        <b class="vertical-top">CC</b>
                        <textarea class="p-2 border-2 ml-4 border-gray-600" 
                        rows="1" cols="80" type="text" 
                        placeholder="Chief Complain"  
                        name="chief_complaint" 
                        id="chief_complaint" required></textarea>
                    </p>
                    <p>
                        <b class="vertical-top">PI</b> 
                        <textarea class="p-2 border-2 ml-4 border-gray-600" 
                        rows="8" cols="80" type="text" 
                        placeholder="Present Illness"  
                        name="present_illness" 
                        id="present_illness" required></textarea>
                    </p>
                </div>
                <div class="vertical-line h-full"></div> <!-- Vertical line -->
                <div class="ml-4">
                    <p class="flex sm\:justify-between">
                        <b class="text-left w-full">MSE</b>
                        <b class="text-right">BW</b>
                        <input class="p-2 border-2 ml-2 border-gray-600" 
                        size=2 type="text" placeholder="BW"  
                        name="body_weight" id="body_weight" required>
                        <b class="text-right">BP</b>
                        <input class="p-2 border-2 ml-2 border-gray-600" 
                        size=3 type="text" placeholder="BP"  
                        name="blood_pressure" id="blood_pressure" required>
                        <b class="text-right">P</b>
                        <input class="p-2 border-2 ml-2 mr-4 border-gray-600" 
                        size=1 type="text" placeholder="P"  
                        name="pulse" id="pulse" required>
                    </p>
                    <textarea class="p-2 border-2 ml-4 border-gray-600" 
                    rows="8" cols="80" type="text" 
                    placeholder="Mental Status Examination"  
                    name="mental_status_examination" 
                    id="mental_status_examination" required></textarea>
                    <p>
                        <b class="text-right">IMP</b>
                        <textarea class="p-2 border-2 ml-4 border-gray-600" 
                        rows="1" cols="75" type="text" 
                        placeholder="Impression"  
                        name="impression" 
                        id="impression" required></textarea>
                    </p>
                    <p>
                        <b class="text-right">ยา</b>
                    </p>

                    <!-- Medicines Picklist --> 
                    <div id="medicines-container">
                        <div class="medicine-item mb-3">
                            <div class="mb-3">
                                <select name="medicines[0][id]" class="form-control">
                                    <option value="">Select Medicine</option>
                                    @foreach($medicines as $medicine)
                                        <option value="{{ $medicine->id }}" {{ old('medicines.0.id') == $medicine->id ? 'selected' : '' }}>
                                            {{ $medicine->name }}
                                        </option>
                                    @endforeach
                                </select>
                                <input type="text" name="medicines[0][usage]" class="form-control" value="{{ old('medicines.0.usage') }}" placeholder="Medicine Usage">
                                <input type="number" step="1" name="medicines[0][usage_amount]" class="form-control" value="{{ old('mediciness.0.usage_amount') }}" placeholder="Medicine Amount">
                            </div>
                        </div>
                    </div>

                    <!-- Button to Add More Medicines -->
                    <button type="button" class="btn btn-secondary" id="add-medicine-btn">Add Another Medicine</button>
                    
                    <p>
                        <b class="text-right">นัด</b>
                        <input class="ml-4" type="datetime-local" value="{{ \Carbon\Carbon::now()->toDateString() }}" name="appointment_date" id="appointment_date" required>
                    </p>
                    <p>
                        <b class="text-right">ใบรับรองแพทย์</b>
                        <input class="p-2 border-2 ml-4 border-gray-600" type="text" placeholder="have/none" name="medical_certificate" id="medical_certificate" required>
                    </p>
                    <p>
                        <b class="text-right">ค่ารักษา</b>
                        <input type="number" step="1" class="p-2 border-2 ml-2 mr-4 border-gray-600" size=10 placeholder="ค่ารักษา"  name="treatment_costs" id="treatment_costs" required>
                        <b class="text-right">บาท</b>
                    </p>
                </div>
            </div>
            <div>
                <button type="submit" class="button color-violet">
                    Save Medical Record
                </button>
            </div>
        </form>
        <br>
        @if ($patient->medicalRecords)
            <section>
                @foreach($patient->medicalRecords->sortByDesc('record_date') as $record)
                <hr> <!-- Horizontal line -->
                <div class="grid-container">
                    <div class="ml-4">
                        <p>
                            <b class="vertical-top">วันที่ </b>
                            <a>&nbsp;{{ $record->record_date }}</a>
                        </p>
                        <p>
                            <b class="vertical-top">CC</b>
                            <a>&nbsp;{{ $record->chief_complaint }}</a>
                        </p>
                        <p>
                            <b class="vertical-top">PI</b> 
                            <a>&nbsp;{{ $record->present_illness }}</a>
                        </p>
                    </div>
                    <div class="vertical-line h-full"></div> <!-- Vertical line -->
                    <div class="ml-4">
                        <p class="flex sm\:justify-between">
                            <b class="text-left w-full">MSE</b>
                            <b class="text-right">BW</b>
                            <a>&nbsp;{{ $record->body_weight }}&nbsp;</a>
                            <b class="text-right">BP</b>
                            <a>&nbsp;{{ $record->blood_pressure }}&nbsp;</a>
                            <b class="text-right">P</b>
                            <a>&nbsp;{{ $record->pulse }}</a>
                        </p>
                        <a>{{ $record->mental_status_examination }}</a>
                        <p>
                            <b class="text-right">IMP</b>
                            <a>&nbsp;{{ $record->impression }}</a>
                        </p>
                        <p>
                        <b class="text-right">ยา</b>
                        </p>
                        @if ($record->medicines)
                            <section class="mx-16">
                                @foreach($record->medicines->sortByDesc('name') as $medicine)
                                    <div>
                                        {{ $medicine->name }}&nbsp;{{ $medicine->pivot->usage }}&nbsp;/&nbsp;{{ $medicine->pivot->usage_amount }}
                                    </div>
                                @endforeach
                            </section>
                        @endif
                        <p>
                            <b class="text-right">นัด</b>
                            <a>&nbsp;{{ $record->appointment_date }}</a>
                        </p>
                        <p>
                            <b class="text-right">ใบรับรองแพทย์</b>
                            <a>&nbsp;{{ $record->medical_certificate }}</a>
                        </p>
                        <p>
                            <b class="text-right">ค่ารักษา</b>
                            <a>&nbsp;{{ $record->treatment_costs }}</a>
                            <b class="text-right">&nbsp;บาท</b>
                        </p>
                    </div>
                </div>
                @endforeach
            </section>
        @endif    
    </main>
    <script>
        // JavaScript to dynamically add new condition fields
        document.getElementById('add-medicine-btn').addEventListener('click', function () {
            const container = document.getElementById('medicines-container');
            const medicineIndex = container.getElementsByClassName('medicine-item').length;

            const newMedicine = document.createElement('div');
            newMedicine.classList.add('medicine-item');

            newMedicine.innerHTML = `
                <div class="mb-3">
                    <select name="medicines[${medicineIndex}][id]" class="form-control">
                        <option value="">Select Medicine</option>
                        @foreach($medicines as $medicine)
                            <option value="{{ $medicine->id }}" {{ old('medicines.${medicineIndex}.id') == $medicine->id ? 'selected' : '' }}>
                                {{ $medicine->name }}
                            </option>
                        @endforeach
                    </select>
                    <input type="text" name="medicines[${medicineIndex}][usage]" class="form-control" value="{{ old('medicines.0.usage') }}" placeholder="Medicine Usage">
                    <input type="text" name="medicines[${medicineIndex}][usage_amount]" class="form-control" value="{{ old('medicines.0.usage_amount') }}" placeholder="Medicine Amount">
                </div>

            `;

            container.appendChild(newMedicine);
        });
    </script>
@endsection