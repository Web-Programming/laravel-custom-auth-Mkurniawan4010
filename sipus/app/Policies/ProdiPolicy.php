<?php

namespace App\Policies;

use App\Models\Prodi;
use App\Models\User;
use GuzzleHttp\Psr7\Request;
use Illuminate\Auth\Access\Response;

class ProdiPolicy
{
    /**
     * Determine whether the user can view any models.
     */
    public function viewAny(User $user)
    {
        //
        return $user->level == 'admin' || $user->level == 'user';
    }

    /**
     * Determine whether the user can view the model.
     */
    public function view(User $user, Prodi $prodi)
    {
        //
        return $user->level == 'admin' || $user->level == 'user';
    }

    /**
     * Determine whether the user can create models.
     */
    public function create(User $user)
    {
        //
        return $user->level == 'admin';
    }

    /**
     * Determine whether the user can update the model.
     */
    public function update(User $user, Prodi $prodi)
    {
        //
        return $user->level == 'admin';
    }

    /**
     * Determine whether the user can delete the model.
     */
    public function delete(User $user, Prodi $prodi): bool
    {
        //
        return $user->level == 'admin';
    }

    /**
     * Determine whether the user can restore the model.
     */
    public function restore(User $user, Prodi $prodi)
    {
        //
    }

    /**
     * Determine whether the user can permanently delete the model.
     */
    public function forceDelete(User $user, Prodi $prodi)
    {
        //
    }

    public function store(Request $request){

    }
}
