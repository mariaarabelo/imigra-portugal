<?php

namespace App\Policies;

use App\Models\Author;
use App\Models\User;
use App\Models\Content;

class ContentPolicy
{
    /**
     * Create a new policy instance.
     */
    public function __construct()
    {
        //
    }

    public function update(User $user, Content $content)
    {
        return Author::where('iduser', $user->id)
            ->where('idcontent', $content->id)
            ->exists();
    }

    public function delete(User $user, Content $content)
    {
        return Author::where('iduser', $user->id)
            ->where('idcontent', $content->id)
            ->exists();
    }
}
