<?php

namespace App\Service;

use App\Contract\RbacInterface;
use App\Role;
use App\User;

class RbacService implements RbacInterface
{
    /** List of roles with descriptions */
    protected $roles = [
        [
            'name' => Role::ROLE_ADMIN,
            'display_name' => 'System Administrator',
            'description' => 'User is allowed to manage any actions'
        ],
        [
            'name' => Role::ROLE_PARTNER,
            'display_name' => 'Talent partner',
            'description' => ''
        ],
        [
            'name' => Role::ROLE_CLIENT,
            'display_name' => 'Client',
            'description' => ''
        ]
    ];

    /** Create (Update) roles in the system */
    public function createRoles()
    {
        foreach ($this->roles as $role) {
            try {
                /** @var Role $model */
                $model = Role::where(['name' => $role['name']])->first();
                if($model){
                    $model->setRawAttributes($role);
                }else{
                    $model = new Role($role);
                }

                $model->save();
            } catch (\Exception $e) {
                echo $e->getMessage();
                return;
            }
        }
    }

    /**
     * Create list of permissions in the system
     *
     * @param User $user
     * @param Role $role
     * @return mixed
     */
    public function attachRole(User $user, Role $role)
    {
        $user->attachRole($role->toArray());
    }
}