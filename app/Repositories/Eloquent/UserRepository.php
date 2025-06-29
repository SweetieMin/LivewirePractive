<?php
namespace App\Repositories\Eloquent;

use App\Models\User;
use Illuminate\Support\Facades\Auth;
use App\Repositories\Contracts\UserRepositoryInterface;

class UserRepository implements UserRepositoryInterface
{
    public function getAll(): array
    {
        return User::all()->toArray();
    }
}
