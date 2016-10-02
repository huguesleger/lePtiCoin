<?php

namespace PticoinBundle\Controller;

use DateTime;
use PticoinBundle\Entity\Annonce;
use PticoinBundle\Form\AnnonceType;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

/**
 * Annonce controller.
 * Ici on va considerer le CRUD par Entité vous avez idem avec les autres entités
 *
 */
class AnnonceController extends Controller {

    /**
     * @Route("annonces/del/{id}",name="removeAnn")
     * @param Request $r
     * @return type
     */
    public function remove($id) {
        $annonce = new Annonce();
        $f = $this->createForm(AnnonceType::class, $annonce);
        $em = $this->getDoctrine()->getManager();
        $em->remove($this->getDoctrine()->getRepository("PticoinBundle:Annonce")->find($id));
        $em->flush();
        return $this->redirectToRoute("annonces");
    }

    /**
     * @Route("annonces/add",name="addAnn")
     */
    public function add(Request $r) {
        $a = new Annonce();

        $f = $this->createForm(AnnonceType::class, $a);
        if ($r->getMethod() == 'POST') {
            $f->handleRequest($r);
            $nomDuFichier = md5(uniqid()) . "." . $a->getImage()->guessExtension();
            $a->getImage()->move('web/uploads/img', $nomDuFichier);

            $a->setImage($nomDuFichier);
            $em = $this->getDoctrine()->getManager();
            $em->persist($a);
            $em->flush();
        }
        return $this->redirectToRoute("annonces");
    }

    /**
     * 
     * @Route("annonces/edit",name="editAnn")
     */
    public function edit(Request $r) {
        $a = $this->getDoctrine()->getRepository("PticoinBundle:Annonce")->find($r->get('id'));
        $f = $this->createForm(AnnonceType::class, $a);
        if ($r->isXmlHttpRequest()) {
            $f->handleRequest($r);
            $em = $this->getDoctrine()->getManager();
            $em->merge($a);
            $em->flush();

            return new Response("votre annonce à bien été mise a jour");
        }
        return new Response("Allez vous faire foutre mes amis !!!!!");
    }

}
