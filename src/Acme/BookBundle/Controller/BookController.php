<?php

namespace Acme\BookBundle\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Acme\BookBundle\Entity\Book;
use Acme\BookBundle\Form\BookType;

/**
 * Book controller.
 *
 * @Route("/book")
 */
class BookController extends Controller
{
    /**
     * Lists all Book entities.
     *
     * @Route("/", name="book")
     * @Template()
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $entities = $em->getRepository('AcmeBookBundle:Book')->findAll();

        return array(
            'entities' => $entities,
        );
    }

    /**
     * Finds and displays a Book entity.
     *
     * @Route("/{id}/show", name="book_show")
     * @Template()
     */
    public function showAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('AcmeBookBundle:Book')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Book entity.');
        }

        $deleteForm = $this->createDeleteForm($id);

        return array(
            'entity'      => $entity,
            'delete_form' => $deleteForm->createView(),
        );
    }

    /**
     * Displays a form to create a new Book entity.
     *
     * @Route("/new", name="book_new")
     * @Template()
     */
    public function newAction()
    {
        $entity = new Book();
        $form   = $this->createForm(new BookType(), $entity, array(
            'em' => $this->getDoctrine()->getEntityManager(),
        ));

        return array(
            'entity' => $entity,
            'form'   => $form->createView(),
        );
    }

    /**
     * Creates a new Book entity.
     *
     * @Route("/create", name="book_create")
     * @Method("POST")
     * @Template("AcmeBookBundle:Book:new.html.twig")
     */
    public function createAction(Request $request)
    {
        $entity  = new Book();
        $form = $this->createForm(new BookType(), $entity, array(
            'em' => $this->getDoctrine()->getEntityManager(),
        ));
        $form->bind($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($entity);
            $em->flush();

            return $this->redirect($this->generateUrl('book_show', array('id' => $entity->getId())));
        }

        return array(
            'entity' => $entity,
            'form'   => $form->createView(),
        );
    }

    /**
     * Displays a form to edit an existing Book entity.
     *
     * @Route("/{id}/edit", name="book_edit")
     * @Template()
     */
    public function editAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('AcmeBookBundle:Book')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Book entity.');
        }

        // echo '<pre>';
        // \Doctrine\Common\Util\Debug::dump($entity,2);
        // echo '</pre>';
        // die('');

        $editForm = $this->createForm(new BookType(), $entity, array(
            'em' => $this->getDoctrine()->getEntityManager(),
        ));
        $deleteForm = $this->createDeleteForm($id);

        return array(
            'entity'      => $entity,
            'edit_form'   => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        );
    }

    /**
     * Edits an existing Book entity.
     *
     * @Route("/{id}/update", name="book_update")
     * @Method("POST")
     * @Template("AcmeBookBundle:Book:edit.html.twig")
     */
    public function updateAction(Request $request, $id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('AcmeBookBundle:Book')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Book entity.');
        }

        $deleteForm = $this->createDeleteForm($id);
        $editForm = $this->createForm(new BookType(), $entity, array(
            'em' => $this->getDoctrine()->getEntityManager(),
        ));
        $editForm->bind($request);

        // $temp = $form->
        // $entity->setCategories();
        // echo '<pre>';
        // \Doctrine\Common\Util\Debug::dump($editForm->get('categories')->getData(),1);
        // echo '</pre>';
        // die('');

        // $a = $editForm->get('categories')->getData();
        // $categories = new \Doctrine\Common\Collections\ArrayCollection();
        // if (is_null($a)===false) {
        //     $categories[] = $a;
        // }
        // if ($categories) {
        //     $entity->setCategories($categories);
        // }

        if ($editForm->isValid()) {
            $em->persist($entity);
            $em->flush();

            //return $this->redirect($this->generateUrl('book_edit', array('id' => $id)));
            return $this->redirect($this->generateUrl('book'));
        }

        return array(
            'entity'      => $entity,
            'edit_form'   => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        );
    }

    /**
     * Deletes a Book entity.
     *
     * @Route("/{id}/delete", name="book_delete")
     * @Method("POST")
     */
    public function deleteAction(Request $request, $id)
    {
        $form = $this->createDeleteForm($id);
        $form->bind($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $entity = $em->getRepository('AcmeBookBundle:Book')->find($id);

            if (!$entity) {
                throw $this->createNotFoundException('Unable to find Book entity.');
            }

            $em->remove($entity);
            $em->flush();
        }

        return $this->redirect($this->generateUrl('book'));
    }

    private function createDeleteForm($id)
    {
        return $this->createFormBuilder(array('id' => $id))
            ->add('id', 'hidden')
            ->getForm()
        ;
    }
}
