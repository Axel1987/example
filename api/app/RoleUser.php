<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class RoleUser extends Model
{
    protected $table = 'role_user';

    protected $hidden = ['created_at', 'updated_at'];
    
    public function role()
    {
        return $this->belongsTo(Role::class, 'role_id', 'id');
    }
}
