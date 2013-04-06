<?php

namespace Acme\BookBundle\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Acme\BookBundle\Entity\Author;
use Acme\BookBundle\Form\AuthorType;
use Acme\BookBundle\Form\Type\AuthorUpdateFormType;

use Acme\BookBundle\Form\Model\AuthorCreateFormModel;
use Acme\BookBundle\Form\Model\AuthorUpdateFormModel;

use Acme\BookBundle\Form\AuthorOtherType;
use Doctrine\Common\Collections\ArrayCollection;
/**
 * Author controller.
 *
 * @Route("/author")
 */
class AuthorController extends Controller
{
    /**
     * Lists all Author entities.
     *
     * @Route("/", name="author")
     * @Template()
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $entities = $em->getRepository('AcmeBookBundle:Author')->findAll();

        return array(
            'entities' => $entities,
        );
    }

    /**
     * Finds and displays a Author entity.
     *
     * @Route("/{id}/show", name="author_show")
     * @Template()
     */
    public function showAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('AcmeBookBundle:Author')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Author entity.');
        }

        $deleteForm = $this->createDeleteForm($id);

        return array(
            'entity'      => $entity,
            'delete_form' => $deleteForm->createView(),
        );
    }

    /**
     * Displays a form to create a new Author entity.
     *
     * @Route("/new", name="author_new")
     * @Template()
     */
    public function newAction()
    {
        $model  = new AuthorUpdateFormModel();
        //$entity = new Author();
        $form   = $this->createForm(new AuthorUpdateFormType(), $model);

        return array(
            'form'   => $form->createView(),
        );
    }

    /**
     * Creates a new Author entity.
     *
     * @Route("/create", name="author_create")
     * @Method("POST")
     * @Template("AcmeBookBundle:Author:new.html.twig")
     */
    public function createAction(Request $request)
    {
        $entity  = new Author();

        $model  = new AuthorUpdateFormModel();
        $form = $this->createForm(new AuthorUpdateFormType(), $model);
        $form->bind($request);

        $entity->setName($model->getName());
        $entity->setEmail($model->getEmail());
        $entity->setWebsite($model->getWebsite());

        $booksNovels = $model->getBooksNovels();
        $booksNotNovels = $model->getBooksNotNovels();
        $books = new ArrayCollection();
        foreach ($booksNovels as $book) {
            $books->add($book);
        }
        foreach ($booksNotNovels as $book) {
            $books->add($book);
        }
        $entity->setBooks($books);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($entity);
            $em->flush();

            return $this->redirect($this->generateUrl('author_show', array('id' => $entity->getId())));
        }

        return array(
            'entity' => $entity,
            'form'   => $form->createView(),
        );
    }

    /**
     * Displays a form to edit an existing Author entity.
     *
     * @Route("/{id}/edit", name="author_edit")
     * @Template()
     */
    public function editAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('AcmeBookBundle:Author')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Author entity.');
        }

        $model  = new AuthorUpdateFormModel();
        $model->setName($entity->getName());
        $model->setWebsite($entity->getWebsite());
        $model->setEmail($entity->getEmail());
        $model->setBooksNovels($entity->getBooks());
        $model->setBooksNotNovels($entity->getBooks());

        $editForm = $this->createForm(new AuthorUpdateFormType(), $model);

        // $editForm = $this->createForm(new AuthorType(), $entity);
        // $editOtherForm = $this->createForm(new AuthorOtherType(), $entity);
        $deleteForm = $this->createDeleteForm($id);

        return array(
            'entity'      => $entity,
            'edit_form'   => $editForm->createView(),
            // 'form2'   => $editOtherForm->createView(),
            'delete_form' => $deleteForm->createView(),
        );
    }

    /**
     * Edits an existing Author entity.
     *
     * @Route("/{id}/update", name="author_update")
     * @Method("POST")
     * @Template("AcmeBookBundle:Author:edit.html.twig")
     */
    public function updateAction(Request $request, $id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('AcmeBookBundle:Author')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Author entity.');
        }

        $deleteForm = $this->createDeleteForm($id);
        // $editForm = $this->createForm(new AuthorType(), $entity);
        $model  = new AuthorUpdateFormModel();
        $editForm = $this->createForm(new AuthorUpdateFormType(), $model);
        $editForm->bind($request);

        $booksNovels = $model->getBooksNovels();
        $booksNotNovels = $model->getBooksNotNovels();


        $books = new ArrayCollection();

        foreach ($booksNovels as $book) {
            $books->add($book);
        }

        foreach ($booksNotNovels as $book) {
            $books->add($book);
        }


        $entity->setBooks($books);

        if ($editForm->isValid()) {
            $em->persist($entity);
            $em->flush();

        if(0) {
            echo '<pre>';
            \Doctrine\Common\Util\Debug::dump($entity, 4);
            echo '</pre>';
            die();
        }
            //return $this->redirect($this->generateUrl('author_edit', array('id' => $id)));
            return $this->redirect($this->generateUrl('author'));
        }

        return array(
            'entity'      => $entity,
            'edit_form'   => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        );
    }

    /**
     * Deletes a Author entity.
     *
     * @Route("/{id}/delete", name="author_delete")
     * @Method("POST")
     */
    public function deleteAction(Request $request, $id)
    {
        $form = $this->createDeleteForm($id);
        $form->bind($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $entity = $em->getRepository('AcmeBookBundle:Author')->find($id);

            if (!$entity) {
                throw $this->createNotFoundException('Unable to find Author entity.');
            }

            $em->remove($entity);
            $em->flush();
        }

        return $this->redirect($this->generateUrl('author'));
    }

    private function createDeleteForm($id)
    {
        return $this->createFormBuilder(array('id' => $id))
            ->add('id', 'hidden')
            ->getForm()
        ;
    }
}
