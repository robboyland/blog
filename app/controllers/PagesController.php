<?php

use Blog\Repository\Article\ArticleInterface;
use Blog\Repository\Category\CategoryInterface;

class PagesController extends BaseController {

    public function __construct(ArticleInterface $article, CategoryInterface $category)
    {
        $this->article = $article;
        $this->category = $category;
    }

    public function home()
    {
        $page = Input::get('page', 1);
        $pagiData = $this->article->byPage($page, $perPage = 9);
        $posts = Paginator::make($pagiData->items, $pagiData->totalItems, $perPage);

        $categories = $this->category->all();
        $tags = Tag::all();

        return View::make('pages.home', compact('posts', 'categories', 'tags'));
    }
}
