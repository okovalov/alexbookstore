<?php

namespace Acme\BookBundle\Form\Model;

use Doctrine\ORM\Mapping as ORM;
use Doctrine\Common\Collection\ArrayCollection;

/**
 * AuthorUpdateFormModel
 *
 */
class AuthorUpdateFormModel
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
    protected $booksNovels;

    /**
     * @var \Doctrine\Common\Collection\ArrayCollection $books
     *
     */
    protected $booksNotNovels;


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
     * Set books novels
     *
     * @param \Doctrine\Common\Collections\ArrayCollection $books
     */
    public function setBooksNovels($booksNovels)
    {
        $this->booksNovels = $booksNovels;
    }

    /**
     * Get books novels
     *
     * @return \Doctrine\Common\Collections\ArrayCollection
     */
    public function getBooksNovels()
    {
        return $this->booksNovels;
    }

    /**
     * Set books novels
     *
     * @param \Doctrine\Common\Collections\ArrayCollection $books
     */
    public function setBooksNotNovels($booksNotNovels)
    {
        $this->booksNotNovels = $booksNotNovels;
    }

    /**
     * Get books novels
     *
     * @return \Doctrine\Common\Collections\ArrayCollection
     */
    public function getBooksNotNovels()
    {
        return $this->booksNotNovels;
    }

}
