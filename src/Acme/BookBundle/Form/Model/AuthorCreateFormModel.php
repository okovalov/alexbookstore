<?php

namespace Acme\BookBundle\Form\Model;

use Doctrine\ORM\Mapping as ORM;
use Doctrine\Common\Collection\ArrayCollection;

/**
 * AuthorCreateFormModel
 *
 */
class AuthorCreateFormModel
{
    /**
     * @var string $name
     *
     */
    protected $name;

    /**
     * @var string $email
     *
     */
    protected $email;

    /**
     * @var string $website
     *
     */
    protected $website;

    /**
     * @var \Doctrine\Common\Collection\ArrayCollection $books
     *
     */
    protected $books;


    /**
     * Set name
     *
     * @param string $name
     * @return Author
     */
    public function setName($name)
    {
        $this->name = $name;

        return $this;
    }

    /**
     * Get name
     *
     * @return string
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * Set email
     *
     * @param string $email
     */
    public function setEmail($email)
    {
        $this->email = $email;
    }

    /**
     * Get email
     *
     * @return string
     */
    public function getEmail()
    {
        return $this->email;
    }

    /**
     * Set website
     *
     * @param string $website
     */
    public function setWebsite($website)
    {
        $this->website = $website;
    }

    /**
     * Get website
     *
     * @return string
     */
    public function getWebsite()
    {
        return $this->website;
    }

    /**
     * Set books
     *
     * @param \Doctrine\Common\Collections\ArrayCollection $books
     */
    public function setBooks($books)
    {
        $this->books = $books;
    }

    /**
     * Get books
     *
     * @return \Doctrine\Common\Collections\ArrayCollection
     */
    public function getBooks()
    {
        return $this->books;
    }

}
