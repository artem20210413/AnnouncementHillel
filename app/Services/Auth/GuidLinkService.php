<?php


namespace App\Services\Auth;


use App\Models\GuidUser;
use App\Models\User;

class GuidLinkService
{

    public function createGuid(User $user): string
    {
        $this->deactivationGuidUser($user);
        $guid = $this->generationGuid();
        $guidUser = new GuidUser();
        $guidUser->userId = $user->id;
        $guidUser->guid = $guid;
        $guidUser->save();

        return $guid;
    }

    public function deactivationGuidUser(User $user)
    {
        if (($guidUSer = GuidUser::where('userId', $user->id)->where('active', 1)->first())) {
            $guidUSer->active = 0;
            $guidUSer->save();
        }
    }

    private function generationGuid(): string
    {
        $guid = uniqid() . uniqid() . uniqid();
        if (GuidUser::where('guid', $guid)->first() != null)
            $this->generationGuid();

        return $guid;
    }

    public function checkGuid($guid)
    {
        $guidUser = GuidUser::where('guid', $guid)->first();

        if ($guidUser == null || $guidUser->active == 0) {

            return null;
        }

        $user = User::find($guidUser->userId);

        if ($guidUser->created_at->diffInHours(now()) > 2) {
            $this->deactivationGuidUser($user);

            return null;
        }

        return $user;
    }


}
