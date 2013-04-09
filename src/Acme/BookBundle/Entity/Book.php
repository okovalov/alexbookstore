<?php

namespace Acme\BookBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Book
 *
 * @ORM\Table(name="book")
 * @ORM\Entity
 */
class Book
{
    /**
     * @var integer
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
    * @var $name
    *
    * @ORM\Column(name="name", type="string", length=255, nullable=false, unique=false)
    */
    protected $name;

    /**
    * @var $price
    *
    * @ORM\Column(name="price", type="decimal", precision=9, scale=2)
    */
    protected $price;

    /**
    * @var $color
    *
    * @ORM\Column(name="color", type="string", length=255, nullable=false, unique=false)
    */
    protected $color;

    /**
    * @var $isNovell
    *
    * @ORM\Column(name="is_novell", type="boolean", nullable=false, unique=false)
    */
    protected $isNovell;

    /** 
    * @var \Doctrine\Common\Collection\ArrayCollection $authors
    *
    * @ORM\ManyToMany(targetEntity="Acme\BookBundle\Entity\Author", mappedBy="books")
    */
    protected $authors;

    /**
    * @var \Doctrine\Common\Collection\ArrayCollection $categories
    *
    * @ORM\ManyToMany(targetEntity="Acme\BookBundle\Entity\Category", inversedBy="books")
    * @ORM\JoinTable(
    *   name="category_book"
    *   ,joinColumns={@ORM\JoinColumn(name="category_id", referencedColumnName="id")}
    *   ,inverseJoinColumns={@ORM\JoinColumn(name="book_id",referencedColumnName="id")}
    * )
    */
    protected $categories;

    /**
     * Get id
     *
     * @return integer
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Constructor
     */
    public function __construct()
    {
        $this->authors = new \Doctrine\Common\Collections\ArrayCollection();
        $this->categories = new \Doctrine\Common\Collections\ArrayCollection();
    }

    /**
    * @return string
    */
    public function __toString() {
        return $this->getName();
    }

    /**
     * Set name
     *
     * @param string $name
     * @return Book
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
     * Set price
     *
     * @param float $price
     * @return Book
     */
    public function setPrice($price)
    {
        $this->price = $price;

        return $this;
    }

    /**
     * Get price
     *
     * @return float
     */
    public function getPrice()
    {
        return $this->price;
    }

    /**
     * Set color
     *
     * @param string $color
     * @return Book
     */
    public function setColor($color)
    {
        $this->color = $color;

        return $this;
    }

    /**
     * Get color
     *
     * @return string
     */
    public function getColor()
    {
        return $this->color;
    }

    /**
     * Set isNovell
     *
     * @param string $isNovell
     * @return Book
     */
    public function setIsNovell($isNovell)
    {
        $this->isNovell = $isNovell;

        return $this;
    }

    /**
     * Get isNovell
     *
     * @return string
     */
    public function getIsNovell()
    {
        return $this->isNovell;
    }

    /**
     * Add author
     *
     * @param \Acme\BookBundle\Entity\Author $author
     * @return Book
     */
    public function addAuthor(\Acme\BookBundle\Entity\Author $author)
    {
        $this->authors[] = $author;

        return $this;
    }

    /**
     * Remove author
     *
     * @param \Acme\BookBundle\Entity\Author $author
     */
    public function removeAuthor(\Acme\BookBundle\Entity\Author $author)
    {
        $this->authors->removeElement($author);
    }

    /**
     * Get authors
     *
     * @return \Doctrine\Common\Collections\ArrayCollection
     */
    public function getAuthors()
    {
        return $this->authors;
    }

    /**
     * Add category
     *
     * @param \Acme\BookBundle\Entity\Category $category
     * @return Level
     */
    public function addCategory(\Acme\BookBundle\Entity\Category $category)
    {
        $this->categories[] = $category;

        return $this;
    }

    /**
     * Remove categories
     *
     * @param \Acme\BookBundle\Entity\Category $categories
     */
    public function removeCategory(\Acme\BookBundle\Entity\Category $categories)
    {
        $this->categories->removeElement($categories);
    }

    /**
     * Get categories
     *
     * @return \Doctrine\Common\Collections\ArrayCollection
     */
    public function getCategories()
    {
        return $this->categories;
    }

    /**
     * Set categories
     *
     * @param \Doctrine\Common\Collections\ArrayCollection
     */
    public function setCategories($categories)
    {
        $this->categories = $categories;
    }
}
