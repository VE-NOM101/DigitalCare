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
}
