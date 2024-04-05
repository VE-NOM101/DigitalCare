<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Department;

class Block extends Model
{
    use HasFactory;
    public function departments()
    {
        return $this->hasMany(Department::class,'block_id', 'id');
    }
}
