<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;

class Patient extends Model
{
    use HasFactory;

    protected $fillable = ['name', 'nickname','birthdate','address','email','occupation', 'phone'];

    public function age()
    {
        return Carbon::parse($this->attributes['birthdate'])->age;
    }

    public function medicalRecords() {
        return $this->hasMany(MedicalRecord::class);
    }

    public function allergies()
    {
        return $this->hasMany(Allergy::class);
    }

}
