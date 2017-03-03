<?php

namespace CodeEduBook\Policies;

use CodeEduBook\Models\Book;
use CodeEduUser\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class BookPolicy
{
    use HandlesAuthorization;

    public function before($user, $ability)
    {
        if ($user->can(config('codeedubook.acl.permissions.book_manage_all'))){
            return true;
        }
    }

    /**
     * Determine whether the user can update the book.
     *
     * @param  User  $user
     * @param  Book  $book
     * @return mixed
     */
    public function update(User $user, Book $book)
    {
        return $user->id == $book->author_id;
    }

}
