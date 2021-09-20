<?php

namespace App\Repositories;

use App\Models\Role;
use App\Models\User;
use App\Repositories\Contracts\UserRepositoryInterface;

class UserRepository implements UserRepositoryInterface {

    /**
     * @inheritDoc
     */
    public function create(array $data): User {
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
    public function setActive(User $user): void {
        // update status to active
        $user->status = 'active';
        $user->save();
    }

    /**
     * @inheritDoc
     */
    public function find($id): User {
        return User::whereId($id)->first();
    }
    
    /**
     * @inheritDoc
     */
    public function findBy(string $column, $key): User {
        return User::where($column, $key)->first();
    }
}