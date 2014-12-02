<?php

use Blog\Repository\Article\ArticleInterface;

class PagesController extends BaseController {

    public function __construct(ArticleInterface $article)
    {
        $this->article = $article;
    }

    public function home()
    {
        $page = Input::get('page', 1);
        $pagiData = $this->article->byPage($page, $perPage = 9);
        $posts = Paginator::make($pagiData->items, $pagiData->totalItems, $perPage);

        $categories = Category::all();
        $tags = Tag::all();

        return View::make('pages.home', compact('posts', 'categories', 'tags'));
    }
}
