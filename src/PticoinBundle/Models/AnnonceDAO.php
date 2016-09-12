<?php

namespace PticoinBundle\Models;

use Doctrine\ORM\EntityManager;

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of AnnonceDAO
 *
 * @author Formateur BeWeb
 */
class AnnonceDAO {

    private $em;

    function __construct(EntityManager $em) {
        $this->em = $em;
    }

    public function getCat() {
        $rsm = new ResultSetMappingBuilder($this->em);
        //Le mappage se fera avec l'entitée News(qui est déclaré ici avec la table Niouz... voir l'annotation table de l'entité)
        //le deuxieme parametre est un alias au besoin qui va nous servir pour les clauses SQL
        $rsm->addRootEntityFromClassMetadata('PticoinBundle:Categorie', 'cat');
        //Ici on fait une requete SQL "classique" (on fera mieux plus tard ;), on y passe aussi notre mapping pour que doctrine puisse 
        //nous ...
        $query = $this->em->createNativeQuery("select * from categorie", $rsm);
        //...renvoyer une liste d'objets corespond a notre demande (ici News)
        //$niouzes est donc une liste de News
        return $query->getResult();
    }

}
