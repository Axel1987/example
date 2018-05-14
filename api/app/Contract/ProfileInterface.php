<?php

namespace App\Contract;


use App\Http\Request\EditProfileRequest;

interface ProfileInterface
{
    /**
     * View current user profile
     *
     * @return \Illuminate\Contracts\Auth\Authenticatable|null
     */
    public function view();

    /**
     * Edit current user profile
     *
     * @param EditProfileRequest $request
     * @param string $link
     * @return mixed
     */
    public function edit(EditProfileRequest $request, $link);
    
    /**
     * Drop record of user
     *
     * @return \Illuminate\Contracts\Routing\ResponseFactory|\Symfony\Component\HttpFoundation\Response
     */
    public function delete();
}