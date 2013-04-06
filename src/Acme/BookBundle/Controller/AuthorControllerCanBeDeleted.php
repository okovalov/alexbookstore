<?php

namespace Acme\BookBundle\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Acme\BookBundle\Entity\Author;
use Acme\BookBundle\Entity\Book;
use Acme\BookBundle\Form\Type\AuthorCreateFormType;
use Acme\BookBundle\Form\Type\AuthorUpdateFormType;
use Acme\BookBundle\Form\AuthorOtherType;
use Acme\BookBundle\Form\Model\AuthorCreateFormModel;
use Acme\BookBundle\Form\Model\AuthorUpdateFormModel;
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
        $model = new AuthorCreateFormModel();
        $form   = $this->createForm(new AuthorCreateFormType(), $model);

        return array(
            'entity' => $model,
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
        $model  = new AuthorCreateFormModel ();
        $form = $this->createForm(new AuthorCreateFormType(), $model);
        $form->bind($request);

        $book = new Book();
        $author = new Author();

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();

            $author->setEmail($model->getEmail());
            $author->setName($model->getName());
            $author->setWebsite($model->getWebsite());

            $book->setColor('red');
            $book->setPrice(1);
            $book->setIsNovell(false);

            $book->setName('Book' . $model->getBooks());
            $book->setAuthor($author);

            $em->persist($author);
            $em->persist($book);

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

        $model  = new AuthorUpdateFormModel ();

        $editForm = $this->createForm(new AuthorUpdateFormType($entity->getId()), $model);
        //$editOtherForm = $this->createForm(new AuthorOtherType(), $entity);
        $deleteForm = $this->createDeleteForm($id);

        return array(
            'entity'      => $entity,
            'edit_form'   => $editForm->createView(),
            //'form2'       => $editOtherForm->createView(),
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
        $editForm = $this->createForm(new AuthorType(), $entity);
        if(1) {
            echo '<pre>';
            \Doctrine\Common\Util\Debug::dump($entity, 8);
            echo '</pre>';
            die();
        }
        $editForm->bind($request);

        if ($editForm->isValid()) {
            $em->persist($entity);
            $em->flush();

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
