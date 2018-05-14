<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Role extends Model
{
    const ROLE_ADMIN = 'admin';
    const ROLE_PARTNER = 'partner';
    const ROLE_CLIENT = 'client';
    
    protected $fillable = ['name', 'display_name', 'description'];

    protected $hidden = ['created_at', 'updated_at'];
}
