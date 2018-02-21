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

  

}
