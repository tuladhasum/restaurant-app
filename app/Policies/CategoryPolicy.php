<?php

namespace App\Policies;

use App\User;
use App\Category;
use Illuminate\Auth\Access\HandlesAuthorization;

class CategoryPolicy
{
  use HandlesAuthorization;

  public function before(User $user, $ability)
  {
    if ($user->isAdmin){
      return true;
    }
  }

  /**
   * Determine whether the user can manage the category.
   *
   * @param \App\User $user
   * @param \App\Category $category
   * @return mixed
   */
  public function manage(User $user)
  {
        return $user->isAdmin;
  }

  /**
   * Determine whether the user can create categories.
   *
   * @param \App\User $user
   * @return mixed
   */
  public function create(User $user)
  {
    //
  }

  /**
   * Determine whether the user can update the category.
   *
   * @param \App\User $user
   * @param \App\Category $category
   * @return mixed
   */
  public function update(User $user, Category $category)
  {
    //
  }

  /**
   * Determine whether the user can delete the category.
   *
   * @param \App\User $user
   * @param \App\Category $category
   * @return mixed
   */
  public function delete(User $user, Category $category)
  {
    //
  }

  /**
   * Determine whether the user can restore the category.
   *
   * @param \App\User $user
   * @param \App\Category $category
   * @return mixed
   */
  public function restore(User $user, Category $category)
  {
    //
  }

  /**
   * Determine whether the user can permanently delete the category.
   *
   * @param \App\User $user
   * @param \App\Category $category
   * @return mixed
   */
  public function forceDelete(User $user, Category $category)
  {
    //
  }
}
