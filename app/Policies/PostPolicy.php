<?php

namespace App\Policies;

use App\Incidencia;
use App\Post;
use App\Professor;
use Illuminate\Auth\Access\HandlesAuthorization;

class PostPolicy
{
    use HandlesAuthorization;

    /**
     * Determine whether the user can view any posts.
     *
     * @param  \App\Professor  $user
     * @return mixed
     */
    public function viewAny(Professor $user)
    {
        //
    }

    /**
     * Determine whether the user can view the post.
     *
     * @param  \App\Professor  $user
     * @param  \App\Post  $post
     * @return mixed
     */
    public function view(Professor $user, Incidencia $post)
    {
        return $user->id === $post->id_profesor;
    }

    /**
     * Determine whether the user can create posts.
     *
     * @param  \App\Professor  $user
     * @return mixed
     */
    public function create(Professor $user)
    {
        //
    }

    /**
     * Determine whether the user can update the post.
     *
     * @param  \App\Professor  $user
     * @param  \App\Post  $post
     * @return mixed
     */
    public function update(Professor $user, Incidencia $post)
    {
        return $user->id === $post->id_profesor;
    }

    /**
     * Determine whether the user can delete the post.
     *
     * @param  \App\Professor  $user
     * @param  \App\Post  $post
     * @return mixed
     */
    public function delete(Professor $user, Incidencia $post)
    {
        return $user->id === $post->id_profesor;
    }

    /**
     * Determine whether the user can restore the post.
     *
     * @param  \App\Professor  $user
     * @param  \App\Post  $post
     * @return mixed
     */
    public function restore(Professor $user, Incidencia $post)
    {
        //
    }

    /**
     * Determine whether the user can permanently delete the post.
     *
     * @param  \App\Professor  $user
     * @param  \App\Post  $post
     * @return mixed
     */
    public function forceDelete(Professor $user, Post $post)
    {
        //
    }
}
