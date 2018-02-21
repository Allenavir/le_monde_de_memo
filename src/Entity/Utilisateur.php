<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * @ORM\Entity(repositoryClass="App\Repository\UtilisateurRepository")
 */
class Utilisateur
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;


      /**     
     * @Assert\NotBlank()
     * @ORM\Column(type="string", length=100)
     */
    private $pseudo;


     /**     
     * @Assert\NotBlank()
     * @ORM\Column(type="string", length=100)
     */
    private $password;


     /**     
     * @Assert\NotBlank()
     * @ORM\Column(type="string", length=255)
     */
    private $mail; 

    /**
     * @ORM\Column(type="integer", nullable=true) 
     * @ORM\OneToMany(targetEntity="App\Entity\Memo", mappedBy="Utilisateur")
     */
    public $Memo;



    //Setter and getter
    //id
    public function getId()
    {
        return $this->id;
    }

    public function setId($id)
    {
        $this->id = $id;
    }


    //pseudo
    public function getPseudo()
    {
        return $this->pseudo;
    }

    public function setPseudo($pseudo)
    {
        $this->pseudo = $pseudo;
    }

    //password
    public function getPassword()
    {
        return $this->password;
    }

    public function setPassword($password)
    {
        $this->password = $password;
    }


    //mail
    public function getMail()
    {
        return $this->mail;
    }

    public function setMail($mail)
    {
        $this->mail = $mail;
    }

}
