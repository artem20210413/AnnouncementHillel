<?php


namespace App\Services\Auth;


use App\Models\GuidUser;
use App\Models\User;

class GuidLink
{

    public function createGuid(User $user): string
    {
        $guid = $this->generationGuid();

        $guidUser = new GuidUser();
        $guidUser->userId = $user->id;
        $guidUser->guid = $guid;

        return $guid;
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
        if ($guidUser == null && $guidUser->created_at->diffInHours(now()) > 2) {

            return false;
        } else {
            $guidUser->active = 0;
            $guidUser->seve();

            return true;
        }
    }


}
