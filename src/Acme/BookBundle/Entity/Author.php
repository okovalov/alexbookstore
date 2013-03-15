<?php

namespace Acme\BookBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Author
 *
 * @ORM\Table(name="author")
 * @ORM\Entity
 */
class Author
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
    * @var string $email
    *
    * @ORM\Column(name="email", type="string", length=255, unique=false, nullable=true)
    */
    protected $email;

    /**
    * @var string $website
    *
    * @ORM\Column(name="url", type="string", length=255, unique=false, nullable=true)
    */
    protected $website;

    /**
    * @var \Doctrine\Common\Collection\ArrayCollection $books
    *
    * @ORM\ManyToMany(targetEntity="Acme\BookBundle\Entity\Book", inversedBy="authors")
    * @ORM\JoinTable(
    *   name="author_book"
    *   ,joinColumns={@ORM\JoinColumn(name="author_id", referencedColumnName="id")}
    *   ,inverseJoinColumns={@ORM\JoinColumn(name="book_id",referencedColumnName="id")}
    * )
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
     * @return Author
     */
    public function setEmail($email)
    {
        $this->email = $email;

        return $this;
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
     * @return Author
     */
    public function setWebsite($website)
    {
        $this->website = $website;

        return $this;
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
     * Add book
     *
     * @param \Acme\BookBundle\Entity\Book $book
     * @return Author
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
        $this->books = $books;
    }

}
