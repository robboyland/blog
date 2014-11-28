<?php namespace Blog\Services;

use Blog\Repositories\Article\ArticleInterface;
use Blog\Validators\PostValidator;

class PostCreator
{
    protected $validator;

    protected $article;

    public function __construct(PostValidator $validator, ArticleInterface $article)
    {
        $this->validator = $validator;
        $this->article = $article;
    }

    public function make($attributes)
    {
        if ($this->validator->isValid($attributes))
        {
            return $this->article->create($attributes);
        }

        return $this->validator->getErrors();
    }
}