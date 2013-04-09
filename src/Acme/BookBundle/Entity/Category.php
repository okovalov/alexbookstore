<?php
namespace Acme\BookBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Category
 *
 * @ORM\Table(name="category")
 * @ORM\Entity
 */
class Category
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
    * @var string $name
    *
    * @ORM\Column(name="name", type="string", length=255, unique=false, nullable=false)
    */
    protected $name;

    /** 
    * @var \Doctrine\Common\Collection\ArrayCollection $books
    *
    * @ORM\ManyToMany(targetEntity="Acme\BookBundle\Entity\Author", mappedBy="categories")
    */
    protected $books;


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
        $this->books = new \Doctrine\Common\Collections\ArrayCollection();
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
     * @return Level     */
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
     * Add book
     *
     * @param \Acme\BookBundle\Entity\Book $book
     * @return Level
     */
    public function addBook(\Acme\BookBundle\Entity\Book $book)
    {
        $this->books[] = $book;

        return $this;
    }

    /**
     * Remove books
     *
     * @param \Acme\BookBundle\Entity\Book $books
     */
    public function removeBook(\Acme\BookBundle\Entity\Book $books)
    {
        $this->books->removeElement($books);
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

    /**
     * Set books
     *
     * @param \Doctrine\Common\Collections\ArrayCollection
     */
    public function setBooks($books)
    {
        $this->categories = $categories;
    }

}
