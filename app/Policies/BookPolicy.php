<?php

namespace App\Policies;

use App\Models\User;
use App\Models\Book;

class BookPolicy
{
    public function viewAny(User $user)
    {
        return true; // everyone can see list
    }

    public function view(User $user, Book $book)
    {
        return true; // everyone can view a book
    }

    public function create(User $user)
    {
        return $user->role === 'admin';
    }

    public function update(User $user, Book $book)
    {
        return $user->role === 'admin';
    }

    public function delete(User $user, Book $book)
    {
        return $user->role === 'admin';
    }
}
