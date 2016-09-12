<?php

namespace PticoinBundle\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use PticoinBundle\Entity\Localite;
use PticoinBundle\Form\LocaliteType;

/**
 * Localite controller.
 *
 * @Route("/localite")
 */
class LocaliteController extends Controller
{
    /**
     * Lists all Localite entities.
     *
     * @Route("/", name="localite_index")
     * @Method("GET")
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $localites = $em->getRepository('PticoinBundle:Localite')->findAll();

        return $this->render('localite/index.html.twig', array(
            'localites' => $localites,
        ));
    }

    /**
     * Creates a new Localite entity.
     *
     * @Route("/new", name="localite_new")
     * @Method({"GET", "POST"})
     */
    public function newAction(Request $request)
    {
        $localite = new Localite();
        $form = $this->createForm('PticoinBundle\Form\LocaliteType', $localite);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($localite);
            $em->flush();

            return $this->redirectToRoute('localite_show', array('id' => $localite->getId()));
        }

        return $this->render('localite/new.html.twig', array(
            'localite' => $localite,
            'form' => $form->createView(),
        ));
    }

    /**
     * Finds and displays a Localite entity.
     *
     * @Route("/{id}", name="localite_show")
     * @Method("GET")
     */
    public function showAction(Localite $localite)
    {
        $deleteForm = $this->createDeleteForm($localite);

        return $this->render('localite/show.html.twig', array(
            'localite' => $localite,
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Displays a form to edit an existing Localite entity.
     *
     * @Route("/{id}/edit", name="localite_edit")
     * @Method({"GET", "POST"})
     */
    public function editAction(Request $request, Localite $localite)
    {
        $deleteForm = $this->createDeleteForm($localite);
        $editForm = $this->createForm('PticoinBundle\Form\LocaliteType', $localite);
        $editForm->handleRequest($request);

        if ($editForm->isSubmitted() && $editForm->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($localite);
            $em->flush();

            return $this->redirectToRoute('localite_edit', array('id' => $localite->getId()));
        }

        return $this->render('localite/edit.html.twig', array(
            'localite' => $localite,
            'edit_form' => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Deletes a Localite entity.
     *
     * @Route("/{id}", name="localite_delete")
     * @Method("DELETE")
     */
    public function deleteAction(Request $request, Localite $localite)
    {
        $form = $this->createDeleteForm($localite);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->remove($localite);
            $em->flush();
        }

        return $this->redirectToRoute('localite_index');
    }

    /**
     * Creates a form to delete a Localite entity.
     *
     * @param Localite $localite The Localite entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm(Localite $localite)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('localite_delete', array('id' => $localite->getId())))
            ->setMethod('DELETE')
            ->getForm()
        ;
    }
}
