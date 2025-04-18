<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class MedicalRecord extends Model
{

    public function patient() {
        return $this->belongsTo(Patient::class);
    }
    
    public function medicines() {
        return $this->belongsToMany(Medicine::class)
                    ->withPivot(['usage', 'usage_amount']);
    }
}
