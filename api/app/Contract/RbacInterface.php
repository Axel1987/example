<?php

namespace App\Contract;

use App\Role;
use App\User;

interface RbacInterface
{
    /**
     * Create the roles in the system
     * @return mixed
     */
    public function createRoles();

    /**
     * Create list of permissions in the system
     * 
     * @param User $user
     * @param Role $role
     * @return mixed
     */
    public function attachRole(User $user, Role $role);
}