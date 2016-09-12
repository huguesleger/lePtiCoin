<?php

namespace NavigationBundle\Controller;

use PticoinBundle\Entity\Annonce;
use PticoinBundle\Entity\Categorie;
use PticoinBundle\Form\AnnonceType;
use PticoinBundle\Form\CategorieType;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Response;

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of ViewController
 *
 * @author Formateur BeWeb
 */
class ViewController extends Controller {

    /**
     * @Route("/",name="home")
     * @Template("NavigationBundle::index.html.twig")
     */
    public function indexAction() {
        return null;
    }

    /**
     * @Route("annonces",name="annonces")
     * @Template("NavigationBundle::annonces.html.twig")
     */
    public function getAnnonces() {
        
        return array("annonces" => $this->getDoctrine()->getRepository('PticoinBundle:Annonce')->findAll());
    }

    /**
     * @Route("annonces/{id}",name="more")
     * @Template("NavigationBundle::details.html.twig")
     * @param type $id
     * @param \NavigationBundle\Controller\Annonce $annonce
     * @return type
     */
    public function getDetail($id, Annonce $annonce) {
        return array("annonce" => $annonce);
    }

    /**
     * @Route("annonce/add",name="addAnnonce")
     * @Template("NavigationBundle::annoncesAdd.html.twig")
     */
    public function ajoutAnnonce() {

        return array("annonce" => $this->createForm(AnnonceType::class, new Annonce())->createView());
    }

    /**
     * @Route("annonce/edit/{id}",name="editAnnonce")
     * @Template("NavigationBundle::annoncesEdit.html.twig")
     */
    public function editAnnonce(Annonce $a){
        return array("annonce" => $this->createForm(AnnonceType::class, $a)->createView());
    }
    
    /**
     * @Template("NavigationBundle::categories.html.twig")
     * @Route("categories",name="categories")
     */
    public function getCategories() {
        $categorie = new Categorie();
        return array(
            "categories" => $this->getDoctrine()->getRepository("PticoinBundle:Categorie")->findAll(),
            "formulaire" => $this->createForm(CategorieType::class, $categorie)->createView()
        );
    }

    
    /**
     * @Route("test/ann")
     */
    public function testAnn(){
        var_dump($this->getDoctrine()->getRepository("PticoinBundle:Annonce")->find(1));
        return new Response("test");
    }
}
