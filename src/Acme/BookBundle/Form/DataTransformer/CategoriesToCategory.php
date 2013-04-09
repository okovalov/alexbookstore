<?php
namespace Acme\BookBundle\Form\DataTransformer;

use Symfony\Component\Form\DataTransformerInterface;
use Symfony\Component\Form\Exception\TransformationFailedException;
use Doctrine\Common\Persistence\ObjectManager;
use Acme\BookBundle\Entity\Book;

class CategoriesToCategory implements DataTransformerInterface
{
	/**
	* @var ObjectManager
	*/
	private $om;

	/**
	* @param ObjectManager $om
	*/
	public function __construct(ObjectManager $om)
	{		
		$this->om = $om;
	}
	/**
     * Transforms an object $categories (ArrayCollection) to a single $category (Entity).
     *
     * @param  \Doctrine\Common\Collections\ArrayCollection|null $categories
     * @return \Acme\BookBundle\Entity\Category
     */
	public function transform($categories)
	{
		if ($categories === null) {
            return "";
        }
		return $categories[0];
	}
	/**
     * Transforms a category (\Acme\BookBundle\Entity\Category) to categories (\Doctrine\Common\Collections\ArrayCollection).
     *
     * @param  \Acme\BookBundle\Entity\Category $category
     *
     * @return \Doctrine\Common\Collections\ArrayCollection|null
     *
     * @throws TransformationFailedException if object (category) is not found.
     */
	public function reverseTransform($category)
	{
		if (!$category) {
            return null;
        }
        $categories = new \Doctrine\Common\Collections\ArrayCollection();
		$categories[] = $category;
		return $categories;
	}
}
?>