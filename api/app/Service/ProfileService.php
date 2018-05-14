<?php

namespace App\Service;

use App\Contract\ProfileInterface;
use App\Http\Request\EditProfileRequest;
use App\User;

class ProfileService implements ProfileInterface
{
    /**
     * View current user profile
     * 
     * @return \Illuminate\Contracts\Auth\Authenticatable|null
     */
    public function view()
    {
        $user = auth()->user();

        return User::where(['id' => $user->id])
            ->with('userRole.role')
            ->first();
    }

    /**
     * Edit current user profile
     * 
     * @param EditProfileRequest $request
     * @param string $link
     * @return mixed
     */
    public function edit(EditProfileRequest $request, $link = null)
    {
        /** @var User $user */
        $user = auth()->user();
        $data = $request->all();
        if($link){
            $data['avatar'] = $link;
        }
        
        $user->update($data);

        return User::where(['id' => $user->id])
            ->with('userRole.role')
            ->first();
    }

    /**
     * Drop record of user
     * 
     * @return \Illuminate\Contracts\Routing\ResponseFactory|\Symfony\Component\HttpFoundation\Response
     */
    public function delete()
    {
        /** @var User $user */
        $user = auth()->user();
        $user->delete();
        
        return response('', 204);
    }
}