<?php

namespace App\Http\Controllers\Admin;


use App\Contract\UserInterface;
use App\Http\Controllers\Controller;
use App\Http\Request\Admin\CreateUserRequest;
use App\Http\Request\Admin\EditUserRequest;
use App\Service\UserService;
use App\User;
use Auth;
use Illuminate\Http\Request;

class UsersController extends Controller
{
    /** @var  UserService $userService */
    protected $userService;

    /**
     * UsersController constructor.
     */
    public function __construct()
    {
        $this->userService = app()->make(UserInterface::class);
    }

    /**
     * @SWG\Get(
     *     tags={"ADMIN:: User's methods"},
     *     path="/admin/users",
     *     summary="",
     *     description="",
     *     produces={"application/json"},
     *     security={{"Bearer":{}}},
     *     @SWG\Response(
     *      response="200",
     *      description="User's data"
     *     )
     * )
     */
    /**
     * @param Request $request
     * @return mixed
     */
    public function index(Request $request)
    {
        return $this->userService->index($request);
    }

    /**
     * @SWG\Get(
     *     tags={"ADMIN:: User's methods"},
     *     path="/admin/users/list",
     *     summary="",
     *     description="",
     *     produces={"application/json"},
     *     security={{"Bearer":{}}},
     *     @SWG\Parameter(
     *          name="role",
     *          type="string",
     *          in="query",
     *          description="User's role",
     *          required=true,
     *     ),
     *     @SWG\Response(
     *      response="200",
     *      description="User's data"
     *     )
     * )
     */
    /**
     * @param Request $request
     * @return mixed|void
     */
    public function getList(Request $request)
    {
        return $this->userService->getListOfUsers($request);
    }

    /**
     * @SWG\Post(
     *     tags={"ADMIN:: User's methods"},
     *     path="/admin/users",
     *     summary="Add new user",
     *     description="",
     *     produces={"application/json"},
     *     security={{"Bearer":{}}},
     *     @SWG\Parameter(
     *          name="data",
     *          in="body",
     *          description="User's data",
     *          required=true,
     *          @SWG\Schema(
     *              type="object",
     *              @SWG\Property(property="name", type="string", default="" ),
     *              @SWG\Property(property="email", type="string", default="" ),
     *              @SWG\Property(property="phone", type="string", default="" ),
     *              @SWG\Property(property="user_role", type="object",
     *                  @SWG\Property(property="role_id", type="integer", default="" ),
     *              ),
     *          ),
     *     ),
     *     @SWG\Response(
     *      response="200",
     *      description="User's data"
     *     )
     * )
     */
    /**
     * @param CreateUserRequest $request
     * @return mixed
     */
    public function create(CreateUserRequest $request)
    {
        return $this->userService->create($request);
    }

    /**
     * @SWG\Put(
     *     tags={"ADMIN:: User's methods"},
     *     path="/admin/users/{id}",
     *     summary="Edit user",
     *     description="",
     *     produces={"application/json"},
     *     security={{"Bearer":{}}},
     *     @SWG\Parameter(
     *          name="id",
     *          type="integer",
     *          in="path",
     *          description="User's id",
     *          required=true,
     *     ),
     *     @SWG\Parameter(
     *          name="data",
     *          in="body",
     *          description="User's data",
     *          required=true,
     *          @SWG\Schema(
     *              type="object",
     *              @SWG\Property(property="name", type="string", default="" ),
     *              @SWG\Property(property="email", type="string", default="" ),
     *              @SWG\Property(property="phone", type="string", default="" ),
     *              @SWG\Property(property="user_role", type="object",
     *                  @SWG\Property(property="role_id", type="integer", default="" ),
     *              ),
     *          ),
     *     ),
     *     @SWG\Response(
     *      response="200",
     *      description="User's data"
     *     )
     * )
     */
    /**
     * @param User $user
     * @param EditUserRequest $request
     * @return mixed
     */
    public function edit(User $user, EditUserRequest $request)
    {
        return $this->userService->edit($user, $request);
    }
}