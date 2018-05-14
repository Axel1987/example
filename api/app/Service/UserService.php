<?php

namespace App\Service;

use App\Contract\UserInterface;
use App\Http\Request\Admin\CreateUserRequest;
use App\Role;
use App\User;
use Illuminate\Http\Request;

class UserService implements UserInterface
{
    /**
     * Get list of users with pagination and user's roles
     *
     * @param Request $request
     * @param null $role
     * @return \Illuminate\Contracts\Pagination\LengthAwarePaginator
     */
    public function index(Request $request, $role = null)
    {
        $query = User::with('rating');
        
        if($role){
            $query->whereHas('userRole', function ($roleQuery) use ($role) {
                $roleQuery->whereHas('role', function ($q) use ($role){
                    $q->where(['name' => $role]);
                });
            });
        }else{
            $query->with(['userRole' => function ($roleQuery) {
                $roleQuery->with('role');
            }]);
        }
        
        return $query->orderBy('id')->paginate(10);
    }

    /**
     * Get list of users with pagination and user's roles
     *
     * @param Request $request
     * @param null $role
     * @return mixed
     */
    public function getListOfUsers(Request $request, $role = null)
    {
        $role = $role ? $role : $request->get('role');
        
        if($role == Role::ROLE_ADMIN){
            return [];
        }

        return User::whereHas('userRole', function ($roleQuery) use ($role) {
            $roleQuery->whereHas('role', function ($q) use ($role){
                $q->where(['name' => $role]);
            });
        })->get();
    }

    /**
     * Create new user
     *
     * @param CreateUserRequest $request
     * @return mixed
     */
    public function create(CreateUserRequest $request)
    {
        $userRole = $request->get('user_role');
        $role = Role::find($userRole['role_id']);
        
        $user = new User($request->all());
        $user->password = bcrypt($user->password);
        $user->save();
        
        $user->attachRole($role->toArray());

        return User::where(['id' => $user->id])
            ->with(['userRole' => function ($roleQuery) {
                $roleQuery->with('role');
            }])
            ->first();
    }

    /**
     * Edit user
     *
     * @param User $user
     * @param Request $request
     * @return mixed
     */
    public function edit(User $user, Request $request)
    {        
        $userRole = $request->get('user_role');
        $data = $request->all();
        
        if(!empty($data['password'])){
            $data['password'] = bcrypt($data['password']);
        }
        
        $user->update($data);
        
        $role = Role::find($userRole['role_id']);
        $currentRole = $user->userRole()->with('role')->first();
        
        $user->detachRoles($currentRole->toArray());
        $user->attachRole($role->toArray());
        
        return User::where(['id' => $user->id])
            ->with(['userRole' => function ($roleQuery) {
                $roleQuery->with('role');
            }])
            ->first();
    }
}