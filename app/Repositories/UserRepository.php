<?php

namespace App\Repositories;

use App\Models\Role;
use App\Models\User;
use App\Repositories\Contracts\UserRepositoryInterface;

class UserRepository implements UserRepositoryInterface
{

    /**
     * @inheritDoc
     */
    public function create(array $data): User
    {
        // set the default Role
        $data['role_id'] = Role::getDefault()->id;
        $data['status'] = 'inactive';

        $user = User::create($data);

        // create profile for User
        $user->profile()->create();

        return $user;
    }

    /**
     * @inheritDoc
     */
    public function setActive(User $user): void
    {
        // update status to active
        $user->status = 'active';
        $user->save();
    }

    /**
     * @inheritDoc
     */
    public function find($id): User
    {
        return User::whereId($id)->with('profile')->first();
    }

    /**
     * @inheritDoc
     */
    public function findBy(string $column, $key): ?User
    {
        return User::where($column, $key)->with('profile')->first();
    }

<<<<<<< HEAD
    /**
     * @inheritDoc
     */
    public function delete($user): bool
    {
        return User::whereId($user)->delete();
    }
}
=======
    public function delete($user) : bool
    {
        return User::whereId($user)->delete();
    }
}
>>>>>>> 378766ca4f6f1dfa04b1f942ec9f23af899ad376
