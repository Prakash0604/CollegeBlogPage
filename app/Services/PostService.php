<?php

namespace App\Services;
use App\Models\Post;
use App\Services\Main\BaseService;
class PostService extends BaseService{
    protected $post;
    public function __construct(Post $post)
    {
        $this->post=$post;
        parent::__construct($post);
    }
}