<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Medicine extends Model
{
    use HasFactory;

    protected $fillable = ['name', 'sci_name','buy_price','sell_price','stock'];

    public function medicalRecords()
    {
        return $this->belongsToMany(MedicalRecord::class)
                    ->withPivot(['usage', 'usage_amount']);
    }

    public function purchaseRecords() {
        return $this->hasMany(PurchaseRecord::class);
    }
}
