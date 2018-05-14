<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Candidate extends Model
{
    protected $fillable = ['name', 'email', 'phone', 'resume'];
    
    protected $hidden = ['created_at', 'updated_at'];
}
