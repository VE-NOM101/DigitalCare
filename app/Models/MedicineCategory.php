<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class MedicineCategory extends Model
{
    use HasFactory;
    protected $table='medicine_categories';

    public function medicines(){
        return $this->hasMany(Medicine::class,'category_id','id');
    }
    
}
