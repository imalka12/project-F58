<?php

namespace App\Repositories\Contracts;

use Illuminate\Database\Eloquent\Collection;

interface CategoryRepositoryInterface {

    /**
     * Returns a collection of categories from the database
     *
     * @return Collection<App\Models\Category> $categories
     */
    public function all(): Collection;

}