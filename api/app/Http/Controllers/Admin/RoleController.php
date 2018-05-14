<?php

namespace App\Http\Controllers\Admin;


use App\Http\Controllers\Controller;
use App\Role;

class RoleController extends Controller
{
    public function index()
    {
        return Role::all();
    }
}