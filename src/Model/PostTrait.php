<?php

namespace App\Model;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\PostRepository")
 */
trait PostTrait
{
    /**
     * @ORM\Column(type="string", length=255)
     */
    private $author;

    /**
     * @return mixed
     */
    public function getAuthor()
    {
        return $this->author;
    }

    /**
     * @param mixed $author
     * @return PostTrait
     */
    public function setAuthor($author)
    {
        $this->author = $author;
        return $this;
    }

}
