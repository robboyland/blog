<?php namespace Blog\Repository\Category;

use Category;
use Illuminate\Database\Eloquent\Model;

class EloquentCategory implements CategoryInterface
{
    public function __construct(Model $category)
    {
        $this->category = $category;
    }

    public function all()
    {
        return $this->category->orderBy('name', 'asc')->get();
    }
}