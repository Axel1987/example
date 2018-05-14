<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class PartnerCandidate extends Model
{
    protected $fillable = ['name', 'email', 'phone', 'resume'];

    protected $hidden = ['created_at', 'updated_at'];
}
