<?php namespace Blog\Services;

use Post;
use Tag;
use Blog\Validators\PostValidator;

class PostCreator
{

    public function __construct(PostValidator $validator)
    {
        $this->validator = $validator;
    }

    public function make($attributes)
    {
        if ($this->validator->isValid($attributes))
        {
            $post = Post::create([
                            'title'       => $attributes['title'],
                            'body'        => $attributes['body'],
                            'user_id'     => $attributes ['user_id'],
                            'category_id' => $attributes['category_id'],
                            'slug'        => $attributes['slug']
                         ]);

            $post->tags()->sync($attributes['tags']);

            return true;
        }

        return $this->validator->getErrors();
    }
}