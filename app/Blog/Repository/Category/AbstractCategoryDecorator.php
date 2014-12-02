<?php namespace Blog\Repository\Category;

abstract class AbstractCategoryDecorator implements CategoryInterface
{
    protected $category;

    public function __construct(CategoryInterface $category)
    {
        $this->category = $category;
    }

    public function all()
    {
        $this->category->all();
    }
}
