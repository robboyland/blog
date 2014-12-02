<?php namespace Blog\Repository\Tag;

abstract class AbstractTagDecorator implements TagInterface
{
    protected $AbstractTagRepository;

    public function __construct(TagInterface $tag)
    {
        $this->tag = $tag;
    }

    public function findOrCreate(array $tags)
    {
        return $this->tag->findOrCreate($tags);
    }

    public function all()
    {
        return $this->tag->all();
    }
}
