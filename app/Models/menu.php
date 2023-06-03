<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class menu extends Model
{
    use HasFactory;
    protected $fillable = ['title','parent_id'];

    public function childs() {
        return $this->hasMany(menu::class,'parent_id','id');
    }
}
