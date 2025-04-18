<?php

namespace App\Http\Controllers;

use App\Models\Medicine;
use App\Models\MedicalRecord;
use App\Models\PurchaseRecord;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class MedicineController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $searchQuery = $request->get('search');
        $medicines = Medicine::when($searchQuery, function ($query) use ($searchQuery) {
            return $query->where(function ($query) use ($searchQuery) {
                $query->where('name', 'like', '%' . $searchQuery . '%')
                      ->orWhere('sci_name', 'like', '%' . $searchQuery . '%');
            });
        })->orderBy('sci_name', 'asc')->orderBy('name', 'asc')->get();
        return view("medicines.index" , compact('medicines', 'searchQuery')); 
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('medicines.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $medicine = new Medicine();
        $medicine->name = $request->input('name');
        $medicine->sci_name = $request->input('sci_name');
        $medicine->buy_price = $request->input('buy_price');
        $medicine->sell_price = $request->input('sell_price');
        $medicine->stock = 0;
        $medicine->save();
        return redirect()->route('medicines.index');
    }

    /**
     * Display the specified resource.
     */
    public function show(Medicine $medicine)
    {
        return view('medicines.show', ['medicine' => $medicine]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Medicine $medicine)
    {
        return view('medicines.edit', ['medicine' => $medicine]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Medicine $medicine)
    {
        $medicine->name = $request->input('name');
        $medicine->sci_name = $request->input('sci_name');
        $medicine->buy_price = $request->input('buy_price');
        $medicine->sell_price = $request->input('sell_price');
        $medicine->save();
        return redirect()->route('medicines.show', ['medicine' => $medicine->id]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Medicine $medicine)
    {
        $name = $request->input('name');
        if ($name == $medicine->name) {
            $medicine->delete();
            return redirect()->route('medicines.index');
        }
        return redirect()->back();
    }

    public function addStock(Request $request, Medicine $medicine)
    {
        $record = new PurchaseRecord();
        $record->record_date = $request->get('record_date');
        $record->purchase_amount = $request->get('purchase_amount');
        $record->expiration_date = $request->get('expiration_date');
        $record->purchase_price = $request->get('purchase_price');
        $medicine->purchaseRecords()->save($record);
        $medicine->stock += $record->purchase_amount;
        $medicine->save();
        return redirect()->route('medicines.index');
    }
}
