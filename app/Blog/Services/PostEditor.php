<?php namespace Blog\Services;

use Blog\Repositories\Article\ArticleInterface;
use Blog\Validators\PostValidator;

class PostEditor
{
    public function __construct(PostValidator $validator, ArticleInterface $article)
    {
        $this->validator = $validator;
        $this->article = $article;
    }

    public function update($attributes)
    {
        if ($this->validator->isValid($attributes))
        {
            return $this->article->update($attributes);
        }

        return $this->validator->getErrors();
    }
}
