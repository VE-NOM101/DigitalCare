<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Medicine extends Model
{
    use HasFactory;
    public function medicine_categories(){
        return $this->belongsTo(MedicineCategory::class,'category_id','id');
    }
    public function medicine_brands(){
        return $this->belongsTo(MedicineBrand::class,'brand_id','id');
    }
    public function medicinePurchases()
    {
        return $this->belongsToMany(MedicinePurchase::class, 'medicine_purchase_pivot', 'medicine_id', 'medicine_purchase_id')
                    ->withPivot('amount', 'tax', 'lot_no', 'quantity');
    }
}
