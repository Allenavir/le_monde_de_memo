<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * @ORM\Entity(repositoryClass="App\Repository\MemoRepository")
 */
class Memo
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    
    /**
     * @Assert\NotBlank()
     * @ORM\Column(type="string", length=255)
     */
    private $titre;


     /**
     * @Assert\NotBlank()
     * @ORM\Column(type="text")
     */
    private $description;


     /**
     * @Assert\NotBlank()
     * @ORM\Column(type="string", length=255)
     */
    private $type;





    

     /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $image;


    /**     
     * @ORM\Column(type="string", length=255,nullable=true)
     */
    private $auteur;


    /**     
     * @ORM\Column(type="string", length=255,nullable=true)
     */
    private $genre;

    /**     
    * @ORM\Column(type="string", length=255,nullable=true)
     */
    private $acteurs;

     /**
     * @ORM\Column(type="date")
     */
    private $date;

    /**     
     * @ORM\Column(type="string", length=255,nullable=true)
     */
    private $lienInfo;

    /**     
    * @ORM\Column(type="string", length=255,nullable=true)
     */
    private $lienStream;

    /**     
    * @ORM\Column(type="string", length=255,nullable=true)
     */
    private $lienChoix;


    /**
     * @ORM\Column(type="text",nullable=true)
     */
    private $supplement;




    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Utilisateur", inversedBy="Memo")
     * @ORM\JoinColumn(nullable=false)
     */
    private $utilisateur;




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


    //titre
    public function getTitre()
    {
        return $this->titre;
    }

    public function setTitre($titre)
    {
        $this->titre = $titre;
    }

    //type
    public function getType()
    {
        return $this->type;
    }

    public function setType($type)
    {
        $this->type = $type;
    }

    //description
    public function getDescription()
    {
        return $this->description;
    }

    public function setDescription($description)
    {
        $this->description = $description;
    }


    //Image
    public function getImage()
    {
        return $this->image;
    }

    public function setImage($image)
    {
        $this->image = $image;
    }

      //auteur
      public function getAuteur()
      {
          return $this->auteur;
      }
  
      public function setAuteur($auteur)
      {
          $this->auteur = $auteur;
      }

        //genre
    public function getGenre()
    {
        return $this->genre;
    }

    public function setGenre($genre)
    {
        $this->genre = $genre;
    }

      //acteur
      public function getActeurs()
      {
          return $this->acteurs;
      }
  
      public function setActeurs($acteurs)
      {
          $this->acteurs = $acteurs;
      }


    //date
    public function getDate()
    {
        return $this->date;
    }

    public function setDate($date)
    {
        $this->date = $date;
    }
    
      //lineInfo
      public function getLienInfo()
      {
          return $this->lienInfo;
      }
  
      public function setLienInfo($lienInfo)
      {
          $this->lienInfo = $lienInfo;
      }


       //lineStream
       public function getLienStream()
       {
           return $this->lienStream;
       }
   
       public function setLienStream($lienStream)
       {
           $this->lienStream = $lienStream;
       }

        //lineChoix
      public function getLienChoix()
      {
          return $this->lienChoix;
      }
  
      public function setLienChoix($lienChoix)
      {
          $this->lienChoix = $lienChoix;
      }

       //supplement
       public function getsupplement()
       {
           return $this->supplement;
       }
   
       public function setsupplement($supplement)
       {
           $this->supplement = $supplement;
       }

        //utilisateur
        public function getUtilisateur()
        {
            return $this->utilisateur;
        }
    
        public function setUtilisateur($utilisateur)
        {
            $this->utilisateur = $utilisateur;
        }

        









    
}
