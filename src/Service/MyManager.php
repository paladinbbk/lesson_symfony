<?php

namespace App\Service;

use App\Repository\TagRepository;

class MyManager
{
    private $repository;

    public function __construct(TagRepository $repository)
    {
        $this->repository = $repository;
    }

    public function getTags()
    {
        return $this->repository->findAll();
    }

    public function toDo()
    {
        return true;
    }
}