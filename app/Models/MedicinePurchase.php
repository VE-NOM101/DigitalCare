<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MedicinePurchase extends Model
{
    use HasFactory;
    public function medicines()
    {
        return $this->belongsToMany(Medicine::class, 'medicine_purchase_pivot', 'medicine_purchase_id', 'medicine_id')
            ->withPivot('amount', 'tax', 'lot_no', 'quantity');
    }
}
