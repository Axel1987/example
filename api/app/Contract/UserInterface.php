<?php

namespace App\Contract;


use App\Http\Request\Admin\CreateUserRequest;
use App\User;
use Illuminate\Http\Request;

interface UserInterface
{
    /**
     * Get list of users with pagination and user's roles
     *
     * @param Request $request
     * @param null $role
     * @return \Illuminate\Contracts\Pagination\LengthAwarePaginator
     */
    public function index(Request $request, $role = null);
        
    /** 
     * Get list of users with pagination and user's roles
     * 
     * @param Request $request
     * @param null $role
     * @return mixed
     */
    public function getListOfUsers(Request $request, $role = null);

    /**
     * Create new user
     * 
     * @param CreateUserRequest $request
     * @return mixed
     */
    public function create(CreateUserRequest $request);

    /** 
     * Edit user
     * 
     * @param User $user
     * @param Request $request
     * @return mixed
     */
    public function edit(User $user, Request $request);
}