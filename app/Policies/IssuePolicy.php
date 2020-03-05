<?php

namespace App\Policies;

use App\Issue;
use App\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class IssuePolicy
{
    use HandlesAuthorization;

    /**
     * Determine whether the user can view the issue.
     *
     * @param  \App\User $user
     * @param  \App\Issue $issue
     * @return mixed
     */
    public function view(User $user, Issue $issue)
    {
        return true;
    }

    /**
     * Determine whether the user can create issues.
     *
     * @param  \App\User $user
     * @return mixed
     */
    public function create(User $user)
    {
        return true;
    }

    /**
     * Determine whether the user can update the issue.
     *
     * @param  \App\User $user
     * @param  \App\Issue $issue
     * @return bool
     */
    public function update(User $user, Issue $issue)
    {
        if($user->hasRole('supervisor')){
            return true;
        }

        if ($issue->status->name === 'closed') {
            return false;
        }

        return $user->id === $issue->createdBy->id;
    }

    /**
     * Determine whether the user can delete the issue.
     *
     * @param  \App\User $user
     * @param  \App\Issue $issue
     * @return bool
     */
    public function delete(User $user, Issue $issue)
    {
        if($user->hasRole('supervisor')){
            return true;
        }
        
        if ($issue->status->name === 'closed') {
            return false;
        }

        return $user->id === $issue->createdBy->id;
    }
}
