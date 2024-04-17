<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Prescription extends Model
{
    use HasFactory;
    public function medicines()
    {
        return $this->belongsToMany(Medicine::class, 'medicine_prescription', 'prescription_id', 'medicine_id')->withPivot('notes');
    }
    public function diagnoses()
    {
        return $this->belongsToMany(DiagnosisCategory::class, 'diagnosis_prescription', 'prescription_id','diagnosis_id');
    }
}
