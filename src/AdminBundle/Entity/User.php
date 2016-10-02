<?php

namespace AdminBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Security\Core\User\UserInterface;

/**
 * User
 * Afin de profiter de l'automatisation du mecanisme de symfony ,
 * la classe de notre entity DOIT implémenter l'interface UserInterface 
 * Il faut comprendre le concept des interfaces si on veut savoir pourquoi on prend une erreure 
 * si on implemente pas Sérializable sans peupler les methodes  
 * 
 * Et oui le bundle de gestion des user de symfony utilise les methodes getUsername et getPassword 
 * pour acceder a ces propriétés... c'est a nous de nous adapter
 * 
 * Pensez bien a retourner les bonnes propriétés sur les methodes implémentées
 *
 * @ORM\Table(name="user")
 * @ORM\Entity(repositoryClass="AdminBundle\Repository\UserRepository")
 */
class User implements UserInterface, \Serializable
{
    
    /**
     * @var int
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     * @var string
     *
     * @ORM\Column(name="nom", type="string", length=255)
     */
    private $nom;

    /**
     * @var string
     *
     * @ORM\Column(name="pass", type="string", length=255)
     */
    private $pass;

    
    
/**
     * @var array
     *
     * @ORM\Column(name="roles", type="array")
     */
    private $roles;

    /**
     * Get id
     *
     * @return int
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set nom
     *
     * @param string $nom
     *
     * @return User
     */
    public function setNom($nom)
    {
        $this->nom = $nom;

        return $this;
    }

    /**
     * Get nom
     *
     * @return string
     */
    public function getNom()
    {
        return $this->nom;
    }

    /**
     * Set pass
     *
     * @param string $pass
     *
     * @return User
     */
    public function setPass($pass)
    {
        $this->pass = $pass;

        return $this;
    }

    /**
     * Get pass
     *
     * @return string
     */
    public function getPass()
    {
        return $this->pass;
    }
    function __construct() {
        
    }
    function setRoles($roles) {
        $this->roles = $roles;
    }

        
    public function eraseCredentials() {
        
    }

    public function getPassword() {
        return $this->pass;
    }

    public function getRoles() {
        return $this->roles;
    }

    public function getSalt() {
        
    }

    public function getUsername() {
        return $this->nom;
    }

    public function serialize() {
        
    }

    public function unserialize($serialized) {
        
    }

   

}

