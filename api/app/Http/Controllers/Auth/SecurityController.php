<?php

namespace App\Http\Controllers\Auth;


use App\Http\Controllers\Controller;
use App\Http\Request\SignInRequest;
use App\Http\Request\SignUpRequest;
use App\Role;
use App\User;
use Auth;
use Illuminate\Contracts\Auth\Guard;
use JWTAuth;
use Tymon\JWTAuth\Exceptions\JWTException;

class SecurityController extends Controller
{
    /**
     * @var Guard
     */
    private $guard;

    public function __construct()
    {

        $this->guard = \Auth::guard('api');
    }

    /**
     * @SWG\Post(
     *     tags={"Authentications methods"},
     *     path="/sign-in",
     *     summary="Sign in user in the system",
     *     description="Sign in user in the system",
     *     produces={"application/json"},
     *     @SWG\Parameter(
     *          name="data",
     *          in="body",
     *          description="Data for sign in",
     *          required=true,
     *          @SWG\Schema(
     *              type="object",
     *                   @SWG\Property(property="email", type="string", default="" ),
     *                   @SWG\Property(property="password", type="string", default="" ),
     *          ),
     *     ),
     *     @SWG\Response(
     *      response="200",
     *      description="User's data"
     *     )
     * )
     */
    /**
     * @param SignInRequest $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function signIn(SignInRequest $request)
    {
        $credentials = $request->all();
        
        if (!User::where(['email' => $credentials['email']])->first()){
            return response()->json([
                'message' => 'The given data was invalid.',
                'errors' => [
                    'email' => ['Email is wrong']
                ]
            ], 401);
        }

        try {
            if (! $token = JWTAuth::attempt($credentials)) {
                return response()->json([
                    'message' => 'The given data was invalid.',
                    'errors' => [
                        'password' => ['Password is wrong']
                    ]
                ], 401);
            }
        } catch (JWTException $e) {
            return response()->json(['message' => 'Could not create token'], 500);
        }

        $user = User::where(['id' => Auth::user()->id])
                    ->with(['userRole' => function ($roleQuery) {
                    $roleQuery->with('role');
                }])
                ->first();
        $user->token = $token;

        return response()->json($user);
    }

    /**
     * @SWG\Get(
     *     tags={"Authentications methods"},
     *     path="/refresh-token",
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
     * @return mixed
     */
    public function refreshToken()
    {
        return $refreshed = JWTAuth::setToken(JWTAuth::getToken())->refresh();
    }

    /**
     * @SWG\Post(
     *     tags={"Authentications methods"},
     *     path="/sign-up",
     *     summary="Sign up user in the system (Client only!!)",
     *     description="Sign up user in the systemm",
     *     produces={"application/json"},
     *     @SWG\Parameter(
     *          name="data",
     *          in="body",
     *          description="Data for sign up",
     *          required=true,
     *          @SWG\Schema(
     *              type="object",
     *                   @SWG\Property(property="name", type="string", default="" ),
     *                   @SWG\Property(property="company", type="string", default="" ),
     *                   @SWG\Property(property="email", type="string", default="" ),
     *                   @SWG\Property(property="phone", type="string", default="" ),
     *                   @SWG\Property(property="password", type="string", default="" ),
     *                   @SWG\Property(property="password_confirmation", type="string", default="" ),
     *          ),
     *     ),
     *     @SWG\Response(
     *      response="200",
     *      description="User's data"
     *     )
     * )
     */
    /**
     * @param SignUpRequest $request
     * @return User
     */
    public function signUp(SignUpRequest $request)
    {
        $data = $request->all();
        $role = $model = Role::where(['name' => 'client'])->first();
        
        $data['password'] = bcrypt($data['password']);
        
        $user = new User($data);
        $user->save();

        $user->attachRole($role->toArray());
        
        return $user;
    }
}