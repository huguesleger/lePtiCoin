<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace PticoinBundle\Controller;

use PticoinBundle\Entity\Categorie;
use PticoinBundle\Form\CategorieType;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

/**
 * Description of CategorieController
 *
 * @author Formateur BeWeb
 */
class CategorieController extends Controller {
    //put your code here

    /**
     * @Route("categorie/add",name="addCat")
     * 
     */
    public function add(Request $r) {
        $categorie = new Categorie();
        
        $f = $this->createForm(CategorieType::class, $categorie);
        if ($r->getMethod() == 'POST') {
            $f->handleRequest($r);                 
            $em = $this->getDoctrine()->getManager();
            if (count($this->getDoctrine()->getRepository("PticoinBundle:Categorie")->findByNom($categorie->getNom())) == 0) {
                $categorie->setIdParent(1);                
                $em->persist($categorie);                
            }else{
                $categorie = $this->getDoctrine()->getRepository("PticoinBundle:Categorie")->findByNom($categorie->getNom())[0];
                $em->merge($categorie);
            }
            $em->flush();
        }
        return $this->redirectToRoute("categories");
    }

    /**
     * @Route("categorie/del",name="removeCat")
     * @param Request $r
     * @return type
     */
    public function remove(Request $r) {
        $em = $this->getDoctrine()->getManager();
        $em->remove($this->getDoctrine()->getRepository("PticoinBundle:Categorie")->find(intval($r->get("delCat"))));
        $em->flush();
        return $this->redirectToRoute("categories");
    }
}
