<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace PticoinBundle\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Serializer\Encoder\JsonEncoder;
use Symfony\Component\Serializer\Encoder\XmlEncoder;
use Symfony\Component\Serializer\Normalizer\ObjectNormalizer;
use Symfony\Component\Serializer\Serializer;

/**
 * Description of AjaxController
 *Un petit controller spécial pour les requetes ajax (on sent le WebService qui arrive ;) 
 * @author Formateur BeWeb
 */
class AjaxController extends Controller{
    //put your code here
    
    /**
     * @Route("/ajax")
     * @param type $param
     */
    public function ajax(Request $r) {
        $encoder = array(new XmlEncoder(),new JsonEncoder());
        $normalizer = array(new ObjectNormalizer());
        $serailizer = new Serializer($normalizer,$encoder);
        if($r->isXmlHttpRequest()){
            $ann = $this->getDoctrine()->getRepository('PticoinBundle:Annonce')->find(1);
            $a = $serailizer->serialize($ann, 'json');
            
            return new Response($a);
        }
        return new Response("ok pour le post");
    }
}
