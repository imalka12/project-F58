<?php

namespace App\Repositories\Contracts;

use App\Models\User;

interface UserRepositoryInterface {

    /**
     * Create a User
     *
     * @param array $data Details for the User to be created
     * @return User The created User
     */
    public function create(array $data): User;

    /**
     * Set User as active
     *
     * @param User $user User entry to be set as active
     * @return void
     */
    public function setActive(User $user): void;

    /**
     * Find a User with id
     *
     * @param int|string $id
     * @return User $user
     */
    public function find($id): User;

    /**
     * Get the User matching the search key in the search column
     *
     * @param string $column Search column
     * @param [type] $key Search key
     * @return User $user
     */
    public function findBy(string $column, $key): User;

}