<?php

namespace PticoinBundle\Controller;

use PticoinBundle\Entity\Annonce;
use PticoinBundle\Form\AnnonceType;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;



/**
 * Annonce controller.
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
    public function add(Request $r){
        $a = new Annonce();
        $f = $this->createForm(AnnonceType::class, $a);
        
        if($r->getMethod() == 'POST'){
            $f->handleRequest($r);
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
    public function edit(Request $r){ 
        
        return new Response("ok");
    }
    
}
