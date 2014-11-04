<?php namespace Blog\Services;

use Post;
use Tag;
use Blog\Validators\PostValidator;

class PostEditor
{

    public function __construct(PostValidator $validator)
    {
        $this->validator = $validator;
    }

    public function update($attributes, $id)
    {

        if ($this->validator->isValid($attributes))
        {
            $post = Post::find($id);

            $post->title        = $attributes['title'];
            $post->body         = $attributes['body'];
            $post->category_id  = $attributes['category_id'];
            $post->slug         = $attributes['slug'];
            $post->save();

            $post->tags()->sync($attributes['tags']);

            return true;
        }

        return $this->validator->getErrors();
    }
}