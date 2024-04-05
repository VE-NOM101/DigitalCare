<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Block;
class Department extends Model
{
    use HasFactory;
    public function blocks(){
        return $this->belongsTo(Block::class,'block_id','id');
    }

    public function doctors(){
        return $this->hasMany(Department::class,'department_id','id');
    }
}
