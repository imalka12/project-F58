<?php

namespace Tests\Feature;

use App\Models\Category;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class CategoryTest extends TestCase
{
    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function test_if_category_is_created()
    {
        $category = Category::create([
            'title' => 'Test'
        ]);

        $this->assertTrue('Test' === $category->title);
    }

    public function test_if_sub_category_is_created()
    {
        $category = Category::create([
            'title' => 'Test Category'
        ]);

        $subCategory = $category->subCategories()->create([
            'title' => 'Test Sub Category 1'
        ]);

        $this->assertTrue('Test Sub Category 1' === $subCategory->title);
    }
}
