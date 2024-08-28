<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Experience extends Model
{
    use HasFactory, SoftDeletes;
    protected $fillable = ['profile_id', 'title', 'position', 'description'];

    public function experience(){
        return $this->belongsTo(Profile::class, 'profile_id', 'id');
    }
}
