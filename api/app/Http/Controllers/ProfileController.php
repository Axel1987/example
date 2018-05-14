<?php

namespace App\Http\Controllers;


use App\Contract\ProfileInterface;
use App\Contract\UploadInterface;
use App\Http\Request\EditProfileRequest;
use App\Service\ProfileService;
use App\Service\UploadService;
use App\User;
use Symfony\Component\HttpFoundation\File\UploadedFile;

class ProfileController extends Controller
{
    /** @var  ProfileService $profileService */
    protected $profileService;
    
    /** @var  UploadService $uploadService */
    protected $uploadService;

    /**
     * ProfileController constructor
     */
    public function __construct()
    {
        $this->profileService = app()->make(ProfileInterface::class);
        $this->uploadService = app()->make(UploadInterface::class);
    }


    /**
     * @SWG\Get(
     *     tags={"AUTHENTICATED USERS:: Profile methods"},
     *     path="/profile",
     *     summary="View profile of current user",
     *     description="View profile of current user",
     *     produces={"application/json"},
     *     security={{"Bearer":{}}},
     *     @SWG\Response(
     *      response="200",
     *      description="User's data"
     *     )
     * )
     */
    /**
     * @return \Illuminate\Contracts\Auth\Authenticatable|null
     */
    public function view()
    {
        return $this->profileService->view();
    }

    /**
     * @SWG\Post(     
     *     tags={"AUTHENTICATED USERS:: Profile methods"},
     *     path="/profile/{id}",
     *     summary="Edit profile of current user",
     *     description="Edit profile of current user",
     *     consumes={"multipart/form-data"},
     *     produces={"application/json"},
     *     @SWG\Parameter(
     *         description="Avatar Image",
     *         in="formData",
     *         name="avatar_image",
     *         required=false,
     *         type="file"
     *     ),
     *     @SWG\Parameter(
     *         description="User name",
     *         in="formData",
     *         name="name",
     *         required=true,
     *         type="string"
     *     ),
     *     @SWG\Parameter(
     *         description="User avatar (link)",
     *         in="formData",
     *         name="avatar",
     *         required=false,
     *         type="string"
     *     ),
     *     @SWG\Parameter(
     *         description="User email",
     *         in="formData",
     *         name="email",
     *         required=true,
     *         type="string"
     *     ),
     *     @SWG\Parameter(
     *         description="User phone",
     *         in="formData",
     *         name="phone",
     *         required=true,
     *         type="string"
     *     ),
     *     @SWG\Response(
     *      response="200",
     *      description="User data"
     *     )
     * )
     */
    /**
     * @param User $user
     * @param EditProfileRequest $request
     * @return mixed
     */
    public function edit(User $user, EditProfileRequest $request)
    {
        /** @var UploadedFile $file */
        $file = $request->avatar_image;        
        $link = $file ? $this->uploadService->uploadAvatar($file) : null;
        
        return $this->profileService->edit($request, $link);
    }

    /**
     * @SWG\Delete(
     *     tags={"AUTHENTICATED USERS:: Profile methods"},
     *     path="/profile",
     *     summary="Drop user's record",
     *     description="Drop user's record",
     *     produces={"application/json"},
     *     security={{"Bearer":{}}},
     *     @SWG\Response(
     *      response="204",
     *      description="Confirmation of removal"
     *     )
     * )
     */
    public function delete()
    {
        return $this->profileService->delete();
    }
}