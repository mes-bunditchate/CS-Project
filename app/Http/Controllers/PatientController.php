<?php

namespace App\Http\Controllers;

use App\Models\Patient;
use App\Models\Medicine;
use App\Models\Allergy;
use App\Models\MedicalRecord;
use App\Models\MedicineUsage;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class PatientController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $searchQuery = $request->get('search');
        $patients = Patient::when($searchQuery, function ($query) use ($searchQuery) {
            return $query->where(function ($query) use ($searchQuery) {
                $query->where('name', 'like', '%' . $searchQuery . '%')
                      ->orWhere('nickname', 'like', '%' . $searchQuery . '%')
                      ->orWhere('id', 'like', '%' . $searchQuery . '%');
            });
        })->get();
        return view("patients.index" , compact('patients', 'searchQuery')); 
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('patients.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $patient = new Patient();
        $patient->name = $request->input('name');
        $patient->nickname = $request->input('nickname');
        $patient->birthdate = $request->input('birthdate');
        $patient->address = $request->input('address');
        $patient->occupation = $request->input('occupation');
        $patient->phone = $request->input('phone');
        $patient->email = $request->input('email');
        $patient->save();
        $patient->allergies()->create([
            'allergy_name' => $request->input('allergy'),
        ]);
        return redirect()->route('patients.show', ['patient' => $patient->id]);
    }

    /**
     * Display the specified resource.
     */
    public function show(patient $patient)
    {
        $medicines = Medicine::orderBy('name', 'asc')->get();
        return view('patients.show', ['patient' => $patient] , compact('medicines'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(patient $patient)
    {
        return view('patients.edit', ['patient' => $patient]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, patient $patient)
    {
        $patient->name = $request->input('name');
        $patient->nickname = $request->input('nickname');
        $patient->birthdate = $request->input('birthdate');
        $patient->address = $request->input('address');
        $patient->occupation = $request->input('occupation');
        $patient->phone = $request->input('phone');
        $patient->email = $request->input('email');
        $patient->save();
        $patient->allergies()->delete();
        $patient->allergies()->create([
            'allergy_name' => $request->input('sallergy'),
        ]);
        return redirect()->route('patients.show', ['patient' => $patient->id]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(patient $patient)
    {
        $name = $request->input('name');
        if ($name == $patient->name) {
            $patient->delete();
            return redirect()->route('patients.index');
        }
        return redirect()->back();
    }

    public function storeRecord(Request $request, patient $patient)
    {
        $record = new MedicalRecord();
        $record->record_date = $request->get('record_date');
        $record->chief_complaint = $request->get('chief_complaint');
        $record->present_illness = $request->get('present_illness');
        $record->mental_status_examination = $request->get('mental_status_examination');
        $record->body_weight = $request->get('body_weight');
        $record->blood_pressure = $request->get('blood_pressure');
        $record->pulse = $request->get('pulse');
        $record->impression = $request->get('impression');
        $record->treatment_costs = $request->get('treatment_costs');
        $record->appointment_date = $request->get('appointment_date');
        $record->medical_certificate = $request->get('medical_certificate');
        $patient->medicalRecords()->save($record);
        foreach ($request->input('medicines') as $medicineData) {
            $record->medicines()->attach($medicineData['id'],
                ['usage' => $medicineData['usage'],
                'usage_amount' => $medicineData['usage_amount']]
            );
        }
        return redirect()->route('patients.show', ['patient' => $patient]);
    }
}
